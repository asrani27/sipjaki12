<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peraturan = Peraturan::latest()->paginate(10);
        return view('superadmin.peraturan.index', compact('peraturan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.peraturan.create');
    }

    /**
     * Handle TUS protocol file upload.
     */
    public function tusUpload(Request $request)
    {
        // Increase PHP execution time and memory limit for large uploads
        set_time_limit(3600); // 1 hour
        ini_set('memory_limit', '512M');
        ini_set('post_max_size', '20M');
        ini_set('upload_max_filesize', '20M');
        
        // Check if this is a TUS protocol request
        $method = $request->method();
        $tusResumable = $request->header('Tus-Resumable');
        
        if ($tusResumable !== '1.0.0') {
            return response('', 400);
        }

        // Get upload metadata
        $uploadLength = $request->header('Upload-Length');
        $uploadOffset = $request->header('Upload-Offset', 0);
        $uploadMetadata = $request->header('Upload-Metadata', '');
        
        // Parse metadata
        $metadata = [];
        if ($uploadMetadata) {
            $pairs = explode(',', $uploadMetadata);
            foreach ($pairs as $pair) {
                $parts = explode(' ', $pair, 2);
                if (count($parts) === 2) {
                    $key = $parts[0];
                    $value = $parts[1];
                    $metadata[$key] = base64_decode($value);
                }
            }
        }

        // Generate unique file ID based on metadata
        $filename = $metadata['filename'] ?? 'peraturan-' . uniqid();
        $fileId = md5($filename);
        $tempPath = storage_path('app/tus-uploads/' . $fileId);
        $metadataPath = storage_path('app/tus-uploads/' . $fileId . '.meta');
        
        // Ensure temp directory exists
        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        // Handle POST (create upload)
        if ($method === 'POST') {
            // Validate upload length
            if (!$uploadLength) {
                return response('', 400);
            }
            
            // Create empty file
            file_put_contents($tempPath, '');
            
            // Store metadata alongside the file
            file_put_contents($metadataPath, json_encode([
                'filename' => $filename,
                'uploadLength' => $uploadLength,
                'filetype' => $metadata['filetype'] ?? 'application/octet-stream',
                'createdAt' => time()
            ]));
            
            // Return upload URL with Location header
            $uploadUrl = url('/superadmin/peraturan/tus-upload/' . $fileId);
            
            return response('', 201)
                ->header('Location', $uploadUrl)
                ->header('Tus-Resumable', '1.0.0')
                ->header('Upload-Length', $uploadLength)
                ->header('Upload-Offset', '0');
        }

        // Handle PATCH (continue upload)
        if ($method === 'PATCH') {
            $fileId = $request->route('file_id');
            $tempPath = storage_path('app/tus-uploads/' . $fileId);
            $metadataPath = storage_path('app/tus-uploads/' . $fileId . '.meta');
            
            // Check if file exists
            if (!file_exists($tempPath)) {
                return response('', 404);
            }

            // Load metadata
            $uploadMetadata = [];
            if (file_exists($metadataPath)) {
                $metadataContent = file_get_contents($metadataPath);
                $uploadMetadata = json_decode($metadataContent, true) ?? [];
                $uploadLength = $uploadMetadata['uploadLength'] ?? $uploadLength;
            }

            // Get current file size
            $currentSize = filesize($tempPath);
            
            // Check if offset matches
            if ($currentSize != $uploadOffset) {
                return response('', 409);
            }

            // Append chunk data
            $content = $request->getContent();
            $fp = fopen($tempPath, 'a');
            if (flock($fp, LOCK_EX)) { // Acquire exclusive lock
                fwrite($fp, $content);
                flock($fp, LOCK_UN); // Release lock
            }
            fclose($fp);
            
            // Get new file size
            clearstatcache(true, $tempPath);
            $newSize = filesize($tempPath);
            
            // Check if upload is complete
            $expectedSize = (int)$uploadLength;
            if ($newSize >= $expectedSize) {
                // Upload complete, move to S3
                $filename = $uploadMetadata['filename'] ?? 'peraturan-' . $fileId . '.pdf';
                
                // Determine file extension from filename
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                if (in_array($extension, ['doc', 'docx'])) {
                    $mimeType = 'application/msword';
                } elseif ($extension === 'pdf') {
                    $mimeType = 'application/pdf';
                } else {
                    $mimeType = $uploadMetadata['filetype'] ?? 'application/octet-stream';
                }
                
                try {
                    // Upload to S3 - putFileAs returns the full path
                    $s3Path = Storage::disk('s3')->putFileAs(
                        'sipjaki',
                        $tempPath,
                        $filename,
                        [
                            'visibility' => 'public',
                            'mimetype' => $mimeType
                        ]
                    );
                    
                    // Store the S3 path in a session for the store method
                    session(['tus_upload_path_' . $fileId => basename($s3Path)]);
                    
                } catch (\Exception $e) {
                    // Log error but still clean up
                    Log::error('S3 upload failed: ' . $e->getMessage());
                    return response('', 500);
                }
                
                // Clean up temp files
                if (file_exists($tempPath)) {
                    unlink($tempPath);
                }
                if (file_exists($metadataPath)) {
                    unlink($metadataPath);
                }
                
                // Return success with final offset
                return response('', 204)
                    ->header('Tus-Resumable', '1.0.0')
                    ->header('Upload-Offset', (string)$newSize)
                    ->header('Upload-Expires', gmdate('D, d M Y H:i:s T', time() + 86400));
            }
            
            // Upload not complete, return current offset
            return response('', 204)
                ->header('Tus-Resumable', '1.0.0')
                ->header('Upload-Offset', (string)$newSize)
                ->header('Upload-Expires', gmdate('D, d M Y H:i:s T', time() + 86400));
        }

        // Handle HEAD (check upload status)
        if ($method === 'HEAD') {
            $fileId = $request->route('file_id');
            $tempPath = storage_path('app/tus-uploads/' . $fileId);
            $metadataPath = storage_path('app/tus-uploads/' . $fileId . '.meta');
            
            if (!file_exists($tempPath)) {
                return response('', 404);
            }
            
            // Load metadata
            $uploadMetadata = [];
            if (file_exists($metadataPath)) {
                $metadataContent = file_get_contents($metadataPath);
                $uploadMetadata = json_decode($metadataContent, true) ?? [];
                $uploadLength = $uploadMetadata['uploadLength'] ?? $uploadLength;
            }
            
            $currentSize = filesize($tempPath);
            
            return response('', 200)
                ->header('Tus-Resumable', '1.0.0')
                ->header('Upload-Offset', (string)$currentSize)
                ->header('Upload-Length', (string)$uploadLength)
                ->header('Upload-Expires', gmdate('D, d M Y H:i:s T', time() + 86400));
        }

        return response('', 405);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_path' => 'nullable|string',
            'kategori' => 'required|in:UNDANG-UNDANG,PERATURAN PEMERINTAH,PERATURAN PRESIDEN,PERATURAN MENTERI,KEPUTUSAN MENTERI,SURAT EDARAN MENTERI,REFERENSI,PERATURAN DAERAH,PERATURAN GUBERNUR,PERATURAN WALIKOTA,SURAT KEPUTUSAN',
        ]);

        $data = $request->except(['file', 'file_path']);

        // Handle TUS upload file path
        if ($request->filled('file_path')) {
            // Extract file_id from the filename (which was generated as 'peraturan-{timestamp}-{random}.{ext}')
            // The JS generates: 'peraturan-' + Date.now() + '-' + random + extension
            // We need to find the S3 path that was stored in session during TUS upload
            $filename = $request->file_path;
            $fileId = md5($filename);
            $s3Filename = session('tus_upload_path_' . $fileId);
            
            if ($s3Filename) {
                $data['file'] = $s3Filename;
                // Clear the session value
                session()->forget('tus_upload_path_' . $fileId);
            } else {
                // Fallback to using the filename directly if session is lost
                $data['file'] = $filename;
            }
        } elseif ($request->hasFile('file')) {
            // Fallback to traditional upload
            $file = $request->file('file');
            $fileName = 'peraturan-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('s3')->putFileAs('sipjaki', $file, $fileName);
            $data['file'] = basename($path);
        }

        Peraturan::create($data);

        return redirect()->route('superadmin.peraturan.index')
            ->with('success', 'Peraturan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peraturan $peraturan)
    {
        return view('superadmin.peraturan.edit', compact('peraturan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peraturan $peraturan)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'kategori' => 'required|in:UNDANG-UNDANG,PERATURAN PEMERINTAH,PERATURAN PRESIDEN,PERATURAN MENTERI,KEPUTUSAN MENTERI,SURAT EDARAN MENTERI,REFERENSI,PERATURAN DAERAH,PERATURAN GUBERNUR,PERATURAN WALIKOTA,SURAT KEPUTUSAN',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Hapus file lama dari S3
            if ($peraturan->file) {
                Storage::disk('s3')->delete('sipjaki/' . $peraturan->file);
            }

            // Upload file baru ke S3
            $file = $request->file('file');
            $fileName = 'peraturan-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('s3')->putFileAs('sipjaki', $file, $fileName);
            $data['file'] = basename($path);
        }

        $peraturan->update($data);

        return redirect()->route('superadmin.peraturan.index')
            ->with('success', 'Peraturan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peraturan $peraturan)
    {
        // Hapus file dari S3 jika ada
        if ($peraturan->file) {
            Storage::disk('s3')->delete('sipjaki/' . $peraturan->file);
        }

        $peraturan->delete();

        return redirect()->route('superadmin.peraturan.index')
            ->with('success', 'Peraturan berhasil dihapus.');
    }
}

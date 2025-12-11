<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = Slide::latest()->get();
        return view('superadmin.slideshow.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.slideshow.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Store the file in the public/slides directory
            $filePath = $file->storeAs('slides', $fileName, 'public');

            Slide::create([
                'file' => $filePath,
            ]);

            return redirect()->route('superadmin.slideshow.index')
                ->with('success', 'Slide berhasil ditambahkan!');
        }

        return redirect()->back()
            ->with('error', 'Gagal mengupload slide!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slide $slide)
    {
        // Delete the file from storage if it exists
        if ($slide->file && Storage::disk('public')->exists($slide->file)) {
            Storage::disk('public')->delete($slide->file);
        }

        // Delete the record from database
        $slide->delete();

        return redirect()->route('superadmin.slideshow.index')
            ->with('success', 'Slide berhasil dihapus!');
    }
}

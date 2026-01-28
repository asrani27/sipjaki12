import * as tus from 'tus-js-client';

export function initTusUpload() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const progressContainer = document.getElementById('progressContainer');
    const progressFill = document.getElementById('progressFill');
    const progressPercentage = document.getElementById('progressPercentage');
    const progressStatus = document.getElementById('progressStatus');
    const uploadStatus = document.getElementById('uploadStatus');
    const uploadBtn = document.getElementById('uploadBtn');
    const submitBtn = document.getElementById('submitBtn');
    const filePathInput = document.getElementById('file_path');
    const peraturanForm = document.getElementById('peraturanForm');

    if (!uploadArea) return;

    let selectedFile = null;
    let upload = null;

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Click on upload area
    uploadArea.addEventListener('click', function() {
        fileInput.click();
    });

    // Drag and drop handlers
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function() {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFileSelect(files[0]);
        }
    });

    // File input change
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    // Handle file selection
    function handleFileSelect(file) {
        // Validate file type
        const allowedTypes = ['.pdf', '.doc', '.docx'];
        const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
        
        if (!allowedTypes.includes(fileExtension)) {
            alert('Format file tidak didukung. Harap upload file PDF, DOC, atau DOCX.');
            return;
        }

        // Validate file size (10MB = 10 * 1024 * 1024 bytes)
        const maxSize = 10 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar. Maksimal 10MB.');
            return;
        }

        selectedFile = file;
        
        // Display file info
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        fileInfo.classList.add('active');
        
        // Enable upload button
        uploadBtn.disabled = false;
        
        // Reset progress
        progressContainer.classList.remove('active');
        uploadStatus.textContent = '';
        uploadStatus.className = 'upload-status';
    }

    // Upload button click
    uploadBtn.addEventListener('click', function() {
        if (!selectedFile) {
            alert('Silakan pilih file terlebih dahulu.');
            return;
        }
        
        startUpload(selectedFile);
    });

    // Start TUS upload
    function startUpload(file) {
        // Disable button during upload
        uploadBtn.disabled = true;
        submitBtn.disabled = true;
        
        // Show progress
        progressContainer.classList.add('active');
        uploadStatus.textContent = 'Mengupload file...';
        uploadStatus.className = 'upload-status uploading';
        
        // Generate unique filename
        const fileName = 'peraturan-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9) + '.' + file.name.split('.').pop();
        
        // Get endpoint from data attribute
        const endpoint = uploadArea.dataset.endpoint || '/superadmin/peraturan/tus-upload';
        
        // Get CSRF token from meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        // Create TUS upload
        upload = new tus.Upload(file, {
            endpoint: endpoint,
            retryDelays: [0, 1000, 3000, 5000],
            headers: {
                'X-CSRF-TOKEN': csrfToken || ''
            },
            metadata: {
                filename: fileName,
                filetype: file.type,
            },
            chunkSize: 5 * 1024 * 1024, // 5MB chunks
            uploadSize: file.size,
            onError: function(error) {
                console.error('Upload failed:', error);
                uploadStatus.textContent = 'Upload gagal: ' + error.message;
                uploadStatus.className = 'upload-status error';
                uploadBtn.disabled = false;
                submitBtn.disabled = false;
            },
            onProgress: function(bytesUploaded, bytesTotal) {
                const percentage = Math.round((bytesUploaded / bytesTotal) * 100);
                progressFill.style.width = percentage + '%';
                progressPercentage.textContent = percentage + '%';
                progressStatus.textContent = formatFileSize(bytesUploaded) + ' / ' + formatFileSize(bytesTotal);
            },
            onSuccess: function() {
                console.log('Upload finished:', upload.url);
                
                // Extract file path from URL
                const urlParts = upload.url.split('/');
                const filePath = urlParts[urlParts.length - 1];
                
                // Store file path in hidden input
                filePathInput.value = fileName;
                
                uploadStatus.textContent = 'Upload berhasil!';
                uploadStatus.className = 'upload-status success';
                uploadBtn.disabled = false;
                submitBtn.disabled = false;
            }
        });

        // Start the upload
        upload.start();
    }

    // Form submission validation
    if (peraturanForm) {
        peraturanForm.addEventListener('submit', function(e) {
            if (!filePathInput.value) {
                e.preventDefault();
                alert('Silakan upload file terlebih dahulu.');
                return;
            }
        });
    }
}
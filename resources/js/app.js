import './bootstrap';
import { initTusUpload } from './tus-upload';

// Initialize TUS upload on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    initTusUpload();
});

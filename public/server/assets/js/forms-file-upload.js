const fileInput = document.getElementById('foto_berita');
const previewImg = document.getElementById('preview-img');
const dropzoneText = document.getElementById('dropzone-text');
const dropzoneBox = document.getElementById('dropzone-box');
const removeBtn = document.getElementById('remove-preview');
const previewWrapper = document.getElementById('image-preview-wrapper');

// Click untuk memilih file
dropzoneBox.addEventListener('click', (e) => {
    // Cegah klik pada tombol hapus membuka file picker
    if (e.target !== removeBtn) {
        fileInput.click();
    }
});

// File dipilih via dialog
fileInput.addEventListener('change', previewImage);

// Drag & Drop
dropzoneBox.addEventListener('dragover', function (e) {
    e.preventDefault();
    dropzoneBox.classList.add('dragover');
});

dropzoneBox.addEventListener('dragleave', function () {
    dropzoneBox.classList.remove('dragover');
});

dropzoneBox.addEventListener('drop', function (e) {
    e.preventDefault();
    dropzoneBox.classList.remove('dragover');
    fileInput.files = e.dataTransfer.files;
    previewImage({ target: fileInput });
});

// Preview Gambar
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        previewImg.src = URL.createObjectURL(file);
        previewWrapper.style.display = 'block';
        dropzoneText.style.display = 'none';
    }
}

// Hapus gambar
removeBtn.addEventListener('click', (e) => {
    e.stopPropagation(); // Jangan trigger klik dropzone
    fileInput.value = '';
    previewImg.src = '';
    previewWrapper.style.display = 'none';
    dropzoneText.style.display = 'block';
});

// Event change untuk #jenis_link
$('#jenis_link').change(function () {
    const jenis_link = $('#jenis_link').val();
    const editor = document.getElementById('content-editor');
    const cardSubPage = document.getElementById('card-subpage');
    const formSubPage = document.getElementById('form-subpage');

    if (jenis_link === 'non-link') {
        // Sembunyikan input link dan label
        $('#label-link').attr('hidden', true);
        $('#link').addClass('hidden');

        // Tampilkan editor konten
        editor.classList.remove('hidden');

        // Ubah layout kolom
        cardSubPage.classList.remove('col-md-5');
        formSubPage.classList.remove('col-md-12');
        formSubPage.classList.add('col-md-5');

        // Tampilkan grup PDF
        $('#pdf-file-group').addClass('show');
    } else {
        // Tampilkan input link dan label
        $('#link').removeClass('hidden');
        $('#label-link').removeAttr('hidden');

        // Sembunyikan editor konten
        editor.classList.add('hidden');

        // Ubah layout kolom
        cardSubPage.classList.add('col-md-5');
        formSubPage.classList.remove('col-md-5');
        formSubPage.classList.add('col-md-12');

        // Sembunyikan grup PDF
        $('#pdf-file-group').removeClass('show');
    }
});


// Dropzone untuk upload PDF
const pdfDropzone = document.getElementById('pdf-dropzone');
const pdfInput = document.getElementById('pdfInput');
const pdfPreview = document.getElementById('pdfPreview');
const pdfWrapper = document.getElementById('pdf-preview-wrapper');
const dropText = document.getElementById('pdf-drop-text');
const removeBtn = document.getElementById('remove-pdf');

// Fungsi untuk preview PDF dari file
function previewPDF(file) {
    const fileURL = URL.createObjectURL(file);
    pdfPreview.src = fileURL;
    pdfWrapper.style.display = 'block';
    pdfWrapper.scrollIntoView({ behavior: 'smooth' }); // scroll otomatis ke preview
    if (dropText) dropText.style.display = 'none';
}

// Fungsi untuk preview PDF dari URL (file lama)
function previewOldPDF(url) {
    if (!url) return;
    pdfPreview.src = url;
    pdfWrapper.style.display = 'block';
    if (dropText) dropText.style.display = 'none';
}

pdfDropzone.addEventListener('click', () => {
    pdfInput.click();
});

pdfDropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    pdfDropzone.style.borderColor = '#007bff';
});

pdfDropzone.addEventListener('dragleave', () => {
    pdfDropzone.style.borderColor = '#ccc';
});

pdfDropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    pdfDropzone.style.borderColor = '#ccc';
    const files = e.dataTransfer.files;
    if (files.length > 0 && files[0].type === "application/pdf") {
        pdfInput.files = files;
        previewPDF(files[0]);
    }
});

pdfInput.addEventListener('change', () => {
    if (pdfInput.files.length > 0) {
        const file = pdfInput.files[0];
        if (file.type === "application/pdf") {
            previewPDF(file);
        }
    }
});

removeBtn.addEventListener('click', () => {
    pdfInput.value = '';
    pdfPreview.src = '';
    pdfWrapper.style.display = 'none';
    if (dropText) dropText.style.display = 'block';
});

// --- Preview otomatis file PDF lama dari atribut data-old-pdf-url ---
document.addEventListener('DOMContentLoaded', () => {
    const oldPdfUrl = pdfWrapper.getAttribute('data-old-pdf-url');
    if (oldPdfUrl) {
        previewOldPDF(oldPdfUrl);
    }
});

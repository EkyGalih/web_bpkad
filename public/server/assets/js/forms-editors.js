/**
 * Form Editors
 */

'use strict';

(function () {
    // Full Toolbar
    // --------------------------------------------------------------------
    const fullToolbar = [
        [
            {
                font: []
            },
            {
                size: []
            }
        ],
        ['bold', 'italic', 'underline', 'strike'],
        [
            {
                color: []
            },
            {
                background: []
            }
        ],
        [
            {
                script: 'super'
            },
            {
                script: 'sub'
            }
        ],
        [
            {
                header: '1'
            },
            {
                header: '2'
            },
            'blockquote',
            'code-block'
        ],
        [
            {
                list: 'ordered'
            },
            {
                indent: '-1'
            },
            {
                indent: '+1'
            }
        ],
        [{ direction: 'rtl' }, { align: [] }],
        ['link', 'image', 'video', 'formula'],
        ['clean']
    ];

    const fullEditorElem = document.getElementById('full-editor');
    const fullEditor = new Quill('#full-editor', {
        bounds: '#full-editor',
        placeholder: 'Tulis sesuatu disini...',
        modules: {
            syntax: true,
            toolbar: fullToolbar
        },
        theme: 'snow'
    });

    const form = document.getElementById('form-post');
    const quillContentInput = document.getElementById('quill-content');

    form.addEventListener('submit', function (e) {
        // Ambil konten HTML dari editor Quill
        const htmlContent = fullEditor.root.innerHTML;

        // Masukkan ke input hidden
        quillContentInput.value = htmlContent;

        // Form akan submit setelah ini dan kirimkan field 'content' ke backend
    });
})();

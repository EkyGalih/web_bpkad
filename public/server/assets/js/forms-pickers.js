/**
 * Form Picker
 */

'use strict';

(function () {
    const flatpickrDateTime = document.querySelector('#waktu-upload');

    if (flatpickrDateTime) {
        flatpickrDateTime.flatpickr({
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            static: false, // ubah dari true ke false
            position: 'above', // munculkan di atas
            appendTo: document.body // agar tidak tertutup container lain
        });
    }
})();


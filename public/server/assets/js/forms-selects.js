/**
 * Selects & Tags
 */

'use strict';

$(function () {
    const selectPicker = $('.selectpicker'),
        select2 = $('.select2')

    // Select2
    // --------------------------------------------------------------------

    // Default
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            select2Focus($this);
            $this.select2({
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            });
        });
    }
});

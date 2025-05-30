/**
 * Tagify
 */

'use strict';

(function () {

    // Custom list & inline suggestion
    const tagifyCustomInlineSuggestionEl = document.querySelector('#TagifyCustomInlineSuggestion');

    const whitelist = window.availableTags || [];

    // Inline
    if (tagifyCustomInlineSuggestionEl) {
        const tagifyCustomInlineSuggestion = new Tagify(tagifyCustomInlineSuggestionEl, {
            whitelist: whitelist,
            maxTags: 10,
            dropdown: {
                maxItems: 30,
                classname: 'tags-inline',
                enabled: 0,
                closeOnSelect: false
            }
        });
    }
})();

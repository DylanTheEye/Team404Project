// add.js - image preview + size check for the "Gerecht toevoegen" page
document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('afbeelding');
    var box = document.getElementById('uploadBox');
    var preview = document.getElementById('uploadPreview');
    if (!input || !box || !preview) return;

    var maxBytes = parseInt(input.getAttribute('data-max-bytes'), 10) || 0;
    var currentUrl = null;

    input.addEventListener('change', function () {
        var file = input.files && input.files[0];

        if (currentUrl) {
            URL.revokeObjectURL(currentUrl);
            currentUrl = null;
        }

        if (!file) {
            preview.removeAttribute('src');
            box.classList.remove('has_image');
            input.setCustomValidity('');
            return;
        }

        if (maxBytes && file.size > maxBytes) {
            input.setCustomValidity('De afbeelding is te groot (maximaal ' + Math.round(maxBytes / 1048576) + ' MB).');
            input.reportValidity();
            input.value = '';
            preview.removeAttribute('src');
            box.classList.remove('has_image');
            return;
        }

        input.setCustomValidity('');
        currentUrl = URL.createObjectURL(file);
        preview.src = currentUrl;
        box.classList.add('has_image');
    });
});
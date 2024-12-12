//-------------------------------------
// Extend Menu Functionality
//-------------------------------------
document.addEventListener('DOMContentLoaded', function() {
    var iconButtons = document.querySelectorAll('.menu-item-icon-button');
    iconButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var container = this.closest('.menu-item-icon-container');
            var iconInput = container.querySelector('.menu-item-icon');
            var imagePreview = container.querySelector('.menu-item-icon-preview');

            var custom_uploader = wp.media.frames.file_frame = wp.media({
                title: "Choose Icon",
                button: {
                    text: "Choose Icon"
                },
                multiple: false
            });

            custom_uploader.on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                iconInput.value = attachment.id;
                imagePreview.src = attachment.url;
                imagePreview.style.display = 'inline-block';
            });

            custom_uploader.open();
        });
    });

    const menuItems = document.querySelectorAll('.primary-menu > li');
    menuItems.forEach(function(item) {
        item.addEventListener('click', function(e) {
            if (!e.target.closest('a') || e.target.closest('.primary-menu > li > a')) {
                e.preventDefault();
                item.classList.toggle('open');
            }
        });
    });
});
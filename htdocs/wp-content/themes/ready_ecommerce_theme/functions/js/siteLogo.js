jQuery(document).ready(function() {
    var logofield = 'ready_site_logo';
    jQuery('#btn-upload-logo').click(function() {
        jQuery('html').addClass('image');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&width=640&height=480');
        return false;
    });
    jQuery('#btn-delete-logo').click(function() {
        jQuery('#image-logo').attr('src','#');
        jQuery('#site-logo').val('');
    });
    window.old_send_to_editor = window.send_to_editor;
    window.send_to_editor = function(html) {
        if (logofield) {
            url = jQuery('img', html).attr('src');
            jQuery('#site-logo').val(url);
            thumb = jQuery('#image-logo');
            if (url != '') {            
                thumb.show();
                thumb.attr('src', url);
            } else {
                thumb.hide();
            }
            jQuery('html').removeClass('image');
        } else {
            window.old_send_to_editor(html);
        }
        tb_remove();
    }
});

jQuery(document).ready(function($) { 
 jQuery('div').on('click', '.cavcolorpicker', function(event,ui){	
   if( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ){
         jQuery( '.cavcolorpicker' ).wpColorPicker();
     }else {
     	jQuery('.cavcolorpicker').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            jQuery(el).val('#'+hex);
            jQuery(el).ColorPickerHide();
        },
        onBeforeShow: function () {
            jQuery(this).ColorPickerSetColor(this.value);
        },
        onChange: function (hsb, hex, rgb) {
          /* jQuery(this).val('#' + hex); */ 
        }
    }); 
   }
    });
   
});
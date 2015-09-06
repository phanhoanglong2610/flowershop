function social_links_ajax_addNetwork(){
    var siteID = jQuery("#networkDropdown").val();
    var data = {
        siteID : siteID,
        value  : jQuery("#addSettingInput").val(),
        action : 'social_links_add_network'
    }
    jQuery.post(ajaxurl, data, function(response){
        jQuery("#sl_message").html(response.result).removeAttr('class').addClass("updated fade").css('visibility', 'visible');
        if (response.html != '') {
            jQuery("#displayDiv").html(response.html);
            jQuery("#addSettingInput").val('');
            jQuery("#networkDropdown").val('');
        }
    }, 'json');
}

jQuery(document).ready(function(){
   jQuery("#displayDiv").ajaxStart(function(){
       jQuery("#preview .ajax-loader").show();
   })
   jQuery("#displayDiv").ajaxStop(function(){
        jQuery("#preview .ajax-loader").hide();
   });
   jQuery("#networkDropdown").change(function(){
       	var label = jQuery("#instruction");
	var settingInput = jQuery("#addSettingInput");
	var addButton = jQuery("#addButton");
	if (jQuery(this).val() != 0) {
            var currentSelection = jQuery('option',this).filter(':selected');
            label.html(currentSelection.attr('instruction'));
            addButton.removeAttr('disabled');
            settingInput.val('');
        } else {
            label.html('');
            settingInput.val('');
            addButton.attr('disabled', 'disabled');
        }
   }); 
   jQuery("#addSettingInput").keydown(function(event){
       if(event.keyCode == 13){
           social_links_ajax_addNetwork();
       }
   });
   jQuery("#addButton").click(function(){
          social_links_ajax_addNetwork();
   });
   jQuery("#displayDiv").sortable({ 
        items: 'span',
        cursor: 'move', 
        forcePlaceholderSize: true,
        update: function(event, ui) {
            var links = [];
            jQuery('#displayDiv span').each(function(index){
                    link_id = jQuery(this).attr('id');
                    link_id = link_id.replace("link_", "");
                    links[index] = link_id;
            });
           var data = {
                links : links,
                action : 'social_links_sort_networks'
           };
           jQuery.post(ajaxurl,data, function(response){
                jQuery("#sl_message").html(response).removeAttr('class').addClass("updated fade");
           });
        }
    });
    jQuery('#trash').droppable({
            drop: function( event, ui ) {
                    link = ui.draggable.attr('id');
                    link = parseInt(link.replace('link_',''));
                    var data = {
                      link_id    : link,
                      action    : 'social_links_delete_network'
                    };
                    jQuery.post(ajaxurl,data,function(response){
                            ui.draggable.remove();
                            jQuery("#trash").css('background', '#FFFFFF').css('border','1px solid #DFDFDF');
                            jQuery("#sl_message").html(response);
                    });
            }, 
            over : function ( event , ui) {
                    jQuery(this).css('background', '#FBF9EA').css('border','1px solid #D54321');
            },
            out : function ( event, ui) {
                    jQuery(this).css('background', '#FFFFFF').css('border','1px solid #DFDFDF');
            }
    });

    jQuery('#displayDiv span').draggable({ 
            cursor: 'move', 
            helper: 'clone', 
            start : function ( event , ui) {
                    ui.helper.css('border','1px solid #D54321').css('background', '#FFFFFF'); 
            }			
    });
});   
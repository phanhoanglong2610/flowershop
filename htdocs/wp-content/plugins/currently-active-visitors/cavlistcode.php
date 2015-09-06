jQuery(document).ready(function($) {

 function display_cav_list_<?php print $cav_list_id; ?>(){   
  var cavlobject={};
  cavlobject.sid=null;
  
  cavlobject.successListData = function (data){
    $('#cav_list_<?php print $cav_list_id; ?>').html(data);
  }
      
  cavlobject.loadData = function(){
       $.ajax({
          type: 'POST',    
          url: '<?php print RAV_CAV_AJAX_PATH; ?>',
          data:{action: 'cav_action',cavnonce:'<?php print $cav_visit_nonce; ?>',cavtype:5, cavmax:<?php print $cav_list_options['max']; ?>, cavflag:<?php print $cav_list_options['flag']; ?>, cavcity:'<?php print $cav_list_options['city']; ?>', cavstate:'<?php print $cav_list_options['state']; ?>', cavcountry:'<?php print $cav_list_options['country']; ?>'},
          cache:false, 
          success: cavlobject.successListData,
          error:function(jqXHR, textStatus, errorThrown){ }
        });  
     }
  
  cavlobject.loadData();
  cavlobject.sid=setInterval(cavlobject.loadData,<?php print $cav_list_options['refresh']*1000; ?>);    
 }

display_cav_list_<?php print $cav_list_id; ?>();
});
  
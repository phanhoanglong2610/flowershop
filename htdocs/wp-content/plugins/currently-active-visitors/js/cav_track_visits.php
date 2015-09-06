jQuery(document).ready(function($) {

$.ajax({ 
type: 'POST', 
url: cav_visits.cav_ajaxurl, 
data:{cavvid:cav_visits.cav_visitor_id, 
     cavcity: cav_visits.cavcity,
     cavregion: cav_visits.cavregion,
     cavcountry: cav_visits.cavcountry,
     cavcountrycode:  cav_visits.cavcountrycode,
     action: 'cav_action',
     cavnonce: cav_visits.cav_nonce,
     cavtype:1}, 
success: function(data){ }});

});

jQuery(window).bind('beforeunload', function(e) {  
 jQuery.ajax({ 
 type: 'POST', 
 url: cav_visits.cav_ajaxurl, 
 data:{cavvid:cav_visits.cav_visitor_id, 
     action: 'cav_action',
     cavnonce: cav_visits.cav_nonce,
     async: false,
     cavtype:2
     }, 
 success: function(data){ }}); 
});


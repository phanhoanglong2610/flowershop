<?php
	header( "Content-Type:text/javascript" );
?>
jQuery(document).ready(function($) {

var config = {    
		accept: 'page-item',
		noNestingClass: "no-nesting",
		opacity: 0.5,
		helperclass: 'reorder-highlight',
		onChange: function(serialized) {
			reorderData = serialized[0].hash;
		},
		autoScroll: true
};

// submit new order
$(".submit-reorder").click(function() {	
	//if the list has been reordered -- not the case when page first loads
	if ( typeof( window[ 'reorderData' ] ) != "undefined" ) {
		$('span.reorder-loading').show().html('<img src="../wp-content/themes/<?php echo basename(dirname(dirname(dirname(__file__))));?>/lib/reorder/loading.gif" />');
		
		$.post('../wp-content/themes/<?php echo basename(dirname(dirname(dirname(__file__))));?>/lib/reorder/process-sortable.php', reorderData, function(data) {
			$('span.reorder-loading').html('Updated').delay('300').fadeOut();
		});		
	} else {
		$('span.reorder-loading').show().html('Updated').delay('300').fadeOut();
	}	
	return false;
});

$('#order-posts-list-nested').NestedSortable(config);
$('#order-posts-list').Sortable(config);

});
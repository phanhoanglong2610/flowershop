<script type="text/javascript">
// <!--
    if(typeof(toeNavigationItems) == 'undefined') {
        var toeNavigationItems = new Array();
    }
    toeNavigationItems = <?php echo utils::jsonEncode($this->steps)?>;
    jQuery(document).ready(function(){
        var itemWasSelected = false;
        for(id in toeNavigationItems) {
            if(toeNavigationItems[id]['selected']) {
                toeSetNavigationSelected(id, 0);
                itemWasSelected = true;
            }
            if(!itemWasSelected)
                toeSetNavigationPassed(id);
        }
    });
// -->
</script>
<div id="checkPointContainer">
    <div class="navBar"><div></div></div>
    <div class="toeCheckoutNavItems">
    <?php foreach($this->steps as $key => $s) { ?>
    <div class="toeCheckoutNavigationItem">        
        <div class="toeCheckoutNavigationItemPoint <?php echo $key?>"><div class="point"></div></div>
        <div class="toeCheckoutNavigationItemText"><?php echo $s['label']?></div>
    </div>
    <?php }?>
    </div>
    <div class="toeCheckoutNavigationSelected" style="display: none;">&nbsp;</div>
    <div class="clr"></div>
</div>

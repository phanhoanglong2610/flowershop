<?php if(isset($this->oldPrice)) { ?>
    <span class="oldPrice"><s><?php echo frame::_()->getModule('currency')->display($this->oldPrice)?></s></span>
<?php }?>
<span class="newPrice">
	<?php if($this->showFromPriceLabel) { ?>
		<?php lang::_e('From')?>
	<?php }?>
    <?php echo frame::_()->getModule('currency')->display($this->price)?>
</span>
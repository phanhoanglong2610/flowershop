<table>
<?php foreach($this->categories as $c) { ?>
	<tr>
		<td style="vertical-align: top; padding-right: 20px;">
			<?php if($imgSrc = frame::_()->getModule('products')->getCategoryImage($c)) { ?>
				<a href="<?php echo frame::_()->getModule('products')->getLinkToCategory($c, $c->slug)?>"><?php echo html::img($imgSrc, false);?></a>
			<?php } else {
				echo '&nbsp;';
			}?> 
		</td>
		<td style="vertical-align: top;">
			<h1 class="toeCategoryListTitle">
				<a href="<?php echo frame::_()->getModule('products')->getLinkToCategory($c, $c->slug)?>"><?php echo $c->name?></a>
			</h1>
			<div class="toeCategoryListDescription"><?php echo nl2br($c->description)?></div>
		</td>
	</tr>
<?php }?>
</table>
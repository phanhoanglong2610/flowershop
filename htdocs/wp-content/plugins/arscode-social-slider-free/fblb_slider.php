<?
if($options['TabPosition']=='Middle' && in_array($options['TabDesign'],array(3,6)))
{
	$fblbHead_top_margin=-30;
}
if($options['TabPosition']=='Middle' && in_array($options['TabDesign'],array(1,2,4,5)))
{
	$fblbHead_top_margin=-78;
}
if($options['TabPosition']=='Top' && in_array($options['TabDesign'],array(3,6)))
{
	$fblbHead_top_margin=($options['Height']/2)*-1;
}
if($options['TabPosition']=='Top' && in_array($options['TabDesign'],array(1,2,4,5)))
{
	$fblbHead_top_margin=($options['Height']/2)*-1;
}
if($options['TabPosition']=='Bottom' && in_array($options['TabDesign'],array(3,6)))
{
	$fblbHead_top_margin=($options['Height']/2)-60;
}
if($options['TabPosition']=='Bottom' && in_array($options['TabDesign'],array(1,2,4,5)))
{
	$fblbHead_top_margin=($options['Height']/2)-155;
}
?>
<div class="fblbCenterOuter <?=($options['VPosition']=='Fixed' ? 'fblbFixed': '')?> fblb<?=$options['Position']?>" style="<?=($options['VPosition']=='Fixed' ? 'margin-top: '.($options['VPositionPx'] ? $options['VPositionPx'] : '0').'px; ': '')?> <?=($options['Position']=='Left' ? 'left: -'.($options['Width']+$options['Border']).'px;' : 'right: -'.($options['Width']+$options['Border']).'px;')?><?=($options['ZIndex'] ? 'z-index: '.$options['ZIndex'].';': '')?>">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?=$options['TabDesign']?>">
			<div class="fblbForm" style="background: <?=$options['BorderColor']?>; height: <?=$options['Height']?>px; width: <?=$options['Width']?>px; padding: <?=($options['Position']=='Left' ? $options['Border'].'px '.$options['Border'].'px '.$options['Border'].'px 0' : $options['Border'].'px 0 '.$options['Border'].'px '.$options['Border'].'px')?>";">
				<h2 class="fblbHead" style="margin-top: <?=$fblbHead_top_margin?>px; <?=($options['Position']=='Left' ? 'left: '.($options['Width']+$options['Border']).'px;' : 'right: '.($options['Width']+$options['Border']).'px;')?>">Facebook</h2>
				<div class="fblbInner" style="background: <?=$options['BackgroundColor']?>;">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-like-box" data-colorscheme="<?=$options['ColorScheme']?>"  data-border-color="<?=$options['BorderColor']?>" data-href="<?= $options['FacebookPageURL'] ?>" data-width="<?=$options['Width']?>" data-height="<?=$options['Height']-18?>" data-show-faces="<?=($options['ShowFaces'] ? 'true' : 'false')?>" data-stream="<?=($options['ShowStream'] ? 'true' : 'false')?>" data-header="<?=($options['ShowHeader'] ? 'true' : 'false')?>"></div>
					<a style="overflow: hidden; float: <?=($options['Position']=='Left' ? 'right' : 'left')?>; text-decoration: none; color: #ffffff; margin-top: 2px; font-size: 12px; font-style: normal; font-weight: normal;" target="_blank" href="http://codecanyon.net/item/facebook-likebox-slider-for-wordpress-/1021632?ref=arscode"><?=($options['Width']>=290 ? 'Get the Facebook ' : '')?>Likebox Slider Pro for WordPress</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?phpfunction edit_details(){	$option=$_GET['edit'];		if($_GET["edit"]){		$option=$_GET['edit'];	 }	else{		$option='gfullmap_options';	}		?>	<div class="wrap"> <!--wrap div start-->		<div id="icon-themes" class="icon32"></div>		<h2> <?php _e('GoogleMap LightBox '.gfullmap_get_version().' Edit <span style="color:#1E8CBE">('.$option.')</span>' ,'gfullmap'); ?> </h2>	</div>	<!--wrap div end-->	<?php	if (isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated']=="true") {		 _e('<div class="show-message-edit updated">Settings Saved</div>','gfullmap');	} 	?>		<div class="postbox g_innerpage_container" id="gfullmap_admin" style="width:754px;">		<h3 class="hndle"><span><?php _e("Edit GoogleMap Setting's",'gfullmap'); ?></span></h3>		<div class="inside" style="padding: 15px;margin: 0;">			<form method="post" name="map_details" id="#map_details" action="options.php">							<?php 					wp_nonce_field('update-options'); 					$options = get_option($option);       				?>								<table style="width:725px;">                          					<tr>														<td> <?php _e('Check to show Image','gfullmap'); ?></td>						<td colspan="3"> <input <?php if(isset($options['g_image_chkbox'])) checked('1', $options['g_image_chkbox'],true);?> id="fwgm_chk" type="checkbox" name="<?php echo $option; ?>[g_image_chkbox]" value = "1"/> <span> <label style="font-size:11px;color:#DB1E00;" for="fwgm_chk"> <?php _e('Check it, if you want to show image instead of default map.','gfullmap') ?></label> </span> </td> 					</tr> 					 <tr>														<td> <?php _e('Insert image path','gfullmap'); ?></td>						<td colspan="2"> <input class="gfull_upload_image" style="width:220px;" type="text" size="23" name="<?php echo $option; ?>[g_image_path]" value="<?php echo $options['g_image_path'] ?>" /><input class="button-primary gfull_upload_button" type="button" value="Upload Image" /></td>					</tr>					<tr>														<td> <?php _e('Address to Show in Map','gfullmap'); ?></td>						<td> <textarea id="fwgm_add" style="width:220px;" name="<?php echo $option; ?>[g_thumb_address]" ><?php echo $options['g_thumb_address'] ?></textarea></td>					</tr>														<tr>						<td><?php _e('LightBox Map Width','gfullmap') ?></td>						<td><input type="text" size="8" name="<?php echo $option; ?>[glightbox_width]" value="<?php echo $options['glightbox_width'] ?>"/> <span style="font-size:11px;font-weight:normal;"> <?php _e('in pixels','gfullmap') ?> </span> </td>						<td><?php _e('LightBox Map Height','gfullmap') ?></td>						<td><input type="text" size="8" name="<?php echo $option; ?>[glightbox_height]" value="<?php echo $options['glightbox_height'] ?>"/> <span style="font-size:11px;font-weight:normal;"> <?php _e('in pixels','gfullmap') ?> </span> </td>					</tr>					<tr>						<td><?php _e('Map Width','gfullmap') ?></td>						<td><input type="text" size="8" name="<?php echo $option; ?>[g_thumb_width]" value="<?php echo $options['g_thumb_width'] ?>"/> <span style="font-size:11px;font-weight:normal;"> <?php _e('in pixels','gfullmap') ?></span> </td>						<td><?php _e('Map Height','gfullmap') ?></td>						<td><input type="text" size="8" name="<?php echo $option; ?>[g_thumb_height]" value="<?php echo $options['g_thumb_height'] ?>"/> <span style="font-size:11px;font-weight:normal;"><?php _e('in pixels','gfullmap') ?></span> </td>					</tr> 											<tr class ="fwgm_row <?php if(isset($options['g_image_chkbox'])){ ?>hide<?php } ?>">						<td><?php _e("Map Type", 'gfullmap'); ?> </td>						<td>							<select style="width:91px;" name="<?php echo $option; ?>[g_map_type]">								<option <?php selected('roadmap', $options['g_map_type']); ?> value="roadmap"><?php _e('Roadmap','gmapfull'); ?></option>								<option <?php selected('satellite', $options['g_map_type']); ?> value="satellite"><?php _e('Satellite','gmapfull'); ?></option>								<option <?php selected('terrain', $options['g_map_type']); ?> value="terrain"><?php _e('Terrain','gmapfull'); ?></option>								<option <?php selected('hybrid', $options['g_map_type']); ?> value="hybrid"><?php _e('Hybrid','gmapfull'); ?></option>							</select>						</td>                          					</tr>					<tr class ="fwgm_row <?php if(isset($options['g_image_chkbox'])){ ?>hide<?php } ?>" >														<td><?php _e("Map Zoom Level", 'gfullmap'); ?> </td>						<td>							 <select style="width:91px;" name="<?php echo $option; ?>[g_zoom_val]">																	<option <?php  selected('0', $options['g_zoom_val']); ?> value="0"><?php _e('0','gmapfull'); ?></option>								<option <?php  selected('5', $options['g_zoom_val']); ?> value="5"><?php _e('5','gmapfull'); ?></option>								<option <?php selected('10', $options['g_zoom_val']); ?> value="10"><?php _e('10','gmapfull'); ?></option>								<option <?php selected('15', $options['g_zoom_val']); ?> value="15"><?php _e('15','gmapfull'); ?></option>							 </select>						</td>					</tr>								<tr>						<td><?php _e("LightBox Map Type", 'gfullmap'); ?></td>						<td>							<select style="width:91px;" name="<?php echo $option; ?>[glightbox_map_type]">								<option <?php selected('m', $options['glightbox_map_type']); ?> value="m"><?php _e('Roadmap','gmapfull'); ?></option>								<option <?php selected('k', $options['glightbox_map_type']); ?> value="k"><?php _e('Satellite','gmapfull'); ?></option>								<option <?php selected('p', $options['glightbox_map_type']); ?> value="p"><?php _e('Terrain','gmapfull'); ?></option>								<option <?php selected('h', $options['glightbox_map_type']); ?> value="h"><?php _e('Hybrid','gmapfull'); ?></option>							</select>						</td>																							</tr>										<tr>														<td><?php _e("Lightbox Zoom Level", 'gfullmap'); ?></td>						<td>						<select style="width:91px;"  name="<?php echo $option; ?>[glightbox_zoom_val]">								<option <?php selected('0', $options['glightbox_zoom_val']); ?> value="0"><?php _e('0','gmapfull'); ?></option>								<option <?php selected('5', $options['glightbox_zoom_val']); ?> value="5"><?php _e('5','gmapfull'); ?></option>								<option <?php selected('10', $options['glightbox_zoom_val']); ?> value="10"><?php _e('10','gmapfull'); ?></option>								<option <?php selected('15', $options['glightbox_zoom_val']); ?> value="15"><?php _e('15','gmapfull'); ?></option>						 </select>						</td>											</tr>										<tr>														<td><?php _e("Select Language for Lightbox Map", 'gfullmap'); ?></td>						<td>						<select style="width:91px;"  name="<?php echo $option; ?>[gmap_language]">								    														<option <?php selected('ar', $options['gmap_language']); ?> value="ar"><?php _e('ARABIC','gmapfull'); ?></option>							<option <?php selected('eu', $options['gmap_language']); ?> value="eu"><?php _e('BASQUE','gmapfull'); ?></option>							<option <?php selected('bg', $options['gmap_language']); ?> value="bg"><?php _e('BULGARIAN','gmapfull'); ?></option>							<option <?php selected('bn', $options['gmap_language']); ?> value="bn"><?php _e('BENGALI','gmapfull'); ?></option>														<option <?php selected('ca', $options['gmap_language']); ?> value="ca"><?php _e('CATALAN','gmapfull'); ?></option>							<option <?php selected('cs', $options['gmap_language']); ?> value="cs"><?php _e('CZECH','gmapfull'); ?></option>							<option <?php selected('da', $options['gmap_language']); ?> value="da"><?php _e('DANISH','gmapfull'); ?></option>							<option <?php selected('de', $options['gmap_language']); ?> value="de"><?php _e('GERMAN','gmapfull'); ?></option>														<option <?php selected('el', $options['gmap_language']); ?> value="el"><?php _e('GREEK','gmapfull'); ?></option>							<option <?php selected('en', $options['gmap_language']); ?> value="en"><?php _e('ENGLISH','gmapfull'); ?></option>							<option <?php selected('es', $options['gmap_language']); ?> value="es"><?php _e('SPANISH','gmapfull'); ?></option>														<option <?php selected('fa', $options['gmap_language']); ?> value="fa"><?php _e('FARSI','gmapfull'); ?></option>							<option <?php selected('fi', $options['gmap_language']); ?> value="fi"><?php _e('FINNISH','gmapfull'); ?></option>																					<option <?php selected('fr', $options['gmap_language']); ?> value="fr"><?php _e('FRENCH','gmapfull'); ?></option>							<option <?php selected('gl', $options['gmap_language']); ?> value="gl"><?php _e('GALICIAN','gmapfull'); ?></option>							<option <?php selected('gu', $options['gmap_language']); ?> value="gu"><?php _e('GUJARATI','gmapfull'); ?></option>														<option <?php selected('hi', $options['gmap_language']); ?> value="hi"><?php _e('HINDI','gmapfull'); ?></option>							<option <?php selected('hr', $options['gmap_language']); ?> value="hr"><?php _e('CROATIAN','gmapfull'); ?></option>							<option <?php selected('hu', $options['gmap_language']); ?> value="hu"><?php _e('HUNGARIAN','gmapfull'); ?></option>							<option <?php selected('id', $options['gmap_language']); ?> value="id"><?php _e('INDONESIAN','gmapfull'); ?></option>														<option <?php selected('it', $options['gmap_language']); ?> value="it"><?php _e('ITALIAN','gmapfull'); ?></option>							<option <?php selected('iw', $options['gmap_language']); ?> value="iw"><?php _e('HEBREW','gmapfull'); ?></option>							<option <?php selected('ja', $options['gmap_language']); ?> value="ja"><?php _e('JAPANESE','gmapfull'); ?></option>							<option <?php selected('kn', $options['gmap_language']); ?> value="kn"><?php _e('KANNADA','gmapfull'); ?></option>														<option <?php selected('ko', $options['gmap_language']); ?> value="ko"><?php _e('KOREAN','gmapfull'); ?></option>							<option <?php selected('lt', $options['gmap_language']); ?> value="lt"><?php _e('LITHUANIAN','gmapfull'); ?></option>							<option <?php selected('lv', $options['gmap_language']); ?> value="lv"><?php _e('LATVIAN','gmapfull'); ?></option>							<option <?php selected('ml', $options['gmap_language']); ?> value="ml"><?php _e('MALAYALAM','gmapfull'); ?></option>														<option <?php selected('mr', $options['gmap_language']); ?> value="mr"><?php _e('MARATHI','gmapfull'); ?></option>							<option <?php selected('nl', $options['gmap_language']); ?> value="nl"><?php _e('DUTCH','gmapfull'); ?></option>							<option <?php selected('nn', $options['gmap_language']); ?> value="nn"><?php _e('NORWEGIAN NYNORSK','gmapfull'); ?></option>							<option <?php selected('no', $options['gmap_language']); ?> value="no"><?php _e('NORWEGIAN','gmapfull'); ?></option>														<option <?php selected('pl', $options['gmap_language']); ?> value="pl"><?php _e('POLISH','gmapfull'); ?></option>							<option <?php selected('pt', $options['gmap_language']); ?> value="pt"><?php _e('PORTUGUESE','gmapfull'); ?></option>							<option <?php selected('pt-BR', $options['gmap_language']); ?> value="pt-BR"><?php _e('PORTUGUESE (BRAZIL)','gmapfull'); ?></option>							<option <?php selected('pt-PT', $options['gmap_language']); ?> value="pt-PT"><?php _e('PORTUGUESE (PORTUGAL)','gmapfull'); ?></option>														<option <?php selected('rm', $options['gmap_language']); ?> value="rm"><?php _e('ROMANSCH','gmapfull'); ?></option>							<option <?php selected('ro', $options['gmap_language']); ?> value="ro"><?php _e('ROMANIAN','gmapfull'); ?></option>							<option <?php selected('ru', $options['gmap_language']); ?> value="ru"><?php _e('RUSSIAN','gmapfull'); ?></option>							<option <?php selected('sk', $options['gmap_language']); ?> value="sk"><?php _e('SLOVAK','gmapfull'); ?></option>														<option <?php selected('sl', $options['gmap_language']); ?> value="sl"><?php _e('SLOVENIAN','gmapfull'); ?></option>							<option <?php selected('sr', $options['gmap_language']); ?> value="sr"><?php _e('SERBIAN','gmapfull'); ?></option>							<option <?php selected('sv', $options['gmap_language']); ?> value="sv"><?php _e('SWEDISH','gmapfull'); ?></option>																					<option <?php selected('ta', $options['gmap_language']); ?> value="ta"><?php _e('TAMIL','gmapfull'); ?></option>							<option <?php selected('te', $options['gmap_language']); ?> value="te"><?php _e('TELUGU','gmapfull'); ?></option>							<option <?php selected('th', $options['gmap_language']); ?> value="th"><?php _e('THAI','gmapfull'); ?></option>							<option <?php selected('tr', $options['gmap_language']); ?> value="tr"><?php _e('TURKISH','gmapfull'); ?></option>														<option <?php selected('uk', $options['gmap_language']); ?> value="uk"><?php _e('UKRAINIAN','gmapfull'); ?></option>							<option <?php selected('vi', $options['gmap_language']); ?> value="vi"><?php _e('VIETNAMESE','gmapfull'); ?></option>							<option <?php selected('zh-CN', $options['gmap_language']); ?> value="zh-CN"><?php _e('CHINESE (SIMPLIFIED)','gmapfull'); ?></option>							<option <?php selected('zh-TW', $options['gmap_language']); ?> value="zh-TW"><?php _e('CHINESE (TRADITIONAL)','gmapfull'); ?></option>															 </select>						</td>											</tr>												<tr style="display:none;">						<td><?php _e('Show Address Bubble','gfullmap'); ?></td>						<td colspan="3"><input <?php   if(isset($options['glightbox_bubble'])) checked('1', $options['glightbox_bubble'],true); ?>  type="checkbox" id="<?php echo $option; ?>[glightbox_bubble]" name="<?php echo $option; ?>[glightbox_bubble]" value = "1"/> <label style="font-size:11px;color:#DB1E00;margin-left:10px;" for="<?php echo $option; ?>[glightbox_bubble]"> <?php _e('Check it, if you want to show Address bubble in lightbox on Map','gfullmap') ?> </label> </td>					</tr>																										</table>				<input type="hidden" name="action" value="update" />				<input type="hidden" name="page_options" value="<?php echo $option; ?>" />									<p class="button-controls">					<input type="submit" value="<?php _e('Save Settings','gfullmap'); ?>" class="button-primary" id="gfullmap_update" onclick="return frmvalidation();" name="gfullmap_update">					</p>							</form> 		 </div>	</div><?php } ?>
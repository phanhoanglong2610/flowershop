<?php
if ($_POST)
{
	if (isset($_POST['Enable']))
	{
		$options['Enable'] = $_POST['Enable'];
	}
	if (isset($_POST['FacebookPageURL']))
	{
		$options['FacebookPageURL'] = $_POST['FacebookPageURL'];
	}
	if (isset($_POST['Width']) && intval($_POST['Width']))
	{
		$options['Width'] = $_POST['Width'];
	}
	if (isset($_POST['Height']) && intval($_POST['Height']))
	{
		$options['Height'] = $_POST['Height'];
	}
	if (isset($_POST['ShowFaces']))
	{
		$options['ShowFaces'] = $_POST['ShowFaces'];
	}
	if (isset($_POST['ShowStream']))
	{
		$options['ShowStream'] = $_POST['ShowStream'];
	}
	if (isset($_POST['ShowHeader']))
	{
		$options['ShowHeader'] = $_POST['ShowHeader'];
	}
	if (isset($_POST['Position']))
	{
		$options['Position'] = $_POST['Position'];
	}
	if (isset($_POST['TabPosition']))
	{
		$options['TabPosition'] = $_POST['TabPosition'];
	}
	if (isset($_POST['TabDesign']))
	{
		$options['TabDesign'] = $_POST['TabDesign'];
	}
	if (isset($_POST['Border']) && intval($_POST['Border']))
	{
		$options['Border'] = $_POST['Border'];
	}
	if (isset($_POST['BorderColor']))
	{
		$options['BorderColor'] = $_POST['BorderColor'];
	}
	if (isset($_POST['BackgroundColor']))
	{
		$options['BackgroundColor'] = $_POST['BackgroundColor'];
	}
	if (isset($_POST['ColorScheme']))
	{
		$options['ColorScheme'] = $_POST['ColorScheme'];
	}
	if (isset($_POST['VPosition']))
	{
		$options['VPosition'] = $_POST['VPosition'];
	}
	if (isset($_POST['VPositionPx']) && intval($_POST['VPositionPx']))
	{
		$options['VPositionPx'] = $_POST['VPositionPx'];
	}
	if (isset($_POST['ZIndex']) && intval($_POST['ZIndex']))
	{
		$options['ZIndex'] = $_POST['ZIndex'];
	}
	if ($_POST['submit'])
	{
		update_option('FBLB_Options', $options);
		echo '
		<div id="setting-error-settings_updated" class="updated settings-error">
			<p><strong>Settings Saved</strong></p>
		</div>';
	}
}
if ($_POST['preview'])
{
	global $fblb_preview_options;
	$fblb_preview_options = $options;
	add_action('admin_footer', 'fblb_slider');
}
else
{
	$options = fblb_get_options();
}
if (!$options['Position'])
{
	$options['Position'] = 'Left';
}
if (!$options['TabPosition'])
{
	$options['TabPosition'] = 'Top';
}
if (!$options['TabDesign'])
{
	$options['TabDesign'] = 1;
}
if (!$options['Width'])
{
	$options['Width'] = 300;
}
if (!$options['Height'])
{
	$options['Height'] = 500;
}
if (!$options['Border'])
{
	$options['Border'] = 5;
}
if (!$options['BorderColor'])
{
	$options['BorderColor'] = '#3b5998';
}
if (!$options['BackgroundColor'])
{
	$options['BackgroundColor'] = '#ffffff';
}
if (!$options['ColorScheme'])
{
	$options['ColorScheme'] = 'light';
}
if (!$options['VPosition'])
{
	$options['VPosition'] = 'Middle';
}
if (!$options['ZIndex'])
{
	$options['ZIndex'] = 1000;
}
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2>Facebook Likebox Slider by ARScode</h2>
	<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
		<h3>Facebook Likebox</h3>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">Enable</th>
					<td> 
						<fieldset>
							<legend class="screen-reader-text"><span>Enable</span></legend>
							<label for="Enable">
								<input name="Enable" <?= ($options['Enable'] ? 'checked' : '' ) ?> type="checkbox" id="Enable" value="1" />
							</label>
						</fieldset>
					</td>
					<td rowspan="14" style="text-align: center; width: 400px">
						<a href="http://www.productpay.com/p/f82wuu/u/51964/t/wpssfree" target="_blank"><img border="0" width="400" src="<? echo plugins_url('/img/gmo-300x250.gif', __FILE__) ?>" /></a>					
						<a href="http://codecanyon.net/item/facebook-likebox-slider-for-wordpress-/1021632?ref=arscode" target="_blank"><img border="0" width="400" src="<? echo plugins_url('/img/free-pro-table.png', __FILE__) ?>" /></a>					
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="FacebookPageURL">Facebook Page URL</label></th>
					<td><input name="FacebookPageURL" type="text" id="FacebookPageURL" value="<?= $options['FacebookPageURL'] ?>" class="regular-text" /></td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="Width">Width</label></th>
					<td><input name="Width" type="text" id="Width" value="<?= $options['Width'] ?>" class="small-text" /> px</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="Height">Height</label></th>
					<td><input name="Height" type="text" id="Height" value="<?= $options['Height'] ?>" class="small-text" /> px</td>
				</tr>
				<tr valign="top">
					<th scope="row">Show faces</th>
					<td> 
						<fieldset>
							<legend class="screen-reader-text"><span>Show faces</span></legend>
							<label for="ShowFaces">
								<input name="ShowFaces" <?= ($options['ShowFaces'] ? 'checked' : '' ) ?> type="checkbox" id="ShowFaces" value="1" />
							</label>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Show stream</th>
					<td> 
						<fieldset>
							<legend class="screen-reader-text"><span>Show stream</span></legend>
							<label for="ShowStream">
								<input name="ShowStream" <?= ($options['ShowStream'] ? 'checked' : '' ) ?> type="checkbox" id="ShowStream" value="1" />
							</label>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Show header</th>
					<td> 
						<fieldset>
							<legend class="screen-reader-text"><span>Show header</span></legend>
							<label for="ShowHeader">
								<input name="ShowHeader" <?= ($options['ShowHeader'] ? 'checked' : '' ) ?> type="checkbox" id="ShowHeader" value="1" />
							</label>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Position</th>
					<td> 
						<fieldset>
							<label for="PositionLeft">
								<input name="Position" <?= ($options['Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="PositionLeft" value="Left" />
								left
							</label>
							<label for="PositionRight">
								<input name="Position" <?= ($options['Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="PositionRight" value="Right" />
								right
							</label>
						</fieldset>
					</td>
				</tr>
				<input name="VPosition" type="hidden" id="VPositionMiddle" value="Middle" />
				<tr valign="top">
					<th scope="row">Tab position</th>
					<td> 
						<fieldset>
							<label for="TabPositionTop">
								<input name="TabPosition" <?= ($options['TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="TabPositionTop" value="Top" />
								top
							</label>
							<label for="TabPositionMiddle">
								<input name="TabPosition" <?= ($options['TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="TabPositionMiddle" value="Middle" />
								middle
							</label>
							<label for="TabPositionBottom">
								<input name="TabPosition" <?= ($options['TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="TabPositionBottom" value="Bottom" />
								bottom
							</label>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Tab design</th>
					<td> 
						<fieldset>
							<label for="TabDesign1">
								<input name="TabDesign" <?= ($options['TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="TabDesign1" value="1" />
								<img src="<? echo plugins_url('/img/fb1-left.png', __FILE__) ?>" />
							</label>
							<label for="TabDesign2">
								<input name="TabDesign" <?= ($options['TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="TabDesign2" value="2" />
								<img src="<? echo plugins_url('/img/fb2-left.png', __FILE__) ?>" />
							</label>
							<label for="TabDesign3">
								<input name="TabDesign" <?= ($options['TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="TabDesign3" value="3" />
								<img src="<? echo plugins_url('/img/fb3-left.png', __FILE__) ?>" />
							</label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="Border">Border width</label></th>
					<td><input name="Border" type="text" id="Border" value="<?= $options['Border'] ?>" class="small-text" /> px</td>
				</tr>
				<input name="BorderColor" type="hidden" id="BorderColor" value="#3b5998" />
				<input name="BackgroundColor" type="hidden" id="BackgroundColor" value="#ffffff"  /> 
				<input name="ColorScheme" type="hidden" id="ColorSchemelight" value="light" />

				<tr valign="top">
					<th scope="row"><label for="ZIndex">CSS z-index</label></th>
					<td><input name="ZIndex" type="text" id="ZIndex" value="<?= $options['ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
				</tr>
				<tr>
					<td colspan="2">
						<p class="submit">
							<input type="submit" name="submit" id="submit" class="button-primary" value="Save settings" />
							<input type="submit" name="preview" id="preview" value="Preview" />
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<div style="text-align: left;">
			<div style="float: left; margin-right: 10px;">
				<div class="fb-like-box"  data-href="http://www.facebook.com/arscode" data-width="700" data-height="350" data-show-faces="true" data-stream="false" data-header="true"></div>
			</div>
		</div>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pl_PL/all.js#xfbml=1&appId=240394672669013";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>		
	</form>
</div>
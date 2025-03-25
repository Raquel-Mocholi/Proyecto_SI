<?php /* Smarty version 3.1.24, created on 2025-03-20 12:17:20
         compiled from "template/front/home.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:106536451967dbf940d7a492_65327703%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dcfb6ec4cd701977f554841290494513bbe95943' => 
    array (
      0 => 'template/front/home.tpl',
      1 => 1742432609,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106536451967dbf940d7a492_65327703',
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_67dbf940d7b012_95673913',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_67dbf940d7b012_95673913')) {
function content_67dbf940d7b012_95673913 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '106536451967dbf940d7a492_65327703';
?>
 <body style="height:100%">
	<div id="container">
		<div id="content">
			<div id="map"></div>
		</div>
		<div id="menu">
			<div class="button"><i class="fa fa-home"></i></div>
			<div class="button"><i class="fa fa-qrcode"></i></div>
			<div class="button"><i class="fa fa-cog"></i></div>
			<div class="button"><i class="fa fa-power-off"></i></div>
		</div>
	</div>
	<div id="cardPlace">
		<div class="card-place-title"></div>
		<div class="card-place-image"></div>
		<div class="card-place-speech">
			<audio controls id="audio">
				  <source id="audioSource" src="" type="audio/mpeg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<div class="card-place-description"></div>
		<div class="card-place-close" onClick="closeCard()"><i class="fa fa-sign-out"></i></div>
	</div>
</body><?php }
}
?>
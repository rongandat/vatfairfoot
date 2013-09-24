<?php /* Smarty version Smarty-3.1.14, created on 2013-09-24 00:21:10
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\modules\blockcustomerprivacy\blockcustomerprivacy.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3246524113369727d6-60281129%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35a489b828966e100f7daef689e95e3428fc5e1a' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\modules\\blockcustomerprivacy\\blockcustomerprivacy.tpl',
      1 => 1377835944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3246524113369727d6-60281129',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'privacy_message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_524113369ad167_96452683',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_524113369ad167_96452683')) {function content_524113369ad167_96452683($_smarty_tpl) {?>

<div class="error_customerprivacy" style="color:red;"></div>
<fieldset class="account_creation customerprivacy">
	<h3><?php echo smartyTranslate(array('s'=>'Customer data privacy','mod'=>'blockcustomerprivacy'),$_smarty_tpl);?>
</h3>
	<div class="form_content clearfix">
		<span class="required">
			<input type="checkbox" value="1" id="customer_privacy" name="customer_privacy" />				
		</span>
		<label for="customer_privacy"><?php echo $_smarty_tpl->tpl_vars['privacy_message']->value;?>
</label>
	</div>	
</fieldset><?php }} ?>
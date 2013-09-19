<?php /* Smarty version Smarty-3.1.14, created on 2013-09-09 01:14:57
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/modules/blockcustomerprivacy/blockcustomerprivacy.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1614330270522d59515693b8-28616487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0863f873f90ffc7fa4d6e5782f5d9c3d0cb3fc62' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/modules/blockcustomerprivacy/blockcustomerprivacy.tpl',
      1 => 1377879144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1614330270522d59515693b8-28616487',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'privacy_message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_522d5951616b20_52925601',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522d5951616b20_52925601')) {function content_522d5951616b20_52925601($_smarty_tpl) {?>

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
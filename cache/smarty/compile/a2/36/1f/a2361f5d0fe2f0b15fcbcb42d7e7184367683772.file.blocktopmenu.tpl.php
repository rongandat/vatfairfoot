<?php /* Smarty version Smarty-3.1.14, created on 2013-09-18 23:41:24
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\modules\blocktopmenu\blocktopmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9930523a7264233e95-85863005%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2361f5d0fe2f0b15fcbcb42d7e7184367683772' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\modules\\blocktopmenu\\blocktopmenu.tpl',
      1 => 1377835944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9930523a7264233e95-85863005',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MENU' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523a726423bb92_49098464',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523a726423bb92_49098464')) {function content_523a726423bb92_49098464($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['MENU']->value!=''){?>
	<!-- Menu -->
	<nav><ul id="nav">
		<?php echo $_smarty_tpl->tpl_vars['MENU']->value;?>

	</ul></nav>
	<!--/ Menu -->
<?php }?><?php }} ?>
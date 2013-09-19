<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:19
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/modules/blocktopmenu/blocktopmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17641555645229ae7fa01941-92853293%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ac20bc0979dedec28f46ebbcf5b93f218746ccb' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/modules/blocktopmenu/blocktopmenu.tpl',
      1 => 1377879144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17641555645229ae7fa01941-92853293',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MENU' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae7fcbae47_72534854',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae7fcbae47_72534854')) {function content_5229ae7fcbae47_72534854($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['MENU']->value!=''){?>
	<!-- Menu -->
	<nav><ul id="nav">
		<?php echo $_smarty_tpl->tpl_vars['MENU']->value;?>

	</ul></nav>
	<!--/ Menu -->
<?php }?><?php }} ?>
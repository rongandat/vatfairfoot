<?php /* Smarty version Smarty-3.1.14, created on 2013-09-23 06:38:13
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\blockadvertising\blockadvertising.tpl" */ ?>
<?php /*%%SmartyHeaderCode:274652401a15074bf2-13810320%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ccc232ee1104df450beb05dc82f82cee65f232f0' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\blockadvertising\\blockadvertising.tpl',
      1 => 1377659664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '274652401a15074bf2-13810320',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'adv_link' => 0,
    'adv_title' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52401a15080779_84620234',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52401a15080779_84620234')) {function content_52401a15080779_84620234($_smarty_tpl) {?>

<!-- MODULE Block advertising -->
<div class="advertising_block">
	<a href="<?php echo $_smarty_tpl->tpl_vars['adv_link']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['adv_title']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['adv_title']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['adv_title']->value;?>
" width="155"  height="163" /></a>
</div>
<!-- /MODULE Block advertising -->
<?php }} ?>
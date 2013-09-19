<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:49
         compiled from "/home/precya/public_html/vatfairfoot/admin8683/themes/default/template/helpers/list/list_action_default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2408146505229ae9d0853a5-10747836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f09a0d3e8d8f952a50cd4fcc11fb084189f5864' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/admin8683/themes/default/template/helpers/list/list_action_default.tpl',
      1 => 1377702862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2408146505229ae9d0853a5-10747836',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae9d0f5a48_22864124',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae9d0f5a48_22864124')) {function content_5229ae9d0f5a48_22864124($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="default" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['name']->value)){?>name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"<?php }?>>
	<img src="../img/admin/asterisk.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>
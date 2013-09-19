<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:29
         compiled from "/home/precya/public_html/vatfairfoot/admin8683/themes/default/template/helpers/list/list_action_duplicate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3593612425229ae89c05ca8-98782432%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ef59e324287cfe86c4da3d51de1910509253dfe' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/admin8683/themes/default/template/helpers/list/list_action_duplicate.tpl',
      1 => 1377702862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3593612425229ae89c05ca8-98782432',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'confirm' => 0,
    'location_ok' => 0,
    'location_ko' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae89d192a8_16952607',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae89d192a8_16952607')) {function content_5229ae89d192a8_16952607($_smarty_tpl) {?>
<a class="pointer" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')) document.location = '<?php echo $_smarty_tpl->tpl_vars['location_ok']->value;?>
'; else document.location = '<?php echo $_smarty_tpl->tpl_vars['location_ko']->value;?>
';">
	<img src="../img/admin/duplicate.png" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>
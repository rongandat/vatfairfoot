<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:01:00
         compiled from "E:\xampp\htdocs\vatfairfoot\admin8683\themes\default\template\helpers\list\list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32059523faeecb80ba9-75884833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35f67cd698be6db46b065c219217a1ad196f59f8' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\admin8683\\themes\\default\\template\\helpers\\list\\list_action_delete.tpl',
      1 => 1377659662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32059523faeecb80ba9-75884833',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'confirm' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523faeecb94437_48178305',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523faeecb94437_48178305')) {function content_523faeecb94437_48178305($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="delete" <?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)){?>onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/delete.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>
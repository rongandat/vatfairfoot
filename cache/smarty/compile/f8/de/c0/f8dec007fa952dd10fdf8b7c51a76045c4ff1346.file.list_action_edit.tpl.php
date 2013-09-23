<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:01:00
         compiled from "E:\xampp\htdocs\vatfairfoot\admin8683\themes\default\template\helpers\list\list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14282523faeecb711a8-64981475%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8dec007fa952dd10fdf8b7c51a76045c4ff1346' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\admin8683\\themes\\default\\template\\helpers\\list\\list_action_edit.tpl',
      1 => 1377659662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14282523faeecb711a8-64981475',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523faeecb78ea7_54427030',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523faeecb78ea7_54427030')) {function content_523faeecb78ea7_54427030($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="edit" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/edit.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2013-09-20 00:56:24
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\product-toggle-view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21911523bd578f25509-95120890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c306fd3ce496ebd17a7be659f90652782074088' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\product-toggle-view.tpl',
      1 => 1377835944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21911523bd578f25509-95120890',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category_view' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523bd578f3cc14_17792879',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523bd578f3cc14_17792879')) {function content_523bd578f3cc14_17792879($_smarty_tpl) {?>

<div class="jq_toggle_view">
	<span class="label"><?php echo smartyTranslate(array('s'=>'View:'),$_smarty_tpl);?>
</span>
	<a href="#" class="list<?php if ((isset($_smarty_tpl->tpl_vars['category_view']->value)&&$_smarty_tpl->tpl_vars['category_view']->value=='list')){?> active<?php }?>" title="<?php echo smartyTranslate(array('s'=>'List'),$_smarty_tpl);?>
"></a>
	<a href="#" class="grid<?php if ((isset($_smarty_tpl->tpl_vars['category_view']->value)&&$_smarty_tpl->tpl_vars['category_view']->value=='grid')){?> active<?php }?>" title="<?php echo smartyTranslate(array('s'=>'Grid'),$_smarty_tpl);?>
"></a>
</div><?php }} ?>
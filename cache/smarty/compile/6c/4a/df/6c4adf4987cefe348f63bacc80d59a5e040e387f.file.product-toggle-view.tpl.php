<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:32:14
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/product-toggle-view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11844146445229af2e8159a7-33615658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c4adf4987cefe348f63bacc80d59a5e040e387f' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/product-toggle-view.tpl',
      1 => 1377879144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11844146445229af2e8159a7-33615658',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category_view' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229af2e869e70_91393989',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229af2e869e70_91393989')) {function content_5229af2e869e70_91393989($_smarty_tpl) {?>

<div class="jq_toggle_view">
	<span class="label"><?php echo smartyTranslate(array('s'=>'View:'),$_smarty_tpl);?>
</span>
	<a href="#" class="list<?php if ((isset($_smarty_tpl->tpl_vars['category_view']->value)&&$_smarty_tpl->tpl_vars['category_view']->value=='list')){?> active<?php }?>" title="<?php echo smartyTranslate(array('s'=>'List'),$_smarty_tpl);?>
"></a>
	<a href="#" class="grid<?php if ((isset($_smarty_tpl->tpl_vars['category_view']->value)&&$_smarty_tpl->tpl_vars['category_view']->value=='grid')){?> active<?php }?>" title="<?php echo smartyTranslate(array('s'=>'Grid'),$_smarty_tpl);?>
"></a>
</div><?php }} ?>
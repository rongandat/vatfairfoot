<?php /* Smarty version Smarty-3.1.14, created on 2013-09-18 23:44:23
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\modules\psblog\views\templates\front\product-tabcontent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18465523a7317922611-12005990%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a73051874463c5152a727edefa9fb752b6e63412' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\modules\\psblog\\views\\templates\\front\\product-tabcontent.tpl',
      1 => 1378354552,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18465523a7317922611-12005990',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post_product_list' => 0,
    'postProduct' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523a7317939d29_91946993',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523a7317939d29_91946993')) {function content_523a7317939d29_91946993($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['post_product_list']->value&&count($_smarty_tpl->tpl_vars['post_product_list']->value)>0){?>
<ul id="ProductPosts" class="bullet">
	<?php  $_smarty_tpl->tpl_vars['postProduct'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['postProduct']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post_product_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['postProduct']->key => $_smarty_tpl->tpl_vars['postProduct']->value){
$_smarty_tpl->tpl_vars['postProduct']->_loop = true;
?>
	<li><a href="<?php echo $_smarty_tpl->tpl_vars['postProduct']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['postProduct']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['postProduct']->value['title'];?>
</a></li>
    <?php } ?>
</ul>
<?php }?>

<?php }} ?>
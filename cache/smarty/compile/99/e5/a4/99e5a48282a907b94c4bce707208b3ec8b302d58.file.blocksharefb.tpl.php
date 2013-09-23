<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:35:34
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\blocksharefb\blocksharefb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8325523fb706e55df4-22720415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99e5a48282a907b94c4bce707208b3ec8b302d58' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\blocksharefb\\blocksharefb.tpl',
      1 => 1377659664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8325523fb706e55df4-22720415',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product_link' => 0,
    'product_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523fb706e69679_01121852',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523fb706e69679_01121852')) {function content_523fb706e69679_01121852($_smarty_tpl) {?>

<li id="left_share_fb">
	<a href="http://www.facebook.com/sharer.php?u=<?php echo $_smarty_tpl->tpl_vars['product_link']->value;?>
&amp;t=<?php echo $_smarty_tpl->tpl_vars['product_title']->value;?>
" class="js-new-window"><?php echo smartyTranslate(array('s'=>'Share on Facebook!','mod'=>'blocksharefb'),$_smarty_tpl);?>
</a>
</li><?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2013-09-23 06:38:13
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\blockfacebooklikebox\blockfacebooklikebox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1208652401a15704871-65857323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b63bd417e80582751e4756c467a308f4219e1ac6' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\blockfacebooklikebox\\blockfacebooklikebox.tpl',
      1 => 1377835944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1208652401a15704871-65857323',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'fb_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52401a1570c579_82469419',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52401a1570c579_82469419')) {function content_52401a1570c579_82469419($_smarty_tpl) {?><div id="block_facebook_like" class="block">
	<h4><?php echo smartyTranslate(array('s'=>'Facebook'),$_smarty_tpl);?>
</h4>
	<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $_smarty_tpl->tpl_vars['fb_url']->value;?>
&amp;width=200&amp;height=290&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color=%23ffffff&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:290px;" allowTransparency="true"></iframe>
</div><?php }} ?>
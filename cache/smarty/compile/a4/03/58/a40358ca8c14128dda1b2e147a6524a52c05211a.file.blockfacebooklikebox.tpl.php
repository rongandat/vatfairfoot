<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:21
         compiled from "/home/precya/public_html/vatfairfoot/modules/blockfacebooklikebox/blockfacebooklikebox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16806095945229ae814b1e21-56172124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a40358ca8c14128dda1b2e147a6524a52c05211a' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/modules/blockfacebooklikebox/blockfacebooklikebox.tpl',
      1 => 1377879144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16806095945229ae814b1e21-56172124',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'fb_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae817fd402_63917416',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae817fd402_63917416')) {function content_5229ae817fd402_63917416($_smarty_tpl) {?><div id="block_facebook_like" class="block">
	<h4><?php echo smartyTranslate(array('s'=>'Facebook'),$_smarty_tpl);?>
</h4>
	<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $_smarty_tpl->tpl_vars['fb_url']->value;?>
&amp;width=200&amp;height=290&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color=%23ffffff&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:290px;" allowTransparency="true"></iframe>
</div><?php }} ?>
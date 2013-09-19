<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:21
         compiled from "/home/precya/public_html/vatfairfoot/modules/blocksocial01/blocksocial01.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19107338705229ae818042d6-75162749%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc46689efa96c374ebbb00b5828712f946916aec' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/modules/blocksocial01/blocksocial01.tpl',
      1 => 1377879146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19107338705229ae818042d6-75162749',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'facebook_url' => 0,
    'twitter_url' => 0,
    'google_url' => 0,
    'pinterest_url' => 0,
    'tumblr_url' => 0,
    'rss_url' => 0,
    'instagram_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae81bf3092_87958006',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae81bf3092_87958006')) {function content_5229ae81bf3092_87958006($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/precya/public_html/vatfairfoot/tools/smarty/plugins/modifier.escape.php';
?>
<?php if ($_smarty_tpl->tpl_vars['facebook_url']->value!=''||$_smarty_tpl->tpl_vars['twitter_url']->value!=''||$_smarty_tpl->tpl_vars['google_url']->value!=''||$_smarty_tpl->tpl_vars['pinterest_url']->value!=''||$_smarty_tpl->tpl_vars['tumblr_url']->value!=''||$_smarty_tpl->tpl_vars['rss_url']->value!=''){?>
<div id="social_block">
	<h4 class="title_block"><?php echo smartyTranslate(array('s'=>'Follow us','mod'=>'blocksocial01'),$_smarty_tpl);?>
</h4>
	<ul>
		<?php if (isset($_smarty_tpl->tpl_vars['facebook_url']->value)&&$_smarty_tpl->tpl_vars['facebook_url']->value!=''){?><li class="facebook"><a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['facebook_url']->value, 'html', 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Facebook','mod'=>'blocksocial01'),$_smarty_tpl);?>
</a></li><?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['twitter_url']->value)&&$_smarty_tpl->tpl_vars['twitter_url']->value!=''){?><li class="twitter"><a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['twitter_url']->value, 'html', 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Twitter','mod'=>'blocksocial01'),$_smarty_tpl);?>
</a></li><?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['google_url']->value)&&$_smarty_tpl->tpl_vars['google_url']->value!=''){?><li class="google"><a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['google_url']->value, 'html', 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Google+','mod'=>'blocksocial01'),$_smarty_tpl);?>
</a></li><?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['pinterest_url']->value)&&$_smarty_tpl->tpl_vars['pinterest_url']->value!=''){?><li class="pinterest"><a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['pinterest_url']->value, 'html', 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Pinterest','mod'=>'blocksocial01'),$_smarty_tpl);?>
</a></li><?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['tumblr_url']->value)&&$_smarty_tpl->tpl_vars['tumblr_url']->value!=''){?><li class="tumblr"><a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['tumblr_url']->value, 'html', 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Tumblr','mod'=>'blocksocial01'),$_smarty_tpl);?>
</a></li><?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['instagram_url']->value)&&$_smarty_tpl->tpl_vars['instagram_url']->value!=''){?><li class="instagram"><a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['instagram_url']->value, 'html', 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Instagram','mod'=>'blocksocial01'),$_smarty_tpl);?>
</a></li><?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['rss_url']->value)&&$_smarty_tpl->tpl_vars['rss_url']->value!=''){?><li class="rss"><a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['rss_url']->value, 'html', 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'RSS','mod'=>'blocksocial01'),$_smarty_tpl);?>
</a></li><?php }?>
	</ul>
</div>
<?php }?>
<?php }} ?>
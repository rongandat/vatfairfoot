<?php /* Smarty version Smarty-3.1.14, created on 2013-09-23 06:38:12
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\blockpermanentlinks\blockpermanentlinks-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3258052401a14854433-08019676%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8b1babc21d5b297b70e2ff6a260fd4dfaa8861d' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\blockpermanentlinks\\blockpermanentlinks-header.tpl',
      1 => 1377659664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3258052401a14854433-08019676',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'come_from' => 0,
    'meta_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52401a148776c5_40923856',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52401a148776c5_40923856')) {function content_52401a148776c5_40923856($_smarty_tpl) {?>

<!-- Block permanent links module HEADER -->
<ul id="header_links">
	<li id="header_link_contact"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'contact','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
	<li id="header_link_sitemap"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('sitemap'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'blockpermanentlinks'),$_smarty_tpl);?>
</a></li>
	<li id="header_link_bookmark">
		<script type="text/javascript">writeBookmarkLink('<?php echo $_smarty_tpl->tpl_vars['come_from']->value;?>
', '<?php echo addslashes(addslashes($_smarty_tpl->tpl_vars['meta_title']->value));?>
', '<?php echo smartyTranslate(array('s'=>'bookmark','mod'=>'blockpermanentlinks','js'=>1),$_smarty_tpl);?>
');</script>
	</li>
</ul>
<!-- /Block permanent links module HEADER -->
<?php }} ?>
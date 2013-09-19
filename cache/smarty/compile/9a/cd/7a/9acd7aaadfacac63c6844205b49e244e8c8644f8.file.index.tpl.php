<?php /* Smarty version Smarty-3.1.14, created on 2013-09-13 00:39:42
         compiled from "/home/precya/public_html/vatfairfoot/themes/default/mobile/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9699056245232970e61c089-93739261%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9acd7aaadfacac63c6844205b49e244e8c8644f8' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/default/mobile/index.tpl',
      1 => 1377702864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9699056245232970e61c089-93739261',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5232970e67bf07_63961246',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5232970e67bf07_63961246')) {function content_5232970e67bf07_63961246($_smarty_tpl) {?>
	<div data-role="content" id="content">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"DisplayMobileIndex"),$_smarty_tpl);?>

		<?php echo $_smarty_tpl->getSubTemplate ('./sitemap.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div><!-- /content -->
<?php }} ?>
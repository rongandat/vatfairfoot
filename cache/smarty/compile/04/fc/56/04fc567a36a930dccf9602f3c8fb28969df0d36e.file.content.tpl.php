<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:05:52
         compiled from "E:\xampp\htdocs\vatfairfoot\admin8683\themes\default\template\controllers\modules\content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2069523fb010a99148-77999130%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04fc567a36a930dccf9602f3c8fb28969df0d36e' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\admin8683\\themes\\default\\template\\controllers\\modules\\content.tpl',
      1 => 1377659662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2069523fb010a99148-77999130',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523fb010af2ee9_39647854',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523fb010af2ee9_39647854')) {function content_523fb010af2ee9_39647854($_smarty_tpl) {?>

<?php if (isset($_smarty_tpl->tpl_vars['module_content']->value)){?>
	<?php echo $_smarty_tpl->tpl_vars['module_content']->value;?>

<?php }else{ ?>
	<?php if (!isset($_GET['configure'])){?>
		<?php echo $_smarty_tpl->getSubTemplate ('controllers/modules/js.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php if (isset($_GET['select'])&&$_GET['select']=='favorites'){?>
			<?php echo $_smarty_tpl->getSubTemplate ('controllers/modules/favorites.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php }else{ ?>
			<?php echo $_smarty_tpl->getSubTemplate ('controllers/modules/page.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php }?>
	<?php }?>
<?php }?>
<?php }} ?>
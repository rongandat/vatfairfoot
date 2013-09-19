<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:20
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/modules/favoriteproducts/my-account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12788473445229ae8096b449-35142007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82f3f13996911ead854d8acf0ad962f3a10ae50e' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/modules/favoriteproducts/my-account.tpl',
      1 => 1377879144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12788473445229ae8096b449-35142007',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae809837d4_84165711',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae809837d4_84165711')) {function content_5229ae809837d4_84165711($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/precya/public_html/vatfairfoot/tools/smarty/plugins/modifier.escape.php';
?>

<li class="favoriteproducts">
	<a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getModuleLink('favoriteproducts','account'), 'htmlall', 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'My favorite products.','mod'=>'favoriteproducts'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'My favorite products.','mod'=>'favoriteproducts'),$_smarty_tpl);?>
</a>
</li>
<?php }} ?>
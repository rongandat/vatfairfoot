<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:05:26
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\favoriteproducts\views\templates\hook\favoriteproducts-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27005523faff64beff3-85978135%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ecd091612053db295fe9042243b187b17c0b0010' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\favoriteproducts\\views\\templates\\hook\\favoriteproducts-header.tpl',
      1 => 1377659664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27005523faff64beff3-85978135',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523faff6563129_39483738',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523faff6563129_39483738')) {function content_523faff6563129_39483738($_smarty_tpl) {?>
<script type="text/javascript">
	var favorite_products_url_add = '<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('favoriteproducts','actions',array('process'=>'add'),false));?>
';
	var favorite_products_url_remove = '<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('favoriteproducts','actions',array('process'=>'remove'),false));?>
';
<?php if (isset($_GET['id_product'])){?>
	var favorite_products_id_product = '<?php echo intval($_GET['id_product']);?>
';
<?php }?> 
</script>
<?php }} ?>
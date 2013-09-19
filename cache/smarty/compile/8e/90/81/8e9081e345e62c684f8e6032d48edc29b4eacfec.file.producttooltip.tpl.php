<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:36:48
         compiled from "/home/precya/public_html/vatfairfoot/modules/producttooltip/producttooltip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20229983415229b0405d3da0-65955352%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e9081e345e62c684f8e6032d48edc29b4eacfec' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/modules/producttooltip/producttooltip.tpl',
      1 => 1377702864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20229983415229b0405d3da0-65955352',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nb_people' => 0,
    'date_last_order' => 0,
    'date_last_cart' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229b04065a151_81544056',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229b04065a151_81544056')) {function content_5229b04065a151_81544056($_smarty_tpl) {?>

<script type="text/javascript">
$(document).ready(function() {
	<?php if (isset($_smarty_tpl->tpl_vars['nb_people']->value)){?>$.jGrowl('<?php if ($_smarty_tpl->tpl_vars['nb_people']->value==1){?><?php echo smartyTranslate(array('s'=>'%d person is currently watching this product','sprintf'=>$_smarty_tpl->tpl_vars['nb_people']->value,'mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'%d people are currently watching this product','sprintf'=>$_smarty_tpl->tpl_vars['nb_people']->value,'mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
<?php }?>', { life: 3500 });<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['date_last_order']->value)){?>$.jGrowl('<?php echo smartyTranslate(array('s'=>'This product was bought last','mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['date_last_order']->value,'full'=>1),$_smarty_tpl);?>
', { life: 3500 });<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['date_last_cart']->value)){?>$.jGrowl('<?php echo smartyTranslate(array('s'=>'This product was added to cart last','mod'=>'producttooltip','js'=>1),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['date_last_cart']->value,'full'=>1),$_smarty_tpl);?>
', { life: 3500 });<?php }?>
});
</script>
<?php }} ?>
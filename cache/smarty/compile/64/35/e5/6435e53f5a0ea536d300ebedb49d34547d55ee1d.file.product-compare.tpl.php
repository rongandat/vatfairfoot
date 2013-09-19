<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:32:14
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/product-compare.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3502497815229af2e86e9f4-09352192%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6435e53f5a0ea536d300ebedb49d34547d55ee1d' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/product-compare.tpl',
      1 => 1377879144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3502497815229af2e86e9f4-09352192',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'comparator_max_item' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229af2e8d0105_87865577',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229af2e8d0105_87865577')) {function content_5229af2e8d0105_87865577($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['comparator_max_item']->value){?>
<script type="text/javascript">
// <![CDATA[
	var min_item = '<?php echo smartyTranslate(array('s'=>'Please select at least one product','js'=>1),$_smarty_tpl);?>
';
	var max_item = "<?php echo smartyTranslate(array('s'=>'You cannot add more than %d product(s) to the product comparison','sprintf'=>$_smarty_tpl->tpl_vars['comparator_max_item']->value,'js'=>1),$_smarty_tpl);?>
";
//]]>
</script>

	<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('products-comparison');?>
" onsubmit="true">
		<p>
		<input type="submit" id="bt_compare" class="button" value="<?php echo smartyTranslate(array('s'=>'Compare'),$_smarty_tpl);?>
" />
		<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
		</p>
	</form>
<?php }?>

<?php }} ?>
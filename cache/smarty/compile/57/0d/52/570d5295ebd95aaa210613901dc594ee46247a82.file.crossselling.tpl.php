<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:35:34
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\modules\crossselling\crossselling.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4847523fb706d158a6-58797102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '570d5295ebd95aaa210613901dc594ee46247a82' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\modules\\crossselling\\crossselling.tpl',
      1 => 1377835944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4847523fb706d158a6-58797102',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orderProducts' => 0,
    'orderProduct' => 0,
    'link' => 0,
    'crossDisplayPrice' => 0,
    'restricted_country_mode' => 0,
    'PS_CATALOG_MODE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523fb706d7b1c8_18876297',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523fb706d7b1c8_18876297')) {function content_523fb706d7b1c8_18876297($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
?>

<?php if (isset($_smarty_tpl->tpl_vars['orderProducts']->value)&&count($_smarty_tpl->tpl_vars['orderProducts']->value)){?>
<div id="crossselling">
	<h2 class="productscategory_h2"><?php echo smartyTranslate(array('s'=>'Customers who bought this product also bought:','mod'=>'crossselling'),$_smarty_tpl);?>
</h2>
	<ul class="product_list2 jq_carousel2">
		<?php  $_smarty_tpl->tpl_vars['orderProduct'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['orderProduct']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orderProducts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['orderProduct']->key => $_smarty_tpl->tpl_vars['orderProduct']->value){
$_smarty_tpl->tpl_vars['orderProduct']->_loop = true;
?>
		<li>
			<a href="<?php echo $_smarty_tpl->tpl_vars['orderProduct']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['name']);?>
" class="img_container"><img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['orderProduct']->value['link_rewrite'],(($_smarty_tpl->tpl_vars['orderProduct']->value['product_id']).('-')).($_smarty_tpl->tpl_vars['orderProduct']->value['id_image']),'medium_01prem');?>
" alt="<?php echo $_smarty_tpl->tpl_vars['orderProduct']->value['name'];?>
" /></a>
			<p class="product_name"><a href="<?php echo $_smarty_tpl->tpl_vars['orderProduct']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['name']);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['orderProduct']->value['name'],15,'...'), 'htmlall', 'UTF-8');?>
</a></p>
			<?php if ($_smarty_tpl->tpl_vars['crossDisplayPrice']->value&&$_smarty_tpl->tpl_vars['orderProduct']->value['show_price']==1&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?>
				<span class="price_display">
					<span class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['orderProduct']->value['displayed_price']),$_smarty_tpl);?>
</span>
				</span>
			<?php }?>
		</li>
		<?php } ?>
	</ul>
</div>
<?php }?>
<?php }} ?>
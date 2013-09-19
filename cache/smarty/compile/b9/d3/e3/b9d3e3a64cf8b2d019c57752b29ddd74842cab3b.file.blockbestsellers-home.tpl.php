<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:21
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/modules/blockbestsellers/blockbestsellers-home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:443691995229ae8110adb5-38703444%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9d3e3a64cf8b2d019c57752b29ddd74842cab3b' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/modules/blockbestsellers/blockbestsellers-home.tpl',
      1 => 1377879144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '443691995229ae8110adb5-38703444',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'best_sellers' => 0,
    'product' => 0,
    'priceDisplay' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae811d1f94_96775887',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae811d1f94_96775887')) {function content_5229ae811d1f94_96775887($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/precya/public_html/vatfairfoot/tools/smarty/plugins/modifier.escape.php';
?>

<!-- MODULE Home Block best sellers -->
<div id="best-sellers_block_center" class="block products_block">
	<h1><?php echo smartyTranslate(array('s'=>'Top sellers','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</h1>
	<?php if (isset($_smarty_tpl->tpl_vars['best_sellers']->value)&&$_smarty_tpl->tpl_vars['best_sellers']->value){?>
		<ul class="product_list jq_carousel_home">
		<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['best_sellers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
			<li class="ajax_block_product">
				<a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
">
					<div class="content">
						<h2 class="title"><?php if (isset($_smarty_tpl->tpl_vars['product']->value['manufacturer_name'])){?><?php echo $_smarty_tpl->tpl_vars['product']->value['manufacturer_name'];?>
<br /> <?php }?><span><?php echo smarty_modifier_escape($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],35,'...'), 'htmlall', 'UTF-8');?>
</span></h2><br />
						<span class="price"><?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>

						<?php if (isset($_smarty_tpl->tpl_vars['product']->value['reduction'])&&isset($_smarty_tpl->tpl_vars['product']->value['price_without_reduction'])){?>
							<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value>=0&&$_smarty_tpl->tpl_vars['priceDisplay']->value<=2){?>
								<span class="old_price_display"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>
</span>
							<?php }?>
						<?php }?></span>
					</div>
					<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home_01prem');?>
" alt="" /></div>						
				</a>
			</li>
		<?php } ?>
		</ul>
	<?php }else{ ?>
		<p><?php echo smartyTranslate(array('s'=>'No best sellers at this time','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</p>
	<?php }?>
</div>
<!-- /MODULE Home Block best sellers -->
<?php }} ?>
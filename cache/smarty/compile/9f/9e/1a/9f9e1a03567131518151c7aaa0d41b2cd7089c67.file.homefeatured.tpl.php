<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:20
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/modules/homefeatured/homefeatured.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11122475685229ae80f280f9-52780358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f9e1a03567131518151c7aaa0d41b2cd7089c67' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/modules/homefeatured/homefeatured.tpl',
      1 => 1377894396,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11122475685229ae80f280f9-52780358',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'products' => 0,
    'product_view_hp' => 0,
    'product' => 0,
    'link' => 0,
    'restricted_country_mode' => 0,
    'PS_CATALOG_MODE' => 0,
    'priceDisplay' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae810e5102_44688036',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae810e5102_44688036')) {function content_5229ae810e5102_44688036($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/precya/public_html/vatfairfoot/tools/smarty/plugins/modifier.escape.php';
?>

    <!-- MODULE Home Featured Products -->
    <div id="featured-products_block_center" class="block products_block clearfix">
        <h1><?php echo smartyTranslate(array('s'=>'Featured products','mod'=>'homefeatured'),$_smarty_tpl);?>
</h1>
        <?php if (isset($_smarty_tpl->tpl_vars['products']->value)&&$_smarty_tpl->tpl_vars['products']->value){?>
        <ul class="product_list<?php if (isset($_smarty_tpl->tpl_vars['product_view_hp']->value)){?> <?php echo $_smarty_tpl->tpl_vars['product_view_hp']->value;?>
<?php }?> jq_carousel_home">
            <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
            <li class="ajax_block_product">
                <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
">
                    <div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home_01prem');?>
" alt="" /></div>
                    <div class="content">
                        <h2 class="title"><?php if (isset($_smarty_tpl->tpl_vars['product']->value['manufacturer_name'])&&$_smarty_tpl->tpl_vars['product']->value['manufacturer_name']!=''){?><span class="brand"><?php echo $_smarty_tpl->tpl_vars['product']->value['manufacturer_name'];?>
</span><br /> <?php }?><span><?php echo smarty_modifier_escape($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],35,'...'), 'htmlall', 'UTF-8');?>
</span></h2>
                        <?php if ($_smarty_tpl->tpl_vars['product']->value['show_price']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value){?><span class="price"><?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value){?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>
<?php }else{ ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['product']->value['reduction']&&isset($_smarty_tpl->tpl_vars['product']->value['price_without_reduction'])){?>
                            <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value>=0&&$_smarty_tpl->tpl_vars['priceDisplay']->value<=2){?>
                            <span class="old_price_display"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>
</span>
                            <?php }?>
                            <?php }?></span><?php }?>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
        <?php }else{ ?>
        <p><?php echo smartyTranslate(array('s'=>'No featured products','mod'=>'homefeatured'),$_smarty_tpl);?>
</p>
        <?php }?>
    </div>
    <hr />
    <!-- /MODULE Home Featured Products -->
<?php }} ?>
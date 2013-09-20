<?php /* Smarty version Smarty-3.1.14, created on 2013-09-18 23:41:23
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\themeconfig\themeconfig.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7026523a7263ab3988-25848601%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1f7e1da73f186c2b13c9e16ee6d3252bf9df0c5' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\themeconfig\\themeconfig.tpl',
      1 => 1377835946,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7026523a7263ab3988-25848601',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'theme_color1' => 0,
    'theme_color2' => 0,
    'theme_color3' => 0,
    'theme_bgcolor' => 0,
    'theme_txtcolor' => 0,
    'theme_bgbloc' => 0,
    'theme_acolor' => 0,
    'theme_ahcolor' => 0,
    'sidebar_position' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523a7263af9e93_30278194',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523a7263af9e93_30278194')) {function content_523a7263af9e93_30278194($_smarty_tpl) {?>


<?php if ((isset($_smarty_tpl->tpl_vars['theme_color1']->value)&&$_smarty_tpl->tpl_vars['theme_color1']->value!='')&&(isset($_smarty_tpl->tpl_vars['theme_color2']->value)&&$_smarty_tpl->tpl_vars['theme_color2']->value!='')&&(isset($_smarty_tpl->tpl_vars['theme_color3']->value)&&$_smarty_tpl->tpl_vars['theme_color3']->value!='')){?>

<style type="text/css">
	/* 
		CSS
		Custom Style Sheet with themeconfig module
	*/
	/* Body Background Color & Text Color */
	body {
		background-color: #<?php echo $_smarty_tpl->tpl_vars['theme_bgcolor']->value;?>
;
		color: #<?php echo $_smarty_tpl->tpl_vars['theme_txtcolor']->value;?>
;
	}

	/* Background Bloc */
	#right_column .block,
	form.std fieldset {
		background-color: #<?php echo $_smarty_tpl->tpl_vars['theme_bgbloc']->value;?>
;
	}
	.ui-slider .ui-slider-handle {
		border-color: #<?php echo $_smarty_tpl->tpl_vars['theme_bgbloc']->value;?>
;
	}

	/* Link Color */
	a,
	#product_list li .lnk_view {color: #<?php echo $_smarty_tpl->tpl_vars['theme_acolor']->value;?>
;}

	/* Link Hover Color */
	a:hover, a:focus,
	#product_list li .lnk_view:hover,
	#product_list li .lnk_view:focus {color: #<?php echo $_smarty_tpl->tpl_vars['theme_ahcolor']->value;?>
;}

	/* background color */
	#header #currencies_block_top p,
	#setCurrency ul,
	#header #languages_block_top p,
	#countries ul,
	#nav > li > ul,
	#nav > li > a:hover, #nav > li > a:focus, #nav > li:hover > a, #nav > li.sfHoverForce > a,
	#right_column h4,
	table.std th, table.table_block th,
	.cart_total_price .total_price_container p,
	ul.address li.address_title,
	#product_list li span.new,
	form.std fieldset h3 {
		background-color: #<?php echo $_smarty_tpl->tpl_vars['theme_color1']->value;?>
;
	}

	/* border color */
	#nav,
	#page,
	#footer,
	#right_column .block_content,
	table.std, table.table_block,
	table.std td, table.table_block td,
	ul.address,
	#product_list a.product_img_link:hover,
	#product_list a.product_img_link:focus,
	form.std fieldset {
		border-color: #<?php echo $_smarty_tpl->tpl_vars['theme_color1']->value;?>
;
	}

	/* ie8 bug, this needs to be appart */
	table#cart_summary tbody tr:last-child td {
		border-color: #<?php echo $_smarty_tpl->tpl_vars['theme_color1']->value;?>
;
	}

	/* buttons color */
	input.button_mini, input.button_small, input.button, input.button_large,
	input.button_mini_disabled, input.button_small_disabled, input.button_disabled, input.button_large_disabled,
	input.exclusive_mini, input.exclusive_small, input.exclusive, input.exclusive_large,
	input.exclusive_mini_disabled, input.exclusive_small_disabled, input.exclusive_disabled, input.exclusive_large_disabled,
	a.button_mini, a.button_small, a.button, a.button_large,
	a.exclusive_mini, a.exclusive_small, a.exclusive, a.exclusive_large,
	span.button_mini, span.button_small, span.button, span.button_large,
	span.exclusive_mini, span.exclusive_small, span.exclusive_large, span.exclusive_large_disabled,
	span.reduction,
	.sortPagiBar #bt_compare:hover, .sortPagiBar #bt_compare:focus {
			background-color: #<?php echo $_smarty_tpl->tpl_vars['theme_color2']->value;?>
;
	}

	/* hover button */
	input.button_mini:hover, input.button_small:hover, input.button:hover, input.button_large:hover,
	input.exclusive_mini:hover, input.exclusive_small:hover, input.exclusive:hover, input.exclusive_large:hover,
	a.button_mini:hover, a.button_small:hover, a.button:hover, a.button_large:hover,
	a.exclusive_mini:hover, a.exclusive_small:hover, a.exclusive:hover, a.exclusive_large:hover,
	input.button_mini:focus, input.button_small:focus, input.button:focus, input.button_large:focus,
	input.exclusive_mini:focus, input.exclusive_small:focus, input.exclusive:focus, input.exclusive_large:focus,
	a.button_mini:focus, a.button_small:focus, a.button:focus, a.button_large:focus,
	a.exclusive_mini:focus, a.exclusive_small:focus, a.exclusive:focus, a.exclusive_large:focus {
		background-color: #<?php echo $_smarty_tpl->tpl_vars['theme_color3']->value;?>
;
	}

	/* other colors */
	#product_list li .discount, ul#product_list li .on_sale, ul#product_list li .online_only,
	#special_block_right .products span.price,
	#product_comparison .price,
	.on_sale,
	p.online_only {
		color: #<?php echo $_smarty_tpl->tpl_vars['theme_color2']->value;?>
;
	}

	/* color white */
	#nav > li ul li a {color: #fff;}

	<?php if (isset($_smarty_tpl->tpl_vars['sidebar_position']->value)&&$_smarty_tpl->tpl_vars['sidebar_position']->value=="left"){?>
	/* sidebar left */
	#main {
		float: right;
	}
	#right_column {
		float: left;
		margin-top: 0;
	}
	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['sidebar_position']->value)&&$_smarty_tpl->tpl_vars['sidebar_position']->value=="nosidebar"){?>
	/* no sidebar */
	#main {
		float: none;
		width: 100%;
	}
	#right_column {
		display: none;
	}
	#product_list li .center_block {
		width: 945px;
	}
	@media only screen and (max-width: 1320px) {
		#product_list li div.center_block {
			width: 745px;
		}
	}
	@media only screen and (max-width: 1020px) {
		#product_list li div.center_block {
			width: 595px;
		}
	}
	@media only screen and (max-width: 820px) {
		#product_list li div.center_block {
			width: 395px;
		}
	}
	<?php }?>
</style>
<?php }?><?php }} ?>
{* 
	Colors are defined with themeconfig module
*}


{if (isset($theme_color1) && $theme_color1 != "") && (isset($theme_color2) && $theme_color2 != "") && (isset($theme_color3) && $theme_color3 != "")}
{literal}
<style type="text/css">
	/* 
		CSS
		Custom Style Sheet with themeconfig module
	*/
	/* Body Background Color & Text Color */
	body {
		background-color: #{/literal}{$theme_bgcolor}{literal};
		color: #{/literal}{$theme_txtcolor}{literal};
	}

	/* Background Bloc */
	#right_column .block,
	form.std fieldset {
		background-color: #{/literal}{$theme_bgbloc}{literal};
	}
	.ui-slider .ui-slider-handle {
		border-color: #{/literal}{$theme_bgbloc}{literal};
	}

	/* Link Color */
	a,
	#product_list li .lnk_view {color: #{/literal}{$theme_acolor}{literal};}

	/* Link Hover Color */
	a:hover, a:focus,
	#product_list li .lnk_view:hover,
	#product_list li .lnk_view:focus {color: #{/literal}{$theme_ahcolor}{literal};}

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
		background-color: #{/literal}{$theme_color1}{literal};
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
		border-color: #{/literal}{$theme_color1}{literal};
	}

	/* ie8 bug, this needs to be appart */
	table#cart_summary tbody tr:last-child td {
		border-color: #{/literal}{$theme_color1}{literal};
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
			background-color: #{/literal}{$theme_color2}{literal};
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
		background-color: #{/literal}{$theme_color3}{literal};
	}

	/* other colors */
	#product_list li .discount, ul#product_list li .on_sale, ul#product_list li .online_only,
	#special_block_right .products span.price,
	#product_comparison .price,
	.on_sale,
	p.online_only {
		color: #{/literal}{$theme_color2}{literal};
	}

	/* color white */
	#nav > li ul li a {color: #fff;}

	{/literal}{if isset($sidebar_position) && $sidebar_position == "left"}{literal}
	/* sidebar left */
	#main {
		float: right;
	}
	#right_column {
		float: left;
		margin-top: 0;
	}
	{/literal}{/if}
	{if isset($sidebar_position) && $sidebar_position == "nosidebar"}{literal}
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
	{/literal}{/if}
</style>
{/if}
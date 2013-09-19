{*
* 2007-2012 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2012 PrestaShop SA
*  @version  Release: $Revision: 17499 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<!-- MODULE Home Block best sellers -->
<div id="best-sellers_block_center" class="block products_block">
	<h1>{l s='Top sellers' mod='blockbestsellers'}</h1>{* | <a href="{$link->getPageLink('best-sales.php')}">{l s='All best sellers' mod='blockbestsellers'}</a><br />*}
	{if isset($best_sellers) AND $best_sellers}
		<ul class="product_list{*if $best_sellers|@count > 5*} jq_carousel_home{*/if*}">
		{foreach from=$best_sellers item=product name=myLoop}
			<li class="ajax_block_product">
				<a href="{$product.link}">
					<div class="content">
						<h2 class="title">{if isset($product.manufacturer_name)}{$product.manufacturer_name}<br /> {/if}<span>{$product.name|truncate:35:'...'|escape:'htmlall':'UTF-8'}</span></h2><br />
						<span class="price">{$product.price}
						{if isset($product.reduction) && isset($product.price_without_reduction)}
							{if $priceDisplay >= 0 && $priceDisplay <= 2}
								<span class="old_price_display">{convertPrice price=$product.price_without_reduction}</span>
							{/if}
						{/if}</span>
					</div>
					<div class="image"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_01prem')}" alt="" /></div>						
				</a>
			</li>
		{/foreach}
		</ul>
	{else}
		<p>{l s='No best sellers at this time' mod='blockbestsellers'}</p>
	{/if}
</div>
<!-- /MODULE Home Block best sellers -->

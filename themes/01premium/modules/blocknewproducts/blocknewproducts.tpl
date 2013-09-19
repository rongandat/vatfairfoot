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
*  @version  Release: $Revision: 6594 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<!-- MODULE Block new products -->
<div id="new-products_block_right" class="block products_block">
	<h4><a href="{$link->getPageLink('new-products.php')}" title="{l s='New products' mod='blocknewproducts'}">{l s='New products' mod='blocknewproducts'}</a></h4>
	<div class="block_content">
	{if $new_products !== false}
		<ul class="products{if $new_products|@count > 2} jq_carousel1{/if}">
		{foreach from=$new_products item=product name=myLoop}
			<li class="clearfix{if $smarty.foreach.myLoop.last} last_item{elseif $smarty.foreach.myLoop.first} first_item{else} item{/if}">
				<a href="{$product.link}" title="{$product.legend|escape:html:'UTF-8'}" class="content_img"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'medium_01prem')}" alt="{$product.legend|escape:html:'UTF-8'}" /></a>
				<div class="text_desc">
					<h5><a href="{$product.link}" title="{$product.legend|escape:html:'UTF-8'}">{$product.name|truncate:14:'...'|strip_tags|escape:html:'UTF-8'}</a></h5>
					<p><a href="{$product.link}" title="{$product.legend|escape:html:'UTF-8'}">{$product.description_short|strip_tags:'UTF-8'|truncate:44:'...'}</a></p>
				</div>
			</li>
		{/foreach}
		</ul>
		<p class="more"><a href="{$link->getPageLink('new-products.php')}" title="{l s='All new products' mod='blocknewproducts'}">&raquo; {l s='All new products' mod='blocknewproducts'}</a></p>
	{else}
		<p>&raquo; {l s='No new products at this time' mod='blocknewproducts'}</p>
	{/if}
	</div>
</div>
<!-- /MODULE Block new products -->
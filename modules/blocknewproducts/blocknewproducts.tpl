{*
* 2007-2013 PrestaShop
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
    *  @copyright  2007-2013 PrestaShop SA
    *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
    *  International Registered Trademark & Property of PrestaShop SA
    *}
    <div class="block products_block clearfix" id="new-products_block_center">
        <h1>{l s='New products' mod='blocknewproducts'}</h1>
        <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;"><div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;"><ul class="product_list default jq_carousel_home jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 340px;">
                    <li class="ajax_block_product jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: none outside none;" jcarouselindex="1">
                        <a href="http://vatfairfoot.lc/index.php?id_product=9&amp;controller=product&amp;id_lang=1">
                            <div class="image"><img alt="" src="http://vatfairfoot.lc/img/p/3/0/30-home_01prem.jpg"></div>
                            <div class="content">
                                <h2 class="title"><span> iPod Nano</span></h2>
                                <span class="price">$158.07                            </span>                    </div>
                        </a>
                    </li>
                </ul></div><div class="jcarousel-prev jcarousel-prev-horizontal jcarousel-prev-disabled jcarousel-prev-disabled-horizontal" style="display: block;" disabled="disabled"></div><div class="jcarousel-next jcarousel-next-horizontal jcarousel-next-disabled jcarousel-next-disabled-horizontal" style="display: block;" disabled="disabled"></div></div>
    </div>
    <!-- MODULE Block new products -->
    <div id="new-products_block_right" class="block products_block">
        <h4 class="title_block"><a href="{$link->getPageLink('new-products')|escape:'html'}" title="{l s='New products' mod='blocknewproducts'}">{l s='New products' mod='blocknewproducts'}</a></h4>
        <div class="block_content">
            {if $new_products !== false}
            <ul class="product_images clearfix">
                {foreach from=$new_products item='product' name='newProducts'}
                {if $smarty.foreach.newProducts.index < 2}
                <li{if $smarty.foreach.newProducts.first} class="first"{/if}><a href="{$product.link|escape:'html'}" title="{$product.legend|escape:html:'UTF-8'}"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'medium_default')|escape:'html'}" height="{$mediumSize.height}" width="{$mediumSize.width}" alt="{$product.legend|escape:html:'UTF-8'}" /></a></li>
                {/if}
                {/foreach}
            </ul>
            <dl class="products">
                {foreach from=$new_products item=newproduct name=myLoop}
                <dt class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}"><a href="{$newproduct.link|escape:'html'}" title="{$newproduct.name|escape:html:'UTF-8'}">{$newproduct.name|strip_tags|escape:html:'UTF-8'}</a></dt>
                {if $newproduct.description_short}<dd class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}"><a href="{$newproduct.link|escape:'html'}">{$newproduct.description_short|strip_tags:'UTF-8'|truncate:75:'...'}</a><br /><a href="{$newproduct.link}" class="lnk_more">{l s='Read more' mod='blocknewproducts'}</a></dd>{/if}
                {/foreach}
            </dl>
            <p><a href="{$link->getPageLink('new-products')|escape:'html'}" title="{l s='All new products' mod='blocknewproducts'}" class="button_large">&raquo; {l s='All new products' mod='blocknewproducts'}</a></p>
            {else}
            <p>&raquo; {l s='Do not allow new products at this time.' mod='blocknewproducts'}</p>
            {/if}
        </div>
    </div>
    <!-- /MODULE Block new products -->

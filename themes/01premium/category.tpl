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
*  @version  Release: $Revision: 6844 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{include file="$tpl_dir./breadcrumb.tpl"}
{include file="$tpl_dir./errors.tpl"}

{if isset($category)}
	{if $category->id AND $category->active}
		<h1>
			{strip}
				{$category->name|escape:'htmlall':'UTF-8'}
				{if isset($categoryNameComplement)}
					{$categoryNameComplement|escape:'htmlall':'UTF-8'}
				{/if}
			{/strip}
		</h1>
		
		{*<div class="resumecat category-product-count">
			{include file="$tpl_dir./category-count.tpl"}
		</div>*}
		
		
		{*
		{if isset($subcategories)}
		<!-- Subcategories -->
		<div id="subcategories">
			<h3>{l s='Subcategories'}</h3>
			<ul class="inline_list clearfix">
			{foreach from=$subcategories item=subcategory}
				<li>
					<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'htmlall':'UTF-8'}">
						{if $subcategory.id_image}
							<img src="{$link->getCatImageLink($subcategory.link_rewrite, $subcategory.id_image, 'subcat_01prem')}" alt="" class="img" />
						{/if}
						<div class="content">
							<h2>{$subcategory.name|escape:'htmlall':'UTF-8'}</h2>
						</div>
					</a>
				</li>
			{/foreach}
			</ul>
		</div>
		{/if}
		*}

		{if $products}
			<div class="sortPagiBar clearfix">
				{include file="./product-sort.tpl"}
				{include file="./nbr-product-page.tpl"}
				{include file="./product-toggle-view.tpl"}
				{include file="./product-compare.tpl"}
			</div>
			
			<div id="product_list_container" {if (isset($category_view))}class="{$category_view}"{/if}>
				{include file="./product-list.tpl" products=$products}
			</div>
			
			<div class="sortPagiBar clearfix">
				{include file="./product-compare.tpl"}
			</div>
			{include file="./pagination.tpl"}
		{/if}
	{elseif $category->id}
		<p class="warning">{l s='This category is currently unavailable.'}</p>
	{/if}
{/if}

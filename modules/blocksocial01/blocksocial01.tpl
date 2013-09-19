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

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $facebook_url != '' || $twitter_url != '' || $google_url != '' || $pinterest_url != '' || $tumblr_url != '' || $rss_url != ''}
<div id="social_block">
	<h4 class="title_block">{l s='Follow us' mod='blocksocial01'}</h4>
	<ul>
		{if isset($facebook_url) && $facebook_url != ''}<li class="facebook"><a href="{$facebook_url|escape:html:'UTF-8'}">{l s='Facebook' mod='blocksocial01'}</a></li>{/if}
		{if isset($twitter_url) && $twitter_url != ''}<li class="twitter"><a href="{$twitter_url|escape:html:'UTF-8'}">{l s='Twitter' mod='blocksocial01'}</a></li>{/if}
		{if isset($google_url) && $google_url != ''}<li class="google"><a href="{$google_url|escape:html:'UTF-8'}">{l s='Google+' mod='blocksocial01'}</a></li>{/if}
		{if isset($pinterest_url) && $pinterest_url != ''}<li class="pinterest"><a href="{$pinterest_url|escape:html:'UTF-8'}">{l s='Pinterest' mod='blocksocial01'}</a></li>{/if}
		{if isset($tumblr_url) && $tumblr_url != ''}<li class="tumblr"><a href="{$tumblr_url|escape:html:'UTF-8'}">{l s='Tumblr' mod='blocksocial01'}</a></li>{/if}
		{if isset($instagram_url) && $instagram_url != ''}<li class="instagram"><a href="{$instagram_url|escape:html:'UTF-8'}">{l s='Instagram' mod='blocksocial01'}</a></li>{/if}
		{if isset($rss_url) && $rss_url != ''}<li class="rss"><a href="{$rss_url|escape:html:'UTF-8'}">{l s='RSS' mod='blocksocial01'}</a></li>{/if}
	</ul>
</div>
{/if}

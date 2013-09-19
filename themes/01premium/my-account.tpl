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
*  @version  Release: $Revision: 6599 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{capture name=path}{l s='My account'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<h1>{l s='My account'}</h1>
{if isset($account_created)}
	<p class="success">
		{l s='Your account has been created.'}
	</p>
{/if}
<h4>{l s='Welcome to your account. Here you can manage al of your personal information and orders. '}</h4>
<ul class="myaccount_lnk_list">
	{if $has_customer_an_address}
	<li class="address"><a href="{$link->getPageLink('address', true)}" title="{l s='Add my first address'}">{l s='Add my first address'}</a></li>
	{/if}
	<li class="orders"><a href="{$link->getPageLink('history', true)}" title="{l s='Orders'}">{l s='Order history and details '}</a></li>
	{if $returnAllowed}
		<li class="return"><a href="{$link->getPageLink('order-follow', true)}" title="{l s='Merchandise returns'}">{l s='My merchandise returns'}</a></li>
	{/if}
	<li class="slip"><a href="{$link->getPageLink('order-slip', true)}" title="{l s='Credit slips'}">{l s='My credit slips'}</a></li>
	<li class="address"><a href="{$link->getPageLink('addresses', true)}" title="{l s='Addresses'}">{l s='My addresses'}</a></li>
	<li class="identity"><a href="{$link->getPageLink('identity', true)}" title="{l s='Information'}">{l s='My personal information'}</a></li>
	{if $voucherAllowed}
		<li class="voucher"><a href="{$link->getPageLink('discount', true)}" title="{l s='Vouchers'}">{l s='My vouchers'}</a></li>
	{/if}
	{$HOOK_CUSTOMER_ACCOUNT}
	<li class="logout"><a href="{$link->getPageLink('index.php')}?mylogout" title="{l s='Log me out'}">{l s='Sign out'}</a></li>	
</ul>

<?php
/*
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
*/

if (!defined('_CAN_LOAD_FILES_'))
	exit;
	
class blocksocial01 extends Module
{
	public function __construct()
	{
		$this->name = 'blocksocial01';
		$this->tab = 'front_office_features';
		$this->version = '1.0';

		parent::__construct();

		$this->displayName = $this->l('Block social 01');
		$this->description = $this->l('Allows you to add extra information about social networks');
	}
	
	public function install()
	{
		return (parent::install() AND Configuration::updateValue('blocksocial01_tumblr', '') && Configuration::updateValue('blocksocial01_pinterest', '') && Configuration::updateValue('blocksocial01_google', '') && Configuration::updateValue('blocksocial01_facebook', '') && Configuration::updateValue('blocksocial01_twitter', '') && Configuration::updateValue('blocksocial01_rss', '') && $this->registerHook('displayHeader') && $this->registerHook('displayFooter'));
	}
	
	public function uninstall()
	{
		//Delete configuration			
		return (Configuration::deleteByName('blocksocial01_pinterest') AND Configuration::deleteByName('blocksocial01_google') AND Configuration::deleteByName('blocksocial01_tumblr') AND Configuration::deleteByName('blocksocial01_facebook') AND Configuration::deleteByName('blocksocial01_twitter') AND Configuration::deleteByName('blocksocial01_rss') AND parent::uninstall());
	}
	
	public function getContent()
	{
		// If we try to update the settings
		$output = '';
		if (isset($_POST['submitModule']))
		{	
			Configuration::updateValue('blocksocial01_facebook', (($_POST['facebook_url'] != '') ? $_POST['facebook_url']: ''));
			Configuration::updateValue('blocksocial01_twitter', (($_POST['twitter_url'] != '') ? $_POST['twitter_url']: ''));		
			Configuration::updateValue('blocksocial01_rss', (($_POST['rss_url'] != '') ? $_POST['rss_url']: ''));
			Configuration::updateValue('blocksocial01_google', (($_POST['google_url'] != '') ? $_POST['google_url']: ''));
			Configuration::updateValue('blocksocial01_pinterest', (($_POST['pinterest_url'] != '') ? $_POST['pinterest_url']: ''));		
			Configuration::updateValue('blocksocial01_tumblr', (($_POST['tumblr_url'] != '') ? $_POST['tumblr_url']: ''));
			Configuration::updateValue('blocksocial01_instagram', (($_POST['instagram_url'] != '') ? $_POST['instagram_url']: ''));		
			$output = '<div class="conf confirm">'.$this->l('Configuration updated').'</div>';
		}
		
		return '
		<h2>'.$this->displayName.'</h2>
		'.$output.'
		<form action="'.Tools::htmlentitiesutf8($_SERVER['REQUEST_URI']).'" method="post">
			<fieldset class="width2">				
				<label for="facebook_url">'.$this->l('Facebook URL: ').'</label>
				<input type="text" id="facebook_url" name="facebook_url" value="'.Tools::safeOutput((Configuration::get('blocksocial01_facebook') != "") ? Configuration::get('blocksocial01_facebook') : "").'" />
				<div class="clear">&nbsp;</div>
				<label for="twitter_url">'.$this->l('Twitter URL: ').'</label>
				<input type="text" id="twitter_url" name="twitter_url" value="'.Tools::safeOutput((Configuration::get('blocksocial01_twitter') != "") ? Configuration::get('blocksocial01_twitter') : "").'" />
				<div class="clear">&nbsp;</div>
				<label for="google_url">'.$this->l('Google + URL: ').'</label>
				<input type="text" id="google_url" name="google_url" value="'.Tools::safeOutput((Configuration::get('blocksocial01_google') != "") ? Configuration::get('blocksocial01_google') : "").'" />
				<div class="clear">&nbsp;</div>
				<label for="pinterest_url">'.$this->l('Pinterest URL: ').'</label>
				<input type="text" id="pinterest_url" name="pinterest_url" value="'.Tools::safeOutput((Configuration::get('blocksocial01_pinterest') != "") ? Configuration::get('blocksocial01_pinterest') : "").'" />
				<div class="clear">&nbsp;</div>
				<label for="tumblr_url">'.$this->l('Tumblr URL: ').'</label>
				<input type="text" id="tumblr_url" name="tumblr_url" value="'.Tools::safeOutput((Configuration::get('blocksocial01_tumblr') != "") ? Configuration::get('blocksocial01_tumblr') : "").'" />
				<div class="clear">&nbsp;</div>
				<label for="rss_url">'.$this->l('Instagram URL: ').'</label>
				<input type="text" id="instagram_url" name="instagram_url" value="'.Tools::safeOutput((Configuration::get('blocksocial01_instagram') != "") ? Configuration::get('blocksocial01_instagram') : "").'" />
				<div class="clear">&nbsp;</div>
				<label for="rss_url">'.$this->l('RSS URL: ').'</label>
				<input type="text" id="rss_url" name="rss_url" value="'.Tools::safeOutput((Configuration::get('blocksocial01_rss') != "") ? Configuration::get('blocksocial01_rss') : "").'" />
				<div class="clear">&nbsp;</div>
				<br /><center><input type="submit" name="submitModule" value="'.$this->l('Update settings').'" class="button" /></center>
			</fieldset>
		</form>';
	}
	
	public function hookDisplayHeader()
	{
		$this->context->controller->addCSS(($this->_path).'blocksocial01.css', 'all');
	}
		
	public function hookDisplayFooter()
	{
		global $smarty;

		$smarty->assign(array(
			'facebook_url' => Configuration::get('blocksocial01_facebook'),
			'twitter_url' => Configuration::get('blocksocial01_twitter'),
			'rss_url' => Configuration::get('blocksocial01_rss'),
			'google_url' => Configuration::get('blocksocial01_google'),
			'pinterest_url' => Configuration::get('blocksocial01_pinterest'),
			'tumblr_url' => Configuration::get('blocksocial01_tumblr'),
			'instagram_url' => Configuration::get('blocksocial01_instagram')
		));
		return $this->display(__FILE__, 'blocksocial01.tpl');
	}
}
?>

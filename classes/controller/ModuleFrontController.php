<?php
/*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

/**
 * @since 1.5.0
 */
class ModuleFrontControllerCore extends FrontController
{
	/**
	 * @var Module
	 */
	public $module;

	public function __construct()
	{
		$this->controller_type = 'modulefront';
		
		$this->module = Module::getInstanceByName(Tools::getValue('module'));
		if (!$this->module->active)
			Tools::redirect('index');
		$this->page_name = 'module-'.$this->module->name.'-'.Dispatcher::getInstance()->getController();

		parent::__construct();
	}

	/**
	 * Assign module template
	 *
	 * @param string $template
	 */
	public function setTemplate($template)
	{
            
		if (Tools::file_exists_cache(_PS_THEME_DIR_.'modules/'.$this->module->name.'/'.$template))
			$this->template = _PS_THEME_DIR_.'modules/'.$this->module->name.'/'.$template;
		elseif (Tools::file_exists_cache(_PS_THEME_DIR_.'modules/'.$this->module->name.'/views/templates/front/'.$template))
			$this->template = _PS_THEME_DIR_.'modules/'.$this->module->name.'/views/templates/front/'.$template;
		elseif (Tools::file_exists_cache($this->getTemplatePath().$template))
			$this->template = $this->getTemplatePath().$template;
		else
			throw new PrestaShopException("Template '$template'' not found");
	}

	/**
	 * Get path to front office templates for the module
	 *
	 * @return string
	 */
	public function getTemplatePath()
	{
		return _PS_MODULE_DIR_.$this->module->name.'/views/templates/front/';
	}
}

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

class ContactController extends ContactControllerCore {

    public $php_self = 'contact';
    public $ssl = true;

    /**
     * Start forms process
     * @see FrontController::postProcess()
     */
    public function postProcess() {
        parent::postProcess();
    }

    /**
     * Assign template vars related to page content
     * @see FrontController::initContent()
     */
    public function initContent() {
        parent::initContent();
    }

    /**
     * Assign template vars related to order list and product list ordered by the customer
     */
    protected function assignOrderList() {
        parent::assignOrderList();
        $this->context->smarty->assign(array(
            'blockcontactinfos_company' => Configuration::get('blockcontactinfos_company'),
            'blockcontactinfos_address' => Configuration::get('blockcontactinfos_address'),
            'blockcontactinfos_phone' => Configuration::get('blockcontactinfos_phone'),
            'blockcontactinfos_email' => Configuration::get('blockcontactinfos_email')
        ));
    }

}
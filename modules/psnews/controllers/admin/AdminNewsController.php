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
require_once(_PS_MODULE_DIR_ . 'psnews/classes/News.php');
class AdminNewsController extends ModuleAdminController {
    public function __construct() {
        $this->table = 'news';
        $this->className = 'News';
        $this->lang = true;
        $this->deleted = false;
        $this->explicitSelect = true;
        $this->allow_export = true;

        $this->context = Context::getContext();

        $this->fieldImageSettings = array(
            'name' => 'image',
            'dir' => 'c'
        );

        $this->fields_list = array(
            'id_news' => array(
                'title' => $this->l('ID'),
                'align' => 'center',
                'width' => 20
            ),
            'name' => array(
                'title' => $this->l('Name'),
                'width' => 'auto'
            ),
            'description' => array(
                'title' => $this->l('Description'),
                'width' => 500,
                'maxlength' => 90,
                'callback' => 'getDescriptionClean',
                'orderby' => false
            ),
            'position' => array(
                'title' => $this->l('Position'),
                'width' => 40,
                'filter_key' => 'position',
                'align' => 'center',
                'position' => 'position'
            ),
            'active' => array(
                'title' => $this->l('Displayed'),
                'active' => 'status',
                'align' => 'center',
                'type' => 'bool',
                'width' => 70,
                'orderby' => false
            )
        );

        $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected')));
        $this->specificConfirmDelete = false;

        parent::__construct();
    }
    
    public function init() {
        parent::init();

        // context->shop is set in the init() function, so we move the _news instanciation after that
        if (($id_news = Tools::getvalue('id_news')) && $this->action != 'select_delete')
            $this->_news = new News($id_news);
        
        // shop restriction : if news is not available for current shop, we redirect to the list from default news
        if (Validate::isLoadedObject($this->_news) && !$this->_news->isAssociatedToShop() && Shop::getContext() == Shop::CONTEXT_SHOP) {
            $this->redirect_after = self::$currentIndex . '&id_news=' . (int) $this->context->shop->getNews() . '&token=' . $this->token;
            $this->redirect();
        }
    }

    public function renderForm() {
        $this->initToolbar();
        $obj = $this->loadObject(true);

        $this->fields_form = array(
            'tinymce' => true,
            'legend' => array(
                'title' => $this->l('News'),
                'image' => '../img/admin/tab-categories.gif'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Name:'),
                    'name' => 'name',
                    'lang' => true,
                    'size' => 48,
                    'required' => true,
                    'class' => 'copy2friendlyUrl',
                    'hint' => $this->l('Invalid characters:') . ' <>;=#{}',
                ),
                array(
                    'type' => 'radio',
                    'label' => $this->l('Displayed:'),
                    'name' => 'active',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    )
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Description:'),
                    'name' => 'description',
                    'autoload_rte' => true,
                    'lang' => true,
                    'rows' => 10,
                    'cols' => 100,
                    'hint' => $this->l('Invalid characters:') . ' <>;=#{}'
                ),
                array(
                    'type' => 'file',
                    'label' => $this->l('Image:'),
                    'name' => 'image',
                    'display_image' => true,
                    'desc' => $this->l('Upload a news logo from your computer.')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Meta title:'),
                    'name' => 'meta_title',
                    'lang' => true,
                    'hint' => $this->l('Forbidden characters:') . ' <>;=#{}'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Meta description:'),
                    'name' => 'meta_description',
                    'lang' => true,
                    'hint' => $this->l('Forbidden characters:') . ' <>;=#{}'
                ),
                array(
                    'type' => 'tags',
                    'label' => $this->l('Meta keywords:'),
                    'name' => 'meta_keywords',
                    'lang' => true,
                    'hint' => $this->l('Forbidden characters:') . ' <>;=#{}',
                    'desc' => $this->l('To add "tags," click in the field, write something, and then press "Enter."')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Friendly URL:'),
                    'name' => 'link_rewrite',
                    'lang' => true,
                    'required' => true,
                    'hint' => $this->l('Only letters and the minus (-) character are allowed.')
                )
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );

        return parent::renderForm();
    }

}
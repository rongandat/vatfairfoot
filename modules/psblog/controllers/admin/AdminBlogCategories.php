<?php

/**
 * Prestablog tab for admin panel
 * @category admin
 *
 * @author Appside 
 * @copyright Appside
 * @link appside.net
 * 
 */
require_once(_PS_MODULE_DIR_ . 'psblog/psblog.php');
require_once(_PS_MODULE_DIR_ . 'psblog/classes/BlogCategory.php');
require_once(_PS_MODULE_DIR_ . 'psblog/classes/BlogPost.php');
require_once(_PS_MODULE_DIR_ . 'psblog/classes/BlogShop.php');

class AdminBlogCategoriesController extends ModuleAdminController {

    public function __construct() {
        $this->table = 'blog_category';
        $this->className = 'BlogCategory';
        $this->module = 'psblog';

        $this->multishop_context = Shop::CONTEXT_ALL;

        $this->edit = true;
        $this->delete = true;
        $this->view = false;

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $this->_select = ' l.`iso_code` ';
        $this->_join .= ' LEFT JOIN ' . _DB_PREFIX_ . 'lang l on l.id_lang = a.id_lang ';

        $this->fields_list = array('id_blog_category' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 30),
             'active' => array('title' => $this->l('Active'), 'active' => 'status', 'align' => 'center', 'type' => 'bool', 'orderby' => false, 'width' => 60));
        
        if(count(Language::getLanguages(true)) > 1){    
            $this->fields_list['iso_code'] = array('title' => $this->l('Language'), 'width' => 20);
        }
        
        $this->fields_list['position'] = array('title' => $this->l('Position'), 'width' => 60);
        $this->fields_list['name'] = array('title' => $this->l('Category name'), 'width' => 400);

        BlogShop::addBlogAssoTables();

        parent::__construct();
    }

    public function renderForm() {

        $this->toolbar_btn['save-and-stay'] = array('href' => '#', 'desc' => $this->l('Save and stay'));

        $this->initToolbar();
        if (!$this->loadObject(true))
            return;

        $this->addJS(array(_MODULE_DIR_ . $this->module->name . '/js/psblog.js'));

        $lang_value = $this->default_form_language;

        $lang_list = Language::getlanguages(TRUE);
        
        $input_lang_type = count($lang_list) > 1 ? 'select' : 'hidden';
        
        $lang_list[] = array('id_lang' => 0, 'name' => $this->l('All languages'));
        
        $this->fields_form = array(
            'tinymce' => true,
            'legend' => array(
                'title' => $this->l('Category'),
                'image' => '../img/admin/tab-categories.gif'
            ),
            'input' => array(
                array(
                    'type' => $input_lang_type,
                    'label' => $this->l('Language:'),
                    'name' => 'id_lang',
                    'options' => array(
                        'query' => $lang_list,
                        'id' => 'id_lang',
                        'name' => 'name'
                )),
                array(
                    'type' => 'text',
                    'label' => $this->l('Name :'),
                    'name' => 'name',
                    'id' => 'title_' . $lang_value,
                    'size' => 50,
                    'required' => true,
                    'class' => 'copy2friendlyBlogUrl'
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Description :'),
                    'name' => 'description',
                    'autoload_rte' => true,
                    'rows' => 10,
                    'cols' => 100,
                    'desc' => $this->l('Will be displayed in top of blog category page')
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Meta description :'),
                    'rows' => 2,
                    'cols' => 80,
                    'name' => 'meta_description',
                    'desc' => $this->l('Search engines meta description')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Meta keywords :'),
                    'size' => 50,
                    'name' => 'meta_keywords',
                    'desc' => $this->l('Separate keywords by ,')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Friendly URL :'),
                    'size' => 50,
                    'id' => 'link_rewrite_' . $lang_value,
                    'name' => 'link_rewrite',
                    'desc' => $this->l('Only letters and the minus (-) character are allowed')
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );

        $this->fields_form['input'][] = array(
            'type' => 'text',
            'label' => $this->l('Position :'),
            'size' => 3,
            'name' => 'position'
        );

        $this->fields_form['input'][] = array(
            'type' => 'radio',
            'label' => $this->l('Active :'),
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
        );

        if (Shop::isFeatureActive())
            $this->fields_form['input'][] = array(
                'type' => 'shop',
                'label' => $this->l('Shop association :'),
                'name' => 'checkBoxShopAsso',
            );

        return parent::renderForm();
    }

}

?>

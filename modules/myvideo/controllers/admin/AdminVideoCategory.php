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
require_once(_PS_MODULE_DIR_ . 'myvideo/classes/VideoCategory.php');

class AdminVideoCategoryController extends ModuleAdminController {

    public function __construct() {
        $this->table = 'video_cat';
        $this->className = 'VideoCategory';
        $this->module = 'myvideos';

        $this->lang = true;
       
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));

        $this->fields_list = array(
            'id_video' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 30),
            'name' => array('title' => $this->l('Name'), 'width' => 'auto'),
            'description' => array('title' => $this->l('Description'), 'width' => 500, 'maxlength' => 90, 'orderby' => false),
            'position' => array('title' => $this->l('Position'), 'width' => 40, 'filter_key' => 'position', 'align' => 'center'),
            'active' => array(
                'title' => $this->l('Displayed'), 'width' => 25, 'active' => 'status',
                'align' => 'center', 'type' => 'bool', 'orderby' => false
        ));
        parent::__construct();
    }

    public function renderForm() {
        $this->toolbar_btn['save-and-stay'] = array('href' => '#', 'desc' => $this->l('Save and stay'));

        $this->initToolbar();
        if (!$this->loadObject(true))
            return;

        $this->fields_form = array(
            'tinymce' => true,
            'legend' => array(
                'title' => $this->l('Category'),
                'image' => '../img/admin/tab-categories.gif'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Name:'),
                    'name' => 'name',
                    'required' => true,
                    'lang' => true,
                    'class' => 'copy2friendlyUrl',
                    'hint' => $this->l('Invalid characters:') . ' <>;=#{}'
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Description :'),
                    'name' => 'description',
                    'autoload_rte' => true,
                    'rows' => 10,
                    'cols' => 100,
                    'lang' => true,
                    'desc' => $this->l('Will be displayed in top of category page')
                )
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
            'label' => $this->l('Status :'),
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

        return parent::renderForm();
    }

}

?>

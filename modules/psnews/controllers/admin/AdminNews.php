<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(_PS_MODULE_DIR_ . 'psnews/psnews.php');
require_once(_PS_MODULE_DIR_ . 'psnews/classes/News.php');

class AdminNewsController extends ModuleAdminController {

    public function __construct() {
        $this->table = 'news';
        $this->className = 'News';
        $this->module = 'psnews';

        $this->lang = true;
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));
        $this->context = Context::getContext();

        $this->fieldImageSettings = array(
            'name' => 'image',
            'dir' => 'psn'
        );
        $this->fields_list = array(
            'id_news' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 30),
            'image' => array(
                'title' => $this->l('Image'),
                'image' => 'psnews',
                'orderby' => false,
                'search' => false,
                'width' => 150,
                'align' => 'center',
            ),
            'title' => array('name' => $this->l('Title'), 'width' => 'auto'),
            'description' => array('title' => $this->l('Description'), 'width' => 500, 'maxlength' => 90, 'orderby' => false),
            'position' => array('title' => $this->l('Position'), 'width' => 40, 'filter_key' => 'position', 'align' => 'center'),
            'active' => array(
                'title' => $this->l('Displayed'), 'width' => 25, 'active' => 'status',
                'align' => 'center', 'type' => 'bool', 'orderby' => false
        ));
        parent::__construct();
    }

    public function setMedia() {
        parent::setMedia();
        $this->addJqueryUi('ui.widget');
        $this->addJqueryPlugin('tagify');
    }

    public function renderForm() {
        $this->toolbar_btn['save-and-stay'] = array('href' => '#', 'desc' => $this->l('Save and stay'));
        $defaultLanguage = $this->default_form_language;

        $this->initToolbar();
        if (!$this->loadObject(true))
            return;

        $this->fields_form = array(
            'tinymce' => true,
            'legend' => array(
                'title' => $this->l('Photo'),
                'image' => '../img/admin/tab-categories.gif'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Title:'),
                    'name' => 'name',
                    'required' => true,
                    'lang' => true,
                    'class' => 'copy2friendlyUrl',
                    'hint' => $this->l('Invalid characters:') . ' <>;=#{}'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Meta Title:'),
                    'name' => 'meta_title',
                    'lang' => true,
                    'class' => '',
                    'hint' => $this->l('Invalid characters:') . ' <>;=#{}'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Meta Keword:'),
                    'name' => 'meta_keywords',
                    'lang' => true,
                    'class' => '',
                    'hint' => $this->l('Invalid characters:') . ' <>;=#{}'
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Meta Description :'),
                    'name' => 'meta_description',
                    'autoload_rte' => true,
                    'rows' => 10,
                    'cols' => 100,
                    'lang' => true,
                    'desc' => $this->l('Will be displayed in top of category page')
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
                ),
                array(
                    'type' => 'file',
                    'label' => $this->l('Image :'),
                    'name' => 'image',
                    'required' => true,
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Youtube:'),
                    'name' => 'youtube_id',
                    'class' => '',
                    'required' => FALSE,
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Friendly URL:'),
                    'name' => 'link_rewrite',
                    'lang' => true,
                    'required' => true,
                    'hint' => $this->l('Only letters and the minus (-) character are allowed.')
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
        if (!($news = $this->loadObject(true)))
            return;
        $image = ImageManager::thumbnail(_PS_PSNEWS_IMG_DIR_ . '/' . $news->id_news . '.jpg', $this->table . '_' . (int) $news->id_news . '.' . $this->imageType, 350, $this->imageType, true);
        $this->fields_value = array(
            'image' => $image ? $image : false,
            'size' => $image ? filesize(_PS_PSNEWS_IMG_DIR_ . '/' . $news->id_news . '.jpg') / 1000 : false
        );
        $this->tpl_form_vars = array(
            'active' => $this->object->active,
            'PS_ALLOW_ACCENTED_CHARS_URL', (int) Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL')
        );
        return parent::renderForm();
    }

    protected function afterImageUpload() {
        $res = true;

        /* Generate image with differents size */
        if (($id_news = (int) Tools::getValue('id_news')) &&
                isset($_FILES) &&
                count($_FILES) &&
                file_exists(_PS_PSNEWS_IMG_DIR_ . $id_news . '.jpg')) {
            $images_types = ImageType::getImagesTypes('products');
            foreach ($images_types as $k => $image_type) {
                $res &= ImageManager::resize(
                                _PS_PSNEWS_IMG_DIR_ . $id_news . '.jpg', _PS_PSNEWS_IMG_DIR_ . $id_news . '-' . stripslashes($image_type['name']) . '.jpg', (int) $image_type['width'], (int) $image_type['height']
                );
            }
        }

        if (!$res)
            $this->errors[] = Tools::displayError('Unable to resize one or more of your pictures.');

        return $res;
    }

}

?>

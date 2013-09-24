<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(_PS_MODULE_DIR_ . 'myphotos/classes/PhotosCategory.php');
require_once(_PS_MODULE_DIR_ . 'myphotos/classes/Photos.php');
require_once(_PS_MODULE_DIR_ . 'myphotos/helper/HelperFieldFormNew.php');

class AdminPhotoController extends ModuleAdminController {

    public function __construct() {
        $this->table = 'photo';
        $this->className = 'Photos';
        $this->module = 'myphotos';

        $this->lang = true;
        $this->addRowAction('view');
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));

        $this->fields_list = array(
            'id_photo' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 30),
            'title' => array('title' => $this->l('Title'), 'width' => 'auto'),
            'description' => array('title' => $this->l('Description'), 'width' => 500, 'maxlength' => 90, 'orderby' => false),
            'position' => array('title' => $this->l('Position'), 'width' => 40, 'filter_key' => 'position', 'align' => 'center'),
            'active' => array(
                'title' => $this->l('Displayed'), 'width' => 25, 'active' => 'status',
                'align' => 'center', 'type' => 'bool', 'orderby' => false
        ));
        parent::__construct();
    }

    public function renderForm() {
        $form_output = '';
        $defaultLanguage = $this->default_form_language;

        if (!$this->loadObject(true))
            return;

        $obj = $this->object;

        $lang_value = $this->default_form_language;
        $activeLanguages = Language::getLanguages(true);

        $form_output .= '<form class="defaultForm adminposts" id="' . $this->table . '_form" action="' . self::$currentIndex . '&submitAdd' . $this->table . '=1&token=' . $this->token . '" method="post" enctype="multipart/form-data">
                            ' . ($obj->id ? '<input type="hidden" name="id_' . $this->table . '" value="' . $obj->id . '" />' : '');

        $form_output .= '</fieldset><div class="clear space">&nbsp;</div>

                    <fieldset>
                        
                    <legend><img src="../img/admin/translation.gif"> ' . $this->l('Content') . '</legend>';

        if (count($activeLanguages) > 1) {
            $lang_options = array();
            foreach ($activeLanguages as $l)
                $lang_options[] = array('value' => $l['id_lang'], 'title' => $l['name']);

            $lang_options[] = array('value' => 0, 'title' => $this->l('All languages'));
            $form_output .= HelperFieldFormNew::displaySelectField('id_lang', $lang_options, $lang_value, $this->l('Language :'));
        } else {
            $form_output .= '<input type="hidden" name="id_lang" value="0" />';
        }

        $form_output .= HelperFieldFormNew::displayTextField('title', $this->getFieldValue($obj, 'title'), 'text', $this->l('Title :'), NULL, array('required' => true, 'class' => 'copy2friendlyBlogUrl', 'id' => 'title_' . $lang_value));

        $form_output .= HelperFieldFormNew::displayTextField('description', $this->getFieldValue($obj, 'description'), 'textarea', $this->l('Description :'), NULL, array('tinymce' => true));

        $form_output .= '</fieldset><div class="clear space">&nbsp;</div>';

        // MEDIAS
        $form_output .= '<fieldset>
                            <legend><img src="../img/admin/picture.gif"> ' . $this->l('Medias') . '</legend>
                            <label>' . $this->l('Images :') . ' </label>
                            <div class="margin-form">
                                <input type="file" accept="gif|jpg|png" maxlength="' . $this->conf['nb_max_img'] . '" id="img" name="img" /> .jpg, .png, .gif
                            </div>
                            <div class="margin-form" id="blog-img-list"></div>
                            
                            <div class="margin-form">';



        $relative = rtrim($this->conf['img_save_path'], '/') . "/";

        $images = $this->getFieldValue($obj, 'img');
       if($images){
          $form_output .= ' <img src="' . __PS_BASE_URI__ . $relative . 'thumb/' . $images . '" alt="' . $images . '" style="max-height:200px;" />';
       }      
        $form_output .= '</fieldset>';
        $form_output .= '<div class="clear space">&nbsp;</div>';


        // CATEGORIES
        $form_output .= '<fieldset><legend><img src="../img/admin/tab-categories.gif"> ' . $this->l('Categories') . '</legend>';
        $form_output .= '<label>&nbsp;</label>
					<div class="margin-form"> ';

        $post_categories = Tools::getValue('groupBox', $obj->getCategories());       
        $categories = PhotosCategory::listCategories(false, false);
        
        if (is_array($categories) && count($categories)) {
            $form_output .= '<table cellspacing="0" cellpadding="0" class="table" style="min-width:500px;">
                                <tr>
                                    <th style="width:40px;"><input type="checkbox" name="checkme" class="noborder" onclick="checkDelBoxes(this.form, \'groupBox[]\', this.checked)" /></th>
                                    <th style="width:30px;">' . $this->l('ID') . '</th>
                                    <th>' . $this->l('Category name') . '</th>
                                </tr>';
            $irow = 0;
            foreach ($categories as $cat) {
                $form_output .= '
                                    <tr class="' . ($irow++ % 2 ? 'alt_row' : '') . '">
                                            <td><input type="checkbox" name="groupBox[]" class="groupBox" id="groupBox_' . $cat['id_photo_cat'] . '" value="' . $cat['id_photo_cat'] . '" ' . (in_array($cat['id_photo_cat'], $post_categories) ? 'checked="checked" ' : '') . '/></td>
                                            <td>' . $cat['id_photo_cat'] . '</td>
                                            <td><label for="groupBox_' . $cat['id_photo_cat'] . '" class="t">' . $cat['name'] . ' ' . (count($activeLanguages) > 1 && $cat['iso_code'] != '' ? '(' . $cat['iso_code'] . ')' : '') . ' </label></td>
                                    </tr>';
            }
            $form_output .= '
                                </table>
                                <p style="padding:0px; margin:10px 0px 10px 0px;">' . $this->l('Mark all checkbox(es) of categories to which the photo is to be in') . '</p>';
        }
        else
            $form_output .= '<p>' . $this->l('No category created') . '</p>';

        $form_output .= '</div>';
        $form_output .= '</fieldset><div class="clear space">&nbsp;</div>';


        $helper = new HelperCore();
        $helper->module = new MyPhotos();
        $template = $helper->createTemplate('form_photo.tpl');

        $iso_code = $this->context->language->iso_code;
        $iso = file_exists(_PS_ROOT_DIR_ . '/js/tiny_mce/langs/' . $iso_code . '.js') ? $iso_code : 'en';
        $iso_tiny_mce = (file_exists(_PS_JS_DIR_ . 'tiny_mce/langs/' . $iso_code . '.js') ? $iso_code : 'en');

        $this->addjQueryPlugin(array('autocomplete', 'ajaxfileupload', 'date'));

        $this->addJS(array(
            _MODULE_DIR_ . $this->module->name . '/js/photo.js',
            _MODULE_DIR_ . $this->module->name . '/js/jquery.MultiFile.pack.js',
            _PS_JS_DIR_ . 'tiny_mce/tiny_mce.js',
            _PS_JS_DIR_ . 'tinymce.inc.js',
            _PS_JS_DIR_ . 'fileuploader.js'));

        $this->addJqueryUI(array('ui.core', 'ui.datepicker'));

        $this->toolbar_btn['save-and-stay'] = array('href' => '#', 'desc' => $this->l('Save and stay'));

        $title = array($this->l('Photo'), ($obj->id ? $this->l('Edit') : $this->l('Add new')));

        $template->assign(array(
            'show_toolbar' => true,
            'path_css' => _THEME_CSS_DIR_,
            'toolbar_btn' => $this->toolbar_btn,
            'currentIndex' => self::$currentIndex,
            'toolbar_scroll' => true,
            'title' => $title,
            'ad' => dirname($_SERVER['PHP_SELF']),
            'form_content' => $form_output,
            'iso_tiny_mce' => $iso_tiny_mce,
            'iso' => $iso,
            'tinymce' => true,
            'vat_number' => file_exists(_PS_MODULE_DIR_ . 'vatnumber/ajax.php'),
            'languages' => $this->_languages,
            'id_lang_default' => $defaultLanguage,
            'defaultFormLanguage' => $defaultLanguage,
            'allowEmployeeFormLang' => $this->allow_employee_form_lang
        ));

        $form_content = $template->fetch();

        return $form_content;
    }

}

?>

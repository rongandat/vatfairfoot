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
require_once(_PS_MODULE_DIR_ . 'psblog/helper/HelperFieldForm.php');

class AdminBlogPostsController extends ModuleAdminController {

    private $conf;

    public function __construct() {
        $this->table = 'blog_post';
        $this->className = 'BlogPost';

        $this->edit = true;
        $this->view = false;
        $this->delete = true;

        if (isset($_GET['id_' . $this->table]) || isset($_GET['add' . $this->table])) {
            $this->multishop_context = Shop::CONTEXT_ALL;
        }

        $this->module = 'psblog';
        $this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items ?')));

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $this->_select .= ' l.iso_code ';
        $this->_join .= ' LEFT JOIN ' . _DB_PREFIX_ . 'lang l on l.id_lang = a.id_lang ';
        $this->_orderBy = 'id_blog_post';
        $this->_orderWay = 'DESC';

        $this->fields_list = array(
            'id_blog_post' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 30),
            'status' => array('title' => $this->l('Status'), 'align' => 'center', 'icon' => array('published' => 'enabled.gif', 'drafted' => 'warning.gif', 'suspended' => 'forbbiden.gif', 'default' => 'unknown.gif'), 'orderby' => false, 'search' => false, 'width' => 60));
        
        if(count(Language::getLanguages(true)) > 1){
            $this->fields_list['iso_code'] = array('title' => $this->l('Lang'), 'width' => 20);
        }
        
        $this->fields_list['title'] = array('title' => $this->l('Title'), 'width' => 400);
        $this->fields_list['date_on'] = array('title' => $this->l('Publication date'), 'width' => 120, 'type' => 'date', 'search' => false);

        $this->conf = Psblog::getPreferences();

        BlogShop::addBlogAssoTables();

        parent::__construct();
    }

    public function setMedia() {
        parent::setMedia();
    }

    public function renderList() {
        $this->initListPosts();
    }

    public function initListPosts() {
        $this->context->smarty->assign('title_list', $this->l('List of posts'));
        $this->content .= parent::renderList();
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

            $form_output .= HelperFieldForm::displaySelectField('id_lang', $lang_options, $obj->id_lang, $this->l('Language :'));
        } else {
            $form_output .= '<input type="hidden" name="id_lang" value="0" />';
        }

        $form_output .= HelperFieldForm::displayTextField('title', $this->getFieldValue($obj, 'title'), 'text', $this->l('Title :'), NULL, array('required' => true, 'class' => 'copy2friendlyBlogUrl', 'id' => 'title_' . $lang_value));

        $form_output .= HelperFieldForm::displayTextField('excerpt', $this->getFieldValue($obj, 'excerpt'), 'textarea', $this->l('Excerpt :'), $this->l('Article summary for lists'), array('rows' => 3));

        $form_output .= HelperFieldForm::displayTextField('content', $this->getFieldValue($obj, 'content'), 'textarea', $this->l('Content :'), NULL, array('tinymce' => true));

        $form_output .= '</fieldset><div class="clear space">&nbsp;</div>';

        // MEDIAS
        $form_output .= '<fieldset>
                            <legend><img src="../img/admin/picture.gif"> ' . $this->l('Medias') . '</legend>
                            <label>' . $this->l('Images/Videos :') . ' </label>
                            <div class="margin-form">
                                <input type="file" accept="gif|jpg|png|mp4|flv|wmv" maxlength="' . $this->conf['nb_max_img'] . '" id="blog_img" name="blog_img[]" /> .jpg, .png, .gif, .mp4, .flv, .wmv
                            </div>
                            <div class="margin-form" id="blog-img-list"></div>
                            
                            <div class="margin-form">';
       


        $relative = rtrim($this->conf['img_save_path'], '/') . "/";

        $images = (Tools::getValue('id_blog_post') ? $obj->getImages() : array());
        if (count($images)) {
            $form_output .= '<table class="table" cellpadding="0" cellspacing="0" style="min-width:700px;">
                                        <tr>
                                        <th>' . $this->l('Image/Video') . '</th>
                                        <th>' . $this->l('Default') . '</th>
                                        <th>' . $this->l('Position') . '</th>
                                        <th>' . $this->l('Delete') . '</th>
                                        </tr>';
            $irow = 0;
            foreach ($images as $val) {
                $filename = $val['img_name'];
                if (file_exists(_PS_ROOT_DIR_ . "/" . $relative . $filename)) {
                    $form_output .= '<tr class="' . ($irow++ % 2 ? 'alt_row' : '') . '">
                                                    <td><img src="' . __PS_BASE_URI__ . $relative . 'thumb/' . $filename . '" alt="' . $filename . '" style="max-height:200px;" /></td>
                                                    <td><input type="radio" id="blog_img_default_' . $val['id_blog_image'] . '" name="blog_img_default" ' . (intval($val['default']) == 1 ? 'checked' : '') . ' value="' . $val['id_blog_image'] . '" /></td>
                                                    <td><input type="text" name="img_pos[' . $val['id_blog_image'] . ']" value="' . $val['position'] . '" size="2" /></td>
                                                    <td style="width:70px; text-align:center">
                                                        <a href="' . self::$currentIndex . '&deleteImg&update' . $this->table . '&token=' . $this->token . '&id_' . $this->table . '=' . $obj->id . '&id_img=' . $val['id_blog_image'] . '" title="' . $this->l('Delete') . '" onclick="if(!confirm(\'' . $this->l('Are you sure you want to delete this picture ?') . '\')) return false;"><img src="../img/admin/delete.gif" alt="' . $this->l('Delete') . '" /></a></td> 
                                                  </tr>';
                }
            }
            $form_output .= "</table>";
        }
        $form_output .= '</fieldset>';
        $form_output .= '<div class="clear space">&nbsp;</div>';

        if (isset($this->conf['category_active']) && $this->conf['category_active'] == 1) {
            // CATEGORIES
            $form_output .= '<fieldset><legend><img src="../img/admin/tab-categories.gif"> ' . $this->l('Categories') . '</legend>';
            $form_output .= '<label>&nbsp;</label>
					<div class="margin-form"> ';

            $post_categories = Tools::getValue('groupBox', $obj->getCategories());

            $categories = BlogCategory::listCategories(false, false);
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
                                            <td><input type="checkbox" name="groupBox[]" class="groupBox" id="groupBox_' . $cat['id_blog_category'] . '" value="' . $cat['id_blog_category'] . '" ' . (in_array($cat['id_blog_category'], $post_categories) ? 'checked="checked" ' : '') . '/></td>
                                            <td>' . $cat['id_blog_category'] . '</td>
                                            <td><label for="groupBox_' . $cat['id_blog_category'] . '" class="t">' . $cat['name'] . ' ' . (count($activeLanguages) > 1 && $cat['iso_code'] != '' ? '(' . $cat['iso_code'] . ')' : '') . ' </label></td>
                                    </tr>';
                }
                $form_output .= '
                                </table>
                                <p style="padding:0px; margin:10px 0px 10px 0px;">' . $this->l('Mark all checkbox(es) of categories to which the post is to be in') . '</p>';
            } else
                $form_output .= '<p>' . $this->l('No category created') . '</p>';
            
            $form_output .= '</div>';
            $form_output .= '</fieldset><div class="clear space">&nbsp;</div>';
        }

        if (isset($this->conf['product_active']) && $this->conf['product_active'] == 1) {
            // PRODUCTS
            $form_output .= '<fieldset>
                                    <legend><img src="../img/admin/tab-products.gif"> ' . $this->l('Related products') . '</legend>';

            $accessories = (Tools::getValue('id_blog_post') ? $obj->getProducts(false) : array());

            $form_output .= '<div id="divAccessories">';
            foreach ($accessories as $accessory)
                $form_output .= $accessory['name'] . (!empty($accessory['reference']) ? ' (' . $accessory['reference'] . ')' : '') . ' <span class="delAccessory" name="' . $accessory['id_product'] . '" style="cursor:pointer;"><img src="../img/admin/delete.gif" class="middle" alt="Delete" /></span><br />';
            $form_output .= '</div>';

            $form_output .= '<div class="margin-form"> 

                                <input type="hidden" name="inputAccessories" id="inputAccessories" value="';
            foreach ($accessories as $accessory) {
                $form_output .= $accessory['id_product'] . '-';
            } $form_output .= '" />	
                                <input type="hidden" name="nameAccessories" id="nameAccessories" value="';
            foreach ($accessories as $accessory) {
                $form_output .= $accessory['name'] . '¤';
            } $form_output .= '" />';

            $form_output .= '<div id="ajax_choose_product" style="padding:6px; padding-top:2px; width:600px;">
                                        <p class="clear">' . $this->l('Begin typing the first letters of the product name, then select the product from the drop-down list:') . '</p>
                                        <input type="text" value="" id="product_autocomplete_input" />
                                        <img onclick="$(this).prev().search();" style="cursor: pointer;" src="../img/admin/add.gif" alt="' . $this->l('Add a product') . '" />
                                    </div';

            $form_output .= '</div>';

            $form_output .= '</fieldset><div class="clear space">&nbsp;</div>';
        }

        if (isset($this->conf['related_active']) && $this->conf['related_active'] == 1) {

            // RELATED ARTICLES
            $form_output .= '<fieldset>
					<legend><img src="../img/admin/tab-categories.gif"> ' . $this->l('Related blog posts') . '</legend>';

            $blog_related = Tools::getValue('groupRelated', $obj->getRelatedIds(true));
            $articles = BlogPost::listPosts(false, false, null, null, false, null, null, $obj->id);

            $form_output .= '<label> &nbsp; </label>
                             <div class="margin-form" style="height:140px; overflow-x:hidden; overflow-y:scroll; padding:0;">';

            if (count($articles)) {

                $form_output .= '<table cellspacing="0" cellpadding="0" class="table" style="min-width:500px;">
                                <tr>
                                        <th style="width:40px;"></th>
                                        <th style="width:30px;">' . $this->l('ID') . '</th>
                                        <th>' . $this->l('Title') . '</th>
                                </tr>';

                $irow = 0;
                foreach ($articles as $post) {

                    if ($post['id_blog_post'] == $obj->id) continue;
                    $iso = (count($activeLanguages) > 1 && $post['id_lang'] != 0 ? '(' . Language::getIsoById($post['id_lang']) . ')' : '');
                    
                    $form_output .= '<tr class="' . ($irow++ % 2 ? 'alt_row' : '') . '">
                                                                <td><input type="checkbox" name="groupRelated[]" class="groupBox" id="groupRelated_' . $post['id_blog_post'] . '" value="' . $post['id_blog_post'] . '" ' . (in_array($post['id_blog_post'], $blog_related) ? 'checked="checked" ' : '') . '/></td>
                                                                <td>' . $post['id_blog_post'] . '</td>
                                                                <td><label for="groupRelated_' . $post['id_blog_post'] . '" class="t">' . $post['title'] .' '.$iso. '</label></td>
                                                        </tr>';
                }

                $form_output .= '</table>';
                $form_output .= '</div> <p style="font-size:11px;">' . $this->l('Select related posts') . '</p> <div class="clear">&nbsp;</div>';
                
            }else {
                $form_output .= '<p>' . $this->l('No posts created') . '</p>';
            }

            $form_output .= '</fieldset><div class="clear space">&nbsp;</div>';
        }

        $form_output .= '<fieldset><legend>' . $this->l('SEO - Post metas') . '</legend>';

        $form_output .= HelperFieldForm::displayTextField('link_rewrite', $this->getFieldValue($obj, 'link_rewrite'), 'text', $this->l('Friendly URL :'), $this->l('Only letters and the minus (-) character are allowed'), array('id' => 'link_rewrite_' . $lang_value));

        $form_output .= HelperFieldForm::displayTextField('meta_description', $this->getFieldValue($obj, 'meta_description'), 'textarea', $this->l('META description :'), $this->l('Search engines meta description'), array('rows' => 2));

        $form_output .= HelperFieldForm::displayTextField('meta_keywords', $this->getFieldValue($obj, 'meta_keywords'), 'text', $this->l('META keywords :'), $this->l('Separate keywords by ,'));

        $form_output .= '</fieldset><div class="clear space">&nbsp;</div>';

        $form_output .= '<fieldset><legend><img src="../img/admin/cog.gif"> ' . $this->l('Publication options') . '</legend>';

        $status_options = array(array('value' => 'published', 'title' => $this->l('Published')),
            array('value' => 'drafted', 'title' => $this->l('Drafted')),
            array('value' => 'suspended', 'title' => $this->l('Suspended')));

        $status_value = $this->getFieldValue($obj, 'status');

        $form_output .= HelperFieldForm::displaySelectField('status', $status_options, $status_value, $this->l('Status :'));

        if (isset($this->conf['comment_active']) && $this->conf['comment_active'] == 1) {

            $comments_options = array(array('value' => '1', 'title' => $this->l('Enabled')),
                array('value' => '0', 'title' => $this->l('Disabled')));

            $comments_value = (!$obj->id) ? 1 : $this->getFieldValue($obj, 'allow_comments');

            $form_output .= HelperFieldForm::displayRadioField('allow_comments', $comments_options, $comments_value, $this->l('Allow comments :'));
        }

        $date_on = $this->getFieldValue($obj, 'date_on') == "" ? date('Y-m-d') : $this->getFieldValue($obj, 'date_on');

        $form_output .= HelperFieldForm::displayDateField('date_on', $date_on, $this->l('Publication date :'));

        if (Shop::isFeatureActive()) {
            $form_output .= '<label>&nbsp;</label>
                             <div class="margin-form">';

            $helperForm = new HelperForm();
            $helperForm->identifier = $this->identifier;
            $helperForm->table = $this->table;
            $helperForm->id = $obj->id;
            $form_output .= $helperForm->renderAssoShop();

            $form_output .= '</div>';
        }

        $form_output .= '</fieldset><div class="clear space">&nbsp;</div>';

        $form_output .= '<div class="small"><sup>*</sup> ' . $this->l('Required field') . '</div>
                    
                    <input type="submit" class="button" name="submitAdd' . $this->table . '" value="' . $this->l('Save') . '" id="' . $this->table . '_form_submit_btn" />
			
		</form>
		
		<div class="clear space">&nbsp;</div>';

        $helper = new HelperCore();
        $helper->module = new Psblog();
        $template = $helper->createTemplate('form_blog_post.tpl');

        $iso_code = $this->context->language->iso_code;
        $iso = file_exists(_PS_ROOT_DIR_ . '/js/tiny_mce/langs/' . $iso_code . '.js') ? $iso_code : 'en';
        $iso_tiny_mce = (file_exists(_PS_JS_DIR_ . 'tiny_mce/langs/' . $iso_code . '.js') ? $iso_code : 'en');

        $this->addjQueryPlugin(array('autocomplete', 'ajaxfileupload', 'date'));

        $this->addJS(array(
            _MODULE_DIR_ . $this->module->name . '/js/psblog.js',
            _MODULE_DIR_ . $this->module->name . '/js/jquery.MultiFile.pack.js',
            _PS_JS_DIR_ . 'tiny_mce/tiny_mce.js',
            _PS_JS_DIR_ . 'tinymce.inc.js',
            _PS_JS_DIR_ . 'fileuploader.js'));

        $this->addJqueryUI(array('ui.core', 'ui.datepicker'));

        $this->toolbar_btn['save-and-stay'] = array('href' => '#', 'desc' => $this->l('Save and stay'));

        $title = array($this->l('Blog'), ($obj->id ? $this->l('Edit') : $this->l('Add new')));

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

    public function initProcess() {
        parent::initProcess();
        if (Tools::isSubmit('deleteImg') && Tools::getValue('id_img')) {
            $this->action = 'postimage';
        }
    }

    public function processPostimage() {

        if (Tools::isSubmit('deleteImg') && Tools::getValue('id_img')) {

            $id = intval(Tools::getValue($this->identifier));
            if (!$id)
                return false;

            $id_blog_image = Tools::getValue('id_img');
            $object = new $this->className($id);
            $object->removeImage($id_blog_image);

            $this->redirect_after = self::$currentIndex . '&' . $this->identifier . '=' . $object->id . '&conf=7&update' . $this->table . '&token=' . $this->token;
        }
    }

    public function processSave() {

        $object = parent::processSave();

        if ($object) {

            if (empty($this->errors)) {
                $save_path = rtrim($this->conf['img_save_path'], '/') . "/";

                $groupList = Tools::getValue('groupBox');
                $object->cleanCategories();
                if (is_array($groupList) AND sizeof($groupList) > 0)
                    $object->addCategories($groupList);

                $object->cleanProducts();
                if (Tools::getValue('inputAccessories')) {
                    $productArray = explode('-', Tools::getValue('inputAccessories'), -1);
                    $object->addProducts($productArray);
                }

                $groupRelated = Tools::getValue('groupRelated');
                $object->cleanRelated();
                if (is_array($groupRelated) AND sizeof($groupRelated) > 0)
                    $object->addRelated($groupRelated);

                $images_position = Tools::getValue('img_pos');
                if (is_array($images_position) && count($images_position)) {
                    $object->setImagesPosition($images_position);
                }

                if (isset($_FILES['blog_img']) && !empty($_FILES['blog_img']['tmp_name'][0])) {
                    
                    $j = 0;
                    foreach ($_FILES['blog_img']['name'] as $key => $val) {
                        
                        if (empty($val))
                            continue;

                        $id_img = null;

                        try {
                            
                            $file['name'] = $val;
                            $file['type'] = $_FILES['blog_img']['type'][$key];
                            $file['error'] = $_FILES['blog_img']['error'][$key];
                            $file['size'] = $_FILES['blog_img']['size'][$key];
                            $file['tmp_name'] = $_FILES['blog_img']['tmp_name'][$key];

                            //img name
                            $curr_time = time() + $j;
                            $ext = substr(strrchr($file['name'], '.'), 1);
                            $img_name = $curr_time . '.' . $ext;
                            
                            $dest = _PS_ROOT_DIR_ . '/' . $save_path;
                            
                            $this->checkFile($file, $dest);
                            
                            $id_img = $object->addImage($img_name, 0);
                            $this->uploadFile($file, $dest . $img_name);

                            $object->generateImageThumbs($id_img);
                        } catch (Exception $e) {
                            $this->_errors[] = Tools::displayError($e->getMessage());
                            if (!is_null($id_img))
                                $object->removeImage($id_img);
                        }

                        $j++;
                    }
                }

                BlogShop::generateSitemap();

                if (Tools::getValue('blog_img_default')) {
                    $idImg = Tools::getValue('blog_img_default');
                    $object->setImageDefault($idImg);
                } elseif ($object->getImages(true) > 0) {
                    $object->setImageDefault(0);
                }
            }
        }

        return $object;
    }

    protected function checkFile($_file, $save_path) {

        $supported_formats = explode("|", $this->conf['file_formats']);
        $save_path = rtrim($save_path, '/') . "/";
        $MAX_FILENAME_LENGTH = 128;
        $max_file_size_in_bytes = 2147483647;

        $uploadErrors = array(0 => "There is no error, the file uploaded with success",
            1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
            2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
            3 => "The uploaded file was only partially uploaded",
            4 => "No file was uploaded",
            6 => "Missing a temporary folder");
        $tmp_file = $_file['tmp_name'];
        $file_name = $_file["name"];
        //erreurs diverses
        if (isset($_file["error"]) && $_file["error"] != 0) {
            throw new Exception("Error in file " . $file_name . " with message : " . $uploadErrors[$_file["error"]]);
        }
        
        $ext = substr(strrchr($file_name, '.'), 1);
        if (count($supported_formats) > 0) {
            if (!in_array(strtolower($ext), $supported_formats))
                throw new Exception("File format \"." . $ext . "\" is not allowed  (" . implode(',', $supported_formats) . ")");
        }
        $file_size = @filesize($tmp_file);
        //size
        if ($file_size > $max_file_size_in_bytes) {
            throw new Exception("the file " . $file_name . " is too heavy (" . $file_size . "), max size : " . $max_file_size_in_bytes);
        }
        //check filename
        if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
            throw new Exception("the filename is not valid.");
        }
        return true;
    }

    protected function uploadFile($_file, $file_name) {
        $tmp_file = $_file['tmp_name'];
        if (!@move_uploaded_file($tmp_file, $file_name)) {
            throw new Exception("the file " . $file_name . " was not uploaded");
        }
        return true;
    }

}
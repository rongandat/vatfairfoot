<?php

if (!defined('_PS_VERSION_'))
    exit;
define('_PS_PSNEWS_IMG_DIR_', _PS_IMG_DIR_ . 'psn/');

class Psnews extends Module {

    private $_html = '';
    private $_postErrors = array();
    private static $prefnews = null;
    public static $default_values = array(
        "img_width" => 200,
        "img_list_width" => 100,
        "category_active" => 1,
        "view_display_date" => 1,
        "view_display_popin" => 1,
        "list_display_date" => 1,
        'list_news_limit_page' => 15
    );

    public function __construct() {
        $this->name = 'psnews';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Khiem Pham';
        $this->multishop_context = Shop::CONTEXT_ALL;
        $this->need_instance = 0;
        parent::__construct();
        $this->checkServerConf();

        $this->displayName = $this->l('News');
        $this->description = $this->l('Add a News View on your page.');
    }

    public function install() {

        if (!parent::install())
            return false;
        if (!$this->registerHook('header') OR !$this->registerHook('actionHtaccessCreate') OR !$this->registerHook('productTab') OR !$this->registerHook('productTabContent'))
            return false;
        if (!Configuration::updateValue('PSNEWS_CONF', base64_encode(serialize(self::$default_values))))
            return false;
        if (!is_dir(_PS_PSNEWS_IMG_DIR_))
            mkdir(_PS_PSNEWS_IMG_DIR_);
        $this->createAdminTabs();
        
        require_once(dirname(__FILE__) . '/install-sql.php');
        return true;
    }
    
     public function hookActionHtaccessCreate($params) {
        $this->generateRewriteRules();
    }
    
    

    
    
    private function generateRewriteRules() {

        if (Configuration::get('PS_REWRITING_SETTINGS')) {

            $rules = "#start_prestanews - not remove this comment \n";

            $physical_uri = array();
            foreach (ShopUrl::getShopUrls() as $shop_url) {
                if (in_array($shop_url->physical_uri, $physical_uri))
                    continue;

                $rules .= "RewriteRule ^(.*)news$ " . $shop_url->physical_uri . "index.php?fc=module&module=psnews&controller=news [QSA,L] \n";
                $rules .= "RewriteRule ^(.*)news/([0-9]+)\-([a-zA-Z0-9-]*) " . $shop_url->physical_uri . "index.php?fc=module&module=psnews&controller=news&news=$2 [QSA,L] \n";

                $physical_uri[] = $shop_url->physical_uri;
            }
            $rules .= "#end_prestanews \n\n";

            $path = _PS_ROOT_DIR_ . '/.htaccess';

            if (is_writable($path)) {

                $existingRules = file_get_contents($path);

                if (!strpos($existingRules, "start_prestanews")) {
                    $handle = fopen($path, 'w');
                    fwrite($handle, $rules . $existingRules);
                    fclose($handle);
                }
            }
        }
    }
    

    
    public function hookHeader($params) {
        $this->context->controller->addCSS($this->_path . 'psnews.css', 'all');
    }

 


    private function createAdminTabs() {

        $langs = Language::getLanguages();
        $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');

        /*         * ** create tab publications *** */

        $tab0 = new Tab();
        $tab0->class_name = "AdminNews";
        $tab0->module = "psnews";
        $tab0->id_parent = 0;
        foreach ($langs as $l) {
            $tab0->name[$l['id_lang']] = $this->l('News');
        }
        $tab0->save();
        $news_tab_id = $tab0->id;

        $tab1 = new Tab();
        $tab1->class_name = "AdminNews";
        $tab1->module = "psnews";
        $tab1->id_parent = $news_tab_id;
        foreach ($langs as $l) {
            $tab1->name[$l['id_lang']] = $this->l('News');
        }
        $tab1->save();


        /*         * * RIGHTS MANAGEMENT ** */
        Db::getInstance()->Execute('DELETE FROM ' . _DB_PREFIX_ . 'access 
                                        WHERE `id_tab` = ' . (int) $tab0->id . ' 
                                            OR `id_tab` = ' . (int) $tab1->id);

        Db::getInstance()->Execute('DELETE FROM ' . _DB_PREFIX_ . 'module_access WHERE `id_module` = ' . (int) $this->id);

        $profiles = Profile::getProfiles($id_lang);

        if (count($profiles)) {
            foreach ($profiles as $p) {

                Db::getInstance()->Execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'access`(`id_profile`,`id_tab`,`view`,`add`,`edit`,`delete`) 
                                                 VALUES (' . $p['id_profile'] . ', ' . (int) $tab0->id . ',1,1,1,1)');

                Db::getInstance()->Execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'access`(`id_profile`,`id_tab`,`view`,`add`,`edit`,`delete`) 
                                                 VALUES (' . $p['id_profile'] . ', ' . (int) $tab1->id . ',1,1,1,1)');



                Db::getInstance()->execute('INSERT INTO ' . _DB_PREFIX_ . 'module_access(`id_profile`, `id_module`, `configure`, `view`)
                                                VALUES (' . $p['id_profile'] . ',' . (int) $this->id . ',1,1)');
            }
        }
    }

    private function _displayForm() {
        $values = (isset($_POST) && isset($_POST['submitPsnews'])) ? Tools::getValue('prefnews') : array_merge(self::$default_values, self::getPreferences());
        $this->_html .='
		
		<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">';
        $this->_html .= '<fieldset>
				
                                <label>' . $this->l('Number of articles per page') . '</label> 
                <div class="margin-form">
                <input type="text" name="prefnews[list_news_limit_page]" value="' . $values['list_news_limit_page'] . '" size="3" />
                </div><div class="clear"></div><br />
				
				<div class="clear"></div><br /></fieldset>';

        $this->_html .= '<div class="clear"></div>
		
                    <input class="button" name="submitPsnews" value="' . $this->l('Update settings') . '" type="submit" />';

        $this->_html .='
		
		</form>';
    }

    public function uninstall() {
        $tab_id = Tab::getIdFromClassName("AdminNews");
        if ($tab_id) {
            $tab = new Tab($tab_id);
            $tab->delete();
        }

        $tab_id = Tab::getIdFromClassName("AdminNews");
        if ($tab_id) {
            $tab = new Tab($tab_id);
            $tab->delete();
        }

        if (!Configuration::deleteByName('PSNEWS_CONF') OR !parent::uninstall())
            return false;
        return true;
    }

    public static function getPreferences() {
        if (is_null(self::$prefnews)) {
            $config = Configuration::get('PSNEWS_CONF');
            $options = self::$default_values;

            if ($config)
                $options = array_merge($options, unserialize(base64_decode($config)));
            self::$prefnews = $options;
        }
        return self::$prefnews;
    }

    public function checkServerConf() {
//        $prefnews = self::getPreferences();
//        $this->warning = '';
//        if (!is_writable(_PS_ROOT_DIR_ . '/' . $prefnews['img_save_path'])) {
//            $this->warning .= _PS_ROOT_DIR_ . '/' . $prefnews['img_save_path'] . ' ' . $this->l('must be writable') . "<br />";
//        }
//        if (!is_writable(_PS_ROOT_DIR_ . '/' . $prefnews['img_save_path'] . 'thumb/')) {
//            $this->warning .= _PS_ROOT_DIR_ . '/' . $prefnews['img_save_path'] . 'thumb/ ' . $this->l('must be writable') . "<br />";
//        }
//        if (!is_writable(_PS_ROOT_DIR_ . '/' . $prefnews['img_save_path'] . 'list/')) {
//            $this->warning .= _PS_ROOT_DIR_ . '/' . $prefnews['img_save_path'] . 'list/ ' . $this->l('must be writable') . "<br />";
//        }
    }

    private function _postValidation() {

        $numericValues = array('list_news_limit_page');

        if (isset($_POST['submitPsnews'])) {
            foreach ($numericValues as $val) {
                if (empty($_POST['prefnews'][$val]) || !is_numeric($_POST['prefnews'][$val])) {
                    $this->_postErrors[] = $val . $this->l(' must be a numeric value');
                }
            }
        }
    }

    private function _postProcess() {
        if (Tools::isSubmit('submitPsnews')) {
            $prefnews = $_POST['prefnews'];
            $old_values = self::getPreferences();

            $checkboxes = array('category_active', 'product_active', 'comment_active', 'comment_moderate',
                'comment_guest', 'list_display_date', 'view_display_date', 'related_active',
                'view_display_popin', 'rewrite_active', 'product_page_related', 'rss_active', 'share_active');

            foreach ($checkboxes as $input) {
                if (!isset($prefnews[$input]))
                    $prefnews[$input] = 0;
            }

            $new_values = array_merge(self::$default_values, $prefnews);
            Configuration::updateValue('PSBLOG_CONF', base64_encode(serialize($new_values)));


            $this->_html .= '<div class="conf confirm">' . $this->l('Settings updated') . '</div>';
        } elseif (Tools::isSubmit('submitGenerateImg')) {

            include_once(_PS_MODULE_DIR_ . "psnews/classes/BlogPost.php");

            $images = BlogPost::getAllImages();
            $save_path = _PS_ROOT_DIR_ . '/' . rtrim(self::$prefnews['img_save_path'], '/') . "/";

            foreach ($images as $img) {

                @unlink($save_path . 'thumb/' . $img['img_name']);
                @unlink($save_path . 'list/' . $img['img_name']);

                BlogPost::generateImageThumbs($img['id_news_image']);
            }

            $this->_html .= '<div class="conf confirm">' . $this->l('Images regenerated') . '</div>';
        } elseif (Tools::isSubmit('submitGenerateSitemap')) {

            include_once(_PS_MODULE_DIR_ . "psnews/classes/BlogShop.php");

            BlogShop::generateSitemap();

            $this->_html .= '<div class="conf confirm">' . $this->l('Google sitemap regenerated') . '</div>';
        }
    }

    public function getContent() {
        $this->checkServerConf();
        if ($this->warning != '') {
            $this->_html .= '<div style="width:680px;" class="warning bold">' . $this->warning . '</div>';
        }

        $this->_html .= '<h2>' . $this->l('Prestanews settings') . '</h2>';

        $this->_html .= '<p>' . $this->l('If you want to add articles, you must go to the Blog tab on the navigation menu') . '</p>';

        if (isset($_POST)) {
            $this->_postValidation();
            if (!isset($this->_postErrors) || !sizeof($this->_postErrors)) {
                $this->_postProcess();
            } else {
                foreach ($this->_postErrors AS $err)
                    $this->_html .= '<div class="alert error">' . $err . '</div>';
            }
        } else {
            $this->_html .= '<br />';
        }
        $this->_displayForm();
        return $this->_html;
    }
    
    

}

?>
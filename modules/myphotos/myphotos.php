<?php

if (!defined('_PS_VERSION_'))
    exit;

class MyPhotos extends Module {
    private $_html = '';
    private $_postErrors = array();
    private static $pref = null;
    public static $default_values = array(
        "img_width" => 200,
        "img_list_width" => 100,
        "category_active" => 1,
        "view_display_date" => 1,
        "view_display_popin" => 1,
        "list_limit_page" => 5,
        "list_display_date" => 1,
       
    );

    public function __construct() {
        $this->name = 'myphotos';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Huyen Nguyen';
        $this->need_instance = 0;
        parent::__construct();
        $this->checkServerConf();
        
        $this->displayName = $this->l('My Photos');
        $this->description = $this->l('Add a Photos View on your page.');       
    }

    public function install() {
        if (!parent::install())
            return false;
        if (!Configuration::updateValue('MYPHOTOS_CONF', base64_encode(serialize(self::$default_values))))
            return false;
        $this->createAdminTabs();
        require_once(dirname(__FILE__) . '/install-sql.php');
        return true;
    }

    private function createAdminTabs() {

        $langs = Language::getLanguages();
        $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');

        /*         * ** create tab publications *** */

        $tab0 = new Tab();
        $tab0->class_name = "AdminPhotos";
        $tab0->module = "myphotos";
        $tab0->id_parent = 0;
        foreach ($langs as $l) {
            $tab0->name[$l['id_lang']] = $this->l('Photos');
        }
        $tab0->save();
        $blog_tab_id = $tab0->id;

        $tab1 = new Tab();
        $tab1->class_name = "AdminPhotosCategory";
        $tab1->module = "myphotos";
        $tab1->id_parent = $blog_tab_id;
        foreach ($langs as $l) {
            $tab1->name[$l['id_lang']] = $this->l('Photo Categories');
        }
        $tab1->save();

        /*         * ** create tab categories *** */
        $tab2 = new Tab();
        $tab2->class_name = "AdminPhoto";
        $tab2->module = "myphotos";
        $tab2->id_parent = $blog_tab_id;
        foreach ($langs as $l) {
            $tab2->name[$l['id_lang']] = $this->l('Images');
        }
        $tab2->save();

        /*         * * RIGHTS MANAGEMENT ** */
        Db::getInstance()->Execute('DELETE FROM ' . _DB_PREFIX_ . 'access 
                                        WHERE `id_tab` = ' . (int) $tab0->id . ' 
                                            OR `id_tab` = ' . (int) $tab1->id . ' 
                                            OR `id_tab` = ' . (int) $tab2->id);

        Db::getInstance()->Execute('DELETE FROM ' . _DB_PREFIX_ . 'module_access WHERE `id_module` = ' . (int) $this->id);

        $profiles = Profile::getProfiles($id_lang);

        if (count($profiles)) {
            foreach ($profiles as $p) {

                Db::getInstance()->Execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'access`(`id_profile`,`id_tab`,`view`,`add`,`edit`,`delete`) 
                                                 VALUES (' . $p['id_profile'] . ', ' . (int) $tab0->id . ',1,1,1,1)');

                Db::getInstance()->Execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'access`(`id_profile`,`id_tab`,`view`,`add`,`edit`,`delete`) 
                                                 VALUES (' . $p['id_profile'] . ', ' . (int) $tab1->id . ',1,1,1,1)');

                Db::getInstance()->Execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'access`(`id_profile`,`id_tab`,`view`,`add`,`edit`,`delete`) 
                                                 VALUES (' . $p['id_profile'] . ', ' . (int) $tab2->id . ',1,1,1,1)');
               

                Db::getInstance()->execute('INSERT INTO ' . _DB_PREFIX_ . 'module_access(`id_profile`, `id_module`, `configure`, `view`)
                                                VALUES (' . $p['id_profile'] . ',' . (int) $this->id . ',1,1)');
            }
        }
    }
    
    public function uninstall() {
        $tab_id = Tab::getIdFromClassName("AdminPhotos");
        if ($tab_id) {
            $tab = new Tab($tab_id);
            $tab->delete();
        }

        $tab_id = Tab::getIdFromClassName("AdminPhotosCategory");
        if ($tab_id) {
            $tab = new Tab($tab_id);
            $tab->delete();
        }
  
        $tab_id = Tab::getIdFromClassName("AdminPhoto");
        if ($tab_id) {
            $tab = new Tab($tab_id);
            $tab->delete();
        }


        if (!Configuration::deleteByName('MYPHOTOS_CONF') OR !parent::uninstall())
            return false;
        return true;
    }
    
    public static function getPreferences() {
        if (is_null(self::$pref)) {
            $config = Configuration::get('MYPHOTOS_CONF');
            $options = self::$default_values;

            if ($config)
                $options = array_merge($options, unserialize(base64_decode($config)));
            self::$pref = $options;
        }
        return self::$pref;
    }

    public function checkServerConf() {
//        $pref = self::getPreferences();
//        $this->warning = '';
//        if (!is_writable(_PS_ROOT_DIR_ . '/' . $pref['img_save_path'])) {
//            $this->warning .= _PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . ' ' . $this->l('must be writable') . "<br />";
//        }
//        if (!is_writable(_PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . 'thumb/')) {
//            $this->warning .= _PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . 'thumb/ ' . $this->l('must be writable') . "<br />";
//        }
//        if (!is_writable(_PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . 'list/')) {
//            $this->warning .= _PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . 'list/ ' . $this->l('must be writable') . "<br />";
//        }
    }
}

?>
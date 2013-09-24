<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('_PS_MYPHOTO_IMG_DIR_', _PS_IMG_DIR_ . 'myphoto/');

class Photos extends ObjectModel {

    public $id;
    public $id_photo;
    public $id_photo_cat;
    public $title;
    public $img;
    public $active = 1;
    public $description;
    public $position;
    public $date_add;
    public $date_upd;
    protected static $_links = array();

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'photo',
        'primary' => 'id_photo',
        'multilang' => true,
        'fields' => array(
            'id_photo_cat' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'position' => array('type' => self::TYPE_INT),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'title' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 64),
            'description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'),
        ),
    );
    public $id_image = 'default';

    public function __construct($id_photo = null, $id_lang = null, $id_shop = null) {
        parent::__construct($id_photo, $id_lang, $id_shop);
        $this->id_image = ($this->id && file_exists(_PS_MYPHOTO_IMG_DIR_ . (int) $this->id . '.jpg')) ? (int) $this->id : false;
        $this->image_dir = _PS_MYPHOTO_IMG_DIR_;
    }

    public function add($autodate = true, $null_values = false) {
        return parent::add($autodate, true);
    }

    public function delete() {
        return parent::delete();
    }

    /*     * **** categories ***** */

    public function getCategories() {
        $groups = array();
        $result = Db::getInstance()->ExecuteS('
		SELECT pc.`id_photo_cat` FROM ' . _DB_PREFIX_ . 'photo p 
		WHERE p.`id_photo` = ' . intval($this->id));
        foreach ($result as $group)
            $groups[] = $group['id_photo_cat'];
        return $groups;
    }

    public static function getPhotosByCategory($category_id) {
        $query = ' Select * from ' . _DB_PREFIX_ . 'photo p ';

        $query .= ' LEFT JOIN ' . _DB_PREFIX_ . 'photo_lang pl ON p.id_photo = pl.id_photo';


        $query .= ' WHERE p.id_photo_cat = ' . $category_id;
        $context = Context::getContext();
        $query .= ' AND pl.id_lang = ' . $context->language->id;

        $query .= ' AND p.active = 1';
        $query .= ' ORDER BY p.position, pl.title';

        return Db::getInstance()->ExecuteS($query);
    }

}

?>

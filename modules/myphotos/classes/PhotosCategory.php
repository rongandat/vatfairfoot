<?php

/**
 * PsblogCategory class
 * Prestablog module
 * @category classes
 *
 * @author Appside
 * @copyright Appside
 *
 */
define('_PS_MYPHOTO_IMG_DIR_', _PS_IMG_DIR_ . 'myphoto/');
require_once(_PS_MODULE_DIR_ . 'myphotos/classes/Photos.php');

class PhotosCategory extends ObjectModel {

    public $id_photo_cat;
    public $name;
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
        'table' => 'photo_cat',
        'primary' => 'id_photo_cat',
        'multilang' => true,
        'fields' => array(
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'position' => array('type' => self::TYPE_INT),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            // Lang fields
            'name' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 64),
            'description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'),
        ),
    );

    public function add($autodate = true, $null_values = false) {
        foreach ($this->name as $k => $value)
            if (preg_match('/^[1-9]\./', $value))
                $this->name[$k] = '0' . $value;
        $ret = parent::add($autodate, $null_values);
        return $ret;
    }

    public function update($null_values = false) {
        foreach ($this->name as $k => $value)
            if (preg_match('/^[1-9]\./', $value))
                $this->name[$k] = '0' . $value;
        return parent::update($null_values);
    }

    public static function searchByName($id_lang, $query, $unrestricted = false) {
        if ($unrestricted === true)
            return Db::getInstance()->getRow('
			SELECT pc.*, pcl.*
			FROM `' . _DB_PREFIX_ . 'photo_cat` pc
			LEFT JOIN `' . _DB_PREFIX_ . 'photo_cat_lang` pcl ON (pc.`id_photo_cat` = pcl.`id_photo_cat`)
			WHERE `name` LIKE \'' . pSQL($query) . '\'');
        else
            return Db::getInstance()->executeS('
			SELECT pc.*, pcl.*
			FROM `' . _DB_PREFIX_ . 'photo_cat` pc
			LEFT JOIN `' . _DB_PREFIX_ . 'photo_cat_lang` pcl ON (pc.`id_photo_cat` = pcl.`id_photo_cat` AND `id_lang` = ' . (int) $id_lang . ')
			WHERE `name` LIKE \'%' . pSQL($query) . '%\' AND pc.`id_photo_cat` != 1');
    }

    public static function listCategories($id_lang) {
        $query = 'SELECT pc.id_photo_cat as id_option,pcl.name
			  FROM  ' . _DB_PREFIX_ . 'photo_cat pc  
                          LEFT JOIN ' . _DB_PREFIX_ . 'photo_cat_lang pcl ON pc.id_photo_cat = pcl.id_photo_cat
                          ';

        $query .= ' WHERE 1=1 ';
        $query .= ' AND pcl.id_lang = ' . $id_lang . ' ';
        $query .= ' AND pc.active=1';
        $query .= ' ORDER BY pc.`position` ASC, pcl.`name` ASC';

        return Db::getInstance()->ExecuteS($query);
    }

    public static function getCategories($start = 0, $limit = null, $publish = true) {
        $query = ' Select * from ' . _DB_PREFIX_ . 'photo_cat pc ';

        $query .= ' LEFT JOIN ' . _DB_PREFIX_ . 'photo_cat_lang pcl ON pc.id_photo_cat = pcl.id_photo_cat';


        $query .= ' WHERE 1 = 1 ';
        $context = Context::getContext();
        $query .= ' AND pcl.id_lang = ' . $context->language->id;

        if ($publish)
            $query .= ' AND pc.active = 1';
        $query .= ' ORDER BY pc.`position` ASC, pcl.`name` ASC';
        if (!is_null($limit))
            $query .= ' LIMIT ' . $start . ',' . $limit;


        return Db::getInstance()->ExecuteS($query);
    }

    public function delete() {
        $to_delete = array((int) $this->id);
        $list = count($to_delete) > 1 ? implode(',', $to_delete) : (int) $this->id;
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'photo_cat` WHERE `id_photo_cat` IN (' . $list . ')');
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'photo_cat_lang` WHERE `id_photo_cat` IN (' . $list . ')');
        // Delete photo which are in categories to delete
        $result = Db::getInstance()->executeS('
		SELECT `id_photo`
		FROM `' . _DB_PREFIX_ . 'photo`
		WHERE `id_photo_cat` IN (' . $list . ')');
       
        foreach ($result as $p) {
            $photo = new Photos($p['id_photo']);            
            if (Validate::isLoadedObject($photo))
                $photo->delete();
        }
        return true;
    }

}

?>

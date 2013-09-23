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

require_once(_PS_MODULE_DIR_ . 'myvideo/classes/Videos.php');
class VideoCategory extends ObjectModel {

    public $id_video_cat;
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
        'table' => 'video_cat',
        'primary' => 'id_video_cat',
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

    public static function listCategories($id_lang) {
        $query = 'SELECT pc.id_video_cat as id_option,pcl.name
			  FROM  ' . _DB_PREFIX_ . 'video_cat pc  
                          LEFT JOIN ' . _DB_PREFIX_ . 'video_cat_lang pcl ON pc.id_video_cat = pcl.id_video_cat
                          ';

        $query .= ' WHERE 1=1 ';
        $query .= ' AND pcl.id_lang = ' . $id_lang . ' ';
        $query .= ' AND pc.active=1';
        $query .= ' ORDER BY pc.`position` ASC, pcl.`name` ASC';

        return Db::getInstance()->ExecuteS($query);
    }
    
    public function delete() {
        $to_delete = array((int) $this->id);
        $list = count($to_delete) > 1 ? implode(',', $to_delete) : (int) $this->id;
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'video_cat` WHERE `id_video_cat` IN (' . $list . ')');
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'video_cat_lang` WHERE `id_video_cat` IN (' . $list . ')');
        // Delete video which are in categories to delete
        $result = Db::getInstance()->executeS('
		SELECT `id_video`
		FROM `' . _DB_PREFIX_ . 'video`
		WHERE `id_video_cat` IN (' . $list . ')');
       
        foreach ($result as $p) {
            $video = new Photos($p['id_video']);            
            if (Validate::isLoadedObject($video))
                $video->delete();
        }
        return true;
    }

    public static function getCategories($start = 0, $limit = null, $publish = true) {
        $query = ' Select * from ' . _DB_PREFIX_ . 'video_cat pc ';

        $query .= ' LEFT JOIN ' . _DB_PREFIX_ . 'video_cat_lang pcl ON pc.id_video_cat = pcl.id_video_cat';


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

}

?>

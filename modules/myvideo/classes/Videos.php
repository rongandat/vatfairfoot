<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('_PS_MYVIDEO_IMG_DIR_', _PS_IMG_DIR_ . 'myvideo/');
class Videos extends ObjectModel {
    public $id;
    public $id_video;
    public $id_video_cat;
    public $title;
    public $youtube_id;
    public $active = 1;
    public $description;
    public $position;
    public $date_add;
    public $date_upd;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'video',
        'primary' => 'id_video',
        'multilang' => true,
        'fields' => array(
            'id_video_cat' => 	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'position' => array('type' => self::TYPE_INT),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'youtube_id' => array('type' => self::TYPE_STRING),
            // Lang fields
            'title' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 64),
            'description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'),
        ),
    );
   public function __construct($id = NULL, $id_lang = NULL) {
        parent::__construct($id, $id_lang);     
    }
    /****** categories ******/
    public function getCategories() {
        $groups = array();
        $result = Db::getInstance()->ExecuteS('
		SELECT pc.`id_video_cat` FROM ' . _DB_PREFIX_ . 'video p 
		WHERE p.`id_video` = ' . intval($this->id));
        foreach ($result as $group)
            $groups[] = $group['id_video_cat'];
        return $groups;
    }

    public static function getVideoByCategory($category_id) {
        $query = ' Select * from ' . _DB_PREFIX_ . 'video p ';

        $query .= ' LEFT JOIN ' . _DB_PREFIX_ . 'video_lang pl ON p.id_video = pl.id_video';


        $query .= ' WHERE p.id_video_cat = ' . $category_id;
        $context = Context::getContext();
        $query .= ' AND pl.id_lang = ' . $context->language->id;

        $query .= ' AND p.active = 1';
        $query .= ' ORDER BY p.position, pl.title';

        return Db::getInstance()->ExecuteS($query);
    }
}
?>

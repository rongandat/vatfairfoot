<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('_PS_MYFRIENDS_IMG_DIR_', _PS_IMG_DIR_ . 'myfriends/');
class FriendsImage extends ObjectModel {
    public $id;
    public $id_friend_data;
    public $id_friend;
    public $youtube_id;
    public $active = 1;
    public $position;
    public $date_add;
    public $date_upd;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'friend_data',
        'primary' => 'id_friend_data',
        'multilang' => true,
        'fields' => array(
            'id_friend' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'position' => array('type' => self::TYPE_INT),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'youtube_id' => array('type' => self::TYPE_STRING),   
            // Lang fields
            'title' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 64)
        ),
    );
   public function __construct($id = NULL, $id_lang = NULL) {
        parent::__construct($id, $id_lang);     
    }
    
    public static function getImageByFriend($friend_id) {
        $query = ' Select * from ' . _DB_PREFIX_ . 'friend_data fd ';
        $query .= ' LEFT JOIN ' . _DB_PREFIX_ . 'friend_data_lang fdl ON fd.id_friend_data = fdl.id_friend_data';
        $query .= ' WHERE fd.id_friend = ' . $friend_id;
        $context = Context::getContext();
        $query .= ' AND fdl.id_lang = ' . $context->language->id;
        $query .= ' AND fd.active = 1';
        $query .= ' ORDER BY fd.position';

        return Db::getInstance()->ExecuteS($query);
    }
}
?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('_PS_MYPHOTO_IMG_DIR_', _PS_IMG_DIR_ . 'myphoto/');

class PhotosRatting extends ObjectModel {

    public $id_photo_ratting;
    public $id_photo;
    public $id_customer;
    public $ratting;
    public $date_add;
    public $date_upd;
    
    public static $definition = array(
        'table' => 'photo_ratting',
        'primary' => 'id_photo_ratting',
        'multilang' => true,
        'fields' => array(
            'id_photo' => array('type' => self::TYPE_INT, 'required' => true),
            'id_customer' => array('type' => self::TYPE_INT, 'required' => true),
            'ratting' => array('type' => self::TYPE_INT, 'required' => true),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
        ),
    );

    public function __construct($id_photo = null, $id_lang = null, $id_shop = null) {
        parent::__construct();
    }
    
    public static function checkRatting($id_photo) {
        $id_customer = Context::getContext()->customer->id;
        
        if (!$id_customer)
            return FALSE;
        $result = Db::getInstance()->ExecuteS('
		SELECT * FROM ' . _DB_PREFIX_ . 'photo_ratting 
		WHERE `id_photo` = ' . intval($id_photo) . ' AND id_customer = ' . intval($id_customer));
        if ($result)
            return FALSE;
        return TRUE;
    }
    
    public static function getAverage($id_photo){
        
        $result = Db::getInstance()->ExecuteS('
		SELECT AVG(ratting) as average FROM ' . _DB_PREFIX_ . 'photo_ratting 
		WHERE `id_photo` = ' . intval($id_photo));
        return isset($result[0]['average']) ? $result[0]['average'] : 0;
    }

    public function add($data) {
         $id_customer = Context::getContext()->customer->id;
        $result = Db::getInstance()->ExecuteS(
                'INSERT INTO ' . _DB_PREFIX_ . 'photo_ratting (`id_photo`, `id_customer`, `ratting`,`date_add`)
VALUES (' . $data['id_photo'] . ', ' . $id_customer . ', ' . $data['ratting'] . ', NOW()) '
                );
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

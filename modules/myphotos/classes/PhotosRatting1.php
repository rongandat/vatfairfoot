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
class PhotosRatting extends ObjectModel {

    public $id_photo_ratting;
    public $id_photo;
    public $id_customer;
    public $ratting;
    public $date_add;
    public $date_upd;
    protected static $_links = array();
    
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
    
    public function __construct()
	{
                die('234');
		parent::__construct();
	}

    /**
     * @see ObjectModel::$definition
     */
    

    public static function add($autodate = true, $null_values = false) {
         $id_customer = Context::getContext()->customer->id;
        $result = Db::getInstance()->ExecuteS(
                'INSERT INTO ' . _DB_PREFIX_ . 'photo_ratting (`id_photo`, `id_customer`, `ratting`,`date_add`)
VALUES (' . $data['id_photo'] . ', ' . $id_customer . ', ' . $data['ratting'] . ', NOW()) '
                );
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

}

?>

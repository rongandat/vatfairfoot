<?php

/**
 * BlogComment class
 * Prestablog module
 * @category classes
 *
 * @author AppSide
 * @copyright AppSide
 *
 */
class BlogComment extends ObjectModel {

    public $content;
    public $customer_name;
    public $id_customer;
    public $id_guest;
    public $id_lang;
    public $id_shop;
    public $id_blog_post;
    public $active = 0;
    public $date_add;
    public static $definition = array(
        'table' => 'blog_comment',
        'primary' => 'id_blog_comment',
        'fields' => array(
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'customer_name' => array('type' => self::TYPE_STRING, 'required' => true, 'validate' => 'isGenericName', 'size' => 128),
            'id_customer' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'id_guest' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
            'id_blog_post' => array('type' => self::TYPE_INT, 'required' => true, 'validate' => 'isUnsignedInt'),
            'id_lang' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'content' => array('type' => self::TYPE_STRING, 'validate' => 'isMessage', 'size' => 65535)
        )
    );

    public function getArticle() {
        return new BlogPost($this->id_blog_post);
    }

    static public function getByCustomer($id_blog_post, $id_customer, $last = false, $id_guest = false) {
        $results = Db::getInstance()->ExecuteS('
                SELECT * FROM `' . _DB_PREFIX_ . 'blog_comment` bc
                WHERE bc.`id_blog_post` = ' . (int) ($id_blog_post) . ' 
                AND ' . (!$id_guest ? 'bc.`id_customer` = ' . (int) ($id_customer) : 'bc.`id_guest` = ' . (int) ($id_guest)) . '
                ORDER BY bc.`date_add` DESC ' . ($last ? 'LIMIT 1' : ''));

        if ($last)
            return array_shift($results);
        return $results;
    }

}
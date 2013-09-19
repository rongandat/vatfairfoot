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
require_once(_PS_MODULE_DIR_ . 'psblog/classes/BlogShop.php');

class BlogImages extends ObjectModel {

    public $name;
    public $link_rewrite;
    public $meta_description;
    public $meta_keywords;
    public $id_lang = 0;
    public $active = 1;
    public $position;
    public static $definition = array(
        'table' => 'blog_category',
        'primary' => 'id_blog_category',
        'fields' => array(
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'meta_description' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
            'meta_keywords' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
            'link_rewrite' => array('type' => self::TYPE_STRING, 'validate' => 'isLinkRewrite', 'size' => 128),
            'position' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'id_lang' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'name' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 255),
            'description' => array('type' => self::TYPE_HTML, 'validate' => 'isString', 'size' => 3999999999999)
        )
    );

    public function __construct($id = null, $id_lang = null, $id_shop = null) {
        BlogShop::addBlogAssoTables();
        parent::__construct($id, $id_lang, $id_shop);
    }

    public function add($autodate = true, $nullValues = false) {
        return parent::add($autodate, true);
    }

    public function delete() {
        $this->cleanPostcategories();
        return parent::delete();
    }

    public function cleanPostcategories() {
        return Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'blog_categories` WHERE `id_blog_category` = ' . (int) ($this->id));
    }

    public static function listCategories($currentContext, $active = true) {
        $context = null;
        if ($currentContext instanceof Context) {
            $context = $currentContext;
        } elseif (is_bool($currentContext) && $currentContext === true) {
            $context = Context::getContext();
        }

        $query = 'SELECT c.id_blog_category, c.name, c.link_rewrite, c.position, c.id_lang, pl.iso_code
			  FROM  ' . _DB_PREFIX_ . 'blog_category c  
                          LEFT JOIN ' . _DB_PREFIX_ . 'lang pl ON c.id_lang = pl.id_lang';

        if ($context) {
            $query .= BlogShop::addShopAssociation('blog_category', 'c', $context);
        }

        $query .= ' WHERE 1 = 1 ';

        if ($context && isset($context->language))
            $query .= ' AND (c.id_lang = ' . $context->language->id . ' OR c.id_lang = 0) ';

        if ($active)
            $query .= ' AND c.`active` = 1';

        $query .= ' GROUP BY c.`id_blog_category` ORDER BY c.`position` ASC, c.`name` ASC';
        
        return Db::getInstance()->ExecuteS($query);
    }

    public static function getPostCategories($post_id, $checkContext = true, $active = true) {
        if ($checkContext) {
            $context = Context::getContext();
            $id_lang = $context->language->id;
        }

        $query = 'SELECT pc.`id_blog_category`, c.`name`, c.`link_rewrite`, c.`id_lang` 
                            FROM ' . _DB_PREFIX_ . 'blog_categories pc
                            INNER JOIN ' . _DB_PREFIX_ . 'blog_category c ON c.`id_blog_category` = pc.`id_blog_category` ';

        if ($checkContext) {
            $query .= BlogShop::addShopAssociation('blog_category', 'c');
        }

        $query .= ' WHERE pc.`id_blog_post` = ' . (int) $post_id;
        if ($checkContext)
            $query .= ' AND (c.id_lang = ' . intval($id_lang) . ' OR c.id_lang = 0) ';
        if ($active)
            $query .= ' AND c.`active` = 1';
        $query .= ' GROUP BY c.`id_blog_category` ORDER BY c.`position` ASC, c.`name` ASC';
        $result = Db::getInstance()->ExecuteS($query);

        return $result;
    }

    public function getPosts($checkContext = true, $publish = true, $start = 0, $limit = 5) {

        return BlogPost::listPosts($checkContext, $publish, $start, $limit, false, $this->id);
    }

    public function nbPosts($checkContext = true, $publish = true) {
        return BlogPost::listPosts($checkContext, $publish, null, null, true, $this->id);
    }

    public static function linkCategory($category_id, $rewrite, $id_lang, $p = null, $context = null) {

        if (is_null($context) || !($context instanceof Context)) {
            $context = Context::getContext();
        }

        $languages = Language::getLanguages(true, $context->shop->id);
        $shop_url = $context->shop->getBaseURL();

        if (Configuration::get('PS_REWRITING_SETTINGS')) {

            $iso = ($id_lang > 0 && count($languages) > 1) ? Language::getIsoById(intval($id_lang)) . '/' : '';
            $p = (!is_null($p) ? '?p=' . $p : '');
            
            return $shop_url . $iso . 'blog/category/' . $category_id . '-' . $rewrite . $p;
        } else {
            
            $id_lang = ($id_lang > 0 && count($languages) > 1) ? '&id_lang='.$id_lang : '';
            $p = (!is_null($p) ? '&p=' . $p : '');
            
            return $shop_url . 'index.php?fc=module&module=psblog&controller=posts&category=' . $category_id . $id_lang . $p;
        }
    }

}

?>

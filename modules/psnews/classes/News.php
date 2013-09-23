<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class News extends ObjectModel {

    public $id_news;
    public $name;
    public $youtube_id;
    public $img;
    public $active = 1;
    public $description;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $link_rewrite;
    public $position;
    public $date_add;
    public $date_upd;
    protected static $_links = array();

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'news',
        'primary' => 'id_news',
        'multilang' => true,
        'fields' => array(
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'position' => array('type' => self::TYPE_INT),
            'youtube_id' => array('type' => self::TYPE_STRING,'required' => false,),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            //'img' => array('type' => self::TYPE_STRING),
            // Lang fields
            'name' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 64),
            'meta_title' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => false, 'size' => 64),
            'meta_keywords' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => false, 'size' => 64),
            'description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'),
            'meta_description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'),
            'description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml'),
        ),
    );
    
    public function __construct($id = NULL, $id_lang = NULL) {
        parent::__construct($id, $id_lang);
        
    }

    public function add($autodate = true, $null_values = false) {
        return parent::add($autodate, true);
    }
    
    public static function totalNews($publish = true){
        $query = ' Select COUNT(n.id_news) as nb from ' . _DB_PREFIX_ . 'news n ';
        $query .= ' WHERE 1 = 1 ';
        if ($publish)
            $query .= ' AND n.active = 1';
        $result = Db::getInstance()->getRow($query);
            return $result['nb'];
    }

    public static function listNews($start = 0, $limit = null, $publish = true, $order_by = NULL, $asc = 'ASC') {
        $query = ' Select * from ' . _DB_PREFIX_ . 'news n ';

        $query .= ' LEFT JOIN ' . _DB_PREFIX_ . 'news_lang nl ON n.id_news = nl.id_news';


        $query .= ' WHERE 1 = 1 ';
        $context = Context::getContext();
        $query .= ' AND nl.id_lang = ' . $context->language->id;

        if ($publish)
            $query .= ' AND n.active = 1';
        
         if ($order_by)
            $query .= ' ORDER BY ' . $order_by . ' ' . $asc ;

        if (!is_null($limit))
            $query .= ' LIMIT ' . $start . ',' . $limit;

       
        return Db::getInstance()->ExecuteS($query);
    }
    
    public static function linkPost($id_news, $rewrite, $id_lang, $context = NULL) {

        if (is_null($context) || !($context instanceof Context)) {
            $context = Context::getContext();
        }

        $languages = Language::getLanguages(true, $context->shop->id);
        $shop_url = $context->shop->getBaseURL();

        if (Configuration::get('PS_REWRITING_SETTINGS')) {
          
            $iso = ($id_lang > 0 && count($languages) > 1) ? Language::getIsoById(intval($id_lang)) . '/' : '';

            return $shop_url . $iso . 'news/' . $id_news . '-' . $rewrite;
        } else {
            
            $id_lang = ($id_lang > 0 && count($languages) > 1) ? '&id_lang='.$id_lang : '';
             
            return $shop_url . 'index.php?fc=module&module=psnews&controller=news&news=' . $id_news . $id_lang;
        }
    }
    
    public static function linkList($p = null, $context = null, $search_query = null) {

        if (is_null($context) || !($context instanceof Context)) {
            $context = Context::getContext();
        }

        $languages = Language::getLanguages(true, $context->shop->id);
        $shop_url = $context->shop->getBaseURL();
        
        if (Configuration::get('PS_REWRITING_SETTINGS')) {
            
            $iso = (isset($context->language) && count($languages) > 1) ? $context->language->iso_code . '/' : '';
            
            $params = array();
            
            if(!is_null($search_query)) $params[] = 'search=' . $search_query;
            if(!is_null($p)) $params[] = 'p=' . $p;
            
            $param_str = count($params) ? '?'.implode('&',$params) : '';
            
            return $shop_url . $iso . 'news' . $param_str;
            
        } else {
            
            $id_lang = (isset($context->language) && count($languages) > 1) ? '&id_lang='.$context->language->id : '';
            $p = (!is_null($p) ? '&p=' . $p : '');
            $search = (!is_null($search_query) ? '&search=' . $search_query : '');
            
            return $shop_url . 'index.php?fc=module&module=psnews&controller=news'. $id_lang . $search . $p;
        }
    }

}

?>

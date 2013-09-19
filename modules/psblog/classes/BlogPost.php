<?php

/**
 * BlogPost class
 * Prestablog module
 * @category classes
 *
 * @author AppSide
 * @copyright AppSide
 *
 */
require_once(_PS_MODULE_DIR_ . 'psblog/classes/BlogShop.php');

class BlogPost extends ObjectModel {

    public $title;
    public $content;
    public $id_lang = 0;
    public $link_rewrite;
    public $meta_description;
    public $meta_keywords;
    public $excerpt;
    public $status;
    public $date_on;
    public $allow_comments;
    public $default_img;
    public static $definition = array(
        'table' => 'blog_post',
        'primary' => 'id_blog_post',
        'fields' => array(
            'status' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName'),
            'allow_comments' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'date_on' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
            'meta_description' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
            'meta_keywords' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
            'link_rewrite' => array('type' => self::TYPE_STRING, 'validate' => 'isLinkRewrite', 'size' => 128),
            'id_lang' => array('type' => self::TYPE_INT),
            'title' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 128, 'required' => true),
            'excerpt' => array('type' => self::TYPE_HTML, 'validate' => 'isString', 'size' => 3999999999999),
            'content' => array('type' => self::TYPE_HTML, 'validate' => 'isString', 'size' => 3999999999999)
        )
    );

    public function __construct($id = NULL, $id_lang = NULL) {
        parent::__construct($id, $id_lang);
        if ($this->id) {
            $this->default_img = $this->getDefaultImage();
        }
    }

    public function add($autodate = true, $nullValues = false) {
        return parent::add($autodate, true);
    }

    public function delete() {

        $this->cleanImages();
        $this->cleanProducts();
        $this->cleanCategories();
        $this->cleanComments();
        $this->cleanRelated();

        return parent::delete();
    }

    public static function listPosts($currentContext, $publish = true, $start = 0, $limit = 5, $count = false, $category_id = null, $product_id = null, $except_id = null) {
        $context = null;
        if ($currentContext instanceof Context) {
            $context = $currentContext;
        } elseif (is_bool($currentContext) && $currentContext === true) {
            $context = Context::getContext();
        }

        if ($count) {
            $select = ' COUNT(p.id_blog_post) as nb ';
        } else {
            $select = 'p.id_blog_post, p.title, p.excerpt, p.link_rewrite, p.id_lang, p.date_on, p.allow_comments, 
                       pi.id_blog_image as default_img, pi.img_name as default_img_name, COUNT(bc.id_blog_comment) as nb_comments ';
        }

        $query = 'SELECT ' . $select . ' FROM  ' . _DB_PREFIX_ . 'blog_post p ';

        if ($context)
            $query .= BlogShop::addShopAssociation('blog_post', 'p', $context);

        if (!$count) {
            $query .= ' LEFT JOIN ' . _DB_PREFIX_ . 'blog_image pi ON p.id_blog_post = pi.id_blog_post AND pi.default = 1  
							LEFT JOIN ' . _DB_PREFIX_ . 'blog_comment bc ON p.id_blog_post = bc.id_blog_post AND bc.active = 1 ';

            if ($context) {
                if (isset($context->language))
                    $query .= ' AND bc.id_lang = ' . $context->language->id;

                $query .= ' AND bc.id_shop = ' . $context->shop->id;
            }
        }
       
        if (!is_null($product_id))
            $query .= ' INNER JOIN ' . _DB_PREFIX_ . 'blog_products pp ON pp.`id_blog_post` = p.`id_blog_post` AND  pp.`id_product` = ' . $product_id;
        if (!is_null($category_id))
            $query .= ' INNER JOIN ' . _DB_PREFIX_ . 'blog_categories pc ON pc.id_blog_post = p.id_blog_post AND pc.id_blog_category = ' . $category_id;

        $query .= ' WHERE 1 = 1 ';

        if ($context && isset($context->language))
            $query .= ' AND (p.id_lang = ' . $context->language->id . ' OR p.id_lang = 0) ';

        if (!is_null($except_id) && is_numeric($except_id))
            $query .= ' AND p.id_blog_post != ' . $except_id;

        if ($publish)
            $query .= ' AND p.status = "published" AND NOW() >= p.date_on';

        if ($count) {
            $result = Db::getInstance()->getRow($query);
            return $result['nb'];
        } else {
            $query .= ' GROUP BY p.id_blog_post ';
            $query .= ' ORDER BY p.date_on DESC, p.id_blog_post DESC ';
            if (!is_null($limit))
                $query .= ' LIMIT ' . $start . ',' . $limit;
            return Db::getInstance()->ExecuteS($query);
        }
    }

    public static function searchPosts($search_query, $checkContext = true, $publish = true, $count = false, $start = 0, $limit = 5, $category_id = null) {
        if ($checkContext) {
            $context = Context::getContext();
            $id_lang = $context->language->id;
            $id_shop = $context->shop->id;
        }

        if ($count) {
            $select = 'COUNT(p.id_blog_post) as nb';
        } else {
            $select = 'p.id_blog_post, p.title, p.excerpt, p.link_rewrite, p.meta_description, p.id_lang,
                       p.date_on, pi.id_blog_image as default_img, pi.img_name as default_img_name, 
                       p.allow_comments, COUNT(bc.id_blog_comment) as nb_comments  ';
        }

        $query = 'SELECT ' . $select . ' FROM  ' . _DB_PREFIX_ . 'blog_post p ';

        if ($checkContext) {
            $query .= BlogShop::addShopAssociation('blog_post', 'p');
        }

        if (!$count) {
            $query .= ' LEFT JOIN ' . _DB_PREFIX_ . 'blog_image pi ON p.id_blog_post = pi.id_blog_post AND pi.default = 1  
						LEFT JOIN ' . _DB_PREFIX_ . 'blog_comment bc ON p.id_blog_post = bc.id_blog_post AND bc.active = 1';

            if ($checkContext) {
                $query .= ' AND bc.id_lang = ' . intval($id_lang);
                $query .= ' AND bc.id_shop = ' . intval($id_shop);
            }
        }

        if (!is_null($category_id))
            $query .= ' INNER JOIN ' . _DB_PREFIX_ . 'blog_categories pc ON pc.id_blog_post = p.id_blog_post AND pc.id_blog_category = ' . $category_id;

        $query .= ' WHERE 1 = 1 ';

        if ($checkContext)
            $query .= ' AND (p.id_lang = ' . intval($id_lang) . ' OR p.id_lang = 0) ';

        if ($publish) {
            $query .= ' AND p.status = "published" AND NOW() >= p.date_on';
        }

        $query .= ' AND ( p.title LIKE \'%' . pSQL($search_query) . '%\' 
                                   OR p.excerpt LIKE \'%' . pSQL($search_query) . '%\' 
                                   OR p.meta_keywords LIKE \'%' . pSQL($search_query) . '%\' )';

        if ($count) {
            $result = Db::getInstance()->getRow($query);
            return $result['nb'];
        } else {
            $query .= ' GROUP BY p.id_blog_post ';
            $query .= ' ORDER BY p.date_on DESC, p.id_blog_post DESC ';
            if (!is_null($limit))
                $query .= ' LIMIT ' . $start . ',' . $limit;

            return Db::getInstance()->ExecuteS($query);
        }
    }

    /***** images ****/

    public function getImages($count = false, $exclude_default = false) {
        $select = $count ? "count(*) as nb" : "*";
        $query = 'SELECT ' . $select . ' FROM  ' . _DB_PREFIX_ . 'blog_image pi WHERE pi.id_blog_post = ' . intval($this->id);
        if ($exclude_default)
            $query .= ' AND pi.default = 0';
        if (!$count)
            $query .= ' ORDER BY position ASC, id_blog_image DESC ';

        if ($count) {
            $result = Db::getInstance()->getRow($query);
            return intval($result['nb']);
        } else {
            $result = Db::getInstance()->ExecuteS($query);
        }

        return $result;
    }

    public static function getAllImages() {
        $query = 'SELECT * FROM  ' . _DB_PREFIX_ . 'blog_image';
        return Db::getInstance()->ExecuteS($query);
    }

    public function setImagesPosition($images_position) {
        if (is_array($images_position) && count($images_position)) {
            $query = ' UPDATE ' . _DB_PREFIX_ . 'blog_image SET `position` = CASE `id_blog_image` ';
            $ids = array();
            foreach ($images_position as $id => $pos) {
                if (Validate::isUnsignedInt($id) && Validate::isUnsignedInt($pos)) {
                    $query .= ' WHEN ' . $id . ' THEN ' . $pos;
                    $ids[] = $id;
                }
            }
            if (count($ids)) {
                $query .= ' END WHERE `id_blog_image` IN (' . implode(',', $ids) . ')';
                return Db::getInstance()->Execute($query);
            }
        }
        return false;
    }

    public static function generateImageThumbs($image_id) {

        $image = self::getImage($image_id);

        if (!$image)
            return false;

        $conf = Psblog::getPreferences();
        $dest = _PS_ROOT_DIR_ . '/' . rtrim($conf['img_save_path'], '/') . "/";

        $img_name = $image['img_name'];

        //thumbs
        $img_list_width = $conf['img_list_width'];
        $img_thumb_width = $conf['img_width'];

        $size = getimagesize($dest . $img_name);

        $ratio_list = $img_list_width / $size[0];
        $img_list_height = $size[1] * $ratio_list;

        $ratio_thumb = $img_thumb_width / $size[0];
        $img_thumb_height = $size[1] * $ratio_thumb;

        ImageManager::resize($dest . $img_name, $dest . 'list/' . $img_name, $img_list_width, $img_list_height);
        ImageManager::resize($dest . $img_name, $dest . 'thumb/' . $img_name, $img_thumb_width, $img_thumb_height);
    }

    public function addImage($name, $default = 0) {
        $nb = $this->getImages(true) + 1;

        $result = Db::getInstance()->Execute('INSERT INTO ' . _DB_PREFIX_ . 'blog_image(`id_blog_post`,`img_name`,`default`,`position`) 
												VALUES(' . intval($this->id) . ',"' . $name . '","' . $default . '",' . $nb . ')');
        if ($result)
            return Db::getInstance()->Insert_ID();
        return $result;
    }

    public function setImageDefault($prestablog_image_id) {
        if ($prestablog_image_id != 0) {
            Db::getInstance()->Execute('UPDATE ' . _DB_PREFIX_ . 'blog_image SET `default` = 0 WHERE id_blog_post = ' . intval($this->id));
            Db::getInstance()->Execute('UPDATE ' . _DB_PREFIX_ . 'blog_image SET `default` = 1 WHERE id_blog_image = ' . intval($prestablog_image_id));
        } else {
            Db::getInstance()->Execute('UPDATE ' . _DB_PREFIX_ . 'blog_image SET `default` = 1 WHERE id_blog_post = ' . intval($this->id) . ' ORDER BY id_blog_image ASC LIMIT 1');
        }
    }

    public function getDefaultImage() {
        $result = Db::getInstance()->getRow('SELECT * FROM  ' . _DB_PREFIX_ . 'blog_image pi WHERE pi.default = 1 AND pi.id_blog_post = ' . intval($this->id));
        return $result;
    }

    public static function getImage($image_id) {
        $result = Db::getInstance()->getRow('SELECT * FROM  ' . _DB_PREFIX_ . 'blog_image pi WHERE pi.id_blog_image = ' . intval($image_id));
        return $result;
    }

    public function removeImage($image_id) {

        $conf = Psblog::getPreferences();
        $save_path = _PS_ROOT_DIR_ . '/' . rtrim($conf['img_save_path'], '/') . "/";
        $image = self::getImage($image_id);

        if ($image) {

            $result = Db::getInstance()->Execute('DELETE FROM  ' . _DB_PREFIX_ . 'blog_image WHERE id_blog_image = ' . intval($image_id));

            if ($result) {

                $filename = $image['img_name'];

                if (file_exists($save_path . $filename)) {
                    @unlink($save_path . $filename);
                }
                if (file_exists($save_path . 'thumb/' . $filename)) {
                    @unlink($save_path . 'thumb/' . $filename);
                }
                if (file_exists($save_path . 'list/' . $filename)) {
                    @unlink($save_path . 'list/' . $filename);
                }

                if ($image['default'] == 1)
                    $this->setImageDefault(0);

                return $result;
            }
        }
        return false;
    }

    public function cleanImages() {

        $conf = Psblog::getPreferences();
        $save_path = rtrim($conf['img_save_path'], '/') . "/";

        $psblog_images = $this->getImages();
        foreach ($psblog_images as $img) {
            $filename = $img['img_name'];
            if (file_exists(_PS_ROOT_DIR_ . "/" . $save_path . $filename)) {
                @unlink(_PS_ROOT_DIR_ . "/" . $save_path . $filename);
            }
        }

        $result = Db::getInstance()->Execute('DELETE FROM  ' . _DB_PREFIX_ . 'blog_image WHERE id_blog_post = ' . intval($this->id));
        return $result;
    }

    /****** categories ******/

    public function addCategories($groups) {
        foreach ($groups as $group) {
            $row = array('id_blog_post' => intval($this->id), 'id_blog_category' => intval($group));
            Db::getInstance()->AutoExecute(_DB_PREFIX_ . 'blog_categories', $row, 'INSERT');
        }
    }

    public function getCategories() {
        $groups = array();
        $result = Db::getInstance()->ExecuteS('
		SELECT pc.`id_blog_category` FROM ' . _DB_PREFIX_ . 'blog_categories pc 
		WHERE pc.`id_blog_post` = ' . intval($this->id));
        foreach ($result as $group)
            $groups[] = $group['id_blog_category'];
        return $groups;
    }

    public function listCategories($checkContext = true, $active = true) {
        if ($checkContext) {
            $context = Context::getContext();
            $id_lang = $context->language->id;
        }

        $query = 'SELECT pc.`id_blog_category`, c.`name`, c.`link_rewrite`, c.`id_lang` 
                    FROM ' . _DB_PREFIX_ . 'blog_categories pc 
                    INNER JOIN ' . _DB_PREFIX_ . 'blog_category c ON c.`id_blog_category` = pc.`id_blog_category`';

        if ($checkContext) {
            $query .= BlogShop::addShopAssociation('blog_category', 'c');
        }

        $query .= ' WHERE pc.`id_blog_post` = ' . intval($this->id);

        if ($checkContext)
            $query .= ' AND (c.id_lang = ' . intval($id_lang) . ' OR c.id_lang = 0) ';

        if ($active)
            $query .= ' AND c.`active` = 1 ';

        $query .= ' ORDER BY c.`position` ASC, c.`name` ASC';

        return Db::getInstance()->ExecuteS($query);
    }

    public function cleanCategories() {
        return Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'blog_categories` WHERE `id_blog_post` = ' . intval($this->id));
    }

    /***** comments ****/

    public function getComments($checkContext = true, $publish = true, $count = false) {

        if ($checkContext) {
            $context = Context::getContext();
            $id_lang = $context->language->id;
            $id_shop = $context->shop->id;
        }

        $select = $count ? "count(*) as nb" : "c.*";
        $query = 'SELECT ' . $select . ' FROM  ' . _DB_PREFIX_ . 'blog_comment c
                  INNER JOIN ' . _DB_PREFIX_ . 'blog_post p ON p.id_blog_post = c.id_blog_post ';

        $query .= ' WHERE c.id_blog_post = ' . intval($this->id);

        if ($publish)
            $query .= ' AND active = 1';

        if ($checkContext) {
            $query .= ' AND (c.id_lang = ' . intval($id_lang) . ') ';
            $query .= ' AND (c.id_shop = ' . intval($id_shop) . ') ';
        }

        $query .= ' ORDER BY c.date_add ASC';

        $result = Db::getInstance()->ExecuteS($query);
        if ($count)
            return intval($result[0]['nb']);
        return $result;
    }

    public function cleanComments() {
        return Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'blog_comment` WHERE `id_blog_post` = ' . intval($this->id));
    }

    /***** related *****/

    public function cleanRelated() {
        return Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'blog_related` WHERE `id_blog_post` = ' . intval($this->id));
    }

    public function addRelated($groups) {
        $i = 1;
        foreach ($groups as $group) {
            $row = array('id_blog_post' => intval($this->id), 'id_related_blog_post' => intval($group));
            Db::getInstance()->AutoExecute(_DB_PREFIX_ . 'blog_related', $row, 'INSERT');
            $i++;
        }
    }

    public function getRelatedIds($publish = false) {

        $groups = array();

        $query = 'SELECT pr.`id_related_blog_post` 
                    FROM ' . _DB_PREFIX_ . 'blog_related pr
                    INNER JOIN ' . _DB_PREFIX_ . 'blog_post p ON p.`id_blog_post` = pr.`id_related_blog_post`
                    WHERE pr.`id_blog_post` = ' . intval($this->id);

        if ($publish)
            $query .= ' AND p.`status` = "published" AND p.`date_on` <= NOW()';

        $result = Db::getInstance()->ExecuteS($query);

        foreach ($result as $group)
            $groups[] = $group['id_related_blog_post'];
        return $groups;
    }

    public function listRelated($checkContext = true, $publish = true) {

        if ($checkContext) {
            $context = Context::getContext();
            $id_lang = $context->language->id;
        }

        $query = 'SELECT p.`id_blog_post`, p.`title`, p.`link_rewrite`, p.`id_lang` 
                    FROM ' . _DB_PREFIX_ . 'blog_related pr 
                    INNER JOIN ' . _DB_PREFIX_ . 'blog_post p ON p.`id_blog_post` = pr.`id_related_blog_post`';

        if ($checkContext) {
            $query .= BlogShop::addShopAssociation('blog_post', 'p');
        }

        $query .= ' WHERE pr.`id_blog_post` = ' . intval($this->id);

        if ($checkContext)
            $query .= ' AND (p.id_lang = ' . intval($id_lang) . ' OR p.id_lang = 0) ';

        if ($publish)
            $query .= ' AND p.`status` = "published" AND p.`date_on` <= NOW()';

        $query .= ' ORDER BY p.`date_on` DESC, p.`id_blog_post` DESC';

        return Db::getInstance()->ExecuteS($query);
    }

    /***** products *****/

    public function cleanProducts() {
        return Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'blog_products` WHERE `id_blog_post` = ' . intval($this->id));
    }

    public function addProducts($groups) {
        $i = 1;
        foreach ($groups as $group) {
            $row = array('id_blog_post' => intval($this->id), 'id_product' => intval($group), 'position' => $i);
            Db::getInstance()->AutoExecute(_DB_PREFIX_ . 'blog_products', $row, 'INSERT');
            $i++;
        }
    }

    public function getProducts($active = false) {
       
        $context = Context::getContext();
        $id_lang = $context->language->id;

        $query = 'SELECT p.`id_product`, p.`reference`, pl.`name`, i.`id_image`, 
                    pl.`description_short`, pl.`link_rewrite`
                    FROM `' . _DB_PREFIX_ . 'blog_products` bp
                    LEFT JOIN `' . _DB_PREFIX_ . 'product` p ON (p.`id_product`= bp.`id_product`)
                    ' . Shop::addSqlAssociation('product', 'p') . '
                    LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (
                            p.`id_product` = pl.`id_product`
                            AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl') . '
                    )
                    LEFT JOIN `' . _DB_PREFIX_ . 'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)

                    WHERE bp.`id_blog_post` = ' . intval($this->id);

        if ($active)
            $query .= ' AND p.`active` = 1 ';

        $query .= ' ORDER BY bp.`position` ASC, pl.`name` DESC';
        return Db::getInstance()->executeS($query);
    }

    public static function linkPost($post_id, $rewrite, $id_lang, $context = NULL) {

        if (is_null($context) || !($context instanceof Context)) {
            $context = Context::getContext();
        }

        $languages = Language::getLanguages(true, $context->shop->id);
        $shop_url = $context->shop->getBaseURL();

        if (Configuration::get('PS_REWRITING_SETTINGS')) {
          
            $iso = ($id_lang > 0 && count($languages) > 1) ? Language::getIsoById(intval($id_lang)) . '/' : '';

            return $shop_url . $iso . 'blog/' . $post_id . '-' . $rewrite;
        } else {
            
            $id_lang = ($id_lang > 0 && count($languages) > 1) ? '&id_lang='.$id_lang : '';
             
            return $shop_url . 'index.php?fc=module&module=psblog&controller=posts&post=' . $post_id . $id_lang;
        }
    }

    public static function linkRss() {

        $context = Context::getContext();
        $languages = Language::getLanguages(true, $context->shop->id);
        $shop_url = $context->shop->getBaseURL();

        $rss_url = $shop_url . 'modules/psblog/rss.php';

        if (isset($context->language) && count($languages) > 1) {
            $rss_url .= '?id_lang=' . $context->language->id;
        }
        return $rss_url;
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
            
            return $shop_url . $iso . 'blog' . $param_str;
            
        } else {
            
            $id_lang = (isset($context->language) && count($languages) > 1) ? '&id_lang='.$context->language->id : '';
            $p = (!is_null($p) ? '&p=' . $p : '');
            $search = (!is_null($search_query) ? '&search=' . $search_query : '');
            
            return $shop_url . 'index.php?fc=module&module=psblog&controller=posts'. $id_lang . $search . $p;
        }
    }

}

?>

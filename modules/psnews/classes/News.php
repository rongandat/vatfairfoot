<?php

/*
 * 2007-2013 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2013 PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
define('_PS_NEWS_IMG_DIR_', _PS_MODULE_DIR_ . 'psnews/uploads/');

class News extends ObjectModel {

    public $id;

    /** @var integer news ID */
    public $id_news;

    /** @var string Name */
    public $name;

    /** @var boolean Status for display */
    public $active = 1;

    /** @var  integer news position */
    public $position;

    /** @var string Description */
    public $description;


    /** @var string string used in rewrited URL */
    public $link_rewrite;

    /** @var string Meta title */
    public $meta_title;

    /** @var string Meta keywords */
    public $meta_keywords;

    /** @var string Meta description */
    public $meta_description;

    /** @var string Object creation date */
    public $date_add;

    /** @var string Object last modification date */
    public $date_upd;

    protected static $_links = array();

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'news',
        'primary' => 'id_news',
        'multilang' => true,
        'multilang_shop' => true,
        'fields' => array(
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool', 'required' => true),
            'id_shop_default' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
            'position' => array('type' => self::TYPE_INT),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            // Lang fields
            'name' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCatalogName', 'required' => true, 'size' => 64),
            'link_rewrite' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isLinkRewrite', 'required' => true, 'size' => 64),
            'description' => array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'),
            'meta_title' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 128),
            'meta_description' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255),
            'meta_keywords' => array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255),
        ),
    );

    /** @var string id_image is the news ID when an image exists and 'default' otherwise */
    public $id_image = 'default';

    public function __construct($id_news = null, $id_lang = null, $id_shop = null) {
        parent::__construct($id_news, $id_lang, $id_shop);
        $this->id_image = ($this->id && file_exists(_PS_NEWS_IMG_DIR_ . (int) $this->id . '.jpg')) ? (int) $this->id : false;
        $this->image_dir = _PS_NEWS_IMG_DIR_;
    }

    /**
     * Allows to display the news description without HTML tags and slashes
     *
     * @return string
     */
    public static function getDescriptionClean($description) {
        
        return strip_tags(stripslashes($description));
    }

    public function add($autodate = true, $null_values = false) {

        $ret = parent::add($autodate, $null_values);
        if (Tools::isSubmit('checkBoxShopAsso_news'))
            foreach (Tools::getValue('checkBoxShopAsso_news') as $id_shop => $value) {
                $position = News::getLastPosition((int) $this->id_parent, $id_shop);
                $this->addPosition($position, $id_shop);
            }
        else
            foreach (Shop::getShops(true) as $shop) {
                $position = News::getLastPosition((int) $this->id_parent, $shop['id_shop']);
                if (!$position)
                    $position = 1;
                $this->addPosition($position, $shop['id_shop']);
            }
        if (!isset($this->doNotRegenerateNTree) || !$this->doNotRegenerateNTree)
            News::regenerateEntireNtree();
        $this->updateGroup($this->groupBox);
        Hook::exec('actionNewsAdd', array('news' => $this));
        return $ret;
    }

    /**
     * update news positions in parent
     *
     * @param mixed $null_values
     * @return void
     */
    public function update($null_values = false) {
        if ($this->id_parent == $this->id)
            throw new PrestaShopException('a news cannot be it\'s own parent');
        // Update group selection
        $this->updateGroup($this->groupBox);
        $this->level_depth = $this->calcLevelDepth();
        // If the parent news was changed, we don't want to have 2 categories with the same position
        if ($this->getDuplicatePosition()) {
            $assos = array();
            if (Tools::isSubmit('checkBoxShopAsso_news')) {
                $check_box = Tools::getValue('checkBoxShopAsso_news');
                foreach ($check_box as $id_asso_object => $row) {
                    foreach ($row as $id_shop => $value)
                        $assos[] = array('id_object' => (int) $id_asso_object, 'id_shop' => (int) $id_shop);
                }
            }
            foreach ($assos as $shop)
                $this->addPosition(News::getLastPosition((int) $this->id_parent, $shop['id_shop']), $shop['id_shop']);
        }
        $this->cleanPositions((int) $this->id_parent);
        $ret = parent::update($null_values);
        if (!isset($this->doNotRegenerateNTree) || !$this->doNotRegenerateNTree) {
            News::regenerateEntireNtree();
            $this->recalculateLevelDepth($this->id);
        }
        Hook::exec('actionNewsUpdate', array('news' => $this));
        return $ret;
    }

    /**
     * @see ObjectModel::toggleStatus()
     */
    public function toggleStatus() {
        $result = parent::toggleStatus();
        Hook::exec('actionNewsUpdate');
        return $result;
    }

    /**
     * Recursive scan of subcategories
     *
     * @param integer $max_depth Maximum depth of the tree (i.e. 2 => 3 levels depth)
     * @param integer $current_depth specify the current depth in the tree (don't use it, only for rucursivity!)
     * @param integer $id_lang Specify the id of the language used
     * @param array $excluded_ids_array specify a list of ids to exclude of results
     *
     * @return array Subcategories lite tree
     */
    public function recurseLiteCategTree($max_depth = 3, $current_depth = 0, $id_lang = null, $excluded_ids_array = null) {
        $id_lang = is_null($id_lang) ? Context::getContext()->language->id : (int) $id_lang;

        $children = array();
        $subcats = $this->getSubListNews($id_lang, true);
        if (($max_depth == 0 || $current_depth < $max_depth) && $subcats && count($subcats))
            foreach ($subcats as &$subcat) {
                if (!$subcat['id_news'])
                    break;
                else if (!is_array($excluded_ids_array) || !in_array($subcat['id_news'], $excluded_ids_array)) {
                    $categ = new News($subcat['id_news'], $id_lang);
                    $children[] = $categ->recurseLiteCategTree($max_depth, $current_depth + 1, $id_lang, $excluded_ids_array);
                }
            }

        if (is_array($this->description))
            foreach ($this->description as $lang => $description)
                $this->description[$lang] = News::getDescriptionClean($description);
        else
            $this->description = News::getDescriptionClean($this->description);

        return array(
            'id' => (int) $this->id,
            'link' => Context::getContext()->link->getNewsLink($this->id, $this->link_rewrite),
            'name' => $this->name,
            'desc' => $this->description,
            'children' => $children
        );
    }

    public static function recurseNews($newsList, $current, $id_news = 1, $id_selected = 1) {
        echo '<option value="' . $id_news . '"' . (($id_selected == $id_news) ? ' selected="selected"' : '') . '>' .
        str_repeat('&nbsp;', $current['infos']['level_depth'] * 5) . stripslashes($current['infos']['name']) . '</option>';
        if (isset($newsList[$id_news]))
            foreach (array_keys($newsList[$id_news]) as $key)
                News::recurseNews($newsList, $newsList[$id_news][$key], $key, $id_selected);
    }

    /**
     * Recursively add specified news childs to $to_delete array
     *
     * @param array &$to_delete Array reference where categories ID will be saved
     * @param array $id_news Parent news ID
     */
    protected function recursiveDelete(&$to_delete, $id_news) {
        if (!is_array($to_delete) || !$id_news)
            die(Tools::displayError());

        $result = Db::getInstance()->executeS('
		SELECT `id_news`
		FROM `' . _DB_PREFIX_ . 'news`
		WHERE `id_parent` = ' . (int) $id_news);
        foreach ($result as $row) {
            $to_delete[] = (int) $row['id_news'];
            $this->recursiveDelete($to_delete, (int) $row['id_news']);
        }
    }

    public function deleteLite() {
        // Directly call the parent of delete, in order to avoid recursion
        return parent::delete();
    }

    public function delete() {
        if ((int) $this->id === 0 || (int) $this->id === 1)
            return false;

        $this->clearCache();

        $all_cat = $this->getAllChildren();
        $all_cat[] = $this;
        foreach ($all_cat as $cat) {
            $cat->deleteLite();
            if (!$this->hasMultishopEntries()) {
                $cat->deleteImage();
                $cat->cleanGroups();
                $cat->cleanAssoProducts();
                // Delete associated restrictions on cart rules
                CartRule::cleanProductRuleIntegrity('categories', array($cat->id));
                News::cleanPositions($cat->id_parent);
                /* Delete ListNews in GroupReduction */
                if (GroupReduction::getGroupsReductionByNewsId((int) $cat->id))
                    GroupReduction::deleteNews($cat->id);
            }
        }

        /* Rebuild the nested tree */
        if (!$this->hasMultishopEntries() && (!isset($this->doNotRegenerateNTree) || !$this->doNotRegenerateNTree))
            News::regenerateEntireNtree();

        Hook::exec('actionNewsDelete', array('news' => $this));

        return true;
    }

    /**
     * Delete several categories from database
     *
     * return boolean Deletion result
     */
    public function deleteSelection($newsList) {
        $return = 1;
        foreach ($newsList as $id_news) {
            $news = new News($id_news);
            if ($news->isRootNewsForAShop())
                return false;
            else
                $return &= $news->delete();
        }
        return $return;
    }

    /**
     * Get the depth level for the news
     *
     * @return integer Depth level
     */
    public function calcLevelDepth() {
        /* Root news */
        if (!$this->id_parent)
            return 0;

        $parent_news = new News((int) $this->id_parent);
        if (!Validate::isLoadedObject($parent_news))
            throw new PrestaShopException('Parent news does not exist');
        return $parent_news->level_depth + 1;
    }

    /**
     * Re-calculate the values of all branches of the nested tree
     */
    public static function regenerateEntireNtree() {
        $id = Context::getContext()->shop->id;
        $id_shop = $id ? $id : Configuration::get('PS_SHOP_DEFAULT');
        $newsList = Db::getInstance()->executeS('
		SELECT c.`id_news`, c.`id_parent`
		FROM `' . _DB_PREFIX_ . 'news` c
		LEFT JOIN `' . _DB_PREFIX_ . 'news_shop` cs
			ON (c.`id_news` = cs.`id_news` AND cs.`id_shop` = ' . (int) $id_shop . ')
		ORDER BY c.`id_parent`, cs.`position` ASC');
        $newsList_array = array();
        foreach ($newsList as $news)
            $newsList_array[$news['id_parent']]['subcategories'][] = $news['id_news'];
        $n = 1;

        if (isset($newsList_array[0]) && $newsList_array[0]['subcategories'])
            News::_subTree($newsList_array, $newsList_array[0]['subcategories'][0], $n);
    }

    protected static function _subTree(&$newsList, $id_news, &$n) {
        $left = $n++;
        if (isset($newsList[(int) $id_news]['subcategories']))
            foreach ($newsList[(int) $id_news]['subcategories'] as $id_subnews)
                News::_subTree($newsList, (int) $id_subnews, $n);
        $right = (int) $n++;

        Db::getInstance()->execute('
			UPDATE ' . _DB_PREFIX_ . 'news
			SET nleft = ' . (int) $left . ', nright = ' . (int) $right . '
			WHERE id_news = ' . (int) $id_news . ' LIMIT 1
		');
    }

    /**
     * Updates level_depth for all children of the given id_news
     *
     * @param integer $id_news parent news
     */
    public function recalculateLevelDepth($id_news) {
        if (!is_numeric($id_news))
            throw new PrestaShopException('id news is not numeric');
        /* Gets all children */
        $newsList = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT id_news, id_parent, level_depth
			FROM ' . _DB_PREFIX_ . 'news
			WHERE id_parent = ' . (int) $id_news);
        /* Gets level_depth */
        $level = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT level_depth
			FROM ' . _DB_PREFIX_ . 'news
			WHERE id_news = ' . (int) $id_news);
        /* Updates level_depth for all children */
        foreach ($newsList as $sub_news) {
            Db::getInstance()->execute('
				UPDATE ' . _DB_PREFIX_ . 'news
				SET level_depth = ' . (int) ($level['level_depth'] + 1) . '
				WHERE id_news = ' . (int) $sub_news['id_news']);
            /* Recursive call */
            $this->recalculateLevelDepth($sub_news['id_news']);
        }
    }

    /**
     * Return available categories
     *
     * @param integer $id_lang Language ID
     * @param boolean $active return only active categories
     * @return array ListNews
     */
    public static function getListNews($id_lang = false, $active = true, $order = true, $sql_filter = '', $sql_sort = '', $sql_limit = '') {
        if (!Validate::isBool($active))
            die(Tools::displayError());
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT *
			FROM `' . _DB_PREFIX_ . 'news` c
			' . Shop::addSqlAssociation('news', 'c') . '
			LEFT JOIN `' . _DB_PREFIX_ . 'news_lang` cl ON c.`id_news` = cl.`id_news`' . Shop::addSqlRestrictionOnLang('cl') . '
			WHERE 1 ' . $sql_filter . ' ' . ($id_lang ? 'AND `id_lang` = ' . (int) $id_lang : '') . '
			' . ($active ? 'AND `active` = 1' : '') . '
			' . (!$id_lang ? 'GROUP BY c.id_news' : '') . '
			' . ($sql_sort != '' ? $sql_sort : 'ORDER BY c.`level_depth` ASC, news_shop.`position` ASC') . '
			' . ($sql_limit != '' ? $sql_limit : '')
        );

        if (!$order)
            return $result;

        $newsList = array();
        foreach ($result as $row)
            $newsList[$row['id_parent']][$row['id_news']]['infos'] = $row;

        return $newsList;
    }

    public static function getSimpleListNews($id_lang) {
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
		SELECT c.`id_news`, cl.`name`
		FROM `' . _DB_PREFIX_ . 'news` c
		LEFT JOIN `' . _DB_PREFIX_ . 'news_lang` cl ON (c.`id_news` = cl.`id_news`' . Shop::addSqlRestrictionOnLang('cl') . ')
		' . Shop::addSqlAssociation('news', 'c') . '
		WHERE cl.`id_lang` = ' . (int) $id_lang . '
		GROUP BY c.id_news
		ORDER BY c.`id_news`, news_shop.`position`');
    }

    public function getShopID() {
        return $this->id_shop;
    }

    /**
     * Return current news childs
     *
     * @param integer $id_lang Language ID
     * @param boolean $active return only active categories
     * @return array ListNews
     */
    public function getSubListNews($id_lang, $active = true) {
        if (!Validate::isBool($active))
            die(Tools::displayError());

        $groups = FrontController::getCurrentCustomerGroups();
        $sql_groups = (count($groups) ? 'IN (' . implode(',', $groups) . ')' : '=' . (int) Group::getCurrent()->id);

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT c.*, cl.id_lang, cl.name, cl.description, cl.link_rewrite, cl.meta_title, cl.meta_keywords, cl.meta_description
			FROM `' . _DB_PREFIX_ . 'news` c
			' . Shop::addSqlAssociation('news', 'c') . '
			LEFT JOIN `' . _DB_PREFIX_ . 'news_lang` cl
				ON (c.`id_news` = cl.`id_news`
				AND `id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('cl') . ')
			LEFT JOIN `' . _DB_PREFIX_ . 'news_group` cg
				ON (cg.`id_news` = c.`id_news`)
			WHERE `id_parent` = ' . (int) $this->id . '
				' . ($active ? 'AND `active` = 1' : '') . '
				AND cg.`id_group` ' . $sql_groups . '
			GROUP BY c.`id_news`
			ORDER BY `level_depth` ASC, news_shop.`position` ASC
		');

        foreach ($result as &$row) {
            $row['id_image'] = file_exists(_PS_NEWS_IMG_DIR_ . $row['id_news'] . '.jpg') ? (int) $row['id_news'] : Language::getIsoById($id_lang) . '-default';
            $row['legend'] = 'no picture';
        }
        return $result;
    }

    /**
     * Return current news products
     *
     * @param integer $id_lang Language ID
     * @param integer $p Page number
     * @param integer $n Number of products per page
     * @param boolean $get_total return the number of results instead of the results themself
     * @param boolean $active return only active products
     * @param boolean $random active a random filter for returned products
     * @param int $random_number_products number of products to return if random is activated
     * @param boolean $check_access set to false to return all products (even if customer hasn't access)
     * @return mixed Products or number of products
     */
    public function getProducts($id_lang, $p, $n, $order_by = null, $order_way = null, $get_total = false, $active = true, $random = false, $random_number_products = 1, $check_access = true, Context $context = null) {
        if (!$context)
            $context = Context::getContext();
        if ($check_access && !$this->checkAccess($context->customer->id))
            return false;

        $front = true;
        if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
            $front = false;

        if ($p < 1)
            $p = 1;

        if (empty($order_by))
            $order_by = 'position';
        else
        /* Fix for all modules which are now using lowercase values for 'orderBy' parameter */
            $order_by = strtolower($order_by);

        if (empty($order_way))
            $order_way = 'ASC';
        if ($order_by == 'id_product' || $order_by == 'date_add' || $order_by == 'date_upd')
            $order_by_prefix = 'p';
        elseif ($order_by == 'name')
            $order_by_prefix = 'pl';
        elseif ($order_by == 'manufacturer') {
            $order_by_prefix = 'm';
            $order_by = 'name';
        } elseif ($order_by == 'position')
            $order_by_prefix = 'cp';

        if ($order_by == 'price')
            $order_by = 'orderprice';

        if (!Validate::isBool($active) || !Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way))
            die(Tools::displayError());

        $id_supplier = (int) Tools::getValue('id_supplier');

        /* Return only the number of products */
        if ($get_total) {
            $sql = 'SELECT COUNT(cp.`id_product`) AS total
					FROM `' . _DB_PREFIX_ . 'product` p
					' . Shop::addSqlAssociation('product', 'p') . '
					LEFT JOIN `' . _DB_PREFIX_ . 'news_product` cp ON p.`id_product` = cp.`id_product`
					WHERE cp.`id_news` = ' . (int) $this->id .
                    ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '') .
                    ($active ? ' AND product_shop.`active` = 1' : '') .
                    ($id_supplier ? 'AND p.id_supplier = ' . (int) $id_supplier : '');
            return (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        }

        $sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, MAX(product_attribute_shop.id_product_attribute) id_product_attribute, product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
					pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, MAX(image_shop.`id_image`) id_image,
					il.`legend`, m.`name` AS manufacturer_name, cl.`name` AS news_default,
					DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
					INTERVAL ' . (Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20) . '
						DAY)) > 0 AS new, product_shop.price AS orderprice
				FROM `' . _DB_PREFIX_ . 'news_product` cp
				LEFT JOIN `' . _DB_PREFIX_ . 'product` p
					ON p.`id_product` = cp.`id_product`
				' . Shop::addSqlAssociation('product', 'p') . '
				LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute` pa
				ON (p.`id_product` = pa.`id_product`)
				' . Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1') . '
				' . Product::sqlStock('p', 'product_attribute_shop', false, $context->shop) . '
				LEFT JOIN `' . _DB_PREFIX_ . 'news_lang` cl
					ON (product_shop.`id_news_default` = cl.`id_news`
					AND cl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('cl') . ')
				LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl
					ON (p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('pl') . ')
				LEFT JOIN `' . _DB_PREFIX_ . 'image` i
					ON (i.`id_product` = p.`id_product`)' .
                Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1') . '
				LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il
					ON (image_shop.`id_image` = il.`id_image`
					AND il.`id_lang` = ' . (int) $id_lang . ')
				LEFT JOIN `' . _DB_PREFIX_ . 'manufacturer` m
					ON m.`id_manufacturer` = p.`id_manufacturer`
				WHERE product_shop.`id_shop` = ' . (int) $context->shop->id . '
					AND cp.`id_news` = ' . (int) $this->id
                . ($active ? ' AND product_shop.`active` = 1' : '')
                . ($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '')
                . ($id_supplier ? ' AND p.id_supplier = ' . (int) $id_supplier : '')
                . ' GROUP BY product_shop.id_product';

        if ($random === true) {
            $sql .= ' ORDER BY RAND()';
            $sql .= ' LIMIT 0, ' . (int) $random_number_products;
        }
        else
            $sql .= ' ORDER BY ' . (isset($order_by_prefix) ? $order_by_prefix . '.' : '') . '`' . pSQL($order_by) . '` ' . pSQL($order_way) . '
			LIMIT ' . (((int) $p - 1) * (int) $n) . ',' . (int) $n;

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if ($order_by == 'orderprice')
            Tools::orderbyPrice($result, $order_way);

        if (!$result)
            return array();

        /* Modify SQL result */
        return Product::getProductsProperties($id_lang, $result);
    }

    /**
     * Return main categories
     *
     * @param integer $id_lang Language ID
     * @param boolean $active return only active categories
     * @return array categories
     */
    public static function getHomeListNews($id_lang, $active = true) {
        return self::getChildren(Configuration::get('PS_HOME_NEWS'), $id_lang, $active);
    }

    public static function getRootNews($id_lang = null, Shop $shop = null) {
        $context = Context::getContext();
        if (is_null($id_lang))
            $id_lang = $context->language->id;
        if (!$shop)
            if (Shop::isFeatureActive() && Shop::getContext() != Shop::CONTEXT_SHOP)
                $shop = new Shop(Configuration::get('PS_SHOP_DEFAULT'));
            else
                $shop = $context->shop;
        else
            return new News($shop->getNews(), $id_lang);
        $is_more_than_one_root_news = count(News::getListNewsWithoutParent()) > 1;
        if (Shop::isFeatureActive() && $is_more_than_one_root_news && Shop::getContext() != Shop::CONTEXT_SHOP)
            $news = News::getTopNews($id_lang);
        else
            $news = new News($shop->getNews(), $id_lang);

        return $news;
    }

   
    /**
     * Copy products from a news to another
     *
     * @param integer $id_old Source news ID
     * @param boolean $id_new Destination news ID
     * @return boolean Duplication result
     */
    public static function duplicateProductListNews($id_old, $id_new) {
        $sql = 'SELECT `id_news`
				FROM `' . _DB_PREFIX_ . 'news_product`
				WHERE `id_product` = ' . (int) $id_old;
        $result = Db::getInstance()->executeS($sql);

        $row = array();
        if ($result)
            foreach ($result as $i)
                $row[] = '(' . implode(', ', array((int) $id_new, $i['id_news'], '(SELECT tmp.max + 1 FROM (
					SELECT MAX(cp.`position`) AS max
					FROM `' . _DB_PREFIX_ . 'news_product` cp
					WHERE cp.`id_news`=' . (int) $i['id_news'] . ') AS tmp)'
                        )) . ')';

        $flag = Db::getInstance()->execute('
			INSERT IGNORE INTO `' . _DB_PREFIX_ . 'news_product` (`id_product`, `id_news`, `position`)
			VALUES ' . implode(',', $row)
        );
        return $flag;
    }

    /**
     * Check if news can be moved in another one.
     * The news cannot be moved in a child news.
     *
     * @param integer $id_news current news
     * @param integer $id_parent Parent candidate
     * @return boolean Parent validity
     */
    public static function checkBeforeMove($id_news, $id_parent) {
        if ($id_news == $id_parent)
            return false;
        if ($id_parent == Configuration::get('PS_HOME_NEWS'))
            return true;
        $i = (int) $id_parent;

        while (42) {
            $result = Db::getInstance()->getRow('SELECT `id_parent` FROM `' . _DB_PREFIX_ . 'news` WHERE `id_news` = ' . (int) $i);
            if (!isset($result['id_parent']))
                return false;
            if ($result['id_parent'] == $id_news)
                return false;
            if ($result['id_parent'] == Configuration::get('PS_HOME_NEWS'))
                return true;
            $i = $result['id_parent'];
        }
    }

    public static function getLinkRewrite($id_news, $id_lang) {
        if (!Validate::isUnsignedId($id_news) || !Validate::isUnsignedId($id_lang))
            return false;

        if (!isset(self::$_links[$id_news . '-' . $id_lang]))
            self::$_links[$id_news . '-' . $id_lang] = Db::getInstance()->getValue('
				SELECT cl.`link_rewrite`
				FROM `' . _DB_PREFIX_ . 'news_lang` cl
				WHERE `id_lang` = ' . (int) $id_lang . '
				' . Shop::addSqlRestrictionOnLang('cl') . '
				AND cl.`id_news` = ' . (int) $id_news
            );
        return self::$_links[$id_news . '-' . $id_lang];
    }

    public function getLink(Link $link = null) {
        if (!$link)
            $link = Context::getContext()->link;
        return $link->getNewsLink($this, $this->link_rewrite);
    }

    public function getName($id_lang = null) {
        if (!$id_lang) {
            if (isset($this->name[Context::getContext()->language->id]))
                $id_lang = Context::getContext()->language->id;
            else
                $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');
        }
        return isset($this->name[$id_lang]) ? $this->name[$id_lang] : '';
    }

    /**
     * Light back office search for categories
     *
     * @param integer $id_lang Language ID
     * @param string $query Searched string
     * @param boolean $unrestricted allows search without lang and includes first news and exact match
     * @return array Corresponding categories
     */
    public static function searchByName($id_lang, $query, $unrestricted = false) {
        if ($unrestricted === true)
            return Db::getInstance()->getRow('
				SELECT c.*, cl.*
				FROM `' . _DB_PREFIX_ . 'news` c
				LEFT JOIN `' . _DB_PREFIX_ . 'news_lang` cl
					ON (c.`id_news` = cl.`id_news`' . Shop::addSqlRestrictionOnLang('cl') . ')
				WHERE `name` LIKE \'' . pSQL($query) . '\'
			');
        else
            return Db::getInstance()->executeS('
				SELECT c.*, cl.*
				FROM `' . _DB_PREFIX_ . 'news` c
				LEFT JOIN `' . _DB_PREFIX_ . 'news_lang` cl
					ON (c.`id_news` = cl.`id_news`
					AND `id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('cl') . ')
				WHERE `name` LIKE \'%' . pSQL($query) . '%\''
            );
    }

    /**
     * Retrieve news by name and parent news id
     *
     * @param integer $id_lang Language ID
     * @param string  $news_name Searched news name
     * @param integer $id_parent_news parent news ID
     * @return array Corresponding news
     */
    public static function searchByNameAndParentNewsId($id_lang, $news_name, $id_parent_news) {
        return Db::getInstance()->getRow('
			SELECT c.*, cl.*
		    FROM `' . _DB_PREFIX_ . 'news` c
		    LEFT JOIN `' . _DB_PREFIX_ . 'news_lang` cl
		    	ON (c.`id_news` = cl.`id_news`
		    	AND `id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('cl') . ')
		    WHERE `name`  LIKE \'' . pSQL($news_name) . '\'
				AND c.`id_parent` = ' . (int) $id_parent_news
        );
    }

    /**
     * Get Each parent news of this news until the root news
     *
     * @param integer $id_lang Language ID
     * @return array Corresponding categories
     */
    public function getParentsListNews($id_lang = null) {
        $context = Context::getContext()->cloneContext();
        $context->shop = clone($context->shop);

        if (is_null($id_lang))
            $id_lang = $context->language->id;

        $newsList = null;
        $id_current = $this->id;
        if (count(News::getListNewsWithoutParent()) > 1 && Configuration::get('PS_MULTISHOP_FEATURE_ACTIVE') && count(Shop::getShops(true, null, true)) != 1)
            $context->shop->id_news = News::getTopNews()->id;
        elseif (!$context->shop->id)
            $context->shop = new Shop(Configuration::get('PS_SHOP_DEFAULT'));
        $id_shop = $context->shop->id;
        while (true) {
            $sql = '
			SELECT c.*, cl.*
			FROM `' . _DB_PREFIX_ . 'news` c
			LEFT JOIN `' . _DB_PREFIX_ . 'news_lang` cl
				ON (c.`id_news` = cl.`id_news`
				AND `id_lang` = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('cl') . ')';
            if (Shop::isFeatureActive() && Shop::getContext() == Shop::CONTEXT_SHOP)
                $sql .= '
			LEFT JOIN `' . _DB_PREFIX_ . 'news_shop` cs
				ON (c.`id_news` = cs.`id_news` AND cs.`id_shop` = ' . (int) $id_shop . ')';
            $sql .= '
			WHERE c.`id_news` = ' . (int) $id_current;
            if (Shop::isFeatureActive() && Shop::getContext() == Shop::CONTEXT_SHOP)
                $sql .= '
				AND cs.`id_shop` = ' . (int) $context->shop->id;
            $root_news = News::getRootNews();
            if (Shop::isFeatureActive() && Shop::getContext() == Shop::CONTEXT_SHOP &&
                    (!Tools::isSubmit('id_news') ||
                    (int) Tools::getValue('id_news') == (int) $root_news->id ||
                    (int) $root_news->id == (int) $context->shop->id_news))
                $sql .= '
					AND c.`id_parent` != 0';

            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

            if (isset($result[0]))
                $newsList[] = $result[0];
            else if (!$newsList)
                $newsList = array();
            if (!$result || ($result[0]['id_news'] == $context->shop->id_news))
                return $newsList;
            $id_current = $result[0]['id_parent'];
        }
    }

    /**
     * Specify if a news already in base
     *
     * @param $id_news News id
     * @return boolean
     */
    public static function newsExists($id_news) {
        $row = Db::getInstance()->getRow('
		SELECT `id_news`
		FROM ' . _DB_PREFIX_ . 'news c
		WHERE c.`id_news` = ' . (int) $id_news);

        return isset($row['id_news']);
    }

    public function cleanGroups() {
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'news_group` WHERE `id_news` = ' . (int) $this->id);
    }

    public function cleanAssoProducts() {
        Db::getInstance()->execute('DELETE FROM `' . _DB_PREFIX_ . 'news_product` WHERE `id_news` = ' . (int) $this->id);
    }

    public function addGroups($groups) {
        foreach ($groups as $group) {
            $row = array('id_news' => (int) $this->id, 'id_group' => (int) $group);
            Db::getInstance()->insert('news_group', $row);
        }
    }

    public function getGroups() {
        $groups = array();
        $result = Db::getInstance()->executeS('
			SELECT cg.`id_group`
			FROM ' . _DB_PREFIX_ . 'news_group cg
			WHERE cg.`id_news` = ' . (int) $this->id
        );
        foreach ($result as $group)
            $groups[] = $group['id_group'];
        return $groups;
    }

    public function addGroupsIfNoExist($id_group) {
        $groups = $this->getGroups();
        if (!in_array((int) $id_group, $groups))
            return $this->addGroups(array((int) $id_group));
        else
            return false;
    }

    /**
     * checkAccess return true if id_customer is in a group allowed to see this news.
     *
     * @param mixed $id_customer
     * @access public
     * @return boolean true if access allowed for customer $id_customer
     */
    public function checkAccess($id_customer) {
        if (!$id_customer) {
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
				SELECT ctg.`id_group`
				FROM ' . _DB_PREFIX_ . 'news_group ctg
				WHERE ctg.`id_news` = ' . (int) $this->id . ' AND ctg.`id_group` = ' . (int) Group::getCurrent()->id . '
			');
        } else {
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
				SELECT ctg.`id_group`
				FROM ' . _DB_PREFIX_ . 'news_group ctg
				INNER JOIN ' . _DB_PREFIX_ . 'customer_group cg on (cg.`id_group` = ctg.`id_group` AND cg.`id_customer` = ' . (int) $id_customer . ')
				WHERE ctg.`id_news` = ' . (int) $this->id
            );
        }
        if ($result && isset($result['id_group']) && $result['id_group'])
            return true;
        return false;
    }

    /**
     * Update customer groups associated to the object
     *
     * @param array $list groups
     */
    public function updateGroup($list) {
        $this->cleanGroups();
        if ($list && !empty($list))
            $this->addGroups($list);
        else
            $this->addGroups(array(Configuration::get('PS_UNIDENTIFIED_GROUP'), Configuration::get('PS_GUEST_GROUP'), Configuration::get('PS_CUSTOMER_GROUP')));
    }

    public static function setNewGroupForHome($id_group) {
        if (!(int) $id_group)
            return false;
        return Db::getInstance()->execute('
			INSERT INTO `' . _DB_PREFIX_ . 'news_group`
			VALUES (' . (int) Context::getContext()->shop->getNews() . ', ' . (int) $id_group . ')
		');
    }

    public function updatePosition($way, $position) {
        $id = Context::getContext()->shop->id;
        $id_shop = $id ? $id : Configuration::get('PS_SHOP_DEFAULT');
        if (!$res = Db::getInstance()->executeS('
			SELECT cp.`id_news`, cs.`position`, cp.`id_parent`
			FROM `' . _DB_PREFIX_ . 'news` cp
			LEFT JOIN `' . _DB_PREFIX_ . 'news_shop` cs
				ON (cp.`id_news` = cs.`id_news` AND cs.`id_shop` = ' . (int) $id_shop . ')
			WHERE cp.`id_parent` = ' . (int) $this->id_parent . '
			ORDER BY cs.`position` ASC'
                ))
            return false;

        foreach ($res as $news)
            if ((int) $news['id_news'] == (int) $this->id)
                $moved_news = $news;

        if (!isset($moved_news) || !isset($position))
            return false;
        // < and > statements rather than BETWEEN operator
        // since BETWEEN is treated differently according to databases
        $result = (Db::getInstance()->execute('
			UPDATE `' . _DB_PREFIX_ . 'news_shop` cs
			LEFT JOIN `' . _DB_PREFIX_ . 'news` c
				ON (c.`id_news` = cs.`id_news` AND cs.`id_shop` = ' . (int) $id_shop . ')
			SET cs.`position`= cs.`position` ' . ($way ? '- 1' : '+ 1') . '
			WHERE cs.`position`
			' . ($way ? '> ' . (int) $moved_news['position'] . ' AND cs.`position` <= ' . (int) $position : '< ' . (int) $moved_news['position'] . ' AND cs.`position` >= ' . (int) $position) . '
			AND c.`id_parent`=' . (int) $moved_news['id_parent']) && Db::getInstance()->execute('
			UPDATE `' . _DB_PREFIX_ . 'news_shop` cs
			LEFT JOIN `' . _DB_PREFIX_ . 'news` c
				ON (c.`id_news` = cs.`id_news` AND cs.`id_shop` = ' . (int) $id_shop . ')
			SET cs.`position` = ' . (int) $position . '
			WHERE c.`id_parent` = ' . (int) $moved_news['id_parent'] . '
			AND c.`id_news`=' . (int) $moved_news['id_news']));
        Hook::exec('actionNewsUpdate');
        return $result;
    }

    /**
     * cleanPositions keep order of news in $id_news_parent,
     * but remove duplicate position. Should not be used if positions
     * are clean at the beginning !
     *
     * @param mixed $id_news_parent
     * @return boolean true if succeed
     */
    public static function cleanPositions($id_news_parent = null) {
        if ($id_news_parent === null)
            return;
        $return = true;

        $id = Context::getContext()->shop->id;
        $id_shop = $id ? $id : Configuration::get('PS_SHOP_DEFAULT');
        $result = Db::getInstance()->executeS('
			SELECT c.`id_news`
			FROM `' . _DB_PREFIX_ . 'news` c
			LEFT JOIN `' . _DB_PREFIX_ . 'news_shop` cs
				ON (c.`id_news` = cs.`id_news` AND cs.`id_shop` = ' . (int) $id_shop . ')
			WHERE c.`id_parent` = ' . (int) $id_news_parent . '
			ORDER BY cs.`position`
		');
        $count = count($result);
        for ($i = 0; $i < $count; $i++) {
            $sql = '
				UPDATE `' . _DB_PREFIX_ . 'news` c
				LEFT JOIN `' . _DB_PREFIX_ . 'news_shop` cs
					ON (c.`id_news` = cs.`id_news` AND cs.`id_shop` = ' . (int) $id_shop . ')
				SET cs.`position` = ' . (int) ($i + 1) . '
				WHERE c.`id_parent` = ' . (int) $id_news_parent . '
				AND c.`id_news` = ' . (int) $result[$i]['id_news'];
            $return &= Db::getInstance()->execute($sql);
        }
        return $return;
    }

    /** this function return the number of news + 1 having $id_news_parent as parent.
     *
     * @todo rename that function to make it understandable (getNewLastPosition for example)
     * @param int $id_news_parent the parent news
     * @param int $id_shop
     * @return int
     */
    public static function getLastPosition($id_news_parent, $id_shop) {
        return (int) (Db::getInstance()->getValue('
		SELECT MAX(n.`position`)
		FROM `' . _DB_PREFIX_ . 'news` n'));
    }
    
    public function getNews(){
        
    }

    public static function getUrlRewriteInformations($id_news) {
        return Db::getInstance()->executeS('
			SELECT l.`id_lang`, c.`link_rewrite`
			FROM `' . _DB_PREFIX_ . 'news_lang` AS c
			LEFT JOIN  `' . _DB_PREFIX_ . 'lang` AS l ON c.`id_lang` = l.`id_lang`
			WHERE c.`id_news` = ' . (int) $id_news . '
			AND l.`active` = 1'
        );
    }

    /**
     * Return nleft and nright fields for a given news
     *
     * @since 1.5.0
     * @param int $id
     * @return array
     */
    public static function getInterval($id) {
        $sql = 'SELECT nleft, nright, level_depth
				FROM ' . _DB_PREFIX_ . 'news
				WHERE id_news = ' . (int) $id;
        if (!$result = Db::getInstance()->getRow($sql))
            return false;
        return $result;
    }

    /**
     *
     * @param Array $ids_news
     * @param int $id_lang
     * @return Array
     */
    public static function getNewsInformations($ids_news, $id_lang = null) {
        if ($id_lang === null)
            $id_lang = Context::getContext()->language->id;

        if (!is_array($ids_news) || !count($ids_news))
            return;

        $newsList = array();
        $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT c.`id_news`, cl.`name`, cl.`link_rewrite`, cl.`id_lang`
			FROM `' . _DB_PREFIX_ . 'news` c
			LEFT JOIN `' . _DB_PREFIX_ . 'news_lang` cl ON (c.`id_news` = cl.`id_news`)
			WHERE cl.`id_lang` = ' . (int) $id_lang . '
			AND c.`id_news` IN (' . implode(',', array_map('intval', $ids_news)) . ')
		');

        foreach ($results as $news)
            $newsList[$news['id_news']] = $news;

        return $newsList;
    }

}

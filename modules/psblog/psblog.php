<?php

/**
 * Prestablog module
 *
 * @author Appside
 * @copyright Appside
 * @version 1.5
 *
 */
class Psblog extends Module {

    private $_html = '';
    private $_postErrors = array();
    private static $pref = null;
    public static $default_values = array(
        "nb_max_img" => 0,
        "nb_max_video" => 0,
        "img_width" => 200,
        "img_list_width" => 100,
        "category_active" => 1,
        "product_active" => 1,
        "related_active" => 1,
        "product_page_related" => 1,
        "product_img_format" => "medium_default",
        "comment_active" => 1,
        "comment_moderate" => 1,
        "comment_guest" => 1,
        "comment_min_time" => 20,
        "comment_name_min_length" => 2,
        "view_display_date" => 1,
        "view_display_popin" => 1,
        "list_limit_page" => 5,
        "list_display_date" => 1,
        "file_formats" => "jpg|jpeg|png|gif|mp4|wmv|flv",
        "img_save_path" => "modules/psblog/uploads/",
        "rss_active" => 1,
        "rss_display" => "excerpt",
        "share_active" => 1);

    public function __construct() {
        $this->name = 'psblog';
        $this->version = '1.5.2';
        $this->module_key = "2eb7d51fcd2897494f1d594063c940cc";
        $this->need_instance = 0;
        $this->tab = 'front_office_features';

        parent::__construct();

        $this->checkServerConf();

        $this->author = 'APPSIDE';
        $this->displayName = $this->l('Prestablog');
        $this->description = $this->l('Blog module, articles, categories, comments and products related');
    }

    public function install() {
        if (!parent::install())
            return false;
        if (!Configuration::updateValue('PSBLOG_CONF', base64_encode(serialize(self::$default_values))))
            return false;

        Configuration::updateValue('PSBLOG_VERSION', $this->version);

        $this->createAdminTabs();

        @copy(dirname(__FILE__) . "/AdminBlog.gif", _PS_ROOT_DIR_ . "/img/t/AdminBlog.gif");

        if (!$this->registerHook('header') OR !$this->registerHook('actionHtaccessCreate') OR !$this->registerHook('productTab') OR !$this->registerHook('productTabContent'))
            return false;

        require_once(dirname(__FILE__) . '/install-sql.php');

        $this->generateRewriteRules();

        return true;
    }

    private function createAdminTabs() {

        $langs = Language::getLanguages();
        $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');

        /*         * ** create tab publications *** */

        $tab0 = new Tab();
        $tab0->class_name = "AdminBlog";
        $tab0->module = "psblog";
        $tab0->id_parent = 0;
        foreach ($langs as $l) {
            $tab0->name[$l['id_lang']] = $this->l('Blog');
        }
        $tab0->save();
        $blog_tab_id = $tab0->id;

        $tab1 = new Tab();
        $tab1->class_name = "AdminBlogPosts";
        $tab1->module = "psblog";
        $tab1->id_parent = $blog_tab_id;
        foreach ($langs as $l) {
            $tab1->name[$l['id_lang']] = $this->l('Blog posts');
        }
        $tab1->save();

        /*         * ** create tab categories *** */
        $tab2 = new Tab();
        $tab2->class_name = "AdminBlogCategories";
        $tab2->module = "psblog";
        $tab2->id_parent = $blog_tab_id;
        foreach ($langs as $l) {
            $tab2->name[$l['id_lang']] = $this->l('Blog categories');
        }
        $tab2->save();

        /*         * ** create tab comments *** */
        $tab3 = new Tab();
        $tab3->class_name = "AdminBlogComments";
        $tab3->module = "psblog";
        $tab3->id_parent = $blog_tab_id;
        foreach ($langs as $l) {
            $tab3->name[$l['id_lang']] = $this->l('Blog comments');
        }
        $tab3->save();

        /*         * * RIGHTS MANAGEMENT ** */
        Db::getInstance()->Execute('DELETE FROM ' . _DB_PREFIX_ . 'access 
                                        WHERE `id_tab` = ' . (int) $tab0->id . ' 
                                            OR `id_tab` = ' . (int) $tab1->id . ' 
                                            OR `id_tab` = ' . (int) $tab2->id . ' 
                                            OR `id_tab` = ' . (int) $tab3->id);

        Db::getInstance()->Execute('DELETE FROM ' . _DB_PREFIX_ . 'module_access WHERE `id_module` = ' . (int) $this->id);

        $profiles = Profile::getProfiles($id_lang);

        if (count($profiles)) {
            foreach ($profiles as $p) {

                Db::getInstance()->Execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'access`(`id_profile`,`id_tab`,`view`,`add`,`edit`,`delete`) 
                                                 VALUES (' . $p['id_profile'] . ', ' . (int) $tab0->id . ',1,1,1,1)');

                Db::getInstance()->Execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'access`(`id_profile`,`id_tab`,`view`,`add`,`edit`,`delete`) 
                                                 VALUES (' . $p['id_profile'] . ', ' . (int) $tab1->id . ',1,1,1,1)');

                Db::getInstance()->Execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'access`(`id_profile`,`id_tab`,`view`,`add`,`edit`,`delete`) 
                                                 VALUES (' . $p['id_profile'] . ', ' . (int) $tab2->id . ',1,1,1,1)');

                Db::getInstance()->Execute('INSERT IGNORE INTO `' . _DB_PREFIX_ . 'access`(`id_profile`,`id_tab`,`view`,`add`,`edit`,`delete`) 
                                                 VALUES (' . $p['id_profile'] . ',' . (int) $tab3->id . ',1,1,1,1)');

                Db::getInstance()->execute('INSERT INTO ' . _DB_PREFIX_ . 'module_access(`id_profile`, `id_module`, `configure`, `view`)
                                                VALUES (' . $p['id_profile'] . ',' . (int) $this->id . ',1,1)');
            }
        }
    }

    private function generateRewriteRules() {

        if (Configuration::get('PS_REWRITING_SETTINGS')) {

            $rules = "#start_prestablog - not remove this comment \n";

            $physical_uri = array();
            foreach (ShopUrl::getShopUrls() as $shop_url) {
                if (in_array($shop_url->physical_uri, $physical_uri))
                    continue;

                $rules .= "RewriteRule ^(.*)blog$ " . $shop_url->physical_uri . "index.php?fc=module&module=psblog&controller=posts [QSA,L] \n";
                $rules .= "RewriteRule ^(.*)blog/([0-9]+)\-([a-zA-Z0-9-]*) " . $shop_url->physical_uri . "index.php?fc=module&module=psblog&controller=posts&post=$2 [QSA,L] \n";
                $rules .= "RewriteRule ^(.*)blog/category/([0-9]+)\-([a-zA-Z0-9-]*) " . $shop_url->physical_uri . "index.php?fc=module&module=psblog&controller=posts&category=$2 [QSA,L] \n";

                $physical_uri[] = $shop_url->physical_uri;
            }
            $rules .= "#end_prestablog \n\n";

            $path = _PS_ROOT_DIR_ . '/.htaccess';

            if (is_writable($path)) {

                $existingRules = file_get_contents($path);

                if (!strpos($existingRules, "start_prestablog")) {
                    $handle = fopen($path, 'w');
                    fwrite($handle, $rules . $existingRules);
                    fclose($handle);
                }
            }
        }
    }

    public function hookActionHtaccessCreate($params) {
        $this->generateRewriteRules();
    }

    public function uninstall() {
        /*         * ** delete AdminPsblog tab *** */
        $tab_id = Tab::getIdFromClassName("AdminBlog");
        if ($tab_id) {
            $tab = new Tab($tab_id);
            $tab->delete();
        }

        /*         * ** delete AdminPsblogPosts tab *** */
        $tab_id = Tab::getIdFromClassName("AdminBlogPosts");
        if ($tab_id) {
            $tab = new Tab($tab_id);
            $tab->delete();
        }

        /*         * ** delete AdminPsblogCategory tab *** */
        $tab_id = Tab::getIdFromClassName("AdminBlogCategories");
        if ($tab_id) {
            $tab = new Tab($tab_id);
            $tab->delete();
        }

        /*         * ** delete AdminPsblogComment tab *** */
        $tab_id = Tab::getIdFromClassName("AdminBlogComments");
        if ($tab_id) {
            $tab = new Tab($tab_id);
            $tab->delete();
        }

        @unlink(_PS_ROOT_DIR_ . "/img/t/AdminBlog.gif");

        if (!Configuration::deleteByName('PSBLOG_CONF') OR !parent::uninstall())
            return false;
        return true;
    }

    public function hookHeader($params) {
        $this->context->controller->addCSS($this->_path . 'psblog.css', 'all');
    }

    public function hookProductTab($params) {

        require_once(dirname(__FILE__) . "/classes/BlogPost.php");

        $id_product = (int) $_GET['id_product'];
        $nb = BlogPost::listPosts(true, true, null, null, true, null, $id_product, null);
        if ($nb > 0)
            return $this->display(__FILE__, 'views/templates/front/product-tabtitle.tpl');
    }

    public function hookProductTabContent($params) {

        $id_product = (int) $_GET['id_product'];
        if (!$id_product)
            return false;

        require_once(dirname(__FILE__) . "/classes/BlogPost.php");

        $list = BlogPost::listPosts(true, true, null, null, false, null, $id_product, null);

        if ($list) {
            $i = 0;
            foreach ($list as $val) {
                $list[$i]['link'] = BlogPost::linkPost($val['id_blog_post'], $val['link_rewrite'], $val['id_lang']);
                $i++;
            }
        }
        $this->smarty->assign(array('post_product_list' => $list));
        return $this->display(__FILE__, 'views/templates/front/product-tabcontent.tpl');
    }

    /** various product page hooks * */
    public function hookExtraLeft($params) {
        return $this->hookProductTabContent($params);
    }

    public function hookProductFooter($params) {
        return $this->hookProductTabContent($params);
    }

    public function hookExtra($params) {
        return $this->hookProductTabContent($params);
    }

    public function hookExtraRight($params) {
        return $this->hookProductTabContent($params);
    }

    public static function getPreferences() {
        if (is_null(self::$pref)) {
            $config = Configuration::get('PSBLOG_CONF');
            $options = self::$default_values;

            if ($config)
                $options = array_merge($options, unserialize(base64_decode($config)));
            self::$pref = $options;
        }
        return self::$pref;
    }

    public function checkServerConf() {
        $pref = self::getPreferences();
        $this->warning = '';
        if (!is_writable(_PS_ROOT_DIR_ . '/' . $pref['img_save_path'])) {
            $this->warning .= _PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . ' ' . $this->l('must be writable') . "<br />";
        }
        if (!is_writable(_PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . 'thumb/')) {
            $this->warning .= _PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . 'thumb/ ' . $this->l('must be writable') . "<br />";
        }
        if (!is_writable(_PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . 'list/')) {
            $this->warning .= _PS_ROOT_DIR_ . '/' . $pref['img_save_path'] . 'list/ ' . $this->l('must be writable') . "<br />";
        }
    }

    private function _postValidation() {

        $numericValues = array('img_width', 'img_list_width', 'list_limit_page', 'comment_min_time', 'comment_name_min_length');

        if (isset($_POST['submitPsblog'])) {
            foreach ($numericValues as $val) {
                if (empty($_POST['pref'][$val]) || !is_numeric($_POST['pref'][$val])) {
                    $this->_postErrors[] = $val . $this->l(' must be a numeric value');
                }
            }
        }
    }

    private function _postProcess() {
        if (Tools::isSubmit('submitPsblog')) {
            $pref = $_POST['pref'];
            $old_values = self::getPreferences();

            $checkboxes = array('category_active', 'product_active', 'comment_active', 'comment_moderate',
                'comment_guest', 'list_display_date', 'view_display_date', 'related_active',
                'view_display_popin', 'rewrite_active', 'product_page_related', 'rss_active', 'share_active');

            foreach ($checkboxes as $input) {
                if (!isset($pref[$input]))
                    $pref[$input] = 0;
            }

            $new_values = array_merge(self::$default_values, $pref);
            Configuration::updateValue('PSBLOG_CONF', base64_encode(serialize($new_values)));

            if ($new_values['product_page_related'] != $old_values['product_page_related']) {
                if ($new_values['product_page_related'] == 1) {
                    $this->registerHook('productTab');
                    $this->registerHook('productTabContent');
                } else {
                    $this->unregisterHook(Hook::getIdByName('productTab'));
                    $this->unregisterHook(Hook::getIdByName('productTabContent'));
                }
            }

            $this->_html .= '<div class="conf confirm">' . $this->l('Settings updated') . '</div>';
        } elseif (Tools::isSubmit('submitGenerateImg')) {

            include_once(_PS_MODULE_DIR_ . "psblog/classes/BlogPost.php");

            $images = BlogPost::getAllImages();
            $save_path = _PS_ROOT_DIR_ . '/' . rtrim(self::$pref['img_save_path'], '/') . "/";

            foreach ($images as $img) {

                @unlink($save_path . 'thumb/' . $img['img_name']);
                @unlink($save_path . 'list/' . $img['img_name']);

                BlogPost::generateImageThumbs($img['id_blog_image']);
            }

            $this->_html .= '<div class="conf confirm">' . $this->l('Images regenerated') . '</div>';
        } elseif (Tools::isSubmit('submitGenerateSitemap')) {

            include_once(_PS_MODULE_DIR_ . "psblog/classes/BlogShop.php");

            BlogShop::generateSitemap();

            $this->_html .= '<div class="conf confirm">' . $this->l('Google sitemap regenerated') . '</div>';
        }
    }

    private function _displayForm() {

        $values = (isset($_POST) && isset($_POST['submitPsblog'])) ? Tools::getValue('pref') : array_merge(self::$default_values, self::getPreferences());

        $this->_html .='
		
		<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
		<fieldset>
		<legend>' . $this->l('General') . '</legend>
			
		
		<label>' . $this->l('Active categories') . '</label>  
		<div class="margin-form">
		<input type="checkbox" name="pref[category_active]" value="1" ' . ((isset($values['category_active']) && $values['category_active'] == '1') ? 'checked' : '') . ' />
		</div>
		<div class="clear"></div>
		
		<label>' . $this->l('Active products') . '</label>  
		<div class="margin-form">
		<input type="checkbox" name="pref[product_active]" value="1" ' . ((isset($values['product_active']) && $values['product_active'] == '1') ? 'checked' : '') . ' />
		</div>
		<div class="clear"></div>
		
		<label>' . $this->l('Active comments') . '</label>  
		<div class="margin-form">
		<input type="checkbox" name="pref[comment_active]" value="1" ' . ((isset($values['comment_active']) && $values['comment_active'] == '1') ? 'checked' : '') . ' />
		</div>
		<div class="clear"></div>
		
		<label>' . $this->l('Enable related articles') . '</label>  
		<div class="margin-form">
		<input type="checkbox" name="pref[related_active]" value="1" ' . ((isset($values['related_active']) && $values['related_active'] == '1') ? 'checked' : '') . ' />
		</div>';


        $this->_html .= '
			</fieldset>
			<br /><div class="clear"></div>';

        $this->_html .= '<fieldset>
                <legend>' . $this->l('List settings') . '</legend>

                <label>' . $this->l('Number of articles per page') . '</label> 
                <div class="margin-form">
                <input type="text" name="pref[list_limit_page]" value="' . $values['list_limit_page'] . '" size="3" />
                </div><div class="clear"></div><br />

                <label>' . $this->l('Display date') . '</label>  
                <div class="margin-form">
                <input type="checkbox" name="pref[list_display_date]" value="1" ' . ((isset($values['list_display_date']) && $values['list_display_date'] == '1') ? 'checked' : '') . '/>
                </div><div class="clear"></div><br />

                <label>' . $this->l('Image width in lists') . '</label>
                <div class="margin-form">
                        <input type="text" name="pref[img_list_width]" value="' . $values['img_list_width'] . '" size="3" /> px
                </div>';

        $this->_html .= '</fieldset><br /><div class="clear"></div>';

        $this->_html .= '<fieldset>
				
                                <legend>' . $this->l('View settings') . '</legend>
		
				<label>' . $this->l('Image width in article detail') . '</label>
				<div class="margin-form">
					<input type="text" name="pref[img_width]" value="' . $values['img_width'] . '" size="3" /> px
				</div><div class="clear"></div><br />
				
				<label>' . $this->l('Enable popin for images') . '</label>  
					<div class="margin-form">
					<input type="checkbox" name="pref[view_display_popin]" value="1" ' . ((isset($values['view_display_popin']) && $values['view_display_popin'] == '1') ? 'checked' : '') . '/>
				</div>
				
				<div class="clear"></div><br />
				
				<label>' . $this->l('Display date') . '</label>  
				<div class="margin-form">
				<input type="checkbox" name="pref[view_display_date]" value="1" ' . ((isset($values['view_display_date']) && $values['view_display_date'] == '1') ? 'checked' : '') . '/>
				</div>
				
				<div class="clear"></div><br />';

        $this->_html .= '<label>' . $this->l('Active Addthis') . '</label>  
				<div class="margin-form">
					<input type="checkbox" name="pref[share_active]" value="1" ' . ((isset($values['share_active']) && $values['share_active'] == '1') ? 'checked' : '') . ' />
				</div>
				
				</fieldset>
				<div class="clear"></div><br />';

        $this->_html .= '<fieldset>
                                <legend>' . $this->l('Related products settings') . '</legend>
				
                                <label>' . $this->l('Enable related articles in product page') . '</label>  
                                <div class="margin-form">
                                <input type="checkbox" name="pref[product_page_related]" value="1" ' . ((isset($values['product_page_related']) && $values['product_page_related'] == '1') ? 'checked' : '') . '/>
                                </div><div class="clear"></div><br />';

        $formats = ImageType::getImagesTypes();

        $this->_html .= '<label>' . $this->l('Product image format') . '</label>  
                                  <div class="margin-form">
                                      <select name="pref[product_img_format]">';
        foreach ($formats as $f) {
            $this->_html .= '<option value="' . $f['name'] . '" ' . ($values['product_img_format'] == $f['name'] ? "selected" : "") . '>' . $f['name'] . ' &nbsp;</option>';
        }
        $this->_html .= '</select>
                                 </div>';

        $this->_html .= '</fieldset><div class="clear"></div><br />';

        $this->_html .= '<fieldset>
                                        
                                <legend>' . $this->l('Comments settings') . '</legend>

                                <label>' . $this->l('All comments must be validated by an employee') . '</label>  
                                <div class="margin-form">
                                <input type="checkbox" name="pref[comment_moderate]" value="1" ' . ((isset($values['comment_moderate']) && $values['comment_moderate'] == '1') ? 'checked' : '') . '/>
                                </div>

                                <div class="clear"></div><br />

                                <label>' . $this->l('Allow guest comments') . '</label>  
                                <div class="margin-form">
                                <input type="checkbox" name="pref[comment_guest]" value="1" ' . ((isset($values['comment_guest']) && $values['comment_guest'] == '1') ? 'checked' : '') . '/>
                                </div>

                                <div class="clear"></div><br />

                                <label>' . $this->l('Minimum time between 2 comments from the same user') . '</label>
                                <div class="margin-form">
                                        <input name="pref[comment_min_time]" type="text" class="text" value="' . $values['comment_min_time'] . '" style="width: 40px; text-align: right;" /> ' . $this->l('seconds') . '
                                </div>

                                <div class="clear"></div><br />

                                <label>' . $this->l('Minimum length of user name') . '</label>
                                <div class="margin-form">
                                        <input name="pref[comment_name_min_length]" type="text" class="text" value="' . $values['comment_name_min_length'] . '" style="width: 40px; text-align: right;" /> ' . $this->l('characters') . '
                                </div>';

        $this->_html .= '</fieldset>';

        $this->_html .= '<div class="clear"></div><br />';

        $this->_html .= '<fieldset>
                            
                            <legend>' . $this->l('RSS settings') . '</legend>

                            <label>' . $this->l('Enable RSS feed') . '</label>  
                            <div class="margin-form">
                            <input type="checkbox" name="pref[rss_active]" value="1" ' . ((isset($values['rss_active']) && $values['rss_active'] == '1') ? 'checked' : '') . '/>
                            </div>

                            <div class="clear"></div><br />

                            <label>' . $this->l('Post field used for content') . '</label> 
                            <div class="margin-form">
                                    <select name="pref[rss_display]">
                                            <option value="excerpt" ' . ($values['rss_display'] == "excerpt" ? "selected" : "") . '>' . $this->l('Excerpt') . ' &nbsp;</option>
                                            <option value="content" ' . ($values['rss_display'] == "content" ? "selected" : "") . '>' . $this->l('Content') . ' &nbsp;</option>
                                    </select>
                            </div>';

        $this->_html .= '</fieldset><div class="clear"></div><br />';

        $this->_html .= '<div class="clear"></div>
		
                    <input class="button" name="submitPsblog" value="' . $this->l('Update settings') . '" type="submit" />';

        $this->_html .= '<div class="clear"></div><br /><br />';

        $this->_html .= '<fieldset>
                            
                                <legend>' . $this->l('Tools') . '</legend>
                                
                                 <p>
                                 <input class="button" name="submitGenerateImg" value="' . $this->l('Regenerate all blog images') . '" type="submit" />
                                 &nbsp; ' . $this->l('Useful if you change the images sizes') . '
                                 </p>';

        if (self::isInstalled('gsitemap')) {

            $this->_html .= '<p>
                                        <input class="button" name="submitGenerateSitemap" value="' . $this->l('Regenerate Google sitemap') . '" type="submit" /> 
                                            &nbsp; <a href="' . _PS_BASE_URL_ . __PS_BASE_URI__ . 'modules/psblog/sitemap-blog.xml" target="_blank">' . _PS_BASE_URL_ . __PS_BASE_URI__ . 'modules/psblog/sitemap-blog.xml</a> ' . '
                                    </p>';
        }

        $this->_html .= '<div class="multishop_info">
                            <p>
                            ' . $this->l('If url rewriting doesn\'t works, check that this above lines exist in your current .htaccess file, if no, add it manually on top of your .htaccess file') . ': <br /><br />

                                  <strong>';
        $physical_uri = array();
        foreach (ShopUrl::getShopUrls() as $shop_url) {
            if (in_array($shop_url->physical_uri, $physical_uri))
                continue;

            $this->_html .= "RewriteRule ^(.*)blog$ " . $shop_url->physical_uri . "index.php?fc=module&module=psblog&controller=posts [QSA,L] <br />";
            $this->_html .= "RewriteRule ^(.*)blog/([0-9]+)\-([a-zA-Z0-9-]*) " . $shop_url->physical_uri . "index.php?fc=module&module=psblog&controller=posts&post=$2 [QSA,L] <br />";
            $this->_html .= "RewriteRule ^(.*)blog/category/([0-9]+)\-([a-zA-Z0-9-]*) " . $shop_url->physical_uri . "index.php?fc=module&module=psblog&controller=posts&category=$2 [QSA,L] <br />";

            $physical_uri[] = $shop_url->physical_uri;
        }

        $this->_html .= '</strong>
                                </p>
                              </div>';

        $this->_html .= '<div class="multishop_info">
                            <p>
                            ' . $this->l('To declare blog sitemap xml, add this line at the end of your robots.txt file') . ': <br /><br />

                                  <strong>
                                    Sitemap ' . _PS_BASE_URL_ . __PS_BASE_URI__ . 'modules/psblog/sitemap-blog.xml
                                 </strong>
                            </p>
                </div>';

        $this->_html .= '</fieldset>
                    						
		</form>';
    }

    public static function getRewriteConf() {
        self::getPreferences();
        return self::$pref['rewrite_active'];
    }

    public function getContent() {
        $this->checkServerConf();
        if ($this->warning != '') {
            $this->_html .= '<div style="width:680px;" class="warning bold">' . $this->warning . '</div>';
        }

        $this->_html .= '<h2>' . $this->l('Prestablog settings') . '</h2>';

        $this->_html .= '<p>' . $this->l('If you want to add articles, you must go to the Blog tab on the navigation menu') . '</p>';

        if (isset($_POST)) {
            $this->_postValidation();
            if (!isset($this->_postErrors) || !sizeof($this->_postErrors)) {
                $this->_postProcess();
            } else {
                foreach ($this->_postErrors AS $err)
                    $this->_html .= '<div class="alert error">' . $err . '</div>';
            }
        } else {
            $this->_html .= '<br />';
        }
        $this->_displayForm();
        return $this->_html;
    }

}
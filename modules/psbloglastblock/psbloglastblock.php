<?php

/**
 * Prestablog module
 *
 * @author Appside
 * @copyright Appside
 * @version 1.5
 *
 */
class Psbloglastblock extends Module {

    private $_html = '';
    private static $pref = null;
    public static $default_values = array("img_block_width" => 50,
        "block_limit_items" => 5,
        "block_display_date" => 1,
        "block_display_img" => 1,
        "block_articles_position" => "leftColumn",
        "block_articles_home" => 0);

    public function __construct() {
        $this->name = 'psbloglastblock';
        $this->version = 1.5;
        $this->module_key = "2eb7d51fcd2897494f1d594063c940cc";
        $this->need_instance = 0;
        $this->tab = 'front_office_features';

        parent::__construct();

        $this->checkServerConf();

        $this->author = 'APPSIDE';
        $this->displayName = $this->l('Prestablog last posts block');
        $this->description = $this->l('Adds a block to display last posts');
    }

    public function install() {
        if (parent::install() == false OR $this->registerHook(self::$default_values['block_articles_position']) == false)
            return false;
        if (!Configuration::updateValue('PSBLOG_BLOCK_CONF', base64_encode(serialize(self::$default_values))))
            return false;
        return true;
    }

    private function calculHookCommon($params) {
        $pref = array_merge(Psblog::getPreferences(), self::getPreferences());
        $img_path = rtrim($pref['img_save_path'], '/') . '/';

        $list = BlogPost::listPosts(true, true, 0, intval($pref['block_limit_items']));
        if ($list) {
            $i = 0;
            foreach ($list as $val) {
                $list[$i]['link'] = BlogPost::linkPost($val['id_blog_post'], $val['link_rewrite'], $val['id_lang']);
                $i++;
            }
        }

        $this->smarty->assign(array('last_post_list' => $list,
            'blog_conf' => $pref,
            'linkPosts' => BlogPost::linkList(),
            'img_path' => _PS_BASE_URL_ . __PS_BASE_URI__ . $img_path,
            'posts_rss_url' => BlogPost::linkRss()));
        return true;
    }

    public function hookLeftColumn($params) {

        if (!$this->checkServerConf())
            return false;

        $is_home = Tools::getValue('controller') == 'index' ? true : false;

        require_once(_PS_MODULE_DIR_ . "psblog/psblog.php");
        require_once(_PS_MODULE_DIR_ . "psblog/classes/BlogPost.php");

        $pref = array_merge(Psblog::getPreferences(), self::getPreferences());

        if (!($is_home && $pref['block_articles_home'] == 1)) {
            $this->calculHookCommon($params);
            return $this->display(__FILE__, 'block.tpl');
        }
    }

    public function hookRightColumn($params) {
        return $this->hookLeftColumn($params);
    }

    public function hookHome($params) {

        require_once(_PS_MODULE_DIR_ . "psblog/psblog.php");
        require_once(_PS_MODULE_DIR_ . "psblog/classes/BlogPost.php");

        if (!$this->checkServerConf())
            return false;

        $this->calculHookCommon($params);

        return $this->display(__FILE__, 'home.tpl');
    }

    public function hookdisplayFooterNews($params) {
        return $this->hookHome($params);
    }

    public function getContent() {
        if ($this->warning != '') {
            $this->_html .= '<div style="width:680px;" class="warning bold">' . $this->warning . '</div>';
            return $this->_html;
        }

        $this->_html .= '<h2>' . $this->displayName . '</h2>';
        $this->_html .= '<p>' . $this->l('If you want to add articles, you must go to the Prestablog sub tab on the navigation menu') . '</p>';
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

    private function _displayForm() {
        $values = (isset($_POST) && isset($_POST['submitLastPosts'])) ? Tools::getValue('pref') : array_merge(self::$default_values, self::getPreferences());

        $this->_html .= '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
				<fieldset>
				<legend>' . $this->l('Block last posts settings') . '</legend>
				
				<label>' . $this->l('Number of posts to display in blocks') . '</label> 
				<div class="margin-form">
				<input type="text" name="pref[block_limit_items]" value="' . $values['block_limit_items'] . '" size="3" />
				</div>
				<div class="clear"></div><br />
				
				<label>' . $this->l('Display date') . '</label>  
				<div class="margin-form">
				<input type="checkbox" name="pref[block_display_date]" value="1" ' . ((isset($values['block_display_date']) && $values['block_display_date'] == '1') ? 'checked' : '') . '/>
				</div>
				<div class="clear"></div><br />
				
				<label>' . $this->l('Block last articles position') . '</label> 
				<div class="margin-form">
					<select name="pref[block_articles_position]">
						<option value="leftColumn" ' . ($values['block_articles_position'] == "leftColumn" ? "selected" : "") . '>' . $this->l('Left') . ' &nbsp;</option>
						<option value="rightColumn" ' . ($values['block_articles_position'] == "rightColumn" ? "selected" : "") . '>' . $this->l('Right') . ' &nbsp;</option>
					</select>
				</div>
				<div class="clear"></div><br />
				
				<label>' . $this->l('In homepage, display block in middle content') . '</label>  
				<div class="margin-form">
				<input type="checkbox" name="pref[block_articles_home]" value="1" ' . ((isset($values['block_articles_home']) && $values['block_articles_home'] == '1') ? 'checked' : '') . '/>&nbsp; ' . $this->l('instead of column') . '
				</div>
				
				<div class="clear"></div><br />
				
				<label>' . $this->l('Display images') . '</label>  
				<div class="margin-form">
				<input type="checkbox" name="pref[block_display_img]" value="1" ' . ((isset($values['block_display_img']) && $values['block_display_img'] == '1') ? 'checked' : '') . '/>
				</div>
				<div class="clear"></div><br />
				
				<label>' . $this->l('Image width') . '</label>
				<div class="margin-form">
					<input type="text" name="pref[img_block_width]" value="' . $values['img_block_width'] . '" size="3" /> px
				</div><div class="clear"></div><br />
				
				</fieldset>
				<br />
				<div class="clear"></div>
				<input type="submit" name="submitLastPosts" value="' . $this->l('Save') . '" class="button" />
			</form>';
    }

    private function _postValidation() {
        if (isset($_POST['submitLastPosts'])) {
            if (empty($_POST['pref']['img_block_width']) || !is_numeric($_POST['pref']['img_block_width']))
                $this->_postErrors[] = $this->l('Numeric width is required for image size.');

            if (empty($_POST['pref']['block_limit_items']) || !is_numeric($_POST['pref']['block_limit_items']))
                $this->_postErrors[] = $this->l('Number of posts in block must be a number.');
        }
    }

    private function _postProcess() {
        if (Tools::isSubmit('submitLastPosts')) {
            $pref = $_POST['pref'];
            $old_values = self::getPreferences();

            $checkboxes = array('block_display_date', 'block_articles_home', 'block_display_img');
            foreach ($checkboxes as $input) {
                if (!isset($pref[$input]))
                    $pref[$input] = 0;
            }

            $new_values = array_merge(self::$default_values, $pref);
            Configuration::updateValue('PSBLOG_BLOCK_CONF', base64_encode(serialize($new_values)));

            if ($new_values['block_articles_position'] != $old_values['block_articles_position']) {
                $old_hook_id = Hook::getIdByName($old_values['block_articles_position']);
                $this->unregisterHook($old_hook_id);
                $this->registerHook($new_values['block_articles_position']);
            }

            if ($new_values['block_articles_home'] != $old_values['block_articles_home']) {

                if ($new_values['block_articles_home'] == 1) {
                    $this->registerHook('home');
                } else {
                    $old_hook_id = Hook::getIdByName('home');
                    $this->unregisterHook($old_hook_id);
                }
            }

            $this->_html .= '<div class="conf confirm">' . $this->l('Settings updated') . '</div>';
        }
    }

    public static function getPreferences() {
        if (is_null(self::$pref)) {
            $config = Configuration::get('PSBLOG_BLOCK_CONF');
            $options = self::$default_values;
            if ($config)
                $options = array_merge($options, unserialize(base64_decode($config)));
            self::$pref = $options;
        }
        return self::$pref;
    }

    public function checkServerConf() {
        if (!self::isInstalled('psblog')) {
            $this->warning = $this->l('This module needs Prestablog core module available to work');
            return false;
        }
        return true;
    }

}
<?php

/**
  * Prestablog module
  *
  * @author Appside
  * @copyright Appside
  * @version 1.5
  *
  */

class Psblogcategories extends Module
{	
	private $_html = '';
	private static $pref = null;
	public static $default_values = array("block_categories_position" => "leftColumn");
	
	public function __construct()
	{
		$this->name = 'psblogcategories';
 	 	$this->version = 1.5;
 	 	$this->module_key = "2eb7d51fcd2897494f1d594063c940cc";
 	 	$this->need_instance = 0;
 	 	$this->tab = 'front_office_features';

		parent::__construct();
		
		$this->checkServerConf();
		
                $this->author = 'APPSIDE';
		$this->displayName = $this->l('Prestablog categories block module');
		$this->description = $this->l('Adds a block to display Prestablog categories');
	}
	
	public function install()
	{
		if (parent::install() == false OR $this->registerHook(self::$default_values['block_categories_position']) == false) return false;
		if(!Configuration::updateValue('PSBLOG_CATEGORIES_CONF',base64_encode(serialize(self::$default_values)))) return false;
		return true;		
	}
	
	public function hookLeftColumn($params){	
		
		if(!$this->checkServerConf()) return false;

		require_once(_PS_MODULE_DIR_."psblog/psblog.php");
		require_once(_PS_MODULE_DIR_."psblog/classes/BlogCategory.php");
		
		$pref = array_merge(Psblog::getPreferences(),self::getPreferences());
		
		$list = BlogCategory::listCategories(true,true);
		if($list){
                    $i = 0;
                    foreach($list as $val){
                        $list[$i]['link'] = BlogCategory::linkCategory($val['id_blog_category'],$val['link_rewrite'],$val['id_lang']);
                        $i++;
                    }
		}
		$this->smarty->assign(array('post_categories' => $list,'post_conf' => $pref));
		return $this->display(__FILE__, 'blockcategories.tpl');
	}
	
	public function hookRightColumn($params){
		return $this->hookLeftColumn($params);
	}	
	
	private function _postProcess()
	{
            if (Tools::isSubmit('submitBlockCategories'))
            {
                $pref = $_POST['pref'];
                $old_values = self::getPreferences();
                $new_values = array_merge(self::$default_values,$pref);
                Configuration::updateValue('PSBLOG_CATEGORIES_CONF',base64_encode(serialize($new_values)));
               
                if($new_values['block_categories_position'] != $old_values['block_categories_position']){
                        $old_hook_id = Hook::getIdByName($old_values['block_categories_position']);
                       
                        $this->unregisterHook($old_hook_id);
                        $this->registerHook($new_values['block_categories_position']);
                }
                
                $this->_html .= '<div class="conf confirm">'.$this->l('Settings updated').'</div>';
            }
	}
	
	public function getContent()
	{
		if($this->warning != ''){
                    $this->_html .= '<div style="width:680px;" class="warning bold">'.$this->warning.'</div>';
                    return $this->_html;
		}
		
		$this->_html .= '<h2>'.$this->displayName.'</h2>';
		$this->_html .= '<p>'.$this->l('If you want to add categories, you must go to the blog tab on the navigation menu').'</p>';
		
		if(isset($_POST) && isset($_POST['submitBlockCategories'])){ 
                    $this->_postProcess();    
                }
		
		$this->_displayForm();
		
		return $this->_html;
	}
	
	private function _displayForm()
	{
		$values = (isset($_POST) && isset($_POST['submitBlockCategories'])) ? Tools::getValue('pref') : array_merge(self::$default_values,self::getPreferences());
		
                $this->_html .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
				<fieldset>
				<legend>'.$this->l('Prestablog categories block settings').'</legend>
				
				<label>'.$this->l('Block categories position').'</label> 
				<div class="margin-form">
                                    <select name="pref[block_categories_position]">
                                        <option value="leftColumn" '.($values['block_categories_position'] == "leftColumn" ? "selected" : "").'>'.$this->l('Left').' &nbsp;</option>
                                        <option value="rightColumn" '.($values['block_categories_position'] == "rightColumn" ? "selected" : "").'>'.$this->l('Right').' &nbsp;</option>
                                    </select>
				</div>
				<div class="clear"></div><br />
				
				</fieldset>
				<br />
				<div class="clear"></div>
				<input type="submit" name="submitBlockCategories" value="'.$this->l('Save').'" class="button" />
			</form>';
	}
	
	public static function getPreferences(){
		if(is_null(self::$pref)){
			$config = Configuration::get('PSBLOG_CATEGORIES_CONF');
			$options = self::$default_values;
			if($config) $options = array_merge($options,unserialize(base64_decode($config)));
			self::$pref = $options;
		}
		return self::$pref;
	}
	
	public function checkServerConf()
	{
		if(!self::isInstalled('psblog')){
			$this->warning = $this->l('This module needs Prestablog core module available to work');
			return false;
		}
		return true;
	}
	
}
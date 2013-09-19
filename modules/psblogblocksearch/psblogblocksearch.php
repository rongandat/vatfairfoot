<?php 

/**
  * Prestablog module
  *
  * @author Appside
  * @copyright Appside
  * @version 1.5
  *
  */

class Psblogblocksearch extends Module
{
	private $_html = '';
	private static $pref = null;
	public static $default_values = array("block_search_position" => "leftColumn");
	
	public function __construct()
	{
		$this->name = 'psblogblocksearch';
 	 	$this->version = 1.5;
 	 	$this->module_key = "2eb7d51fcd2897494f1d594063c940cc";
 	 	$this->need_instance = 0;
 	 	$this->tab = 'front_office_features';
 	 	
		parent::__construct();
		
                $this->checkServerConf();
                
                $this->author = 'APPSIDE';
		$this->displayName = $this->l('Prestablog search block module');
		$this->description = $this->l('Adds a block to search in Prestablog articles');
	}
	
	public function install()
	{
		if (parent::install() == false OR !$this->registerHook(self::$default_values['block_search_position'])) return false;
		if(!Configuration::updateValue('PSBLOG_SEARCH_CONF',base64_encode(serialize(self::$default_values)))) return false;
		return true;		
	}
	        
	public function hookLeftColumn($params){
		
		require_once(_PS_MODULE_DIR_."psblog/psblog.php");
		require_once(_PS_MODULE_DIR_."psblog/classes/BlogPost.php");
		
		if(isset($_GET['search']) && trim($_GET['search']) != ''){
                        $search = $_GET['search'];
			$search_nb = BlogPost::searchPosts($search, true, true, true);
			
			$this->smarty->assign('search_query',$search);
			$this->smarty->assign('search_query_nb',$search_nb);
		}
		
                $this->smarty->assign('ENT_QUOTES',ENT_QUOTES);
		$this->smarty->assign('linkPosts', BlogPost::linkList());
		return $this->display(__FILE__, 'blocksearch.tpl');
	}
        
	public function hookRightColumn($params){	
		return $this->hookLeftColumn($params);
	}
        
        public function hookTop($params)
	{
		return $this->hookLeftColumn($params);
	}
	
	private function _postProcess()
	{
		if (Tools::isSubmit('submitBlockSearch'))
		{
			$pref = $_POST['pref'];
			$old_values = self::getPreferences();
			$new_values = array_merge(self::$default_values,$pref);
			Configuration::updateValue('PSBLOG_SEARCH_CONF',base64_encode(serialize($new_values)));
			
			if($new_values['block_search_position'] != $old_values['block_search_position']){
                            $old_hook_id = Hook::getIdByName($old_values['block_search_position']);
                            $this->unregisterHook($old_hook_id);
                            $this->registerHook($new_values['block_search_position']);
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
		if(isset($_POST) && isset($_POST['submitBlockSearch'])){ $this->_postProcess(); }
		$this->_displayForm();
		return $this->_html;
	}
	
	private function _displayForm()
	{
		$values = !empty($_POST) ? Tools::getValue('pref') : array_merge(self::$default_values,self::getPreferences());
		$this->_html .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
				<fieldset>
				<legend>'.$this->l('Prestablog search block settings').'</legend>
				
				<label>'.$this->l('Block search position').'</label> 
				<div class="margin-form">
					<select name="pref[block_search_position]">
						<option value="leftColumn" '.($values['block_search_position'] == "leftColumn" ? "selected" : "").'>'.$this->l('Left').' &nbsp;</option>
						<option value="rightColumn" '.($values['block_search_position'] == "rightColumn" ? "selected" : "").'>'.$this->l('Right').' &nbsp;</option>
					</select>
				</div>
				<div class="clear"></div><br />
				
				</fieldset>
				<br />
				<div class="clear"></div>
				<input type="submit" name="submitBlockSearch" value="'.$this->l('Save').'" class="button" />
			</form>';
	}
	
	public static function getPreferences(){
		if(is_null(self::$pref)){
			$config = Configuration::get('PSBLOG_SEARCH_CONF');
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
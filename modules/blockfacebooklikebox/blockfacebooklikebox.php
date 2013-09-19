<?php
/* THEME CONFIGURATION MODULE - Author : Guillaume Laroche pixmasta.com @glo_www */
	
if (!defined('_PS_VERSION_'))
	exit;

class BlockFacebookLikeBox extends Module{
	
	function __construct(){
		$this->name = 'blockfacebooklikebox';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Pixmasta';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('Facebook Like Box');
		$this->description = $this->l('Display your facebook fan page like box');
	}
	

/*-------------------------------------------------------------*/
/*  INSTALL THE MODULE
/*-------------------------------------------------------------*/
	
	public function install(){
		if (parent::install() && $this->registerHook('displayFooter')){
			Configuration::updateValue('FB_URL', 'http://www.facebook.com/prestashop');
			return true;
		}
		return false;
	}
	
	
/*-------------------------------------------------------------*/
/*  UNINSTALL THE MODULE
/*-------------------------------------------------------------*/	
		
	public function uninstall(){
		if (parent::uninstall()){
			Configuration::deleteByName('FB_URL');
			return true;
		}
		return false;
	}
		
/*-------------------------------------------------------------*/
/*  MODUL INITIALIZE & FORM SUBMIT CHECKs
/*-------------------------------------------------------------*/	
	
		
	public function getContent(){
		
		if (Tools::isSubmit('submitfacebookLikeBox'))
		{
				   
			if (Tools::isSubmit('fb-url')){
				Configuration::updateValue('FB_URL', Tools::getValue('fb-url'));
			} else {
				$this->displayError($this->l('The URL you entered was not valid, sorry'));
			}
		}
			   
		return $this->displayForm();
	}
		
/*-------------------------------------------------------------*/
/*  DISPLAY CONFIGURATION FORM
/*-------------------------------------------------------------*/	
				
	public function displayForm(){
			
		$fburl = Configuration::get('FB_URL');
		
		$this->output = '<h2>'.$this->displayName.'</h2>
		
		<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
				
			<fieldset class="nice-layout"><legend>'.$this->l('Theme Options').'</legend>
						
				<label for="fb-url">'.$this->l('Facebook Page Url').'</label>
				<div class="margin-form">
					<input id="fb-url" size="60" type="text" name="fb-url" value="'.$fburl.'"/>
					<p class="clear">'.$this->l('The URL of the Facebook Page for this like box').'</p>
				</div>

				<p><input type="submit" name="submitfacebookLikeBox" value="'.$this->l('Update').'" class="button" /></p>
			</fieldset>
		</form>';
		return $this->output;
	}
		
		
/*-------------------------------------------------------------*/
/*  PREPARE FOR HOOK
/*-------------------------------------------------------------*/		  

	private function _prepareHook(){
		
		if ((Configuration::get('FB_URL') != '')) {
			$this->smarty->assign('fb_url', Configuration::get('FB_URL'));
		}

		return true;
	}

/*-------------------------------------------------------------*/
/*  HOOK (displayFooter)
/*-------------------------------------------------------------*/
		
		public function hookDisplayFooter (){
			if(!$this->_prepareHook())
				return;

			return $this->display(__FILE__, 'blockfacebooklikebox.tpl');
		}
		
}
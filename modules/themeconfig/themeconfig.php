<?php
/* THEME CONFIGURATION MODULE - Author : Guillaume Laroche @glo_www pixmasta.com */
    
if (!defined('_PS_VERSION_'))
	exit;

class ThemeConfig extends Module{
    
    function __construct(){
        $this->name = 'themeconfig';
        $this->tab = 'front_office_features';
        $this->version = '1.2';
        $this->author = 'Guillaume LAROCHE';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('01PREMIUM theme configuration');
        $this->description = $this->l('Required by 01PREMIUM theme');
    }
    

/*-------------------------------------------------------------*/
/*  INSTALL THE MODULE
/*-------------------------------------------------------------*/
    
    public function install(){
        if (parent::install() && $this->registerHook('displayHeader')){
            $response  = Configuration::updateValue('BG_COLOR', 'ffffff');
            $response  = Configuration::updateValue('BG_BLOC', 'f0f0f0');
            $response &= Configuration::updateValue('TXT_COLOR', '333333');
            $response &= Configuration::updateValue('A_COLOR', '333333');
            $response &= Configuration::updateValue('A_HOVER_COLOR', '000000');
            $response &= Configuration::updateValue('MAIN_COLOR', '333333');
            $response &= Configuration::updateValue('BT_COLOR', '6794AA');
            $response &= Configuration::updateValue('BT_HOVER_COLOR', '2b5a70');
            $response &= Configuration::updateValue('VIEW', 'list');
            $response &= Configuration::updateValue('SIDEBAR_POSITION', 'right');
            $response &= Configuration::updateValue('PRODUCT_VIEW_HP', 'default');
            return $response;
        }
        return false;
    }
    
    
/*-------------------------------------------------------------*/
/*  UNINSTALL THE MODULE
/*-------------------------------------------------------------*/    
    
    public function uninstall(){
        if (parent::uninstall()){
            $response  = Configuration::deleteByName('BG_COLOR');
            $response  = Configuration::deleteByName('BG_BLOC');
            $response &= Configuration::deleteByName('TXT_COLOR');
            $response &= Configuration::deleteByName('A_COLOR');
            $response &= Configuration::deleteByName('A_HOVER_COLOR');
            $response &= Configuration::deleteByName('MAIN_COLOR');
            $response &= Configuration::deleteByName('BT_COLOR');
            $response &= Configuration::deleteByName('BT_HOVER_COLOR');
            $response &= Configuration::deleteByName('VIEW');
            $response &= Configuration::deleteByName('SIDEBAR_POSITION');
            $response &= Configuration::deleteByName('PRODUCT_VIEW_HP');
            return $response;
        }
        return false;
    }
        
/*-------------------------------------------------------------*/
/*  MODUL INITIALIZE & FORM SUBMIT CHECKs
/*-------------------------------------------------------------*/    
    
        
    public function getContent(){
        
		if (Tools::isSubmit('submitthemeConfigurationOptions'))
		{
                   
                    if (Tools::isSubmit('bg-color')){
                        if (Validate::isColor(Tools::getValue('bg-color'))){
                            Configuration::updateValue('BG_COLOR', Tools::getValue('bg-color'));
                        }else{
                            $this->displayError($this->l('Please enter a valid color code (hex)'));
                        }
                    }

                    if (Tools::isSubmit('bg-bloc')){
                        if (Validate::isColor(Tools::getValue('bg-bloc'))){
                            Configuration::updateValue('BG_BLOC', Tools::getValue('bg-bloc'));
                        }else{
                            $this->displayError($this->l('Please enter a valid color code (hex)'));
                        }
                    }

                    if (Tools::isSubmit('txt-color')){
                        if (Validate::isColor(Tools::getValue('txt-color'))){
                            Configuration::updateValue('TXT_COLOR', Tools::getValue('txt-color'));
                        }else{
                            $this->displayError($this->l('Please enter a valid color code (hex)'));
                        }
                    }

                    if (Tools::isSubmit('a-color')){
                        if (Validate::isColor(Tools::getValue('a-color'))){
                            Configuration::updateValue('A_COLOR', Tools::getValue('a-color'));
                        }else{
                            $this->displayError($this->l('Please enter a valid color code (hex)'));
                        }
                    }

                    if (Tools::isSubmit('a-hover-color')){
                        if (Validate::isColor(Tools::getValue('a-hover-color'))){
                            Configuration::updateValue('A_HOVER_COLOR', Tools::getValue('a-hover-color'));
                        }else{
                            $this->displayError($this->l('Please enter a valid color code (hex)'));
                        }
                    }

                    if (Tools::isSubmit('color-scheme')){
                        if (Validate::isColor(Tools::getValue('color-scheme'))){
                            Configuration::updateValue('MAIN_COLOR', Tools::getValue('color-scheme'));
                        }else{
                            $this->displayError($this->l('Please enter a valid color code (hex)'));
                        }
                    }
                    
                    if (Tools::isSubmit('button-color')){
                        if (Validate::isColor(Tools::getValue('button-color'))){
                            Configuration::updateValue('BT_COLOR', Tools::getValue('button-color'));
                        }else{
                            $this->displayError($this->l('Please enter a valid color code (hex)'));
                        }
                    }
                    
                    if (Tools::isSubmit('button-hover-color')){
                        if (Validate::isColor(Tools::getValue('button-hover-color'))){
                            Configuration::updateValue('BT_HOVER_COLOR', Tools::getValue('button-hover-color'));
                        }else{
                            $this->displayError($this->l('Please enter a valid color code (hex)'));
                        }
                    }
                    if (Tools::isSubmit('view')){
                        Configuration::updateValue('VIEW', Tools::getValue('view'));
                    }

                    if (Tools::isSubmit('sidebar')){
                        Configuration::updateValue('SIDEBAR_POSITION', Tools::getValue('sidebar'));
                    }

                    if (Tools::isSubmit('product-view-hp')){
                        Configuration::updateValue('PRODUCT_VIEW_HP', Tools::getValue('product-view-hp'));
                    }
                }
               
                return $this->displayForm();
        }
        
/*-------------------------------------------------------------*/
/*  DISPLAY CONFIGURATION FORM
/*-------------------------------------------------------------*/    
                
	public function displayForm(){
            
            $bgcolor = Configuration::get('BG_COLOR');
            $bgbloc = Configuration::get('BG_BLOC');
            $txtcolor = Configuration::get('TXT_COLOR');
            $acolor = Configuration::get('A_COLOR');
            $ahcolor = Configuration::get('A_HOVER_COLOR');
            $color = Configuration::get('MAIN_COLOR');
            $bcolor = Configuration::get('BT_COLOR');
            $bhcolor = Configuration::get('BT_HOVER_COLOR');
            $view = Configuration::get('VIEW');
            $sidebar = Configuration::get('SIDEBAR_POSITION');
            $productviewhp = Configuration::get('PRODUCT_VIEW_HP');

            $checked_grid = ($view=='grid') ? 'checked="checked"' : '';
            $checked_list = ($view=='grid') ? '' : 'checked="checked"';
            $checked_default = ($productviewhp=='default') ? 'checked="checked"' : '';
            $checked_alternate = ($productviewhp=='alternate') ? 'checked="checked"' : '';
            $checked_alternate2 = ($productviewhp=='alternate2') ? 'checked="checked"' : '';
            $checked_left = ($sidebar=='left') ? 'checked="checked"' : '';
            $checked_right = ($sidebar=='right') ? 'checked="checked"' : '';
            $checked_nosidebar = ($sidebar=='nosidebar') ? 'checked="checked"' : '';
            
            $this->output = '<h2>'.$this->displayName.'</h2>
                <link rel="stylesheet" href="'.$this->_path.'assets/css/colorpicker.css" type="text/css" />

                <script type="text/javascript" src="'.$this->_path.'assets/js/colorpicker.js"></script>
                <script type="text/javascript" src="'.$this->_path.'assets/js/eye.js"></script>
                <script type="text/javascript" src="'.$this->_path.'assets/js/utils.js"></script>
                
                <script type="text/javascript">
                $(document).ready(function(){
                
                    $(".color_container").ColorPicker({
                        onSubmit: function(hsb, hex, rgb, el) {
                            $(el).children("input[type=text]").val(hex);
                            $(el).ColorPickerHide();
                            $(el).children(".color_preview").css("background-color", "#" + hex);  
                        },
                        onBeforeShow: function () {
                            $(this).ColorPickerSetColor($(this).children("input[type=text]").val());
                            $(this).children(".color_preview").css("background-color", "#" + this.value);
                        }
                        })
                        .children("input[type=text]").bind("keyup", function(){
                            $(this).parent(".color_container").ColorPickerSetColor($(this).val());
                            $(this).siblings(".color_preview").css("background-color", "#" + $(this).val());
                    });                   

                });
                </script>

                <style type="text/css">
                    
                    div.element-wrapper{
                        display:block;
                        clear:both;
                        float:left;
                        overflow:hidden;
                        margin-bottom:10px;
                    }
                    
                    label.element-title{
                        display:block;
                        float:left;
                        overflow:hidden;
                        padding:7px 0;
                        margin: 0 20px 0 0;
                        width:220px;
                    }
                    
                    div.element-options{
                        display:block;
                        float:left;
                    }
                    div.element-options label {
                        display:inline-block;
                        float:none;
                        width:auto;
                        margin-right: 10px;
                        padding:7px 0;
                    }
                    
                    span.field-value-type{
                        float:left;
                        margin:16px 0 0 5px;
                    }

                    .element-options input[type=text] {
                        padding:7px 10px;
                        margin-top:0;
                        float:left;
                        display:block;
                    }
                    
                   .color_preview {
                        display:block;
                        width:30px;
                        height:30px;
                        margin:0 0 0 5px;
                        float:left;
                    }
                        
                    .helper{
                        font-size:10px;
                        padding-top:5px;
                        display:block;
                        clear:both;
                    }

                    .color_container {
                        float:left;
                    }
                    
                </style>
                <form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
                    
			<fieldset class="nice-layout"><legend>'.$this->l('Theme Options').'</legend>
                            
                            
                            <div class="element-wrapper">
                                <label class="element-title" for="bg-color">'.$this->l('Background color:').'</label>
                                <div class="element-options">
                                    <div class="color_container">
                                        <input type="text" name="bg-color" id="bg-color" value="'.$bgcolor.'" />
                                        <div style="background-color:#'.$bgcolor.';" class="color_preview"></div>
                                    </div>
                                    <p class="helper">'.$this->l('Default:').' ffffff</p>
                                </div>
                            </div>

                            <div class="element-wrapper">
                                <label class="element-title" for="bg-bloc">'.$this->l('Bloc background color (sidebar):').'</label>
                                <div class="element-options">
                                    <div class="color_container">
                                        <input type="text" name="bg-bloc" id="bg-bloc" value="'.$bgbloc.'" />
                                        <div style="background-color:#'.$bgbloc.';" class="color_preview"></div>
                                    </div>
                                    <p class="helper">'.$this->l('Default:').' EBE8E8</p>
                                </div>
                            </div>

                            <div class="element-wrapper">
                                <label class="element-title" for="txt-color">'.$this->l('Text color:').'</label>
                                <div class="element-options">
                                    <div class="color_container">
                                        <input type="text" name="txt-color" id="txt-color" value="'.$txtcolor.'" />
                                        <div style="background-color:#'.$txtcolor.';" class="color_preview"></div>
                                    </div>
                                    <p class="helper">'.$this->l('Default:').' 333333</p>
                                </div>
                            </div>

                            <div class="element-wrapper">
                                <label class="element-title" for="a-color">'.$this->l('Link color:').'</label>
                                <div class="element-options">
                                    <div class="color_container">
                                        <input type="text" name="a-color" id="a-color" value="'.$txtcolor.'" />
                                        <div style="background-color:#'.$acolor.';" class="color_preview"></div>
                                    </div>
                                    <p class="helper">'.$this->l('Default:').' 333333</p>
                                </div>
                            </div>

                            <div class="element-wrapper">
                                <label class="element-title" for="a-hover-color">'.$this->l('Link hover color:').'</label>
                                <div class="element-options">
                                    <div class="color_container">
                                        <input type="text" name="a-hover-color" id="a-hover-color" value="'.$txtcolor.'" />
                                        <div style="background-color:#'.$ahcolor.';" class="color_preview"></div>
                                    </div>
                                    <p class="helper">'.$this->l('Default:').' 000000</p>
                                </div>
                            </div>

                            <div class="element-wrapper">
                                <label class="element-title" for="color-scheme">'.$this->l('Color Scheme:').'</label>
                                <div class="element-options">
                                    <div class="color_container">
                                        <input type="text" name="color-scheme" id="color-scheme" value="'.$color.'" />
                                        <div style="background-color:#'.$color.';" class="color_preview"></div>
                                    </div>
                                    <p class="helper">'.$this->l('Default:').' 333333</p>
                                </div>
                            </div>        
                            
                            <div class="element-wrapper">
                                <label class="element-title" for="button-color">'.$this->l('Button Color:').'</label>
                                <div class="element-options">                                
                                    <div class="color_container">
                                        <input type="text" name="button-color" id="button-color" value="'.$bcolor.'" />
                                        <div style="background-color:#'.$bcolor.';" class="color_preview"></div>
                                    </div>
                                    <p class="helper">'.$this->l('Default:').' 6794AA</p>
                                </div>
                            </div>       
                            
                            <div class="element-wrapper">
                                <label class="element-title" for="button-hover-color">'.$this->l('Button Hover Color:').'</label>
                                <div class="element-options">                                
                                    <div class="color_container">
                                        <input type="text" name="button-hover-color" id="button-hover-color" value="'.$bhcolor.'" />
                                        <div style="background-color:#'.$bhcolor.';" class="color_preview"></div>
                                    </div>
                                    <p class="helper">'.$this->l('Default:').' 2b5a70</p>
                                </div>
                            </div>

                            <div class="element-wrapper">
                                <label class="element-title">'.$this->l('Default view on category page:').'</label>
                                <div class="element-options">
                                    <label><input type="radio" name="view" value="list" '.$checked_list.' /> '.$this->l('List').'</label>
                                    <label><input type="radio" name="view" value="grid" '.$checked_grid.' /> '.$this->l('Grid').'</label>
                                </div>
                            </div>

                            <div class="element-wrapper">
                                <label class="element-title">'.$this->l('Sidebar position:').'</label>
                                <div class="element-options">
                                    <label><input type="radio" name="sidebar" value="left" '.$checked_left.' /> '.$this->l('Left').'</label>
                                    <label><input type="radio" name="sidebar" value="right" '.$checked_right.' /> '.$this->l('Right').'</label>
                                    <label><input type="radio" name="sidebar" value="nosidebar" '.$checked_nosidebar.' /> '.$this->l('No Sidebar').'</label>
                                </div>
                            </div>

                            <div class="element-wrapper">
                                <label class="element-title">'.$this->l('Product display on homepage:').'</label>
                                <div class="element-options">
                                    <label><input type="radio" name="product-view-hp" value="default" '.$checked_default.' /> '.$this->l('Default').'</label>
                                    <label><input type="radio" name="product-view-hp" value="alternate" '.$checked_alternate.' /> '.$this->l('Alternate').'</label>
                                    <label><input type="radio" name="product-view-hp" value="alternate2" '.$checked_alternate2.' /> '.$this->l('Alternate bis').'</label>
                                </div>
                            </div>

                            <p style="clear:both; padding-left:240px;">
                                <input style="padding:5px 10px; cursor:pointer;" type="submit" name="submitthemeConfigurationOptions" value="'.$this->l('Save').'" class="button" /></center>
                            </p>
                        </fieldset>
                        
                        <br />
                ';
            return $this->output;
            
        }
        
        
/*-------------------------------------------------------------*/
/*  PREPARE FOR HOOK
/*-------------------------------------------------------------*/          

    private function _prepareHook(){
        
        if ((Configuration::get('TXT_COLOR') != '333333') || (Configuration::get('A_COLOR') != '333333') || (Configuration::get('A_HOVER_COLOR') != '000000') ||  (Configuration::get('BG_COLOR') != 'ffffff') || (Configuration::get('MAIN_COLOR') != '333333') || (Configuration::get('BT_COLOR') != '6794AA') || (Configuration::get('BT_HOVER_COLOR') != '2b5a70')){
            $this->smarty->assign('theme_bgcolor', Configuration::get('BG_COLOR'));
            $this->smarty->assign('theme_bgbloc', Configuration::get('BG_BLOC'));
            $this->smarty->assign('theme_txtcolor', Configuration::get('TXT_COLOR'));
            $this->smarty->assign('theme_acolor', Configuration::get('A_COLOR'));
            $this->smarty->assign('theme_ahcolor', Configuration::get('A_HOVER_COLOR'));
            $this->smarty->assign('theme_color1', Configuration::get('MAIN_COLOR'));
            $this->smarty->assign('theme_color2', Configuration::get('BT_COLOR'));
            $this->smarty->assign('theme_color3', Configuration::get('BT_HOVER_COLOR'));
            $this->smarty->assign('sidebar_position', Configuration::get('SIDEBAR_POSITION'));
            $this->smarty->assignGlobal('product_view_hp', Configuration::get('PRODUCT_VIEW_HP'));
        }

        if (isset($_COOKIE['category_view']) && $_COOKIE['category_view'] != '') {
            $this->smarty->assignGlobal('category_view', $_COOKIE['category_view']);
        } else {
            $this->smarty->assignGlobal('category_view', Configuration::get('VIEW'));
        }

        return true;
    }

/*-------------------------------------------------------------*/
/*  HOOK (displayTop)
/*-------------------------------------------------------------*/
        
        public function hookDisplayHeader (){
            if(!$this->_prepareHook())
                return;

            //Load custom JS files
            $this->context->controller->addJS(_THEME_JS_DIR_.'html5.js');
            $this->context->controller->addJqueryPlugin('placeholder-enhanced.min', _THEME_JS_DIR_);
            $this->context->controller->addJqueryPlugin('jcarousel.min', _THEME_JS_DIR_);
            $this->context->controller->addJqueryPlugin('cookie', _THEME_JS_DIR_);
            $this->context->controller->addJqueryPlugin('flexslider-min', _THEME_JS_DIR_);
            $this->context->controller->addJqueryPlugin('touchwipe.min', _THEME_JS_DIR_);
            $this->context->controller->addJS(_THEME_JS_DIR_.'common.js');

            //Load custom CSS file
            $this->context->controller->addCSS(_THEME_CSS_DIR_.'custom.css');

            return $this->display(__FILE__, 'themeconfig.tpl');
        }
        
}
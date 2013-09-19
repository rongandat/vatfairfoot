<?php /* Smarty version Smarty-3.1.14, created on 2013-09-13 04:20:31
         compiled from "/home/precya/public_html/vatfairfoot/modules/psblog/views/templates/admin/_configure/form_blog_post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1950522693522d7fa29f7ad3-25187338%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6731d53a65f545a080b77918147021c208d23719' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/modules/psblog/views/templates/admin/_configure/form_blog_post.tpl',
      1 => 1378756824,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1950522693522d7fa29f7ad3-25187338',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_522d7fa2b79057_71860056',
  'variables' => 
  array (
    'show_toolbar' => 0,
    'toolbar_btn' => 0,
    'toolbar_scroll' => 0,
    'title' => 0,
    'form_content' => 0,
    'iso' => 0,
    'ad' => 0,
    'defaultFormLanguage' => 0,
    'languages' => 0,
    'k' => 0,
    'language' => 0,
    'allowEmployeeFormLang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522d7fa2b79057_71860056')) {function content_522d7fa2b79057_71860056($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['show_toolbar']->value){?>
        <?php echo $_smarty_tpl->getSubTemplate ("toolbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('toolbar_btn'=>$_smarty_tpl->tpl_vars['toolbar_btn']->value,'toolbar_scroll'=>$_smarty_tpl->tpl_vars['toolbar_scroll']->value,'title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>

        <div class="leadin"></div>
<?php }?>

<?php echo $_smarty_tpl->tpl_vars['form_content']->value;?>


<script type="text/javascript">

var iso = '<?php echo $_smarty_tpl->tpl_vars['iso']->value;?>
';
var pathCSS = '<?php echo @constant('_THEME_CSS_DIR_');?>
';
var ad = '<?php echo $_smarty_tpl->tpl_vars['ad']->value;?>
';

$(document).ready(function(){

        
                tinySetup({
                    editor_selector :"autoload_rte",
                    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull|cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,undo,redo",
                    theme_advanced_buttons2 : "link,unlink,anchor,image,cleanup,code,|,forecolor,backcolor,|,hr,removeformat,visualaid,|,charmap,media,|,ltr,rtl,|,fullscreen",
                    theme_advanced_buttons3 : "",
                    theme_advanced_buttons4 : ""
                });
        
        
    var lang_remove = '&nbsp;&nbsp; <img src="../img/admin/disabled.gif" height="16" width="16" alt="x"/>';
    var lang_denied = '<?php echo smartyTranslate(array('s'=>'You cannot select a'),$_smarty_tpl);?>
 $ext <?php echo smartyTranslate(array('s'=>'file, try again with another type..'),$_smarty_tpl);?>
';
    
    $('#blog_img').MultiFile({ STRING: { remove: lang_remove, denied: lang_denied }, list:'#blog-img-list'}); 
    
    if($('#divAccessories').length){
        initAccessoriesAutocomplete();
        $('#divAccessories').delegate('.delAccessory', 'click', function(){ delAccessory($(this).attr('name')); });
    }
    
    if ($(".datepicker").length > 0){
           $(".datepicker").datepicker({ prevText: '', nextText: '', dateFormat: 'yy-mm-dd'});
       }
});
</script>

<script type="text/javascript">
    var module_dir = '<?php echo @constant('_MODULE_DIR_');?>
';
    var id_language = <?php echo $_smarty_tpl->tpl_vars['defaultFormLanguage']->value;?>
;
    var languages = new Array();
    
    // Multilang field setup must happen before document is ready so that calls to displayFlags() to avoid
    // precedence conflicts with other document.ready() blocks
    <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['language']->key;
?>
            languages[<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
] = {
                    id_lang: <?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
,
                    iso_code: '<?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>
',
                    name: '<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
',
                    is_default: '<?php echo $_smarty_tpl->tpl_vars['language']->value['is_default'];?>
'
            };
    <?php } ?>
    // we need allowEmployeeFormLang var in ajax request
    allowEmployeeFormLang = <?php echo $_smarty_tpl->tpl_vars['allowEmployeeFormLang']->value;?>
;
    displayFlags(languages, id_language, allowEmployeeFormLang);
</script><?php }} ?>
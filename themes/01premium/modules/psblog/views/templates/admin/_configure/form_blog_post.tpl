{if $show_toolbar}
        {include file="toolbar.tpl" toolbar_btn=$toolbar_btn toolbar_scroll=$toolbar_scroll title=$title}
        <div class="leadin">{block name="leadin"}{/block}</div>
{/if}

{$form_content}

<script type="text/javascript">

var iso = '{$iso}';
var pathCSS = '{$smarty.const._THEME_CSS_DIR_}';
var ad = '{$ad}';

$(document).ready(function(){

        {block name="autoload_tinyMCE"}
                tinySetup({
                    editor_selector :"autoload_rte",
                    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull|cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,undo,redo",
                    theme_advanced_buttons2 : "link,unlink,anchor,image,cleanup,code,|,forecolor,backcolor,|,hr,removeformat,visualaid,|,charmap,media,|,ltr,rtl,|,fullscreen",
                    theme_advanced_buttons3 : "",
                    theme_advanced_buttons4 : ""
                });
        {/block}
        
    var lang_remove = '&nbsp;&nbsp; <img src="../img/admin/disabled.gif" height="16" width="16" alt="x"/>';
    var lang_denied = '{l s='You cannot select a'} $ext {l s='file, try again with another type..'}';
    
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
    var module_dir = '{$smarty.const._MODULE_DIR_}';
    var id_language = {$defaultFormLanguage};
    var languages = new Array();
    
    // Multilang field setup must happen before document is ready so that calls to displayFlags() to avoid
    // precedence conflicts with other document.ready() blocks
    {foreach $languages as $k => $language}
            languages[{$k}] = {
                    id_lang: {$language.id_lang},
                    iso_code: '{$language.iso_code}',
                    name: '{$language.name}',
                    is_default: '{$language.is_default}'
            };
    {/foreach}
    // we need allowEmployeeFormLang var in ajax request
    allowEmployeeFormLang = {$allowEmployeeFormLang};
    displayFlags(languages, id_language, allowEmployeeFormLang);
</script>
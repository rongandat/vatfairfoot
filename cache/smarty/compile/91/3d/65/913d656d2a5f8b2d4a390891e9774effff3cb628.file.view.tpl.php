<?php /* Smarty version Smarty-3.1.14, created on 2013-09-24 00:17:26
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\psnews\views\templates\front\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126552411256481863-33625697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '913d656d2a5f8b2d4a390891e9774effff3cb628' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\psnews\\views\\templates\\front\\view.tpl',
      1 => 1379903539,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126552411256481863-33625697',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir' => 0,
    'listLink' => 0,
    'news' => 0,
    'img_path' => 0,
    'HOOK_NEWS_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5241125650e283_60824577',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5241125650e283_60824577')) {function content_5241125650e283_60824577($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
?><div class="breadcrumb">
    <a title="<?php echo smartyTranslate(array('s'=>'Back home','mod'=>'psnews'),$_smarty_tpl);?>
" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
"><?php echo smartyTranslate(array('s'=>'Home','mod'=>'psnews'),$_smarty_tpl);?>
</a><span class="navigation-pipe">&gt;</span><span class="navigation_end"><a href="<?php echo $_smarty_tpl->tpl_vars['listLink']->value;?>
"><?php echo smartyTranslate(array('s'=>'Blog','mod'=>'psnews'),$_smarty_tpl);?>
</a></span><?php if ($_smarty_tpl->tpl_vars['news']->value->active==1){?> &gt; <?php echo $_smarty_tpl->tpl_vars['news']->value->name;?>
 <?php }?>
</div>
<?php if ($_smarty_tpl->tpl_vars['news']->value->active==1){?>


<div id="primary_block" class="clearfix">
    <div id="pb-right-column">
        <?php if ($_smarty_tpl->tpl_vars['news']->value->youtube_id!=''){?>
        <a href="http://www.youtube.com/embed/<?php echo $_smarty_tpl->tpl_vars['news']->value->youtube_id;?>
?autoplay=1" class="various fancybox.iframe" title="<?php echo $_smarty_tpl->tpl_vars['news']->value->name;?>
" >
            <?php }else{ ?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['news']->value->id_news, 'htmlall', 'UTF-8');?>
-large_01prem.jpg" rel="other-views" class="single_photo" title="<?php echo $_smarty_tpl->tpl_vars['news']->value->name;?>
" >  
                <?php }?>
                <div id="image-block">
                    <span id="view_full_size">
                        <img id="bigpic" alt="<?php echo $_smarty_tpl->tpl_vars['news']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['news']->value->name;?>
" src="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['news']->value->id_news, 'htmlall', 'UTF-8');?>
-large_01prem.jpg" style="display: inline;">
                        <span class="span_link_container"><span class="span_link">View full size</span></span>
                    </span>
                </div>
            </a>
    </div>
    <div id="pb-left-column">
        <h1><?php echo $_smarty_tpl->tpl_vars['news']->value->name;?>
</h1>
        <div id="short_description_block">
            <?php echo $_smarty_tpl->tpl_vars['news']->value->description;?>

        </div>
    </div>
    <div class="clear"></div>
    <?php if (isset($_smarty_tpl->tpl_vars['HOOK_NEWS_FOOTER']->value)&&$_smarty_tpl->tpl_vars['HOOK_NEWS_FOOTER']->value){?><?php echo $_smarty_tpl->tpl_vars['HOOK_NEWS_FOOTER']->value;?>
<?php }?>
</div>

<?php }else{ ?>

<p class="warning"><?php echo smartyTranslate(array('s'=>'This post is not available','mod'=>'psnews'),$_smarty_tpl);?>
</p>

<?php }?>    

<script>

    $(".various").fancybox({
        maxWidth: 800,
        maxHeight: 600,
        fitToView: false,
        width: '70%',
        height: '70%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none',
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        },
        
    });

    $(".single_photo").fancybox({
        openEffect: 'elastic',
        closeEffect: 'elastic',
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        },
        
    });
</script><?php }} ?>
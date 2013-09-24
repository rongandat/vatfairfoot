<?php /* Smarty version Smarty-3.1.14, created on 2013-09-24 04:13:25
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\myvideo\views\templates\front\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1321152413969ab0306-77276025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08bf5c20e5a92399b2eec1bb5835d0235a186bbf' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\myvideo\\views\\templates\\front\\list.tpl',
      1 => 1380010401,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1321152413969ab0306-77276025',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52413969b44a39_43884845',
  'variables' => 
  array (
    'list_categories' => 0,
    'i' => 0,
    'category' => 0,
    'video' => 0,
    'img_video_dir' => 0,
    'base_dir' => 0,
    'customer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52413969b44a39_43884845')) {function content_52413969b44a39_43884845($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
?><style>
    .fancybox-title{
    font-weight: bold;
    font-size: 14px;
    padding-bottom: 10px;
}
.fancybox-title .video_des{
    font-style: italic;
    font-size: 12px;
}
</style>
<link href="./js/jquery/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="./js/jquery/plugins/fancybox/jquery.fancybox.js"></script>
<?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable("0", null, 0);?>
<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list_categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
<?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
<?php if (count($_smarty_tpl->tpl_vars['category']->value['videos'])>0){?>
<div class="jcarousel-container jcarousel-container-horizontal" style="padding-top: 20px;">
    <h1 style="display: block;"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</h1>
    <ul class="product_list jq_carousel_home">
        <?php  $_smarty_tpl->tpl_vars['video'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['video']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value['videos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['video']->key => $_smarty_tpl->tpl_vars['video']->value){
$_smarty_tpl->tpl_vars['video']->_loop = true;
?>
        <li class="ajax_block_product">
            <a href="http://www.youtube.com/embed/<?php echo $_smarty_tpl->tpl_vars['video']->value['youtube_id'];?>
?autoplay=1" content="<?php echo $_smarty_tpl->tpl_vars['video']->value['id_video'];?>
" class="various fancybox.iframe" title="<?php echo $_smarty_tpl->tpl_vars['video']->value['title'];?>
" my_title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['video']->value['description'], 'htmlall', 'UTF-8');?>
">
                <div class="content">
                    <h2 class="title"><?php echo $_smarty_tpl->tpl_vars['video']->value['title'];?>
</h2><br />
                    <input type="hidden" id="average<?php echo $_smarty_tpl->tpl_vars['video']->value['id_video'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['video']->value['average'];?>
"/>
                </div>
                <div class="image">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['img_video_dir']->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['video']->value['id_video'], 'htmlall', 'UTF-8');?>
-home_01prem.jpg" alt="" />
                </div>	
            </a>
        </li>
        <?php } ?>
    </ul>
</div>
<?php }?>
<script>
    $(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
        helpers : {
        title: {
            type: 'inside',
            position: 'top'
            }
        },
        beforeShow: function () {
            if (this.title) {
                var id_video = $(this.element).attr("content");
                // New line
                this.title += '<br />';
                this.title += '<div class="video_des"> ' + $(this.element).attr("my_title") + '</div><br />';
                this.title += '<div class="exemple4" data-average="' + $('#average' + id_video).val() + '<" data-id="' + id_video + '"></div><br />';
                // Add FaceBook like button
                this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="true"></iframe>';
            }
        },
        afterShow: function() {
            $('.exemple4').jRating({
                bigStarsPath: 'jRating/jquery/icons/stars.png', // path of the icon stars.png
                smallStarsPath: 'jRating/jquery/icons/small.png', // path of the icon small.png
                rateMax: 10, // maximal rate - integer from 0 to 9999 (or more)
                phpPath: '<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
?fc=module&module=myvideo&controller=ratting', // path of the php file jRating.php
                type: 'big', // can be set to 'small' or 'big'
                onSuccess: function() {
                    alert('Success : your rate has been saved');
                },
                onError: function() {
                    <?php if (empty($_smarty_tpl->tpl_vars['customer']->value)){?>
                    alert('Error : you haven\'t yet login');
                    <?php }else{ ?>
                    alert('Error : you have rated for image');
                    <?php }?>
                }
            });
        }
    });
</script>
<?php } ?>
<?php }} ?>
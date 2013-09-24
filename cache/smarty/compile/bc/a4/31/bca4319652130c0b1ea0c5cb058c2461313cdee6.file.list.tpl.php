<?php /* Smarty version Smarty-3.1.14, created on 2013-09-24 03:57:47
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\myphotos\views\templates\front\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1255752401a157d77a5-10741240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bca4319652130c0b1ea0c5cb058c2461313cdee6' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\myphotos\\views\\templates\\front\\list.tpl',
      1 => 1380009464,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1255752401a157d77a5-10741240',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52401a158259c7_49517210',
  'variables' => 
  array (
    'list_categories' => 0,
    'i' => 0,
    'category' => 0,
    'img_photo_dir' => 0,
    'photo' => 0,
    'base_dir' => 0,
    'customer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52401a158259c7_49517210')) {function content_52401a158259c7_49517210($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
?><style>
    .fancybox-title{
        font-weight: bold;
        font-size: 14px;
        padding-bottom: 10px;
    }
    .fancybox-title .photo_des{
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
<?php if (count($_smarty_tpl->tpl_vars['category']->value['photos'])>0){?>
<div class="jcarousel-container jcarousel-container-horizontal" style="padding-top: 20px;">
    <h1 style="display: block;"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</h1>
    <ul class="product_list jq_carousel_home">
        <?php  $_smarty_tpl->tpl_vars['photo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['photo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['photo']->key => $_smarty_tpl->tpl_vars['photo']->value){
$_smarty_tpl->tpl_vars['photo']->_loop = true;
?>
        <li class="ajax_block_product">
            <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>
<?php echo $_smarty_tpl->tpl_vars['img_photo_dir']->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['photo']->value['id_photo'], 'htmlall', 'UTF-8');?>
.jpg" rel="other-views" content="<?php echo $_smarty_tpl->tpl_vars['photo']->value['id_photo'];?>
" class="thickbox<?php echo $_smarty_tpl->tpl_vars['category']->value['id_photo_cat'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['photo']->value['title'];?>
">
                <div class="content">
                    <h2 class="title"><?php echo $_smarty_tpl->tpl_vars['photo']->value['title'];?>
</h2><br />
                    <textarea style="display: none" id="photo_des<?php echo $_smarty_tpl->tpl_vars['photo']->value['id_photo'];?>
"><?php echo $_smarty_tpl->tpl_vars['photo']->value['description'];?>
</textarea>
                    <input type="hidden" id="average<?php echo $_smarty_tpl->tpl_vars['photo']->value['id_photo'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['photo']->value['average'];?>
"/>
                </div>
                <div class="image">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['img_photo_dir']->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['photo']->value['id_photo'], 'htmlall', 'UTF-8');?>
-home_01prem.jpg" alt="" />
                </div>	
            </a>
        </li>
        <?php } ?>
    </ul>
</div>
<?php }?>
<script>

    var cat_id = '<?php echo $_smarty_tpl->tpl_vars['category']->value['id_photo_cat'];?>
';
    $('.thickbox' + cat_id).fancybox({
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 600,
        'speedOut': 200,
        'overlayShow': false,
        'cyclic': true,
        'showNavArrows': true,
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        },
        beforeShow: function() {
            if (this.title) {
                // New line
                var id_photo = $(this.element).attr("content");
                this.title += '<br />';
                this.title += '<div class="photo_des">' + $('#photo_des' + id_photo).val() + '</div><br />';
                this.title += '<div class="exemple4" data-average="' + $('#average' + id_photo).val() + '<" data-id="' + id_photo + '"></div><br />';
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
?fc=module&module=myphotos&controller=ratting', // path of the php file jRating.php
                type: 'big', // can be set to 'small' or 'big'
                onSuccess: function(a,b) {
                    console.debug(a);
                    console.debug(b);
                    alert('Success : your rate has been saved');
                },
                onError: function(a,b) {
                    console.debug(a);
                    console.debug(b);
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
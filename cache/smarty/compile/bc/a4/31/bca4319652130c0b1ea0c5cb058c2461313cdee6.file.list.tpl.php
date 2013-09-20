<?php /* Smarty version Smarty-3.1.14, created on 2013-09-19 08:00:09
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\myphotos\views\templates\front\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15314523abac01c4a04-08029587%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bca4319652130c0b1ea0c5cb058c2461313cdee6' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\myphotos\\views\\templates\\front\\list.tpl',
      1 => 1379592006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15314523abac01c4a04-08029587',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523abac03204d2_31938103',
  'variables' => 
  array (
    'list_categories' => 0,
    'i' => 0,
    'category' => 0,
    'img_photo_dir' => 0,
    'photo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523abac03204d2_31938103')) {function content_523abac03204d2_31938103($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
?><link href="/vatfairfoot/js/jquery/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/vatfairfoot/js/jquery/plugins/fancybox/jquery.fancybox.js"></script>
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
            <a href="<?php echo $_smarty_tpl->tpl_vars['img_photo_dir']->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['photo']->value['id_photo'], 'htmlall', 'UTF-8');?>
-thickbox_01prem.jpg" rel="other-views" class="thickbox<?php echo $_smarty_tpl->tpl_vars['category']->value['id_photo_cat'];?>
">
                <div class="content">
                    <h2 class="title"><?php echo $_smarty_tpl->tpl_vars['photo']->value['title'];?>
<span><?php echo smarty_modifier_escape($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['photo']->value['description'],35,'...'), 'htmlall', 'UTF-8');?>
</span></h2><br />

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
    var cat_id  = '<?php echo $_smarty_tpl->tpl_vars['category']->value['id_photo_cat'];?>
';
    $('.thickbox'+cat_id).fancybox({
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 600,
        'speedOut': 200,
        'overlayShow': false,
        'cyclic': true,
        'showNavArrows': true
    });
</script>
<?php } ?>
<?php }} ?>
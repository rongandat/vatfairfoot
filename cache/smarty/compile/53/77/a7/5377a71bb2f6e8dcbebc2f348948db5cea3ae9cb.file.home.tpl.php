<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:13:33
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\psnewsnest\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18886523fb03cb79c49-35982131%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5377a71bb2f6e8dcbebc2f348948db5cea3ae9cb' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\psnewsnest\\home.tpl',
      1 => 1379905870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18886523fb03cb79c49-35982131',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523fb03cbe7266_35850076',
  'variables' => 
  array (
    'last_post_list' => 0,
    'post' => 0,
    'img_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523fb03cbe7266_35850076')) {function content_523fb03cbe7266_35850076($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
?>
<?php if ($_smarty_tpl->tpl_vars['last_post_list']->value&&count($_smarty_tpl->tpl_vars['last_post_list']->value)>0){?>
<!-- MODULE Home Block best sellers -->
<div id="best-sellers_block_center" class="block products_block">
    <h1><?php echo smartyTranslate(array('s'=>'Last news','mod'=>'psnewsnest'),$_smarty_tpl);?>
</h1>

    <ul class="product_list jq_carousel_home">
        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_post_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
        <li class="ajax_block_product">
            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
">
                <div class="content">
                    <h2 class="title"><?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
<br /> <span><?php echo smarty_modifier_escape($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['post']->value['description'],35,'...'), 'htmlall', 'UTF-8');?>
</span></h2><br />
                    
                </div>
                <div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['post']->value['id_news'], 'htmlall', 'UTF-8');?>
-home_01prem.jpg" alt="" /></div>						
            </a>
        </li>
        <?php } ?>
    </ul>

</div>
<!-- /MODULE Home Block best sellers -->
<?php }?>
<?php }} ?>
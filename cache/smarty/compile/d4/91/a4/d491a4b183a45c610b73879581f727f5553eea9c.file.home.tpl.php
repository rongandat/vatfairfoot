<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:32:37
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\modules\psbloglastblock\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10919523fb655e36233-01387936%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd491a4b183a45c610b73879581f727f5553eea9c' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\modules\\psbloglastblock\\home.tpl',
      1 => 1379591292,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10919523fb655e36233-01387936',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last_post_list' => 0,
    'post' => 0,
    'blog_conf' => 0,
    'img_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523fb655ebaf57_80616814',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523fb655ebaf57_80616814')) {function content_523fb655ebaf57_80616814($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
?>
<!-- Block psblog module -->
<?php if ($_smarty_tpl->tpl_vars['last_post_list']->value&&count($_smarty_tpl->tpl_vars['last_post_list']->value)>0){?>
<div id="posts_home" class="block products_block">
    <h1><?php echo smartyTranslate(array('s'=>'Last articles','mod'=>'psbloglastblock'),$_smarty_tpl);?>
</h1>
    <?php if (isset($_smarty_tpl->tpl_vars['last_post_list']->value)&&$_smarty_tpl->tpl_vars['last_post_list']->value){?>
    <div class="jcarousel-container jcarousel-container-horizontal">
        <ul class="product_list jq_carousel_home">
            <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_post_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
            <li class="ajax_block_product">
                <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
">
                    <div class="content">
                        <h2 class="title"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</h2><br />
                        <?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['block_display_date']){?><span><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>smarty_modifier_escape($_smarty_tpl->tpl_vars['post']->value['date_on'], 'html', 'UTF-8'),'full'=>0),$_smarty_tpl);?>
</span><?php }?>
                        <div class="excerpt"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['post']->value['excerpt']),152,'...');?>
</div>
                    </div>
                    <div class="image">
                        <?php if ($_smarty_tpl->tpl_vars['post']->value['default_img']){?>
                        <div class="img_default">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
list/<?php echo $_smarty_tpl->tpl_vars['post']->value['default_img_name'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" />
                            </a>
                        </div>
                        <?php }?>
                    </div>						
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>

    <?php }else{ ?>
    <p>&raquo; <?php echo smartyTranslate(array('s'=>'No new products at this time','mod'=>'blocknewproducts'),$_smarty_tpl);?>
</p>
    <?php }?>
</div>
<?php }?>
<!-- /Block psblog module -->
<?php }} ?>
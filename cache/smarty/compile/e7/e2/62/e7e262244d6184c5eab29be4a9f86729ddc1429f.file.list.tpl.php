<?php /* Smarty version Smarty-3.1.14, created on 2013-09-09 03:52:20
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/modules/psblog/views/templates/front/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2058887317522d7e34ab6b88-29051781%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7e262244d6184c5eab29be4a9f86729ddc1429f' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/modules/psblog/views/templates/front/list.tpl',
      1 => 1378397752,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2058887317522d7e34ab6b88-29051781',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir' => 0,
    'listLink' => 0,
    'post_category' => 0,
    'notfound' => 0,
    'blog_conf' => 0,
    'posts_rss_url' => 0,
    'modules_dir' => 0,
    'search_query' => 0,
    'post_list' => 0,
    'post' => 0,
    'img_path' => 0,
    'paginationLink' => 0,
    'back' => 0,
    'curr_page' => 0,
    'next' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_522d7e34deb7a6_59936025',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522d7e34deb7a6_59936025')) {function content_522d7e34deb7a6_59936025($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/precya/public_html/vatfairfoot/tools/smarty/plugins/modifier.escape.php';
?>
<div class="breadcrumb">
	<a title="<?php echo smartyTranslate(array('s'=>'Back home','mod'=>'psblog'),$_smarty_tpl);?>
" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
"><?php echo smartyTranslate(array('s'=>'Home','mod'=>'psblog'),$_smarty_tpl);?>
</a><span class="navigation-pipe">&gt;</span><span class="navigation_end"><a title="<?php echo smartyTranslate(array('s'=>'All posts','mod'=>'psblog'),$_smarty_tpl);?>
" href="<?php echo $_smarty_tpl->tpl_vars['listLink']->value;?>
"><?php echo smartyTranslate(array('s'=>'Blog','mod'=>'psblog'),$_smarty_tpl);?>
</a></span> 
    <?php if (isset($_smarty_tpl->tpl_vars['post_category']->value)&&$_smarty_tpl->tpl_vars['post_category']->value){?>&gt; <?php echo smartyTranslate(array('s'=>'Category','mod'=>'psblog'),$_smarty_tpl);?>
 "<?php echo $_smarty_tpl->tpl_vars['post_category']->value->name;?>
" <?php }?>
</div>

<?php if (isset($_smarty_tpl->tpl_vars['notfound']->value)&&$_smarty_tpl->tpl_vars['notfound']->value==true){?>
    
    <?php if (isset($_smarty_tpl->tpl_vars['post_category']->value)){?>
        <p><?php echo smartyTranslate(array('s'=>'This category was not found','mod'=>'psblog'),$_smarty_tpl);?>
</p>
    <?php }else{ ?>
        <p><?php echo smartyTranslate(array('s'=>'The page was not found','mod'=>'psblog'),$_smarty_tpl);?>
</p>
    <?php }?>   
    
<?php }else{ ?>
    
    <?php if (isset($_smarty_tpl->tpl_vars['post_category']->value)){?>
            <h2 class="bt_left"><?php echo smartyTranslate(array('s'=>'Posts in category','mod'=>'psblog'),$_smarty_tpl);?>
 "<?php echo $_smarty_tpl->tpl_vars['post_category']->value->name;?>
"</h2>
            
            <?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['rss_active']){?>
                <p class="bt_right"><a href="<?php echo $_smarty_tpl->tpl_vars['posts_rss_url']->value;?>
" title="RSS"><img src="<?php echo $_smarty_tpl->tpl_vars['modules_dir']->value;?>
psblog/img/rss.png" alt="RSS" /></a></p>
            <?php }?>
            
            <div class="clear"></div>
            
            <div class="rte"><?php echo $_smarty_tpl->tpl_vars['post_category']->value->description;?>
</div>
    <?php }else{ ?>
            <h2 class="bt_left"><?php echo smartyTranslate(array('s'=>'Posts','mod'=>'psblog'),$_smarty_tpl);?>
</h2>
            
            <?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['rss_active']){?>
                <p class="bt_right"><a href="<?php echo $_smarty_tpl->tpl_vars['posts_rss_url']->value;?>
" title="RSS"><img src="<?php echo $_smarty_tpl->tpl_vars['modules_dir']->value;?>
psblog/img/rss.png" alt="RSS" /></a></p>
            <?php }?>
    <?php }?>
    
    <div class="clear"></div>
    
    <?php if (isset($_smarty_tpl->tpl_vars['search_query']->value)){?>
            <?php if (isset($_smarty_tpl->tpl_vars['post_list']->value)&&count($_smarty_tpl->tpl_vars['post_list']->value)>0){?>
                <h3><?php echo smartyTranslate(array('s'=>'Results for','mod'=>'psblog'),$_smarty_tpl);?>
 "<?php echo $_smarty_tpl->tpl_vars['search_query']->value;?>
"</h3>
            <?php }?>
    <?php }?>

    <div id="post_list">

    <?php if (isset($_smarty_tpl->tpl_vars['post_list']->value)&&$_smarty_tpl->tpl_vars['post_list']->value&&count($_smarty_tpl->tpl_vars['post_list']->value)>0){?>
    <ul>
    <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['post']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['post']->iteration=0;
 $_smarty_tpl->tpl_vars['post']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
 $_smarty_tpl->tpl_vars['post']->iteration++;
 $_smarty_tpl->tpl_vars['post']->index++;
 $_smarty_tpl->tpl_vars['post']->first = $_smarty_tpl->tpl_vars['post']->index === 0;
 $_smarty_tpl->tpl_vars['post']->last = $_smarty_tpl->tpl_vars['post']->iteration === $_smarty_tpl->tpl_vars['post']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['publications']['first'] = $_smarty_tpl->tpl_vars['post']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['publications']['last'] = $_smarty_tpl->tpl_vars['post']->last;
?>
    <li <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['publications']['last']){?> class="last_item" <?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['publications']['first']){?> class="first_item" <?php }?>>
            <?php if ($_smarty_tpl->tpl_vars['post']->value['default_img']){?>
            <div class="img_default">
        <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
">
        <img src="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
list/<?php echo $_smarty_tpl->tpl_vars['post']->value['default_img_name'];?>
" width="<?php echo $_smarty_tpl->tpl_vars['blog_conf']->value['img_list_width'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" />
        </a>
        </div>
        <?php }?>
        <div class="<?php if ($_smarty_tpl->tpl_vars['post']->value['default_img']){?> detail_left <?php }else{ ?> detail_large <?php }?>">
            <h3><a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></h3>  
            <p>
            <?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['list_display_date']){?><span><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>smarty_modifier_escape($_smarty_tpl->tpl_vars['post']->value['date_on'], 'html', 'UTF-8'),'full'=>0),$_smarty_tpl);?>
</span><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['comment_active']&&$_smarty_tpl->tpl_vars['post']->value['allow_comments']&&$_smarty_tpl->tpl_vars['post']->value['nb_comments']>0){?> 
            <span> - <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
#postcomments" ><?php echo $_smarty_tpl->tpl_vars['post']->value['nb_comments'];?>
 <?php if ($_smarty_tpl->tpl_vars['post']->value['nb_comments']>1){?><?php echo smartyTranslate(array('s'=>'comments','mod'=>'psblog'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'comment','mod'=>'psblog'),$_smarty_tpl);?>
<?php }?></a></span>
            <?php }?>
            </p>

            <div class="excerpt"><?php echo $_smarty_tpl->tpl_vars['post']->value['excerpt'];?>
</div>
            <p>
            <?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['category_active']&&isset($_smarty_tpl->tpl_vars['post']->value['categories'])&&count($_smarty_tpl->tpl_vars['post']->value['categories'])>0){?>
            <span><?php echo smartyTranslate(array('s'=>'Posted on','mod'=>'psblog'),$_smarty_tpl);?>
 
                <?php  $_smarty_tpl->tpl_vars['post_category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post_category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['post_category']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['post_category']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['post_category']->key => $_smarty_tpl->tpl_vars['post_category']->value){
$_smarty_tpl->tpl_vars['post_category']->_loop = true;
 $_smarty_tpl->tpl_vars['post_category']->iteration++;
 $_smarty_tpl->tpl_vars['post_category']->last = $_smarty_tpl->tpl_vars['post_category']->iteration === $_smarty_tpl->tpl_vars['post_category']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['post_category_list']['last'] = $_smarty_tpl->tpl_vars['post_category']->last;
?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['post_category']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post_category']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['post_category']->value['name'];?>
</a><?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['post_category_list']['last']){?>,<?php }?>
                <?php } ?>	
            </span>
            <?php }?>
            </p>
        </div>
        <div class="clear"></div>
    </li>
    <?php } ?>
    </ul>

    <?php if (isset($_smarty_tpl->tpl_vars['paginationLink']->value)){?>
        <?php if (isset($_smarty_tpl->tpl_vars['back']->value)&&$_smarty_tpl->tpl_vars['back']->value){?><a class="bt_right" href="<?php echo $_smarty_tpl->tpl_vars['paginationLink']->value;?>
<?php echo $_smarty_tpl->tpl_vars['curr_page']->value+1;?>
"><?php echo smartyTranslate(array('s'=>'Previous articles','mod'=>'psblog'),$_smarty_tpl);?>
 &raquo;</a>&nbsp;&nbsp;&nbsp;<?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['next']->value)&&$_smarty_tpl->tpl_vars['next']->value){?><a class="bt_left" href="<?php echo $_smarty_tpl->tpl_vars['paginationLink']->value;?>
<?php echo $_smarty_tpl->tpl_vars['curr_page']->value-1;?>
">&laquo; <?php echo smartyTranslate(array('s'=>'Newest Articles','mod'=>'psblog'),$_smarty_tpl);?>
</a><?php }?>
    <?php }?>

    <div class="clear"></div>

    <?php }else{ ?>
        <?php if (isset($_smarty_tpl->tpl_vars['search_query']->value)){?>
                <p class="warning"><?php echo smartyTranslate(array('s'=>'No results for','mod'=>'psblog'),$_smarty_tpl);?>
 "<?php echo $_smarty_tpl->tpl_vars['search_query']->value;?>
"</p>
        <?php }elseif(isset($_smarty_tpl->tpl_vars['post_category']->value)){?>
                <p class="warning"><?php echo smartyTranslate(array('s'=>'There is no posts in this category','mod'=>'psblog'),$_smarty_tpl);?>
</p>
        <?php }else{ ?>
                <p class="warning"><?php echo smartyTranslate(array('s'=>'There is no posts','mod'=>'psblog'),$_smarty_tpl);?>
</p>
        <?php }?>
    <?php }?>

    </div>
    
<?php }?><?php }} ?>
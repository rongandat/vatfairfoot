<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:20
         compiled from "/home/precya/public_html/vatfairfoot/modules/psbloglastblock/block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13552081365229ae807a1855-43822010%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4f65b41b9bb10df7c27077495b4a9ff8933f2d7' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/modules/psbloglastblock/block.tpl',
      1 => 1377896110,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13552081365229ae807a1855-43822010',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last_post_list' => 0,
    'blog_conf' => 0,
    'posts_rss_url' => 0,
    'modules_dir' => 0,
    'linkPosts' => 0,
    'post' => 0,
    'img_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae808623a8_60538448',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae808623a8_60538448')) {function content_5229ae808623a8_60538448($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/precya/public_html/vatfairfoot/tools/smarty/plugins/modifier.escape.php';
?>
<!-- Block psblog module -->
<?php if ($_smarty_tpl->tpl_vars['last_post_list']->value&&count($_smarty_tpl->tpl_vars['last_post_list']->value)>0){?>
    <div id="last_posts_block" class="block informations_block_left">
	<h4>
	
        <?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['rss_active']){?><a href="<?php echo $_smarty_tpl->tpl_vars['posts_rss_url']->value;?>
" title="RSS"><img src="<?php echo $_smarty_tpl->tpl_vars['modules_dir']->value;?>
psblog/img/rss.png" alt="RSS" /></a><?php }?>
        
        &nbsp; <a href="<?php echo $_smarty_tpl->tpl_vars['linkPosts']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Recent posts','mod'=>'psbloglastblock'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Recent posts','mod'=>'psbloglastblock'),$_smarty_tpl);?>
</a></h4>
        
	<div class="block_content">
	
            <ul>
                <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_post_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['post']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['post']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
 $_smarty_tpl->tpl_vars['post']->iteration++;
 $_smarty_tpl->tpl_vars['post']->last = $_smarty_tpl->tpl_vars['post']->iteration === $_smarty_tpl->tpl_vars['post']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['last_post_list']['last'] = $_smarty_tpl->tpl_vars['post']->last;
?>

                    <li <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['last_post_list']['last']){?> class="last_item" <?php }?>>

                        <?php if ($_smarty_tpl->tpl_vars['post']->value['default_img']&&$_smarty_tpl->tpl_vars['blog_conf']->value['block_display_img']){?>
                        <div style="float:left; width:<?php echo $_smarty_tpl->tpl_vars['blog_conf']->value['img_block_width'];?>
px; margin-right:5px;">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
list/<?php echo $_smarty_tpl->tpl_vars['post']->value['default_img_name'];?>
" width="<?php echo $_smarty_tpl->tpl_vars['blog_conf']->value['img_block_width'];?>
" /></a>
                        </div>
                        <?php }?>

                        <div style="<?php if ($_smarty_tpl->tpl_vars['post']->value['default_img']&&$_smarty_tpl->tpl_vars['blog_conf']->value['block_display_img']){?> float:left; width:135px; <?php }?>">

                        <h5><a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></h5>
                        <?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['block_display_date']){?><span><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>smarty_modifier_escape($_smarty_tpl->tpl_vars['post']->value['date_on'], 'html', 'UTF-8'),'full'=>0),$_smarty_tpl);?>
</span><?php }?>
                        </div>

                         <div class="clear"></div>

                    </li>
                <?php } ?>
            </ul>
            <br />
            <p><a href="<?php echo $_smarty_tpl->tpl_vars['linkPosts']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'View all posts','mod'=>'psbloglastblock'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'View all posts','mod'=>'psbloglastblock'),$_smarty_tpl);?>
 &raquo;</a></p>
	</div>
</div>
<?php }?>
<!-- /Block psblog module --><?php }} ?>
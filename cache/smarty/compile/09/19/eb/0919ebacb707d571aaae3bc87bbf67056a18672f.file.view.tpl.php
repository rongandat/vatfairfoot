<?php /* Smarty version Smarty-3.1.14, created on 2013-09-11 06:17:02
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/modules/psblog/views/templates/front/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:68084385522d7e37b858c1-27307194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0919ebacb707d571aaae3bc87bbf67056a18672f' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/modules/psblog/views/templates/front/view.tpl',
      1 => 1378824168,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68084385522d7e37b858c1-27307194',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_522d7e37ed0e63_12441772',
  'variables' => 
  array (
    'base_dir' => 0,
    'listLink' => 0,
    'post' => 0,
    'img_ext' => 0,
    'blog_conf' => 0,
    'img_path' => 0,
    'HOOK_NEWS_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522d7e37ed0e63_12441772')) {function content_522d7e37ed0e63_12441772($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/precya/public_html/vatfairfoot/tools/smarty/plugins/modifier.escape.php';
?><div class="breadcrumb">
    <a title="<?php echo smartyTranslate(array('s'=>'Back home','mod'=>'psblog'),$_smarty_tpl);?>
" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
"><?php echo smartyTranslate(array('s'=>'Home','mod'=>'psblog'),$_smarty_tpl);?>
</a><span class="navigation-pipe">&gt;</span><span class="navigation_end"><a href="<?php echo $_smarty_tpl->tpl_vars['listLink']->value;?>
"><?php echo smartyTranslate(array('s'=>'Blog','mod'=>'psblog'),$_smarty_tpl);?>
</a></span><?php if ($_smarty_tpl->tpl_vars['post']->value->status=='published'){?> &gt; <?php echo $_smarty_tpl->tpl_vars['post']->value->title;?>
 <?php }?>
</div>

<?php if ($_smarty_tpl->tpl_vars['post']->value->status=='published'){?>
<?php $_smarty_tpl->tpl_vars['img_ext'] = new Smarty_variable(array('jpg','jpeg','png','gif'), null, 0);?>
<div id="post_view">

    <div class="rte">
        <?php if ($_smarty_tpl->tpl_vars['post']->value->default_img){?>
        <?php if (in_array(pathinfo($_smarty_tpl->tpl_vars['post']->value->default_img['img_name'],@constant('PATHINFO_EXTENSION')),$_smarty_tpl->tpl_vars['img_ext']->value)){?>
        <div class="medias">
            <div class="media_list">
                <ul>     
                    <li><?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['view_display_popin']){?><a href="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['post']->value->default_img['img_name'];?>
" rel="post" class="postpopin" title="<?php echo $_smarty_tpl->tpl_vars['post']->value->title;?>
"><?php }?><img src="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
thumb/<?php echo $_smarty_tpl->tpl_vars['post']->value->default_img['img_name'];?>
" width="<?php echo $_smarty_tpl->tpl_vars['blog_conf']->value['img_width'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value->title;?>
" /><?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['view_display_popin']){?></a><?php }?></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <?php }else{ ?>
        <div class="medias">
            <div class="media_list">
                <video width="<?php echo $_smarty_tpl->tpl_vars['blog_conf']->value['img_width'];?>
" height="<?php echo $_smarty_tpl->tpl_vars['blog_conf']->value['img_width'];?>
" controls="controls">
                    <source src="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['post']->value->default_img['img_name'];?>
" type="video/mp4">
                    <object data="" width="<?php echo $_smarty_tpl->tpl_vars['blog_conf']->value['img_width'];?>
" height="<?php echo $_smarty_tpl->tpl_vars['blog_conf']->value['img_width'];?>
">
                        <embed width="320" height="240" src="<?php echo $_smarty_tpl->tpl_vars['img_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['post']->value->default_img['img_name'];?>
">
                    </object>
                </video>
            </div>
        </div>
        <?php }?>
        <?php }?>

        <div id="pb-left-column">
            <h1><?php echo $_smarty_tpl->tpl_vars['post']->value->title;?>
 <?php if ($_smarty_tpl->tpl_vars['blog_conf']->value['view_display_date']){?><?php }?></h1> 
            <p><span><?php echo smartyTranslate(array('s'=>'Published on','mod'=>'psblog'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>smarty_modifier_escape($_smarty_tpl->tpl_vars['post']->value->date_on, 'html', 'UTF-8'),'full'=>0),$_smarty_tpl);?>
</span></p>
            <?php echo $_smarty_tpl->tpl_vars['post']->value->content;?>

        </div>
    </div>
    <div class="clear"></div>
    <?php if (isset($_smarty_tpl->tpl_vars['HOOK_NEWS_FOOTER']->value)&&$_smarty_tpl->tpl_vars['HOOK_NEWS_FOOTER']->value){?><?php echo $_smarty_tpl->tpl_vars['HOOK_NEWS_FOOTER']->value;?>
<?php }?>
</div>
<?php }else{ ?>

<p class="warning"><?php echo smartyTranslate(array('s'=>'This post is not available','mod'=>'psblog'),$_smarty_tpl);?>
</p>

<?php }?>    











<?php }} ?>
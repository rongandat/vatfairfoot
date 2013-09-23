<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:05:27
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\psblogcategories\blockcategories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24847523faff7252174-76159665%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3d6f0d717e3a1870697ffc578fd2cb5e807c277' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\psblogcategories\\blockcategories.tpl',
      1 => 1377852910,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24847523faff7252174-76159665',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post_categories' => 0,
    'post_category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523faff7271582_98474926',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523faff7271582_98474926')) {function content_523faff7271582_98474926($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['post_categories']->value&&count($_smarty_tpl->tpl_vars['post_categories']->value)>0){?>
    
<div class="block informations_block_left">

    <h4><?php echo smartyTranslate(array('s'=>'Blog categories','mod'=>'psblogcategories'),$_smarty_tpl);?>
</h4>
	
    <ul class="block_content">
    <?php  $_smarty_tpl->tpl_vars['post_category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post_category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post_categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['post_category']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['post_category']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['post_category']->key => $_smarty_tpl->tpl_vars['post_category']->value){
$_smarty_tpl->tpl_vars['post_category']->_loop = true;
 $_smarty_tpl->tpl_vars['post_category']->iteration++;
 $_smarty_tpl->tpl_vars['post_category']->last = $_smarty_tpl->tpl_vars['post_category']->iteration === $_smarty_tpl->tpl_vars['post_category']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['post_category_list']['last'] = $_smarty_tpl->tpl_vars['post_category']->last;
?>
        <li <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['post_category_list']['last']){?> class="last_item" <?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['post_category']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post_category']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['post_category']->value['name'];?>
</a>
        </li>
    <?php } ?>
   </ul>
   
</div>
       
<?php }?>
<?php }} ?>
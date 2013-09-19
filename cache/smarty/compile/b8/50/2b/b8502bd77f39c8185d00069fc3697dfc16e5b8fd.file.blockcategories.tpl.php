<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:20
         compiled from "/home/precya/public_html/vatfairfoot/modules/psblogcategories/blockcategories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10636716175229ae80d4b978-79961585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8502bd77f39c8185d00069fc3697dfc16e5b8fd' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/modules/psblogcategories/blockcategories.tpl',
      1 => 1377896110,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10636716175229ae80d4b978-79961585',
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
  'unifunc' => 'content_5229ae80db2a34_31176269',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae80db2a34_31176269')) {function content_5229ae80db2a34_31176269($_smarty_tpl) {?>
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
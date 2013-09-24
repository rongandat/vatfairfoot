<?php /* Smarty version Smarty-3.1.14, created on 2013-09-23 06:38:12
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\modules\blockviewed\blockviewed.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2940452401a14e18e97-79479733%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54a56932deb7b008594a4720ba266116263ea2ac' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\modules\\blockviewed\\blockviewed.tpl',
      1 => 1377835944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2940452401a14e18e97-79479733',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'productsViewedObj' => 0,
    'viewedProduct' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52401a14e8a322_70822101',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52401a14e8a322_70822101')) {function content_52401a14e8a322_70822101($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
?>

<!-- Block Viewed products -->
<div id="viewed-products_block_left" class="block products_block">
	<h4><?php echo smartyTranslate(array('s'=>'Viewed products','mod'=>'blockviewed'),$_smarty_tpl);?>
</h4>
	<div class="block_content">
		<ul class="products clearfix">
			<?php  $_smarty_tpl->tpl_vars['viewedProduct'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['viewedProduct']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productsViewedObj']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['viewedProduct']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['viewedProduct']->iteration=0;
 $_smarty_tpl->tpl_vars['viewedProduct']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['viewedProduct']->key => $_smarty_tpl->tpl_vars['viewedProduct']->value){
$_smarty_tpl->tpl_vars['viewedProduct']->_loop = true;
 $_smarty_tpl->tpl_vars['viewedProduct']->iteration++;
 $_smarty_tpl->tpl_vars['viewedProduct']->index++;
 $_smarty_tpl->tpl_vars['viewedProduct']->first = $_smarty_tpl->tpl_vars['viewedProduct']->index === 0;
 $_smarty_tpl->tpl_vars['viewedProduct']->last = $_smarty_tpl->tpl_vars['viewedProduct']->iteration === $_smarty_tpl->tpl_vars['viewedProduct']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['first'] = $_smarty_tpl->tpl_vars['viewedProduct']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['last'] = $_smarty_tpl->tpl_vars['viewedProduct']->last;
?>
				<li class="clearfix<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['last']){?> last_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['first']){?> first_item<?php }else{ ?> item<?php }?>">
					<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['viewedProduct']->value->id,$_smarty_tpl->tpl_vars['viewedProduct']->value->link_rewrite,$_smarty_tpl->tpl_vars['viewedProduct']->value->category_rewrite);?>
" title="<?php echo smartyTranslate(array('s'=>'More about','mod'=>'blockviewed'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['viewedProduct']->value->name, 'html', 'UTF-8');?>
" class="content_img"><img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['viewedProduct']->value->link_rewrite,$_smarty_tpl->tpl_vars['viewedProduct']->value->cover,'medium_01prem');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['viewedProduct']->value->legend, 'html', 'UTF-8');?>
" /></a>
					<div class="text_desc">
						<h5><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['viewedProduct']->value->id,$_smarty_tpl->tpl_vars['viewedProduct']->value->link_rewrite,$_smarty_tpl->tpl_vars['viewedProduct']->value->category_rewrite);?>
" title="<?php echo smartyTranslate(array('s'=>'More about','mod'=>'blockviewed'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['viewedProduct']->value->name, 'html', 'UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['viewedProduct']->value->name,14,'...'), 'html', 'UTF-8');?>
</a></h5>
						<p><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['viewedProduct']->value->id,$_smarty_tpl->tpl_vars['viewedProduct']->value->link_rewrite,$_smarty_tpl->tpl_vars['viewedProduct']->value->category_rewrite);?>
" title="<?php echo smartyTranslate(array('s'=>'More about','mod'=>'blockviewed'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['viewedProduct']->value->name, 'html', 'UTF-8');?>
"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['viewedProduct']->value->description_short),44,'...');?>
</a></p>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2013-09-19 07:57:32
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29766523a73179a7339-38890883%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd61a9402bee6585c01e6894b8c88a2e4a50adaef' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\product.tpl',
      1 => 1379591849,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29766523a73179a7339-38890883',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523a73182cd6b7_29424289',
  'variables' => 
  array (
    'images' => 0,
    'product' => 0,
    'image' => 0,
    'imageIds' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523a73182cd6b7_29424289')) {function content_523a73182cd6b7_29424289($_smarty_tpl) {?><div id="">
			<ul >
				<?php if (isset($_smarty_tpl->tpl_vars['images']->value)){?>
					<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
					<?php $_smarty_tpl->tpl_vars['imageIds'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['product']->value->id)."-".((string)$_smarty_tpl->tpl_vars['image']->value['id_image']), null, 0);?>
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value->link_rewrite,$_smarty_tpl->tpl_vars['imageIds']->value,'thickbox_01prem');?>
" class="thickbox">
							<img id="thumb_<?php echo $_smarty_tpl->tpl_vars['image']->value['id_image'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value->link_rewrite,$_smarty_tpl->tpl_vars['imageIds']->value,'medium_01prem');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['legend']);?>
" />
						</a>
					</li>
					<?php } ?>
				<?php }?>
			</ul>
		</div><?php }} ?>
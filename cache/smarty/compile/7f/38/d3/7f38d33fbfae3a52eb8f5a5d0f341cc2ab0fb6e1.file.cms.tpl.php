<?php /* Smarty version Smarty-3.1.14, created on 2013-09-19 04:30:52
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\cms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13040523ab63c602281-00849596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f38d33fbfae3a52eb8f5a5d0f341cc2ab0fb6e1' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\cms.tpl',
      1 => 1377835944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13040523ab63c602281-00849596',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'cms' => 0,
    'category' => 0,
    'base_dir' => 0,
    'link' => 0,
    'sub_category' => 0,
    'subcategory' => 0,
    'cms_pages' => 0,
    'cmspages' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523ab63c71f547_93107505',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523ab63c71f547_93107505')) {function content_523ab63c71f547_93107505($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
?>
<?php if (($_smarty_tpl->tpl_vars['content_only']->value==0)){?>
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['cms']->value)&&!isset($_smarty_tpl->tpl_vars['category']->value)){?>
	<?php if (!$_smarty_tpl->tpl_vars['cms']->value->active){?>
		<br />
		<div id="admin-action-cms">
			<p><?php echo smartyTranslate(array('s'=>'This CMS page is not visible to your customers.'),$_smarty_tpl);?>

			<input type="hidden" id="admin-action-cms-id" value="<?php echo $_smarty_tpl->tpl_vars['cms']->value->id;?>
" />
			<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Publish'),$_smarty_tpl);?>
" class="exclusive" onclick="submitPublishCMS('<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
<?php echo smarty_modifier_escape($_GET['ad'], 'htmlall', 'UTF-8');?>
', 0, '<?php echo smarty_modifier_escape($_GET['adtoken'], 'htmlall', 'UTF-8');?>
')"/>
			<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Back'),$_smarty_tpl);?>
" class="exclusive" onclick="submitPublishCMS('<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
<?php echo smarty_modifier_escape($_GET['ad'], 'htmlall', 'UTF-8');?>
', 1, '<?php echo smarty_modifier_escape($_GET['adtoken'], 'htmlall', 'UTF-8');?>
')"/>
			</p>
			<div class="clear" ></div>
			<p id="admin-action-result"></p>
			</p>
		</div>
	<?php }?>
	<div class="rte<?php if ($_smarty_tpl->tpl_vars['content_only']->value){?> content_only<?php }?>">
		<?php echo $_smarty_tpl->tpl_vars['cms']->value->content;?>

	</div>
<?php }elseif(isset($_smarty_tpl->tpl_vars['category']->value)){?>
	<div class="block-cms">
		<h1><a href="<?php if ($_smarty_tpl->tpl_vars['category']->value->id==1){?><?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getCMSCategoryLink($_smarty_tpl->tpl_vars['category']->value->id,$_smarty_tpl->tpl_vars['category']->value->link_rewrite);?>
<?php }?>"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['category']->value->name, 'htmlall', 'UTF-8');?>
</a></h1>
		<?php if (isset($_smarty_tpl->tpl_vars['sub_category']->value)&!empty($_smarty_tpl->tpl_vars['sub_category']->value)){?>	
			<h4><?php echo smartyTranslate(array('s'=>'List of sub categories in %s:','sprintf'=>$_smarty_tpl->tpl_vars['category']->value->name),$_smarty_tpl);?>
</h4>
			<ul class="bullet">
				<?php  $_smarty_tpl->tpl_vars['subcategory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subcategory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sub_category']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subcategory']->key => $_smarty_tpl->tpl_vars['subcategory']->value){
$_smarty_tpl->tpl_vars['subcategory']->_loop = true;
?>
					<li>
						<a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getCMSCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_cms_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']), 'htmlall', 'UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['subcategory']->value['name'], 'htmlall', 'UTF-8');?>
</a>
					</li>
				<?php } ?>
			</ul>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['cms_pages']->value)&!empty($_smarty_tpl->tpl_vars['cms_pages']->value)){?>
		<h4><?php echo smartyTranslate(array('s'=>'List of pages in %s:','sprintf'=>$_smarty_tpl->tpl_vars['category']->value->name),$_smarty_tpl);?>
</h4>
			<ul class="bullet">
				<?php  $_smarty_tpl->tpl_vars['cmspages'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cmspages']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cms_pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cmspages']->key => $_smarty_tpl->tpl_vars['cmspages']->value){
$_smarty_tpl->tpl_vars['cmspages']->_loop = true;
?>
					<li>
						<a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getCMSLink($_smarty_tpl->tpl_vars['cmspages']->value['id_cms'],$_smarty_tpl->tpl_vars['cmspages']->value['link_rewrite']), 'htmlall', 'UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cmspages']->value['meta_title'], 'htmlall', 'UTF-8');?>
</a>
					</li>
				<?php } ?>
			</ul>
		<?php }?>
	</div>
<?php }else{ ?>
	<?php echo smartyTranslate(array('s'=>'This page does not exist.'),$_smarty_tpl);?>

<?php }?>
<br /><?php }} ?>
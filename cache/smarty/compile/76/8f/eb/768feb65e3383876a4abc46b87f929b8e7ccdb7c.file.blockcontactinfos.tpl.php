<?php /* Smarty version Smarty-3.1.14, created on 2013-09-23 06:38:13
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\modules\blockcontactinfos\blockcontactinfos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:306452401a15687864-28183736%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '768feb65e3383876a4abc46b87f929b8e7ccdb7c' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\modules\\blockcontactinfos\\blockcontactinfos.tpl',
      1 => 1377835944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '306452401a15687864-28183736',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'blockcontactinfos_company' => 0,
    'blockcontactinfos_address' => 0,
    'blockcontactinfos_phone' => 0,
    'blockcontactinfos_email' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52401a156ba4e5_52104249',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52401a156ba4e5_52104249')) {function content_52401a156ba4e5_52104249($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\modifier.escape.php';
if (!is_callable('smarty_function_mailto')) include 'E:\\xampp\\htdocs\\vatfairfoot\\tools\\smarty\\plugins\\function.mailto.php';
?>

<!-- MODULE Block contact infos -->
<div id="block_contact_infos">
	<h4><?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcontactinfos'),$_smarty_tpl);?>
</h4>
	<ul>
		<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_company']->value!=''){?><li><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['blockcontactinfos_company']->value, 'htmlall', 'UTF-8');?>
</li><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value!=''){?><li><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value, 'htmlall', 'UTF-8');?>
</li><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value!=''){?><li><?php echo smartyTranslate(array('s'=>'Tel:','mod'=>'blockcontactinfos'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value, 'htmlall', 'UTF-8');?>
</li><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value!=''){?><li><?php echo smartyTranslate(array('s'=>'Email:','mod'=>'blockcontactinfos'),$_smarty_tpl);?>
 <?php echo smarty_function_mailto(array('address'=>smarty_modifier_escape($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value, 'htmlall', 'UTF-8'),'encode'=>"hex"),$_smarty_tpl);?>
</li><?php }?>
	</ul>
</div>
<!-- /MODULE Block contact infos -->
<?php }} ?>
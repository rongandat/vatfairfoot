<?php /* Smarty version Smarty-3.1.14, created on 2013-09-23 22:51:39
         compiled from "E:\xampp\htdocs\vatfairfoot\admin8683\themes\default\template\helpers\list\list_action_enable.tpl" */ ?>
<?php /*%%SmartyHeaderCode:319245240fe3bcd1061-21974306%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fc5cbcf051deb1088540b13e19053d5fc662ae0' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\admin8683\\themes\\default\\template\\helpers\\list\\list_action_enable.tpl',
      1 => 1377659662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '319245240fe3bcd1061-21974306',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_enable' => 0,
    'confirm' => 0,
    'enabled' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5240fe3bcf42e0_20534580',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5240fe3bcf42e0_20534580')) {function content_5240fe3bcf42e0_20534580($_smarty_tpl) {?>

<a href="<?php echo $_smarty_tpl->tpl_vars['url_enable']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)){?>onclick="return confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
');"<?php }?> title="<?php if ($_smarty_tpl->tpl_vars['enabled']->value){?><?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
<?php }?>">
	<img src="../img/admin/<?php if ($_smarty_tpl->tpl_vars['enabled']->value){?>enabled.gif<?php }else{ ?>disabled.gif<?php }?>" alt="<?php if ($_smarty_tpl->tpl_vars['enabled']->value){?><?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
<?php }?>" />
</a>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:30:05
         compiled from "/home/precya/public_html/vatfairfoot/modules/blocksharefb/blocksharefb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6511710315229aead9759e6-89751240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2167567d59057f1464dbc17a3b37334ea2f6e02' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/modules/blocksharefb/blocksharefb.tpl',
      1 => 1377702864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6511710315229aead9759e6-89751240',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product_link' => 0,
    'product_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229aead9dadc5_93973064',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229aead9dadc5_93973064')) {function content_5229aead9dadc5_93973064($_smarty_tpl) {?>

<li id="left_share_fb">
	<a href="http://www.facebook.com/sharer.php?u=<?php echo $_smarty_tpl->tpl_vars['product_link']->value;?>
&amp;t=<?php echo $_smarty_tpl->tpl_vars['product_title']->value;?>
" class="js-new-window"><?php echo smartyTranslate(array('s'=>'Share on Facebook!','mod'=>'blocksharefb'),$_smarty_tpl);?>
</a>
</li><?php }} ?>
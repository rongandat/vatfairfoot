<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:28:52
         compiled from "/home/precya/public_html/vatfairfoot/admin8683/themes/default/template/helpers/help_access/button.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19238781345229ae6451b203-27323631%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fa5ccbf3f58b9d4e0e4ee44ee62c5ddb6b22de1' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/admin8683/themes/default/template/helpers/help_access/button.tpl',
      1 => 1377702862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19238781345229ae6451b203-27323631',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'label' => 0,
    'help_base_url' => 0,
    'iso_lang' => 0,
    'version' => 0,
    'doc_version' => 0,
    'country' => 0,
    'tooltip' => 0,
    'button_class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae64607982_45064023',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae64607982_45064023')) {function content_5229ae64607982_45064023($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/precya/public_html/vatfairfoot/tools/smarty/plugins/modifier.escape.php';
?><li class="help-context-<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['label']->value, 'htmlall', 'UTF-8');?>
" style="display:none">
    <a id="desc-<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['label']->value, 'htmlall', 'UTF-8');?>
-help"
       class="toolbar_btn"
       href="#"
       onclick="showHelp('<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['help_base_url']->value, 'htmlall', 'UTF-8');?>
',
                         '<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['label']->value, 'htmlall', 'UTF-8');?>
',
                         '<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['iso_lang']->value, 'htmlall', 'UTF-8');?>
',
                         '<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['version']->value, 'htmlall', 'UTF-8');?>
',
                         '<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['doc_version']->value, 'htmlall', 'UTF-8');?>
',
                         '<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['country']->value, 'htmlall', 'UTF-8');?>
');"
        title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['tooltip']->value, 'htmlall', 'UTF-8');?>
">
        <span class="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['button_class']->value, 'htmlall', 'UTF-8');?>
"></span>
        <div><?php echo smartyTranslate(array('s'=>'Help'),$_smarty_tpl);?>
</div>
    </a>
</li>
<?php }} ?>
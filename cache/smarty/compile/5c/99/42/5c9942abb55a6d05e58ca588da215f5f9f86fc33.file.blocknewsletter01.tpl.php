<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:21
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/modules/blocknewsletter01/views/templates/hook/blocknewsletter01.tpl" */ ?>
<?php /*%%SmartyHeaderCode:749026375229ae81bfca66-91834439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c9942abb55a6d05e58ca588da215f5f9f86fc33' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/modules/blocknewsletter01/views/templates/hook/blocknewsletter01.tpl',
      1 => 1378220846,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '749026375229ae81bfca66-91834439',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
    'nw_error' => 0,
    'link' => 0,
    'value' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae81cfcdf6_27071233',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae81cfcdf6_27071233')) {function content_5229ae81cfcdf6_27071233($_smarty_tpl) {?>

<!-- Block Newsletter module-->

<div id="newsletter_block_left" class="block">
	<h4 class="title_block"><?php echo smartyTranslate(array('s'=>'Newsletter','mod'=>'blocknewsletter01'),$_smarty_tpl);?>
</h4>
	<div class="block_content">
	<?php if (isset($_smarty_tpl->tpl_vars['msg']->value)&&$_smarty_tpl->tpl_vars['msg']->value){?>
		<p class="<?php if ($_smarty_tpl->tpl_vars['nw_error']->value){?>warning_inline<?php }else{ ?>success_inline<?php }?>"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</p>
	<?php }?>
		<form action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index');?>
#footer" method="post">
			<p>
				
				<input type="text" name="email" size="18" value="<?php if (isset($_smarty_tpl->tpl_vars['value']->value)&&$_smarty_tpl->tpl_vars['value']->value){?><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
<?php }?>" class="inputNew" placeholder="<?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'blocknewsletter01'),$_smarty_tpl);?>
" />
				<!--<select name="action">
					<option value="0"<?php if (isset($_smarty_tpl->tpl_vars['action']->value)&&$_smarty_tpl->tpl_vars['action']->value==0){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Subscribe','mod'=>'blocknewsletter01'),$_smarty_tpl);?>
</option>
					<option value="1"<?php if (isset($_smarty_tpl->tpl_vars['action']->value)&&$_smarty_tpl->tpl_vars['action']->value==1){?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Unsubscribe','mod'=>'blocknewsletter01'),$_smarty_tpl);?>
</option>
				</select>-->
					<input type="submit" value="ok" class="button_mini" name="submitNewsletter" />
				<input type="hidden" name="action" value="0" />
			</p>
		</form>
	</div>
</div>
<!-- /Block Newsletter module-->
<?php }} ?>
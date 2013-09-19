<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:49
         compiled from "/home/precya/public_html/vatfairfoot/admin8683/themes/default/template/controllers/products/combination/helpers/list/list_footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17014745615229ae9d10ae57-08557863%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '790d025e96d6175a6bb49f82171f7c8411da772b' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/admin8683/themes/default/template/controllers/products/combination/helpers/list/list_footer.tpl',
      1 => 1377702862,
      2 => 'file',
    ),
    '0ba7bf4ad4bda01539a3cb5f1dd774763f7bf97a' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/admin8683/themes/default/template/helpers/list/list_footer.tpl',
      1 => 1377702862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17014745615229ae9d10ae57-08557863',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'bulk_actions' => 0,
    'key' => 0,
    'table' => 0,
    'params' => 0,
    'simple_header' => 0,
    'token' => 0,
    'name_controller' => 0,
    'hookName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae9d1f77e4_89462621',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae9d1f77e4_89462621')) {function content_5229ae9d1f77e4_89462621($_smarty_tpl) {?>

			</table>
			<?php if ($_smarty_tpl->tpl_vars['bulk_actions']->value){?>
				<p>
					<?php  $_smarty_tpl->tpl_vars['params'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['params']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['bulk_actions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['params']->key => $_smarty_tpl->tpl_vars['params']->value){
$_smarty_tpl->tpl_vars['params']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['params']->key;
?>
						<input type="submit" class="button" name="submitBulk<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['text'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['params']->value['confirm'])){?>onclick="return confirm('<?php echo $_smarty_tpl->tpl_vars['params']->value['confirm'];?>
');"<?php }?> />
					<?php } ?>
				</p>
			<?php }?>
		</td>
	</tr>
</table>
<?php if (!$_smarty_tpl->tpl_vars['simple_header']->value){?>
	<input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
	</form>
<?php }?>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayAdminListAfter'),$_smarty_tpl);?>

<?php if (isset($_smarty_tpl->tpl_vars['name_controller']->value)){?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('hookName', 'hookName', null); ob_start(); ?>display<?php echo ucfirst($_smarty_tpl->tpl_vars['name_controller']->value);?>
ListAfter<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>$_smarty_tpl->tpl_vars['hookName']->value),$_smarty_tpl);?>

<?php }elseif(isset($_GET['controller'])){?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('hookName', 'hookName', null); ob_start(); ?>display<?php echo htmlentities(ucfirst($_GET['controller']));?>
ListAfter<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>$_smarty_tpl->tpl_vars['hookName']->value),$_smarty_tpl);?>

<?php }?>




	<div class="hint" style="display:block">
		<ul>
			<li><?php echo smartyTranslate(array('s'=>'The row in blue is the default combination.'),$_smarty_tpl);?>
</li>
			<li><?php echo smartyTranslate(array('s'=>'A default combination must be designated for each product.'),$_smarty_tpl);?>
</li>
		</ul>
	</div>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.14, created on 2013-09-19 06:02:52
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14243523a7264cc3317-31668297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b13e88bd1b898122597f7ce3502374fec1926e1' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\footer.tpl',
      1 => 1379584729,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14243523a7264cc3317-31668297',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523a7264cdaa18_77857797',
  'variables' => 
  array (
    'content_only' => 0,
    'page_name' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'logo_image_height' => 0,
    'HOOK_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523a7264cdaa18_77857797')) {function content_523a7264cdaa18_77857797($_smarty_tpl) {?>
		<?php if (!$_smarty_tpl->tpl_vars['content_only']->value){?>
				<?php if ($_smarty_tpl->tpl_vars['page_name']->value!='index'&&$_smarty_tpl->tpl_vars['page_name']->value!='module-psblog-posts'&&$_smarty_tpl->tpl_vars['page_name']->value!='module-myphotos-post'){?>
				</div>
				<!-- /#main end -->

				<!-- Right -->
				<div id="right_column" class="column grid_2 omega">
					<?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>

				</div>
				<?php }?>
			</div>

<!-- Footer -->
			<footer id="footer" <?php if ($_smarty_tpl->tpl_vars['logo_image_height']->value){?>style="min-height:<?php echo $_smarty_tpl->tpl_vars['logo_image_height']->value;?>
px;"<?php }?>>
				<?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>

			</footer>
		</div>
	<?php }?>
	
</body>
</html>
<?php }} ?>
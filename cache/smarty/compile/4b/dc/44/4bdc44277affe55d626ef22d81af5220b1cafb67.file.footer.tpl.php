<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:22
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15069266465229ae820b1300-18789667%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4bdc44277affe55d626ef22d81af5220b1cafb67' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/footer.tpl',
      1 => 1378409384,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15069266465229ae820b1300-18789667',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'page_name' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'logo_image_height' => 0,
    'HOOK_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae8212bb89_27875323',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae8212bb89_27875323')) {function content_5229ae8212bb89_27875323($_smarty_tpl) {?>
		<?php if (!$_smarty_tpl->tpl_vars['content_only']->value){?>
				<?php if ($_smarty_tpl->tpl_vars['page_name']->value!='index'&&$_smarty_tpl->tpl_vars['page_name']->value!='module-psblog-posts'){?>
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
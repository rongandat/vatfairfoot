<?php /* Smarty version Smarty-3.1.14, created on 2013-09-06 06:29:20
         compiled from "/home/precya/public_html/vatfairfoot/themes/01premium/modules/homeslider/homeslider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11313797165229ae80e35c79-44211434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c9ef7c8b90c5b4dcf2140184ea7dfa2bb27e882' => 
    array (
      0 => '/home/precya/public_html/vatfairfoot/themes/01premium/modules/homeslider/homeslider.tpl',
      1 => 1377894796,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11313797165229ae80e35c79-44211434',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'homeslider' => 0,
    'homeslider_slides' => 0,
    'slide' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5229ae80eff8d1_53616084',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5229ae80eff8d1_53616084')) {function content_5229ae80eff8d1_53616084($_smarty_tpl) {?>
<!-- Module HomeSlider -->
<?php if (isset($_smarty_tpl->tpl_vars['homeslider']->value)){?>
<script type="text/javascript">
<?php if (isset($_smarty_tpl->tpl_vars['homeslider_slides']->value)&&count($_smarty_tpl->tpl_vars['homeslider_slides']->value)>1){?>
	<?php if ($_smarty_tpl->tpl_vars['homeslider']->value['loop']==1){?>
		var homeslider_loop = true;
	<?php }else{ ?>
		var homeslider_loop = false;
	<?php }?>
<?php }else{ ?>
	var homeslider_loop = false;
<?php }?>
var homeslider_speed = <?php echo $_smarty_tpl->tpl_vars['homeslider']->value['speed'];?>
;
var homeslider_pause = <?php echo $_smarty_tpl->tpl_vars['homeslider']->value['pause'];?>
;
</script>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['homeslider_slides']->value)){?>
	<div id="slider_home">
		<ul class="slides">
	<?php  $_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slide']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['homeslider_slides']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->key => $_smarty_tpl->tpl_vars['slide']->value){
$_smarty_tpl->tpl_vars['slide']->_loop = true;
?>
		<?php if ($_smarty_tpl->tpl_vars['slide']->value['active']){?>
			<li><?php if (strlen($_smarty_tpl->tpl_vars['slide']->value['url'])>0){?><a href="<?php echo $_smarty_tpl->tpl_vars['slide']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>
"><?php }?><img src="<?php echo @constant('_MODULE_DIR_');?>
/homeslider/images/<?php echo $_smarty_tpl->tpl_vars['slide']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['slide']->value['legend'];?>
"  /><?php if (strlen($_smarty_tpl->tpl_vars['slide']->value['url'])>0){?></a><?php }?></li>
		<?php }?>
	<?php } ?>
		</ul>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('#slider_home').flexslider({
				animation: "slide",
				pauseOnHover: true
			});
		});
	</script>
<?php }?>
<!-- /Module HomeSlider -->
<?php }} ?>
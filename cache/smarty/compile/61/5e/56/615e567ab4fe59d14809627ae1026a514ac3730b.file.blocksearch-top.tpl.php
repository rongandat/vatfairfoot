<?php /* Smarty version Smarty-3.1.14, created on 2013-09-22 23:05:26
         compiled from "E:\xampp\htdocs\vatfairfoot\themes\01premium\modules\blocksearch\blocksearch-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25022523faff675b012-76740329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '615e567ab4fe59d14809627ae1026a514ac3730b' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\themes\\01premium\\modules\\blocksearch\\blocksearch-top.tpl',
      1 => 1377835944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25022523faff675b012-76740329',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'ENT_QUOTES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_523faff6789e23_56236025',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523faff6789e23_56236025')) {function content_523faff6789e23_56236025($_smarty_tpl) {?>
<!-- Block search module TOP -->
<div id="search_block_top">

	<form method="get" action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('search');?>
" id="searchbox">
		<p>
			<label for="search_query_top"><!-- image on background --></label>
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
			<input placeholder="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'blocksearch'),$_smarty_tpl);?>
_"  class="search_query" type="text" id="search_query_top" name="search_query" value="<?php if (isset($_GET['search_query'])){?><?php echo stripslashes(htmlentities($_GET['search_query'],$_smarty_tpl->tpl_vars['ENT_QUOTES']->value,'utf-8'));?>
<?php }?>" />
			<input type="submit" name="submit_search" value="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'blocksearch'),$_smarty_tpl);?>
" class="button" />
	</p>
	</form>
</div>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['self']->value)."/blocksearch-instantsearch.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<!-- /Block search module TOP -->
<?php }} ?>
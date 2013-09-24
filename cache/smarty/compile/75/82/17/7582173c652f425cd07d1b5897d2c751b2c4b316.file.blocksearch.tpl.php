<?php /* Smarty version Smarty-3.1.14, created on 2013-09-23 06:38:13
         compiled from "E:\xampp\htdocs\vatfairfoot\modules\psblogblocksearch\blocksearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2477652401a150ce985-56177749%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7582173c652f425cd07d1b5897d2c751b2c4b316' => 
    array (
      0 => 'E:\\xampp\\htdocs\\vatfairfoot\\modules\\psblogblocksearch\\blocksearch.tpl',
      1 => 1377852910,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2477652401a150ce985-56177749',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'linkPosts' => 0,
    'search_query_nb' => 0,
    'search_query' => 0,
    'ENT_QUOTES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52401a150f5a92_27724251',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52401a150f5a92_27724251')) {function content_52401a150f5a92_27724251($_smarty_tpl) {?>
<div id="post_search_block" class="block">
	<h4><?php echo smartyTranslate(array('s'=>'Search in Blog','mod'=>'psblogblocksearch'),$_smarty_tpl);?>
</h4>
        
            <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['linkPosts']->value;?>
" id="searchbox">
                <div class="block_content">
                        
                    <?php if (isset($_smarty_tpl->tpl_vars['search_query_nb']->value)&&$_smarty_tpl->tpl_vars['search_query_nb']->value>0){?>
                        <p class="results">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['linkPosts']->value;?>
?search=<?php echo $_smarty_tpl->tpl_vars['search_query']->value;?>
">
                                <?php echo $_smarty_tpl->tpl_vars['search_query_nb']->value;?>
 <?php echo smartyTranslate(array('s'=>'Result for the term','mod'=>'psblogblocksearch'),$_smarty_tpl);?>
 "<?php echo $_smarty_tpl->tpl_vars['search_query']->value;?>
"
                            </a>
                        </p>
                    <?php }?>

                    <p>
                        <input type="text" name="search" value="<?php if (isset($_smarty_tpl->tpl_vars['search_query']->value)){?><?php echo stripslashes(htmlentities($_smarty_tpl->tpl_vars['search_query']->value,$_smarty_tpl->tpl_vars['ENT_QUOTES']->value,'utf-8'));?>
<?php }?>" />
                        <input type="submit" class="button_mini" value="<?php echo smartyTranslate(array('s'=>'go','mod'=>'psblogblocksearch'),$_smarty_tpl);?>
" />
                    </p>
                    
		</div>
	</form>

</div><?php }} ?>
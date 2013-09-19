
{if $post_categories && $post_categories|@count > 0}
    
<div class="block informations_block_left">

    <h4>{l s='Blog categories' mod='psblogcategories'}</h4>
	
    <ul class="block_content">
    {foreach from=$post_categories item=post_category name=post_category_list}
        <li {if $smarty.foreach.post_category_list.last} class="last_item" {/if}>
            <a href="{$post_category.link}" title="{$post_category.name}">{$post_category.name}</a>
        </li>
    {/foreach}
   </ul>
   
</div>
       
{/if}

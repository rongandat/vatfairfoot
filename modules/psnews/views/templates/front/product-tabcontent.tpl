{if $post_product_list && $post_product_list|@count > 0}
<ul id="ProductPosts" class="bullet">
	{foreach from=$post_product_list item=postProduct}
	<li><a href="{$postProduct.link}" title="{$postProduct.title}">{$postProduct.title}</a></li>
    {/foreach}
</ul>
{/if}


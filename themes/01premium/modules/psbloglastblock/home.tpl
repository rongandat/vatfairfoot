
<!-- Block psblog module -->
{if $last_post_list && $last_post_list|@count > 0}
<div id="posts_home" class="block products_block">
    <h1>{l s='Last articles' mod='psbloglastblock'}</h1>
    {if isset($last_post_list) AND $last_post_list}
    <div class="jcarousel-container jcarousel-container-horizontal">
        <ul class="product_list jq_carousel_home">
            {foreach from=$last_post_list item=post name=last_post_list}
            <li class="ajax_block_product">
                <a href="{$post.link}" title="{$post.title}">
                    <div class="content">
                        <h2 class="title">{$post.title}</h2><br />
                        {if $blog_conf.block_display_date}<span>{dateFormat date=$post.date_on|escape:'html':'UTF-8' full=0}</span>{/if}
                        <div class="excerpt">{$post.excerpt|strip_tags:'UTF-8'|truncate:152:'...'}</div>
                    </div>
                    <div class="image">
                        {if $post.default_img}
                        <div class="img_default">
                            <a href="{$post.link}" title="{$post.title}">
                                <img src="{$img_path}list/{$post.default_img_name}" alt="{$post.title}" />
                            </a>
                        </div>
                        {/if}
                    </div>						
                </a>
            </li>
            {/foreach}
        </ul>
    </div>

    {else}
    <p>&raquo; {l s='No new products at this time' mod='blocknewproducts'}</p>
    {/if}
</div>
{/if}
<!-- /Block psblog module -->

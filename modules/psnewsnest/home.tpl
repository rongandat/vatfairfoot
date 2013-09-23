
{if $last_post_list && $last_post_list|@count > 0}
<!-- MODULE Home Block best sellers -->
<div id="best-sellers_block_center" class="block products_block">
    <h1>{l s='Last news' mod='psnewsnest'}</h1>

    <ul class="product_list jq_carousel_home">
        {foreach from=$last_post_list item=post name=last_post_list}
        <li class="ajax_block_product">
            <a href="{$post.link}">
                <div class="content">
                    <h2 class="title">{$post.name}<br /> <span>{$post.description|truncate:35:'...'|escape:'htmlall':'UTF-8'}</span></h2><br />
                    
                </div>
                <div class="image"><img src="{$img_path}{$post.id_news|escape:'htmlall':'UTF-8'}-home_01prem.jpg" alt="" /></div>						
            </a>
        </li>
        {/foreach}
    </ul>

</div>
<!-- /MODULE Home Block best sellers -->
{/if}

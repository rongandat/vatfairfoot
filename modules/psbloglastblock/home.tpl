<!-- Block psblog module -->
{if $last_post_list && $last_post_list|@count > 0}
<div class="clear"></div>
<div id="posts_home" class="block">
	<h4>{l s='Last articles' mod='psbloglastblock'} <span><a href="{$linkPosts}">{l s='All posts' mod='psbloglastblock'}</a>  &nbsp; {if $blog_conf.rss_active}<a href="{$posts_rss_url}" title="RSS"><img src="{$modules_dir}psblog/img/rss.png" alt="RSS" /></a>{/if}</span></h4>
       
        

    <div class="block_content">
    <ul>
    {foreach from=$last_post_list item=post name=last_post_list}
        <li {if $smarty.foreach.last_post_list.last} class="last_item" {/if}>
            
            {if $post.default_img}
            <div class="img_default">
            <a href="{$post.link}" title="{$post.title}">
            <img src="{$img_path}list/{$post.default_img_name}" width="{$blog_conf.img_block_width}" alt="{$post.title}" />
            </a>
            </div>
            {/if}
            
            <div class="{if $post.default_img} detail_left {else} detail_large {/if}">
                <h3><a href="{$post.link}" title="{$post.title}">{$post.title}</a></h3>  
                {if $blog_conf.block_display_date}<span>{dateFormat date=$post.date_on|escape:'html':'UTF-8' full=0}</span>{/if}
                <div class="excerpt">{$post.excerpt|strip_tags:'UTF-8'|truncate:152:'...'}</div>
            </div>
            <div class="clear"></div>
        </li>
    {/foreach}
	</ul>
    </div>
</div>
{/if}
<!-- /Block psblog module -->
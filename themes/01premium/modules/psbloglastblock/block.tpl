
<!-- Block psblog module -->
{if $last_post_list && $last_post_list|@count > 0}
    <div id="last_posts_block" class="block informations_block_left">
	<h4>
	
        {if $blog_conf.rss_active}<a href="{$posts_rss_url}" title="RSS"><img src="{$modules_dir}psblog/img/rss.png" alt="RSS" /></a>{/if}
        
        &nbsp; <a href="{$linkPosts}" title="{l s='Recent posts' mod='psbloglastblock'}">{l s='Recent posts' mod='psbloglastblock'}</a></h4>
        
	<div class="block_content">
	
            <ul>
                {foreach from=$last_post_list item=post name=last_post_list}

                    <li {if $smarty.foreach.last_post_list.last} class="last_item" {/if}>

                        {if $post.default_img && $blog_conf.block_display_img}
                        <div style="float:left; width:{$blog_conf.img_block_width}px; margin-right:5px;">
                            <a href="{$post.link}"><img src="{$img_path}list/{$post.default_img_name}" width="{$blog_conf.img_block_width}" /></a>
                        </div>
                        {/if}

                        <div style="{if $post.default_img && $blog_conf.block_display_img} float:left; width:135px; {/if}">

                        <h5><a href="{$post.link}">{$post.title}</a></h5>
                        {if $blog_conf.block_display_date}<span>{dateFormat date=$post.date_on|escape:'html':'UTF-8' full=0}</span>{/if}
                        </div>

                         <div class="clear"></div>

                    </li>
                {/foreach}
            </ul>
            <br />
            <p><a href="{$linkPosts}" title="{l s='View all posts' mod='psbloglastblock'}">{l s='View all posts' mod='psbloglastblock'} &raquo;</a></p>
	</div>
</div>
{/if}
<!-- /Block psblog module -->
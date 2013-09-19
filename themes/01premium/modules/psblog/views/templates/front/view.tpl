<div class="breadcrumb">
    <a title="{l s='Back home' mod='psblog'}" href="{$base_dir}">{l s='Home' mod='psblog'}</a><span class="navigation-pipe">&gt;</span><span class="navigation_end"><a href="{$listLink}">{l s='Blog' mod='psblog'}</a></span>{if $post->status == 'published'} &gt; {$post->title} {/if}
</div>

{if $post->status == 'published'}
{assign var='img_ext' value = array('jpg','jpeg','png','gif')}
<div id="post_view">

    <div class="rte">
        {if $post->default_img}
        {if in_array($post->default_img.img_name|pathinfo:$smarty.const.PATHINFO_EXTENSION, $img_ext)}
        <div class="medias">
            <div class="media_list">
                <ul>     
                    <li>{if $blog_conf.view_display_popin}<a href="{$img_path}{$post->default_img.img_name}" rel="post" class="postpopin" title="{$post->title}">{/if}<img src="{$img_path}thumb/{$post->default_img.img_name}" width="{$blog_conf.img_width}" alt="{$post->title}" />{if $blog_conf.view_display_popin}</a>{/if}</li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        {else}
        <div class="medias">
            <div class="media_list">
                <video width="{$blog_conf.img_width}" height="{$blog_conf.img_width}" controls="controls">
                    <source src="{$img_path}{$post->default_img.img_name}" type="video/mp4">
                    <object data="" width="{$blog_conf.img_width}" height="{$blog_conf.img_width}">
                        <embed width="320" height="240" src="{$img_path}{$post->default_img.img_name}">
                    </object>
                </video>
            </div>
        </div>
        {/if}
        {/if}

        <div id="pb-left-column">
            <h1>{$post->title} {if $blog_conf.view_display_date}{/if}</h1> 
            <p><span>{l s='Published on' mod='psblog'} {dateFormat date=$post->date_on|escape:'html':'UTF-8' full=0}</span></p>
            {$post->content}
        </div>
    </div>
    <div class="clear"></div>
    {if isset($HOOK_NEWS_FOOTER) && $HOOK_NEWS_FOOTER}{$HOOK_NEWS_FOOTER}{/if}
</div>
{else}

<p class="warning">{l s='This post is not available' mod='psblog'}</p>

{/if}    











{*   

{if $blog_conf.share_active}
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
    <a class="addthis_button_compact"></a>
    <a class="addthis_button_email"></a>
    <a class="addthis_button_facebook"></a>
    <a class="addthis_button_twitter"></a>
    <a class="addthis_button_pinterest_share"></a>
    <a class="addthis_button_google_plusone"></a>

</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4debecd65fac86f2"></script>
<!-- AddThis Button END -->
{/if}

{if $blog_conf.related_active && $post_related|@count > 0}
<div class="related">
    <h3>{l s='Related blog posts' mod='psblog'}</h3>
    <ul>
        {foreach from=$post_related item=related_post name=related_list}
        <li>&raquo; <a href="{$related_post.link}">{$related_post.title}</a></li>
        {/foreach}
    </ul>
</div>
{$HOOK_NEWS_FOOTER|var_dump}
{if isset($HOOK_NEWS_FOOTER) && $HOOK_NEWS_FOOTER}{$HOOK_NEWS_FOOTER}{/if}
{/if}

{if $blog_conf.product_active}
{if $post_products|@count > 0}
<div class="products">
    <h3>{l s='Post related products' mod='psblog'}</h3>

    <ul>
        {foreach from=$post_products item=relatedProduct name=related_product_list}
        {cycle values='odd,even' assign='alternate'} 

        <li class="{if $smarty.foreach.related_product_list.first}first_item{elseif $smarty.foreach.related_product_list.last}last_item{else}item{/if} {$alternate}">   
            {if isset($relatedProduct.id_image) && $relatedProduct.id_image}
            <a href="{$relatedProduct.link}" title="{$relatedProduct.name|escape:'htmlall':'UTF-8'}" class="content_img"><img src="{$relatedProduct.imageLink}" alt="{$relatedProduct.name|escape:'htmlall':'UTF-8'}" /></a>
            {/if}
            <div class="text_desc">
                <h5><a href="{$relatedProduct.link}">{$relatedProduct.name|truncate:25:'...':true|escape:'htmlall':'UTF-8'}</a> {if $relatedProduct.reference != ''}<span>{$relatedProduct.reference}</span>{/if}</h5>
                <p><a href="{$relatedProduct.link}" title="{l s='More'}">{$relatedProduct.description_short|strip_tags|truncate:58:'...'}</a></p>
            </div>
            <div class="clear"></div>
        </li>
        {/foreach}
    </ul>

    <div class="clear"></div>
</div>
{/if}
{/if}



{if $blog_conf.comment_active && $post->allow_comments}

<div class="comments" id="postcomments">	 
    <h3>{l s='COMMENTS' mod='psblog'}</h3>

    {if isset($psblog_confirmation)}
    <p class="confirmation">
        {if !$blog_conf.comment_moderate}
        {l s='Comment posted successfully' mod='psblog'}
        {else}
        {l s='Comment posted, awaiting moderator validation' mod='psblog'}
        {/if}
    </p>
    {/if}

    {if isset($psblog_error) && $psblog_error == 'error_input'}
    <p class="error">{l s='Your comment has not been sent, name' mod='psblog'} ({$blog_conf.comment_name_min_length} {l s='chars min' mod='psblog'}) {l s='and comment are required.' mod='psblog'}</p>
    {/if}

    {if isset($psblog_error) && $psblog_error == 'error_already'}
    <p class="error">{l s='This message have been already sent' mod='psblog'}</p>
    {/if}

    {if isset($psblog_error) && $psblog_error == 'error_input_invalid'}
    <p class="error">{l s='HTML tags are not allowed' mod='psblog'}</p>
    {/if}

    {if isset($psblog_error) && $psblog_error == 'error_delay'}
    <p class="error">{$blog_conf.comment_min_time} {l s='seconds required between every comment' mod='psblog'}</p>
    {/if}

    <div class="clear sheets">

        {if isset($post_comments) && $post_comments|@count > 0}

        <table class="table_block" style="width: 100%">
            <thead>
                <tr>
                    <th class="first_item" style="width:100px;">{l s='From' mod='psblog'}</th>
                    <th class="item">{l s='Comment' mod='psblog'}</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$post_comments item=com name=comments_list}
                <tr>
                    <td>
                        <span class="bold">{$com.customer_name|escape:'html':'UTF-8'}</span>
                        <br /><span>{dateFormat date=$com.date_add|escape:'html':'UTF-8' full=0}</span>
                    </td>
                    <td><p>{$com.content|nl2br}</p></td>
                </tr>
                {/foreach}
            </tbody>
        </table>

        {else}
        <td colspan="2">{l s='No customer comments for the moment.' mod='psblog'}</td>
        {/if}

    </div>

    {if !isset($psblog_confirmation)}
    {if $logged == false && !$blog_conf.comment_guest}
    <p class="align_center">{l s='Only registered users can post a new comment.' mod='psblog'}</p>
    {else}
    <form id="sendComment" class="std" method="post" action="{$request_uri}#postcomments">
        <fieldset>
            <h3>{l s='Add a comment' mod='psblog'}</h3>
            <p class="text"><label for="blog_comment">{l s='Name:' mod='psblog'}</label>
                <input type="text" name="customer_name" value="{if isset($comment)}{$comment->customer_name}{else}{$customerName}{/if}" />
            </p>
            <p class="textarea">
                <label for="blog_comment">{l s='Comment:' mod='psblog'}</label>
                <textarea id="blog_comment" name="blog_comment" rows="5" cols="46">{if isset($comment)}{$comment->content}{/if}</textarea>
            </p>
            <p class="submit"><input type="submit" value="{l s='Send' mod='psblog'}" name="submitMessage" class="button"></p>	
        </fieldset>
    </form>
    {/if}
    {/if}
</div>
{/if}

</div>

{else}

<p class="warning">{l s='This post is not available' mod='psblog'}</p>

{/if}

*}
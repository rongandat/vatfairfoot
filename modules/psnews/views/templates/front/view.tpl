<div class="breadcrumb">
    <a title="{l s='Back home' mod='psnews'}" href="{$base_dir}">{l s='Home' mod='psnews'}</a><span class="navigation-pipe">&gt;</span><span class="navigation_end"><a href="{$listLink}">{l s='Blog' mod='psnews'}</a></span>{if $news->active == 1} &gt; {$news->name} {/if}
</div>
{if $news->active == 1}


<div id="primary_block" class="clearfix">
    <div id="pb-right-column">
        {if $news->youtube_id!=''}
        <a href="http://www.youtube.com/embed/{$news->youtube_id}?autoplay=1" class="various fancybox.iframe" title="{$news->name}" >
            {else}
            <a href="{$img_path}{$news->id_news|escape:'htmlall':'UTF-8'}-large_01prem.jpg" rel="other-views" class="single_photo" title="{$news->name}" >  
                {/if}
                <div id="image-block">
                    <span id="view_full_size">
                        <img id="bigpic" alt="{$news->name}" title="{$news->name}" src="{$img_path}{$news->id_news|escape:'htmlall':'UTF-8'}-large_01prem.jpg" style="display: inline;">
                        <span class="span_link_container"><span class="span_link">View full size</span></span>
                    </span>
                </div>
            </a>
    </div>
    <div id="pb-left-column">
        <h1>{$news->name}</h1>
        <div id="short_description_block">
            {$news->description}
        </div>
    </div>
    <div class="clear"></div>
    {if isset($HOOK_NEWS_FOOTER) && $HOOK_NEWS_FOOTER}{$HOOK_NEWS_FOOTER}{/if}
</div>

{else}

<p class="warning">{l s='This post is not available' mod='psnews'}</p>

{/if}    

<script>

    $(".various").fancybox({
        maxWidth: 800,
        maxHeight: 600,
        fitToView: false,
        width: '70%',
        height: '70%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none',
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        },
        
    });

    $(".single_photo").fancybox({
        openEffect: 'elastic',
        closeEffect: 'elastic',
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        },
        
    });
</script>
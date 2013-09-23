<style>
    .fancybox-title{
    font-weight: bold;
    font-size: 14px;
    padding-bottom: 10px;
}
.fancybox-title .video_des{
    font-style: italic;
    font-size: 12px;
}
#friend_list_wrap .jcarousel-clip-horizontal{
    width: 890px;
    margin: 0 auto;
}
#friend_list_wrap .product_list li{
    width: 310px;
}
#friend_list_wrap .jcarousel-prev{
    margin-left: 131px;
    margin-top: 7px;
}
#friend_list_wrap .jcarousel-next{
    margin-right: 130px;
    margin-top: 7px;
}
</style>
<link href="./js/jquery/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="./js/jquery/plugins/fancybox/jquery.fancybox.js"></script>
{assign var="i" value="0"}
{foreach from=$list_friends item=friend}
{assign var="i" value=$i+1}
{if count($friend.media) > 0}
<div class="jcarousel-container jcarousel-container-horizontal" style="padding-top: 20px;" id="friend_list_wrap">
    <h1 style="display: block;">{$friend.name}</h1>
    <ul class="product_list jq_carousel_friend">
        {foreach from=$friend.media item=media name=myLoop}
        <li class="ajax_block_product">
            
            {if $media.youtube_id!=''}
            <a href="http://www.youtube.com/embed/{$media.youtube_id}?autoplay=1" class="various fancybox.iframe" title="{$media.title}" my_title="{l s='Friend name' mod='myfriends'} {$friend.name} {if $friend.website!=''}<br> {l s='Friend website' mod='myfriends'} {$friend.website} {/if} {if $friend.facebook!=''}<br> {l s='Friend facebook' mod='myfriends'} {$friend.facebook}{/if}">
            {else}
               <a href="http://{$smarty.server.HTTP_HOST}{$img_friend_dir}{$media.id_friend_data|escape:'htmlall':'UTF-8'}.jpg" rel="other-views" class="single_photo" title="{$media.title}" my_title="{l s='Friend name' mod='myfriends'} {$friend.name} {if $friend.website!=''}<br> {l s='Friend website' mod='myfriends'} {$friend.website} {/if} {if $friend.facebook!=''}<br> {l s='Friend facebook' mod='myfriends'} {$friend.facebook}{/if}">  
            {/if}
                <div class="content">
                    <h2 class="title">{$media.title}</h2><br />
                </div>
                <div class="image">
                    <img src="{$img_friend_dir}{$media.id_friend_data|escape:'htmlall':'UTF-8'}-large_default.jpg" alt="" />
                </div>	
            </a>
        </li>
        {/foreach}
    </ul>
</div>
{/if}
<script>
    jQuery('.jq_carousel_friend').jcarousel({
		scroll:3,
	});
    $(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
        helpers : {
            title: {
                type: 'inside',
                position: 'top'
                }
        },
        beforeShow: function () {
            if (this.title) {
                // New line
                this.title += '<br />';  
                this.title += $(this.element).attr("my_title") + '<br />';
                // Add FaceBook like button
                this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="true"></iframe>';
            }
        }
    });
    
    $(".single_photo").fancybox({
    	openEffect	: 'elastic',
    	closeEffect	: 'elastic',
        helpers : {
            title: {
                type: 'inside',
                position: 'top'
                }
        },
        beforeShow: function () {
            if (this.title) {
                // New line
                this.title += '<br />';  
                this.title += $(this.element).attr("my_title") + '<br />';
                // Add FaceBook like button
                this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="true"></iframe>';
            }
        }
    });
</script>
{/foreach}

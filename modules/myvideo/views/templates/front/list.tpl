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
</style>
<link href="./js/jquery/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="./js/jquery/plugins/fancybox/jquery.fancybox.js"></script>
{assign var="i" value="0"}
{foreach from=$list_categories item=category}
{assign var="i" value=$i+1}
{if count($category.video) > 0}
<div class="jcarousel-container jcarousel-container-horizontal" style="padding-top: 20px;">
    <h1 style="display: block;">{$category.name}</h1>
    <ul class="product_list jq_carousel_home">
        {foreach from=$category.video item=video name=myLoop}
        <li class="ajax_block_product">
            <a href="http://www.youtube.com/embed/{$video.youtube_id}?autoplay=1" class="various fancybox.iframe" title="{$video.title}" my_title="{$video.description|escape:'htmlall':'UTF-8'}">
                <div class="content">
                    <h2 class="title">{$video.title}</h2><br />
                </div>
                <div class="image">
                    <img src="{$img_video_dir}{$video.id_video|escape:'htmlall':'UTF-8'}-home_01prem.jpg" alt="" />
                </div>	
            </a>
        </li>
        {/foreach}
    </ul>
</div>
{/if}
<script>
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
                this.title += '<div class="video_des"> ' + $(this.element).attr("my_title") + '</div><br />';
                // Add FaceBook like button
                this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="true"></iframe>';
            }
        }
    });
</script>
{/foreach}

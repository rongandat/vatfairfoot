<style>
    .fancybox-title{
        font-weight: bold;
        font-size: 14px;
        padding-bottom: 10px;
    }
    .fancybox-title .photo_des{
        font-style: italic;
        font-size: 12px;
    }
</style>
<link href="./js/jquery/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="./js/jquery/plugins/fancybox/jquery.fancybox.js"></script>
{assign var="i" value="0"}
{foreach from=$list_categories item=category}
{assign var="i" value=$i+1}
{if count($category.photos) > 0}
<div class="jcarousel-container jcarousel-container-horizontal" style="padding-top: 20px;">
    <h1 style="display: block;">{$category.name}</h1>
    <ul class="product_list jq_carousel_home">
        {foreach from=$category.photos item=photo name=myLoop}
        <li class="ajax_block_product">
            <a href="http://{$smarty.server.HTTP_HOST}{$img_photo_dir}{$photo.id_photo|escape:'htmlall':'UTF-8'}.jpg" rel="other-views" content="{$photo.id_photo}" class="thickbox{$category.id_photo_cat}" title="{$photo.title}">
                <div class="content">
                    <h2 class="title">{$photo.title}</h2><br />
                    <textarea style="display: none" id="photo_des{$photo.id_photo}">{$photo.description}</textarea>
                    <input type="hidden" id="average{$photo.id_photo}" value="{$photo.average}"/>
                </div>
                <div class="image">
                    <img src="{$img_photo_dir}{$photo.id_photo|escape:'htmlall':'UTF-8'}-home_01prem.jpg" alt="" />
                </div>	
            </a>
        </li>
        {/foreach}
    </ul>
</div>
{/if}
<script>

    var cat_id = '{$category.id_photo_cat}';
    $('.thickbox' + cat_id).fancybox({
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 600,
        'speedOut': 200,
        'overlayShow': false,
        'cyclic': true,
        'showNavArrows': true,
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        },
        beforeShow: function() {
            if (this.title) {
                // New line
                var id_photo = $(this.element).attr("content");
                this.title += '<br />';
                this.title += '<div class="photo_des">' + $('#photo_des' + id_photo).val() + '</div><br />';
                this.title += '<div class="exemple4" data-average="' + $('#average' + id_photo).val() + '<" data-id="' + id_photo + '"></div><br />';
                // Add FaceBook like button
                this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="true"></iframe>';
            }
        },
        afterShow: function() {
            $('.exemple4').jRating({
                bigStarsPath: 'jRating/jquery/icons/stars.png', // path of the icon stars.png
                smallStarsPath: 'jRating/jquery/icons/small.png', // path of the icon small.png
                rateMax: 10, // maximal rate - integer from 0 to 9999 (or more)
                phpPath: '{$base_dir}?fc=module&module=myphotos&controller=ratting', // path of the php file jRating.php
                type: 'big', // can be set to 'small' or 'big'
                onSuccess: function(a,b) {
                    console.debug(a);
                    console.debug(b);
                    alert('Success : your rate has been saved');
                },
                onError: function(a,b) {
                    console.debug(a);
                    console.debug(b);
                    {if empty($customer)}
                    alert('Error : you haven\'t yet login');
                    {else}
                    alert('Error : you have rated for image');
                    {/if}
                    
                }
            });
        }
    });
</script>
{/foreach}

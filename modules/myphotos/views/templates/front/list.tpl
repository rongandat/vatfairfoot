<link href="/js/jquery/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/js/jquery/plugins/fancybox/jquery.fancybox.js"></script>
{assign var="i" value="0"}
{foreach from=$list_categories item=category}
{assign var="i" value=$i+1}
{if count($category.photos) > 0}
<div class="jcarousel-container jcarousel-container-horizontal" style="padding-top: 20px;">
    <h1 style="display: block;">{$category.name}</h1>
    <ul class="product_list jq_carousel_home">
        {foreach from=$category.photos item=photo name=myLoop}
        <li class="ajax_block_product">
            <a href="{$img_photo_dir}{$photo.id_photo|escape:'htmlall':'UTF-8'}-thickbox_01prem.jpg" rel="other-views" class="thickbox{$category.id_photo_cat}">
                <div class="content">
                    <h2 class="title">{$photo.title}<span>{$photo.description|truncate:35:'...'|escape:'htmlall':'UTF-8'}</span></h2><br />

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
    var cat_id  = '{$category.id_photo_cat}';
    $('.thickbox'+cat_id).fancybox({
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 600,
        'speedOut': 200,
        'overlayShow': false,
        'cyclic': true,
        'showNavArrows': true
    });
</script>
{/foreach}

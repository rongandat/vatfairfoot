{*
	toggle view 
	grig/list

	author : Guillaume Laroche
	pixmasta.com
*}

<div class="jq_toggle_view">
	<span class="label">{l s='View:'}</span>
	<a href="#" class="list{if (isset($category_view) && $category_view=='list')} active{/if}" title="{l s='List'}"></a>
	<a href="#" class="grid{if (isset($category_view) && $category_view=='grid')} active{/if}" title="{l s='Grid'}"></a>
</div>
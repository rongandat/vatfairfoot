
<div id="post_search_block" class="block">
	<h4>{l s='Search in Blog' mod='psblogblocksearch'}</h4>
        
            <form method="get" action="{$linkPosts}" id="searchbox">
                <div class="block_content">
                        
                    {if isset($search_query_nb) && $search_query_nb > 0}
                        <p class="results">
                            <a href="{$linkPosts}?search={$search_query}">
                                {$search_query_nb} {l s='Result for the term' mod='psblogblocksearch'} "{$search_query}"
                            </a>
                        </p>
                    {/if}

                    <p>
                        <input type="text" name="search" value="{if isset($search_query)}{$search_query|htmlentities:$ENT_QUOTES:'utf-8'|stripslashes}{/if}" />
                        <input type="submit" class="button_mini" value="{l s='go' mod='psblogblocksearch'}" />
                    </p>
                    
		</div>
	</form>

</div>
{foreach from=$resultat key=i item=resultats name=foo}


    {if $i == 0 || $i==3 || $i==6 || $i==9 || $i==12 }


        {if $resultats.device != _3}
            <section class="line mb2 grid">
            <div class="grid3">
        {/if}

    {/if}



    {if $resultats.device != _3}
        <div>
            <article itemscope itemtype="http://schema.org/Article">
                <div class="relative"><a itemprop="url" href="{$resultats.url}"
                                         title="{$resultats.titre}"><img itemprop="image" src="{$resultats.image}"
                                                                           alt="{$resultats.legende}" width="330"
                                                                           height="330" class="clear mb1 borderGray"/></a></div>
                <a itemprop="url" href="{$resultats.url}" title="{$resultats.titre}"><h1 class="h2-like m-reset"
                                                                                         itemprop="headline">{$resultats.titre}</h1>
                </a>
                <span itemprop="description">{$resultats.chapeau|truncate:150:" [...]"}</span>
            </article>
        </div>
    {else}
        <article class="line mb1 pa1 zebre" itemscope itemtype="http://schema.org/Article">
            <a href="{$resultats.url}" title="{$resultats.titre}" rel="nofollow"><img width="120" height="120"
                                                                                      class="left"
                                                                                      src="{$resultats.image}"
                                                                                      alt="{$resultats.titre}"
                                                                                      align="left"/></a>
            <a href="{$resultats.url}" title="{$resultats.titre}"><h1
                        class="h3-like p-reset m-reset">{$resultats.titre}</h1></a>
            <span itemprop="description" class="small">{$resultats.chapeau|truncate:50:" [...]"}</span>
        </article>
    {/if}



    {if $i == 2 || $i==5 || $i==8 || $i==11 || $smarty.foreach.foo.last }

        {if $resultats.device != _3}
            </div>
            </section>
        {/if}

    {/if}




{/foreach}




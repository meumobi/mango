{foreach from=$resultat key=i item=resultats name=foo}


        {if $resultats.device != _3}
            <div class="line mb2">
                    <div class="relative"><a href="{$resultats.url}" title="{$resultats.titre}">{if $resultats.video==true}<div class="play play-petit">&nbsp;</div>{/if}<img src="{$resultats.image}" alt="{$resultats.legende}" width="280" height="140" class="left mb1" /></a></div>
                    <a href="{$resultats.url}" title="{$resultats.titre}"><h1 class="h2-like m-reset">{if $resultats.type_news != NULL} {$resultats.type_news} - {/if}{$resultats.titre}</h1></a>
                    <span>{$resultats.chapeau|truncate:100:" [...]"}</span>
            </div>
        {else}
            <div class="line mb1 pa1 zebre">
                <a href="{$resultats.url}" title="{$resultats.titre}" rel="nofollow"><img width="120" height="70" class="left" src="{$resultats.image}" alt="{$resultats.titre}" align="left" /></a>
                <a href="{$resultats.url}" title="{$resultats.titre}"><h1 class="h3-like p-reset m-reset small">{$resultats.titre}</h1></a>
            </div>
        {/if}



{/foreach}




{foreach from=$resultat key=i item=resultats name=foo}

    {if $smarty.foreach.foo.first}
        {* Affiche le premier contenu avec une grande photo  *}

        {if $resultats.device != _3}

            {* Affiche le premier contenu avec une grande photo  *}
            <article itemscope itemtype="http://schema.org/Article" class="line bgBlack mb3">

                <div class="left mod tabW100 relative">
                    <a itemprop="url" href="{$resultats.url}" title="{$resultats.titre}">
                        {* Affiche le player video  *}
                        {if $resultats.video==true}<div class="play play-grand">&nbsp;</div>{/if}
                        <img itemprop="image" src="{$resultats.image_une}" alt="{$resultats.legende}" width="660" height="330" class="borderRightWithe tabW100" />
                    </a>
                </div>


                <time itemprop="dateCreated" datetime="{$resultats.date_publication|date_format:'%d/%m/%Y'}"></time>
                <div class="mod pa2 tabblet-clearB">
                    <a itemprop="url" href="{$resultats.url}" title="{$resultats.titre}"><h1 class="m-reset p-reset h1-like fontWhite" itemprop="headline">{if $resultats.type_news != NULL} {$resultats.type_news} - {/if}{$resultats.titre}</h1></a>
                    <p class="mod mt1 big fontWhite phone-hidden" itemprop="description">{$resultats.chapeau|truncate:150:" [...]"}</p>
                </div>
                {$resultats.path}

            </article>

        {else}

            <article itemscope itemtype="http://schema.org/Article" class="line mb3">
                <div class="W100">
                    <a itemprop="url" href="{$resultats.url}" title="{$resultats.titre}">
                        {* Affiche le player video  *}
                        {if $resultats.video==true}<div class="play play-grand">&nbsp;</div>{/if}
                        <img itemprop="image" src="{$resultats.image_une}" alt="{$resultats.legende}" />
                    </a>
                </div>

                <time itemprop="dateCreated" datetime="{$resultats.date_publication|date_format:'%d/%m/%Y'}"></time>
                <div class="line bgGrisClair pa05">
                    <a itemprop="url" href="{$resultats.url}" title="{$resultats.titre}"><h1 class="m-reset p-reset h4-like" itemprop="headline">{if $resultats.type_news != NULL} {$resultats.type_news} - {/if}{$resultats.titre}</h1></a>
                    <p class="mod mt1" itemprop="description">{$resultats.chapeau|truncate:150:"[...]"}</p>
                </div>
            </article>

        {/if}



    {else}

        {if $i == 3}
            {if $resultats.device == _3}
                {include file='/var/www/vhosts/mango-surf.com/www/lib/template/inscription-nl.tpl'}

            {/if}

        {/if}

        {if $i == 7}

        {/if}


        {if $resultats.device != _3}

            {if $i == 1}
                <aside class="mod right wColDroite phone-hidden tablet-hidden">
                    <!-- box publicite pave -->
                    <div class="line mb2 pa1 bgGrisClair txtcenter" >
                        <div id="5008876"><noscript><a href="http://adserver.adtech.de/adlink|3.0|1502.1|5008876|0|170|ADTECH;loc=300;key=key1+key2+key3+key4;alias=" target="_blank"><img src="http://adserver.adtech.de/adserv|3.0|1502.1|5008876|0|170|ADTECH;loc=300;key=key1+key2+key3+key4;alias=" border="0" width="300" height="250"></a></noscript></div>

                    </div>

                    <section class="mb2">
                        <div class="titreRubrique line mb2">Inscription Newsletter</div>
                        <form action="http://mango-surf.us6.list-manage1.com/subscribe/post?u=8409ca683c7a680d87e380f2a&amp;id=2a787bac56" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup">
                                <label for="mce-EMAIL">Inscrivez-vous dès maintenant et recevez les informations de la planète surf à ne pas manquer  ! - <a href="/corporate/newsletter.php?id=1" title="Voir un exemple" target="_blank">Voir un exemple</a></label>
                                <input type="email" value="" name="EMAIL" class="w100 pa1 mt1 mb1 borderGray" id="mce-EMAIL" placeholder="Votre email" required>
                                <input type="submit" value="Inscrivez-vous" name="subscribe" id="mc-embedded-subscribe" class="bouton">
                            </div>
                        </form>
                    </section>
                </aside>
            {/if}


            <div class="mod wColCentre mbm">

                <div class="relative"><a href="{$resultats.url}" title="{$resultats.titre}">{if $resultats.video==true}<div class="play play-petit">&nbsp;</div>{/if}<img src="{$resultats.image}" alt="{$resultats.legende}" width="280" height="140" class="left mb1" /></a></div>
                <a href="{$resultats.url}" title="{$resultats.titre}"><h1 class="h2-like m-reset">{if $resultats.type_news != NULL} {$resultats.type_news} - {/if}{$resultats.titre}</h1></a>
                <span>{$resultats.chapeau|truncate:110:" [...]"}</span>
            </div>
        {else}
            <div class="line mb1 pa05 zebre">
                <a href="{$resultats.url}" title="{$resultats.titre}" rel="nofollow"><img width="120" height="70" class="left" src="{$resultats.image}" alt="{$resultats.titre}" align="left" /></a>
                <a href="{$resultats.url}" title="{$resultats.titre}"><h1 class="h1-like p-reset m-reset small">{$resultats.titre}</h1></a>
            </div>
        {/if}





    {/if}

{/foreach}




{foreach from=$resultat key=i item=resultats name=foo}
	
	{if $smarty.foreach.foo.first}

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
                    <p class="mod mt1 big fontWhite phone-hidden" itemprop="description">{$resultats.chapeau|truncate:150:""}</p>
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
	
	{if $i == 1 || $i==4 || $i==7 || $i==10 || $i==13 }
	
		{* Affiche un bloc au après le 4ème article *}
		{if $i==4 && $resultats.bloc1==true}
			
			{* Pub Destination surf / Rubrique Trip surf *}
			{if $resultats.rubrique == 3}
				
				{include file='/var/www/vhosts/mango-surf.com/www/lib/template/m-destination-surf.tpl'}
						
			{/if}
		
		
		{/if}
		
		
		{* Affiche un bloc au après le 13ème article *}
		{if $i==13 && $resultats.bloc1==true}
			
			{* Annuaire des surf camp / Rubrique Trip surf *}
			{if $resultats.rubrique == 3}
				
				{*include file='/var/www/vhosts/mango-surf.com/www/lib/template/m-destination-surf.tpl'*}
						
			{/if}
		
		
		{/if}

        {if $resultats.device != _3}
            <section class="line mb2 grid">
            <div class="grid3">
        {/if}
	
	{/if}

        {if $resultats.device != _3}
            <div>
                <article itemscope itemtype="http://schema.org/Article">
                    <div class="relative"><a itemprop="url" href="{$resultats.url}" title="{$resultats.titre}">{if $resultats.video==true}<div class="play play-petit">&nbsp;</div>{/if}<img itemprop="image" src="{$resultats.image}" alt="{$resultats.legende}" width="320" height="160" class="clear mb1" /></a></div>
                    <time itemprop="dateCreated" datetime="{$resultats.date_publication|date_format:'%d/%m/%Y'}"></time>
                    <a itemprop="url" href="{$resultats.url}" title="{$resultats.titre}"><h1 class="h2-like m-reset" itemprop="headline">{if $resultats.type_news != NULL} {$resultats.type_news} - {/if}{$resultats.titre}</h1></a>
                    <span itemprop="description">{$resultats.chapeau}</span>
                </article>
            </div>
        {else}
            <article class="line mb1 pa1 zebre" itemscope itemtype="http://schema.org/Article">
                <a href="{$resultats.url}" title="{$resultats.titre}" rel="nofollow"><img width="120" height="70" class="left" src="{$resultats.image}" alt="{$resultats.titre}" align="left" /></a>
                <a href="{$resultats.url}" title="{$resultats.titre}"><h1 class="h3-like p-reset m-reset">{$resultats.titre}</h1></a>
            </article>
        {/if}


	
	{if $i == 3 || $i==6 || $i==9 || $i==12 || $smarty.foreach.foo.last }

        {if $resultats.device != _3}
            </div>
            </section>
        {/if}

	{/if}
	
	
	{/if}

{/foreach}




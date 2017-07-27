<?php if($device[1] == "_1"){ ?>

    <header id="header" role="banner" class="header-mango-desktop">
        <div class="wSite line">

            <div class="mod left mrm" itemscope itemtype="http://schema.org/Organization">
                <a itemprop="url" href="/" title="L'actualité du surf-Mango-surf.com"><img src="/lib/image/template/logo-mango-surf-2015.png" itemprop="logo" alt="L'actualité du surf-Mango-surf.com" width="90" height="90" border="0" /></a>
            </div>
            <div class="mod right mtl">
                <nav id="navigation" role="navigation">
                    <ul class="unstyled inbl p-reset mtm">
                        <li class="left mr2"><a href="/news/" title="L'actualité du surf" class="menu-mango-desktop <?php if($rubrique == 1) echo 'menu-mango-hover-desktop'; ?>">News</a></li>
                        <li class="left mr2"><a href="/video/" title="Vidéos de surf surf" class="menu-mango-desktop <?php if($rubrique == 9) echo 'menu-mango-hover-desktop'; ?>">Videos</a></li>
                        <li class="left mr2"><a href="/galerie-photo/" title="Photos de surf" class="menu-mango-desktop <?php if($rubrique == 17) echo 'menu-mango-hover-desktop'; ?>">En image</a></li>
                        <li class="left mr2"><a href="/trip-surf/" title="Surf Trip" class="menu-mango-desktop <?php if($rubrique == 3) echo 'menu-mango-hover-desktop'; ?>">Voyage</a></li>
                        <li class="left mr2"><a href="/news/outdoor/" title="Outdoor" class="menu-mango-desktop <?php if($categorie == 48) echo 'menu-mango-hover-desktop'; ?>">Outdoor</a></li>
                        <li class="left mr2"><a href="/shopping/" title="Shop'in" class="menu-mango-desktop <?php if($rubrique == 15) echo 'menu-mango-hover-desktop'; ?>">Tendance</a></li>
                        <li class="left mr2"><a href="/agenda/" title="L'agenda du surf" class="menu-mango-desktop <?php if($rubrique == 16) echo 'menu-mango-hover-desktop'; ?>">Agenda</a></li>
                        <li class="left mr2"><a href="/annuaire/" title="Annuaires" class="menu-mango-desktop <?php if($rubrique == 14) echo 'menu-mango-hover-desktop'; ?>">Annuaires</a></li>
                        <li class="left"><a href="/lexique/" title="Le lexique du surf" class="menu-mango-desktop <?php if($rubrique == 10) echo 'menu-mango-hover-desktop'; ?>">Lexique</a></li>
                    </ul>
                </nav>
            </div>

        </div>


    </header>

    <!-- Publicite -->
    <div class="wrapper line">
        <div class="wSite line txtcenter">

            <div id="5008877"><noscript><a href="http://adserver.adtech.de/adlink|3.0|1502.1|5008877|0|225|ADTECH;loc=300;key=key1+key2+key3+key4;alias=" target="_blank"><img src="http://adserver.adtech.de/adserv|3.0|1502.1|5008877|0|225|ADTECH;loc=300;key=key1+key2+key3+key4;alias=" border="0" width="728" height="90"></a></noscript></div>

            <div class="line">&nbsp;</div>
        </div>
    </div>
    <!-- Publicite -->

<?php } else { ?>

    <header class="header-mango-mobile">


        <div class="txtcenter mt5" itemscope itemtype="http://schema.org/Organization">
            <a itemprop="url" href="/" title="L'actualité du surf-Mango-surf.com"><img src="/lib/image/template/logo-mango-surf-2015.png" itemprop="logo" alt="L'actualité du surf-Mango-surf.com" width="50" height="50" border="0" /></a>
        </div>

        <a href="#menu" class="toggle-menu" aria-role="button"><i class="ion-android-menu"></i></a>
    </header>
    <nav id="menu">
        <a href="#" class="toggle-menu toggle-menu-close" aria-role="button"><i class="ion-close"></i></a>
        <ul>
            <li><a href="/news/" class="lnk-menu <?php if($rubrique == 1) echo 'menu-mango-hover'; ?>" title="L'actualité du surf">News</a></li>
            <li><a href="/video/" class="lnk-menu <?php if($rubrique == 9) echo 'menu-mango-hover'; ?>" title="Vidéos de surf surf">Videos</a></li>
            <li><a href="/galerie-photo/" class="lnk-menu <?php if($rubrique == 17) echo 'menu-mango-hover'; ?>" title="Photos de surf">En image</a></li>
            <li><a href="/trip-surf/" class="lnk-menu <?php if($rubrique == 3) echo 'menu-mango-hover'; ?>" title="Surf Trip">Voyage</a></li>
            <li><a href="/news/outdoor/" class="lnk-menu <?php if($categorie == 48) echo 'menu-mango-hover'; ?>" title="Outdoor">Outdoor</a></li>
            <li><a href="/shopping/" class="lnk-menu <?php if($rubrique == 15) echo 'menu-mango-hover'; ?>" title="Shop'in">Tendance</a></li>
            <li><a href="/agenda/" class="lnk-menu <?php if($rubrique == 16) echo 'menu-mango-hover'; ?>" title="L'agenda du surf">Agenda</a></li>
            <li><a href="/annuaire/" class="lnk-menu <?php if($rubrique == 14) echo 'menu-mango-hover'; ?>" title="Annuaires">Annuaires</a></li>
            <li><a href="/lexique/" class="lnk-menu <?php if($rubrique == 10) echo 'menu-mango-hover'; ?>" title="Lexique">Lexique</a></li>
        </ul>
    </nav>

    <!-- Publicite -->
    <div class="wrapper line">
        <div class="wSite line txtcenter">

            <div id="5008877"><noscript><a href="http://adserver.adtech.de/adlink|3.0|1502.1|5008877|0|225|ADTECH;loc=300;key=key1+key2+key3+key4;alias=" target="_blank"><img src="http://adserver.adtech.de/adserv|3.0|1502.1|5008877|0|225|ADTECH;loc=300;key=key1+key2+key3+key4;alias=" border="0" width="728" height="90"></a></noscript></div>

            <div class="line">&nbsp;</div>
        </div>
    </div>
    <!-- Publicite -->

<?php } ?>
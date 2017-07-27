<?php

//Pour afficher le bon chemin
/*$pathSideBar = explode("/",$_SERVER['PHP_SELF']);
$nbrChemin = count($pathSideBar);

if ($nbrChemin == 2) $cheminSideBar="";
elseif ($nbrChemin == 3) $cheminSideBar .= "../";
elseif ($nbrChemin == 4) $cheminSideBar .= "../../";*/



?>


<aside class="mod left wColDroite phone-hidden tablet-hidden">

test
    <?php require($cheminSideBar."lib/include/n_b-newsletter.php"); ?>


    <!-- box publicite pave -->
    <div class="line mb2 pa1 bgGrisClair txtcenter" >
        <!--<script type='text/javascript' id='div-gpt-ad-1385199416224-2'>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385199416224-2'); });
        </script>-->

        <?php if($publicite == 1){ ?>

            <iframe id='a44cbced' name='a44cbced' src='http://ads.regie24h00.com/www/delivery/afr.php?zoneid=34&amp;cb=INSERT_RANDOM_NUMBER_HERE' frameborder='0' scrolling='no' width='300' height='250'><a href='http://ads.regie24h00.com/www/delivery/ck.php?n=ae1f9242&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://ads.regie24h00.com/www/delivery/avw.php?zoneid=34&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=ae1f9242' border='0' alt='' /></a></iframe>
        <?php } else { ?>

            <iframe id='a44cbced' name='a44cbced' src='http://ads.regie24h00.com/www/delivery/afr.php?zoneid=34&amp;cb=INSERT_RANDOM_NUMBER_HERE' frameborder='0' scrolling='no' width='300' height='250'><a href='http://ads.regie24h00.com/www/delivery/ck.php?n=ae1f9242&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://ads.regie24h00.com/www/delivery/avw.php?zoneid=34&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=ae1f9242' border='0' alt='' /></a></iframe>
        <? } ?>

    </div>

    <!-- box publicite -->



    <?php

    if($nbrChemin > 2){

        require($cheminSideBar."lib/include/n_b-last-news.php");
        ?>

        <!-- box publicite pave -->
        <div class="line mb2 pa1 bgGrisClair txtcenter" >
            <!--<script type='text/javascript' id='div-gpt-ad-1385199416224-2'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385199416224-2'); });
            </script>-->

            <?php if($publicite == 1){ ?>

                <iframe id='a44cbced' name='a44cbced' src='http://ads.regie24h00.com/www/delivery/afr.php?zoneid=34&amp;cb=INSERT_RANDOM_NUMBER_HERE' frameborder='0' scrolling='no' width='300' height='250'><a href='http://ads.regie24h00.com/www/delivery/ck.php?n=ae1f9242&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://ads.regie24h00.com/www/delivery/avw.php?zoneid=34&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=ae1f9242' border='0' alt='' /></a></iframe>

            <?php } else { ?>


                <iframe id='a44cbced' name='a44cbced' src='http://ads.regie24h00.com/www/delivery/afr.php?zoneid=34&amp;cb=INSERT_RANDOM_NUMBER_HERE' frameborder='0' scrolling='no' width='300' height='250'><a href='http://ads.regie24h00.com/www/delivery/ck.php?n=ae1f9242&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://ads.regie24h00.com/www/delivery/avw.php?zoneid=34&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=ae1f9242' border='0' alt='' /></a></iframe>
            <? } ?>

        </div>


        <?php

        require($cheminSideBar."lib/include/n_b-shopping.php");

        require($cheminSideBar."lib/include/n_b-photo.php");

    }
    ?>

</aside>


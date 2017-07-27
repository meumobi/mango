<?php

//Pour afficher le bon chemin
/*$pathSideBar = explode("/",$_SERVER['PHP_SELF']);
$nbrChemin = count($pathSideBar);

if ($nbrChemin == 2) $cheminSideBar="";
elseif ($nbrChemin == 3) $cheminSideBar .= "../";
elseif ($nbrChemin == 4) $cheminSideBar .= "../../";*/



?>


<aside class="mod right wColDroite phone-hidden tablet-hidden">


	<?php require($cheminSideBar."lib/include/n_b-newsletter.php"); ?>


	<!-- box publicite pave -->	
	<div class="line mb2 pa1 bgGrisClair txtcenter" >
        <div id="5008876"><noscript><a href="http://adserver.adtech.de/adlink|3.0|1502.1|5008876|0|170|ADTECH;loc=300;key=key1+key2+key3+key4;alias=" target="_blank"><img src="http://adserver.adtech.de/adserv|3.0|1502.1|5008876|0|170|ADTECH;loc=300;key=key1+key2+key3+key4;alias=" border="0" width="300" height="250"></a></noscript></div>

	</div>

	<!-- box publicite -->
	
	
	
	<?php
	
	if($nbrChemin > 2){
	
		require($cheminSideBar."lib/include/n_b-last-news.php");
	?>
	
	
	<?php
	
		require($cheminSideBar."lib/include/n_b-shopping.php");

		require($cheminSideBar."lib/include/n_b-photo.php"); 
		
	}
	?>
	
</aside>


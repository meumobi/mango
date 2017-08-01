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

	<!-- Publicite -->

    <div class="line mb2 pa1 bgGrisClair txtcenter" >
        <div id="6490489"></div>
    </div>
    <!-- Publicite -->
	
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


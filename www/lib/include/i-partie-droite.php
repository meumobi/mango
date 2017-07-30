<?php

//Pour afficher le bon chemin
$pathSideBar = explode("/",$_SERVER['PHP_SELF']);
$nbrChemin = count($pathSideBar);

if ($nbrChemin == 2) $cheminSideBar="";
elseif ($nbrChemin == 3) $cheminSideBar .= "../";
elseif ($nbrChemin == 4) $cheminSideBar .= "../../";



?>

<aside id="pub">
	
	
	<?php
	
	//Dernière news
	if($nbrChemin > 2){
	
		require($cheminSideBar."lib/include/b-last-news.php"); 
	}
	
	?>
	
	
	
	
	<?php 
	//inscription newsletter
	require($cheminSideBar."lib/include/b-newsletter.php"); 
	?>
	
	<?php 
	//Bouton share
	require($cheminSideBar."lib/include/b-share.php"); 
	?>
	
	<?php 
		//box photo
		if(empty($no_photo)){
			if($nbrChemin != 2){require($cheminSideBar."lib/include/b-photo.php");} 
		}
	?>
	
		
		<?php if(empty($no_sky)){ ?>
		
		<div class="flotG logo bgblanc bloc_arrondie padD10 padG10 padT23 alignC">
			<?php
			if($nbrChemin == 2){
				require($cheminSideBar."lib/include/b-logo.php"); 
			}else{
				require($cheminSideBar."lib/include/b-shopping.php"); 

			}
			
			
			?>
		</div>
	
		<div class="flotG sky">
			<!-- Sky_160x600-2 -->
			<div id='div-gpt-ad-1361306313041-0' style='width:160px; height:600px;'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1361306313041-0'); });
				</script>
			</div>
		</div>

		<div class="clearB mrgB10 mrgT10"> </div>
		
		<?php } ?>

</aside>


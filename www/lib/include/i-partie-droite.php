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
	
	<!-- box publicite pave -->	
	<div class="mrgB20">
	<!--
	<script type="text/javascript">
if (!window.OX_ads) { OX_ads = []; }
OX_ads.push({ "auid" : "218049" });
</script>
<script type="text/javascript">
document.write('<scr'+'ipt src="http://ox-d.adventuremediaglobal.com/w/1.0/jstag"><\/scr'+'ipt>');
</script>
<noscript><iframe id="52161a5c5b772" name="52161a5c5b772" src="http://ox-d.adventuremediaglobal.com/w/1.0/afr?auid=218049&cb=INSERT_RANDOM_NUMBER_HERE" frameborder="0" scrolling="no" width="300" height="250"><a href="http://ox-d.adventuremediaglobal.com/w/1.0/rc?cs=52161a5c5b772&cb=INSERT_RANDOM_NUMBER_HERE" ><img src="http://ox-d.adventuremediaglobal.com/w/1.0/ai?auid=218049&cs=52161a5c5b772&cb=INSERT_RANDOM_NUMBER_HERE" border="0" alt=""></a></iframe></noscript>
-->

	
	
	
	
	
	<div id='div-gpt-ad-1361306082999-0' style='width:300px; height:250px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1361306082999-0'); });
		</script>
	</div>
		
	</div>
	<!-- box publicite -->
	
	
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


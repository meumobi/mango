<?php 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/f-all.php");
require("../lib/fonction/f-formulaire.php");
$no_sky = 1;
$no_photo = 1;

?>

<?php require("../lib/include/n_i-meta.php"); ?>	
<title>Widget News</title>

</head>

<body>

<div class="wSite">

	<?php require("../lib/include/n_i-header.php"); ?>	
			
	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1">Widget News</div>
			<div class="content bloc_arrondie">
			
			<?php echo fil_ariance("Accueil","../","Widget News","widget-news.php","","","",""); ?>
			
			<div class="overflow mrgT20 mrgB20 pad10" id="introduction">
				<h1 class="accroche">Publiez les news sur votre site !</h1>
				Vous souhaitez faire vivre votre site au quotidien <strong>pour attirer toujours plus de visiteurs</strong> ! Nous vous proposons d'intégrer sur votre site notre Widget News.<br /><br />
				C'est très simple, vous renseignez via le formulaire quelques paramètre, vous validez, vous copier coller le code sur votre site et les news apparaissent !
			</div>

			<form action="widget-news.php" method="POST" name="widget-news">
				<?php require("../lib/formulaire/n_form-widget-news.php"); ?>
			</form>
			<br /><br />
			
			<?php 
			if(!empty($_POST["nbr_news"])) { 
				$url ='<script type="text/javascript" src="http://www.mango-surf.com/corporate/widget-news-distant.php?description='.$_POST["chapeau_widget"].'&nbr_news='.$_POST["nbr_news"].'&image='.$_POST["photo_widget"].'"></script>';
			?>
			<?php echo $textarea = textarea("<h2>Copier - Coller le code sur votre site</h2>","corps",$url,"3",""); ?>
			<h2>Prévisualisation</h2>
			<?php echo $url; ?>
			<?php } ?>
			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>
<?php 
$rubrique = 19;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");

$no_sky = 1;
$no_photo = 1;

//on rÃ©rupÃ¨re les donnees
$res = donnee("m_editorial","id",$_GET['id'],"","",$mysql_link);

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title><?php echo $res['titre']; ?> - <?php if(!empty($res["id_cat"])){ echo categorie($res['id_cat']).' - ';} ?>Annonce</title>	
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/annonce/'.$res['nom_fichier'].'--'.$res['id'].'.html'; ?>" />
<meta name="description" content="<?php if(!empty($res["id_cat"])){ echo categorie($res['id_cat']).' - ';} ?><?php echo $res['titre']; ?> - Annonce" />

<meta property="og:title" content="<?php if(!empty($res["id_cat"])){ echo categorie($res['id_cat']).' - ';} ?><?php echo stripslashes($res['titre']); ?>" /> 
<meta property="og:description" content="<?php if(!empty($res["id_cat"])){ echo categorie($res['id_cat']).' - ';} ?><?php echo $res['titre']; ?> - Annonce" />  

<?php if(!empty($res['userfile3'])){ ?>
<meta property="og:image" content="http://www.mango-surf.com/lib/image/editorial/<?php echo $res['userfile3']; ?>" /> 
<?php } ?>

</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
			
	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1"><?php echo rubrique(19,$mysql_link); ?></div>
			<article>
			<?php echo fil_ariance("Accueil","../",rubrique(19,$mysql_link),".",tronquer(stripslashes($res['titre']),80),"","",""); ?>

				<h1><?php if(!empty($res["id_cat"])){ echo categorie($res["id_cat"],$mysql_link)." - "; } echo stripslashes($res["titre"]); ?></h1>
				
				
				<div class="big">
				
				<?php
				
	
				if(!empty($res['userfile3'])){ 
					$image = image($res['userfile3'],"right","","","","editorial","","",$mysql_link);
					echo $image;
				}

				echo stripslashes(nl2br($res['corps'])).'<br />';
				
				if(!empty($res['prix'])){ 
					echo '<strong>Prix : '.$res['prix'].' euros';
				}
				
				if(!empty($res['email'])){ 
					echo '<br /><strong>Contact : '.$res['email'];
				}
				?>
				
				</div>
			</article>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>
<?php 
$categorie = 48;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");


//on rÃ©rupÃ¨re les donnees
$res = donnee("m_editorial","id",$_GET['id'],"","",$mysql_link);
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?>


<?php require("../lib/include/n_i-meta.php"); ?>	

<title><?php echo $res['titre']; ?></title>	
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/trip-surf/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_sommaire'].'.html'; ?>" />

<meta name="description" content="<?php echo stripslashes($res['chapeau']); ?>" />

<meta property="og:title" content="Surf - <?php echo stripslashes($res['titre']); ?>" /> 
<meta property="og:description" content="<?php echo stripslashes($res['chapeau']); ?>" />  
<meta property="og:image" content="http://www.mango-surf.com/lib/image/editorial/<?php echo $res['userfile3']; ?>" /> 
	
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php  $tab = titresommaire($_GET['dossier'],$mysql_link); echo fil_ariance("L'actualité du surf","../",rubrique(3,$mysql_link),".",$tab[0],$tab[1],"",""); ?>



		<div class="mod wColCentre left">
		
			<article class="line" itemscope itemtype="http://schema.org/Article">
			

			
			<?php
				$date_publication = dateformat($res["date_publication"],"en","fr"); 
				
				if(($date_publication != "00-00-0000") AND ($date_publication != "00/00/0000")){
					echo '<div class="line small font-grisclair">Publié le <time itemprop="dateCreated" datetime="'.$res["date_publication"].'T08:00">'.$date_publication.'</span></div>';
				}
			?>	
			<h1 itemprop="headline" class="m-reset"><?php echo stripslashes($res['titre']); ?></h1>
			<?php if(!empty($res['chapeau'])){ ?><h2 itemprop="description"><?php echo stripslashes($res['chapeau']); ?></h2><?php } ?>
			
				<div class="big">
				
				
				<?php echo $image = image($res['userfile3'],"",$res['legende3'],$res['copyright3'],"1","editorial",$res['titre_photo'],$res['id_photo'],$mysql_link); ?>
				
				<?php if(!empty($res['userfile4'])){ $image2 = image($res['userfile4'],"flotG alingG mrgD10",$res['legende4'],$res['copyright4'],"1","editorial","","",$mysql_link);} ?>
				
				<?php if(!empty($res['corps'])){ ?><p itemprop="text" <?php if(!empty($res['corps'])){ ?>class="center"<? } ?>><?php echo stripslashes(nl2br(ereg_replace("image2",$image2,$res['corps']))); ?></p> <?php } ?>
				
				</div>
				
				
				
				
				<div class="line mt2">
				
				<?php 
				if(!empty($res['titre_photo'])){ 
					$plusdephoto = plusdephoto($res['titre_photo'],$res['id_photo'],"m_photo",$mysql_link);
					echo $plusdephoto;
				}
				?>
				
				
				<?php 
				if(!empty($res['nom_lien'])){ 
					$lien = lien($res['nom_lien'],$res['url_lien'],"_blank","",""); 
					echo '<p>'.$lien.'</p>';
				}
				?>
				
				<?php 
				if(!empty($res['titre_news'])){ 
					$plusdenews = plusdecontenu($res['titre_news'],$res['id_news'],"m_editorial",$mysql_link);
					echo $plusdenews;
				}
				?>
				
				<?php 
				if(!empty($res['titre_video'])){ 
					$plusdevideo = plusdecontenu($res['titre_video'],$res['id_video'],"m_editorial",$mysql_link);
					echo $plusdevideo;
				}
				?>
				
				
							
				<p>
				
				<?php
				if(!empty($res["classement"])){
					$menu_page = page_suivante($res["classement"],"m_editorial",$res["id_sommaire"],$mysql_link);
				}
				
				?>
				
				<div class="center"><?php echo $menu_page; ?></div>
				
				</p>
				
				<?php
				
				
				//Pour afficher une publicité qui est paramétré dans les tags
				if(!empty($res["id_publicite"])){
				
					$res_pub = donnee("m_tag","id",$res["id_publicite"],"","",$mysql_link);
 					echo $res_pub['corps'];
				
				}
				
				?>
				
				
				<?php echo genere_commentaire($res["id_rubrique"],$res["id"],$_POST['ajout'],$_POST['nom'],$_POST['corps'],$res["nom_fichier"],$_GET['p'],$res["id_sommaire"],"",$_POST['link'],$mysql_link); ?>
				</div>
			
				
			
			</article>
			
		</div>
    <?php require("../lib/include/n_i-partie-droite.php") ?>

    <?php require("../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>
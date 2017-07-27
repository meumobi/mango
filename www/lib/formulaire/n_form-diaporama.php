<section class="line mb1 grid">
	<div class="grid3">
	<?php echo $input = input("Tag Id (xx-xx-xx) - <a href='/admin/tag/ajout.php?id_rubrique=18' target='_blank'>Ajouter</a>","id_tag","text","",$res['id_tag'],"pa1 borderGray w100","");?>
	<?php echo $input = input("Tag produits","id_produit","text","",$res['id_produit'],"pa1 borderGray w100","");?>
	<?php echo $input = input("Tag publicite","id_publicite","text","",$res['id_publicite'],"pa1 borderGray w100","");?>
	</div>
</section>

<?php echo $input = input("Titre <span class='alerte'>*</span> - 180 caractères maximum","titre","text","180",$res['titre'],"w100 pa1 borderGray","mb1"); ?>

<?php echo $textarea = textarea("Chapeau <span class='alerte'>*</span> - 255 caractères maximum","chapeau",$res["chapeau"],"2","w100 pa1 borderGray mb1"); ?>

<?php echo $textarea = textarea("Texte <span class='alerte'>*</span>","corps",$res["corps"],"50","w100 pa1 borderGray mb1"); ?>


<section class="line mb1 grid">
	<div class="grid2">

	<?php 
	if (($_GET['id_rubrique'] != 4) AND ($_GET['id_rubrique'] != 6)){
		echo $input = input("Signature <span class='alerte'>*</span>","auteur","text","255",$res["auteur"],"pa1 borderGray w100",""); 
	}else{
		echo $input = input("Classement","classement","text","255",$res["classement"],"pa1 borderGray w100",""); 
	}
	?>
	
	<?php echo $input = input("Date Publication <span class='alerte'>*</span>","date_publication","text","255",$date_publication,"pa1 borderGray w100",""); ?>
	</div>
</section>


<section class="line mb1 grid">
	<div class="grid2">
	<?php 
	
	$req = "SELECT id,nom FROM m_emplacement ORDER BY nom";
	$query = mysqli_query($mysql_link,$req);
	
	echo $liste = liste("Mettre en avant l'article","id_emplacement",$res['id_emplacement'],$optgroup1,$query,$optgroup2,$query2,"pa1 borderGray w100",""); 
	
	$req = "SELECT id,nom FROM m_cat WHERE id_rubrique=1 ORDER BY id";
	$query = mysqli_query($mysql_link,$req);

				
	echo $liste = liste("Catégorie<span class='alerte'>*</span>","id_cat",$res['id_cat'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1"); 
	
	
	?>
	</div>
</section>


<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Lien Externe","nom_lien","text","180",$res["nom_lien"],"pa1 borderGray w100",""); ?>
	<?php echo $input = input("URL lien externe","url_lien","text","255",$res['url_lien'],"pa1 borderGray w100",""); ?>
	</div>
</section>

<section class="line mb1 grid">
	<div class="grid2">			
	<?php echo $input = input("Titre article","titre_news","text","180",$res["titre_news"],"pa1 borderGray w100",""); ?>
	<?php echo $input = input("ID article","id_news","text","180",$res["id_news"],"pa1 borderGray w100",""); ?>
	</div>
</section>

<?php echo $textarea = textarea("Code de la vidéo","video_article",$res["video_article"],"5","w100 pa1 borderGray mb1"); ?>

<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Titre vidéo","titre_video","text","180",$res["titre_video"],"pa1 borderGray w100",""); ?>
	<?php echo $input = input("ID vidéo","id_video","text","180",$res["id_video"],"pa1 borderGray w100",""); ?>
	</div>
</section>

<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Titre photo","titre_photo","text","180",$res["titre_photo"],"pa1 borderGray w100",""); ?>
	<?php echo $input = input("ID photo","id_photo","text","180",$res["id_photo"],"pa1 borderGray w100",""); ?>
	</div>
</section>

<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Image Grande <span class='alerte'>*</span> - 660x330 px","userfile2","file","180","","pa1 borderGray w100",""); ?>
	<?php echo $input = input("Image article 2 - max : 300x400 px","userfile4","file","180","","pa1 borderGray w100",""); ?>
	</div>
</section>

<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Légende image 1 <span class='alerte'>*</span>","legende3","text","180",$res["legende3"],"pa1 borderGray w100",""); ?>
	<?php echo $input = input("Légende image 2","legende4","text","180",$res["legende4"],"pa1 borderGray w100",""); ?>
	</div>
</section>

<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("copyright image 1 <span class='alerte'>*</span>","copyright3","text","180",$res["copyright3"],"pa1 borderGray w100",""); ?>
	<?php echo $input = input("copyright image 2","copyright4","text","180",$res["copyright4"],"pa1 borderGray w100",""); ?>
	</div>
</section>

<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>
<?php echo $checkbox = checkbox("Ne pas diffuser sur Iphone","no_iphone",$res["no_iphone"],1,"pa1 borderGray","left mr1"); ?>
<?php echo $checkbox = checkbox("Pas de commentaire","no_comment",$res["no_comment"],1,"pa1 borderGray","left mr1"); ?>
<?php echo $checkbox = checkbox("Vérifié","verifie",$res["verifie"],1,"pa1 borderGray","left mr1"); ?>

<?php echo $input = input("","id_sommaire","hidden","180",$_GET["id_sommaire"],"",""); ?>
<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
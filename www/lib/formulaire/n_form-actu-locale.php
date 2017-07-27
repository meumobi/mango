<?php echo $input = input("Tag Id (xx-xx-xx) - Affiche des tags sur la page article <a href='/admin/tag/ajout.php?id_rubrique=18' target='_blank'>Ajouter</a>","id_tag","text","",$res['id_tag'],"pa1 borderGray w100","");?>



<?php echo $input = input("Titre<span class='alerte'>*</span> - 180 caractères maximum","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>

<?php 
$req = "SELECT id,nom FROM m_region WHERE id_pays=67 AND indicatif='dom-tom' ORDER BY nom";
$query = mysqli_query($mysql_link,$req);
		
	
$req2 = "SELECT id,nom FROM m_region WHERE id_pays=67 AND indicatif!='dom-tom' ORDER BY nom";
$query2 = mysqli_query($mysql_link,$req2);


				
echo $liste = liste("Localisation<span class='alerte'>*</span>","id_region",$res["id_region"],"Dom - Com",$query,"Région",$query2,"w100 pa1 borderGray","mb1");
				
?>



<?php echo $textarea = textarea("Chapeau<span class='alerte'>*</span> - 255 caractères maximum","chapeau",$res["chapeau"],"2","w100 pa1 borderGray mb1"); ?>

<?php
	if(empty($internaute)){ 
		echo $textarea = textarea("Texte <span class='alerte'>*</span>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); 
	}else{
		echo $textarea = textarea("Texte<span class='alerte'>*</span>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); 
	}
?>


<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Signature","auteur","text","255",$res["auteur"],"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("Date Publication<span class='alerte'>*</span>","date_publication","text","255",$date_publication,"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>




<?php

if(empty($internaute)){

	$req = "SELECT id,nom FROM m_emplacement ORDER BY nom";
	$query = mysqli_query($mysql_link,$req);

	echo $liste = liste("Mettre en avant l'article","id_emplacement",$res['id_emplacement'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1"); 
?>

<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Lien Externe","nom_lien","text","180",$res["nom_lien"],"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("URL lien externe","url_lien","text","255",$res['url_lien'],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>


<?php echo $input = input("Renseigner les ID article pour afficher des articles dans le bloc Sur le même sujet","id_news","text","180",$res["id_news"],"pa1 borderGray w100",""); ?>

<?php echo $input = input("Image Grande <span class='alerte'>*</span> - 1000x500px","userfile2","file","180","","w100 pa1 borderGray","mb1"); ?>


<?php } ?>

<?php if(empty($internaute)){ ?>

	<?php echo $input = input("Légende image 1 <span class='alerte'>*</span>","legende3","text","180",$res["legende3"],"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("copyright image 1 <span class='alerte'>*</span>","copyright3","text","180",$res["copyright3"],"w100 pa1 borderGray","mb1"); ?>
	

<?php }else{ ?>


	<?php echo $input = input("Légende<span class='alerte'>*</span>","legende3","text","180",$res["legende3"],"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("copyright<span class='alerte'>*</span>","copyright3","text","180",$res["copyright3"],"w100 pa1 borderGray","mb1"); ?>



	<?php echo $input = input("Photo<span class='alerte'>*</span> - max : 1000x500px","userfile3","file","180","","w100 pa1 borderGray","mb1"); ?>
	

<?php } ?>

<?php if(empty($internaute)){ ?>


	<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>
	<?php echo $checkbox = checkbox("Vérifié","verifie",$res["verifie"],1,"pa1 borderGray","left mr1"); ?>

<?php } ?>


<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php 

	if(!empty($_GET["id"]))$id_news_tempo = $_GET["id"];
	if(!empty($_POST["id"]))$id_news_tempo = $_POST["id"];
	
	echo $input = input("","id","hidden","180",$id_news_tempo,"",""); 

?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
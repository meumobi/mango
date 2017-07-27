<?php if(empty($internaute)){ 
		echo $input = input("Tag Id (xx-xx-xx) - <a href='/admin/tag/ajout.php?id_rubrique=18' target='_blank'>Ajouter un Tag</a>","id_tag","text","180",$res['id_tag'],"w100 pa1 borderGray","mb1");
	}
?>


<?php echo $input = input("Titre<span class='alerte'>*</span>","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>

<?php 
$req = "SELECT id,nom FROM m_pays ORDER BY nom";
$query = mysqli_query($mysql_link,$req);
		
echo $liste = liste("Localisation<span class='alerte'>*</span>","id_pays",$res["id_pays"],"",$query,"",$query2,"w100 pa1 borderGray","mb1");
				
?>


<?php echo $input = input("Nom du spot<span class='alerte'>*</span>","spot","text","255",$res['spot'],"w100 pa1 borderGray","mb1"); ?>

<?php echo $textarea = textarea("Chapeau<span class='alerte'>*</span>","chapeau",$res["chapeau"],"2","w100 pa1 borderGray mb1"); ?>

<?php
	if(empty($internaute)){ 
		echo $textarea = textarea("Texte <span class='alerte'>*</span>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); 
	}else{
		echo $textarea = textarea("Texte<span class='alerte'>*</span>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); 
	}
?>

<section class="line mb1 grid">
	<div class="grid2">
<?php echo $input = input("Auteur de la session<span class='alerte'>*</span>","auteur","text","255",$res["auteur"],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Date de la session<span class='alerte'>*</span>","date_publication","text","255",$date_publication,"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>

<?php if(empty($internaute)){ ?>

	<?php
	
	$req = "SELECT id,nom FROM m_emplacement ORDER BY nom";
	$query = mysqli_query($mysql_link,$req);
	
	echo $liste = liste("Emplacement article","id_emplacement",$res['id_emplacement'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1"); 
	
	?>
	
	<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Lien Externe","nom_lien","text","180",$res["nom_lien"],"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("URL lien externe","url_lien","text","255",$res['url_lien'],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>




<?php echo $input = input("Image Grande <span class='alerte'>*</span> - 1000x500px","userfile2","file","180","","w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Légende 1<span class='alerte'>*</span>","legende3","text","180",$res["legende3"],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("copyright 2","copyright4","text","180",$res["copyright4"],"w100 pa1 borderGray","mb1"); ?>

	
	
	<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>
	<?php echo $checkbox = checkbox("Vérifié","verifie",$res["verifie"],1,"pa1 borderGray","left mr1"); ?>

<?php }else{ ?>
<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("copyright 1<span class='alerte'>*</span>","copyright3","text","180",$res["copyright3"],"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("Légende 1<span class='alerte'>*</span>","legende3","text","180",$res["legende3"],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>

	<?php echo $input = input("Photo","userfile3","file","180","","w100 pa1 borderGray","mb1"); ?>


<?php } ?>

<?php 

	if(!empty($_GET["id"]))$id_content_tempo = $_GET["id"];
	if(!empty($_POST["id"]))$id_content_tempo = $_POST["id"];
	
	echo $input = input("","id","hidden","180",$id_content_tempo,"",""); 
?>


<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
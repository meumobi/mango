<?php echo $input = input("Titre de la manifestation<span class='alerte'>*</span>","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>


<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Date de début<span class='alerte'>*</span> JJ/MM/AAAA","date_debut","text","255",$date_debut,"w100 pa1 borderGray","mb1 hasDatepicker"); ?>
	<?php echo $input = input("Date de fin<span class='alerte'>*</span> JJ/MM/AAAA","date_fin","text","255",$date_fin,"w100 pa1 borderGray","mb1 hasDatepicker"); ?>
	</div>
</section>

<?php
	if(empty($internaute)){ 
		echo $textarea = textarea("Texte <span class='alerte'>*</span> - <a href='../editorial/tag.php' target='_blank'>Ajouter un Tag</a>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); 
	}else{
		echo $textarea = textarea("Texte<span class='alerte'>*</span>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); 
	}
?>

<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Lieu<span class='alerte'>*</span>","lieu","text","255",$res["lieu"],"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("E-mail contact","email","text","255",$res['email'],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>


<?php if(empty($internaute)){ ?>
<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Nom du site","nom_lien","text","180",$res["nom_lien"],"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("URL du lien","url_lien","text","255",$res['url_lien'],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>


<?php echo $input = input("Tag manifestation","id_news","text","180",$res["id_news"],"w100 pa1 borderGray","mb1"); ?>

<?php echo $input = input("Image Grande","userfile2","file","180","","w100 pa1 borderGray","mb1"); ?>

<?php echo $input = input("Légende<span class='alerte'>*</span>","legende","text","180",$res["legende"],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Copyright<span class='alerte'>*</span>","copyright","text","180",$res["copyright"],"w100 pa1 borderGray","mb1"); ?>
<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>

<?php }else{ ?>

<?php echo $input = input("Légende<span class='alerte'>*</span>","legende","text","180",$res["legende"],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Copyright<span class='alerte'>*</span>","copyright","text","180",$res["copyright"],"w100 pa1 borderGray","mb1"); ?>

	
	
	
<?php echo $input = input("Affiche - Taille maximum : 1000x500px","userfile2","file","180","","w100 pa1 borderGray","mb1"); ?>


<?php } ?>

<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php 

	if(!empty($_GET["id"]))$id_content_tempo = $_GET["id"];
	if(!empty($_POST["id"]))$id_content_tempo = $_POST["id"];
	
	echo $input = input("","id","hidden","180",$id_content_tempo,"",""); 
?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
<?php echo $input = input("Titre<span class='alerte'>*</span>","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>



<section class="line mb1 grid">
	<div class="grid2">
<?php 

$req = "SELECT id,nom FROM m_cat WHERE id_rubrique=15 ORDER BY id";
$query = mysqli_query($mysql_link,$req);

				
echo $liste = liste("Catégorie<span class='alerte'>*</span>","id_cat",$res['id_cat'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1"); 
	
$req = "SELECT id,nom FROM m_tag WHERE id_cat = 32 ORDER BY nom";
$query = mysqli_query($mysql_link,$req);
			
echo $liste = liste("Marque<span class='alerte'>*</span>","id_marque",$res["id_marque"],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1");

				
?>
	</div>
</section>


<?php echo $textarea = textarea("Texte<span class='alerte'>*</span>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); ?>

<section class="line mb1 grid">
	<div class="grid2">
<?php echo $input = input("Date collection ou parution<span class='alerte'>*</span>","date_publication","text","255",$date_publication,"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Prix","prix","text","255",$res["prix"],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>

<section class="line mb1 grid">
	<div class="grid2">
<?php echo $input = input("Nom du shop","nom_shop","text","180",$res["nom_shop"],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("URL lien externe","url_shop","text","255",$res['url_shop'],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>

<?php echo $input = input("Photo - 400x400px","userfile2","file","180","","w100 pa1 borderGray","mb1"); ?><br />


<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>


<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
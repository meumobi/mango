<?php 

	
$req = "SELECT id,nom FROM m_cat WHERE id_rubrique=18 ORDER BY id ASC";
$query = mysqli_query($mysql_link,$req);

echo $liste = liste("Type de Tag<span class='alerte'>*</span>","id_cat",$res["id_cat"],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1");
	
				
?>

<?php echo $textarea = textarea("Description du Tag (séparateur de mot clé <strong>,</strong> - Ne pas mettre d'espace)","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); ?>


<?php echo $checkbox = checkbox("Forcer l'ajout du Tag","force_ajout",$res["force_ajout"],1,"pa1 borderGray","left mr1"); ?>

<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
<?php echo $input = input("Nom de la catégorie<span class='alerte'>*</span>","nom","text","255",$res['nom'],"input",""); ?>

<?php 

	
$req = "SELECT id,nom FROM m_rubrique ORDER BY id ASC";
$query = mysqli_query($mysql_link,$req);

echo $liste = liste("Rubrique<span class='alerte'>*</span>","rubrique",$res["id_rubrique"],$optgroup1,$query,$optgroup2,$query2,"input","");
	
				
?>

<?php echo $textarea = textarea("Introduction de la catgorie - courte","presentation",$res["presentation"],"10",""); ?>
<?php echo $textarea = textarea("Introduction de la catgorie - longue","presentation_longue",$res["presentation_longue"],"10",""); ?>



<?php echo $input = input("Dossier<span class='alerte'>*</span>","dossier","text","180",$res["dossier"],"gauche","flotG mrgD10"); ?>
<?php echo $input = input("Nom du fichier<span class='alerte'>*</span>","nom_fichier","text","255",$res['nom_fichier'],"gauche",""); ?>

<?php echo $input = input("Illustration<span class='alerte'>*</span>","userfile1","file","180","","gauche","flotG mrgD10"); ?>


<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","button bloc_arrondie"); ?>
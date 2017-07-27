<?php echo $input = input("Titre<span class='alerte'>*</span>","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>

<?php 
			
if($_GET['id_rubrique'] == 3){

	$req = "SELECT id,nom FROM m_pays ORDER BY nom";
	$query = mysqli_query($mysql_link,$req);
				
	echo $liste = liste("Localisation<span class='alerte'>*</span>","id_pays",$res["id_pays"],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1");
}

				
?>



<?php echo $textarea = textarea("Chapeau<span class='alerte'>*</span>","chapeau",$res["chapeau"],"2","w100 pa1 borderGray"); ?>

<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Auteur<span class='alerte'>*</span>","auteur","text","255",$res["auteur"],"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("Date Publication<span class='alerte'>*</span>","date_publication","text","255",$date_publication,"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>



<?php 

$req = "SELECT id,nom FROM m_emplacement ORDER BY nom";
$query = mysqli_query($mysql_link,$req);

echo $liste = liste("Emplacement article","id_emplacement",$res['id_emplacement'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1"); 

?>


				
<?php echo $input = input("Image Grande <span class='alerte'>*</span> - 1000x500px","userfile2","file","180","","w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Légende 1<span class='alerte'>*</span>","legende3","text","180",$res["legende3"],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("copyright 1<span class='alerte'>*</span>","copyright3","text","180",$res["copyright3"],"w100 pa1 borderGray","mb1"); ?>




<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>



<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
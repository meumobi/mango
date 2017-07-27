
<?php echo $input = input("Tag Id (xx-xx-xx) - <a href='/admin/tag/ajout.php?id_rubrique=18' target='_blank'>Ajouter un Tag</a>","id_tag","text","180",$res['id_tag'],"w100 pa1 borderGray","mb1");?>
<?php echo $input = input("Photo - 1000x500px","userfile1","file","180","","w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Légende<span class='alerte'>*</span>","legende","text","255",$res['legende'],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Copyright<span class='alerte'>*</span>","copyright","text","180",$res["copyright"],"w100 pa1 borderGray","mb1"); ?>





<section class="line mb1 grid">
	<div class="grid2">

<?php 

$req = "SELECT id,nom FROM m_tag WHERE id_cat=33 ORDER BY nom";
$query = mysqli_query($mysql_link,$req);

				
echo $liste = liste("Photographe \ Marque","id_photographe",$res['id_photographe'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1"); 

$req = "SELECT id,titre FROM m_editorial WHERE id_rubrique=17 ORDER BY date_publication";
$query = mysqli_query($mysql_link,$req);




$req = "SELECT id,nom FROM m_cat WHERE id_rubrique=17 ORDER BY nom";
$query = mysqli_query($mysql_link,$req);
echo $liste = liste("Catégorie<span class='alerte'>*</span>","id_cat",$res['id_cat'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1");


	
			
?>
</div>
</section>


<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>
<?php echo $checkbox = checkbox("Photo premium (remonte les photos sur la Home)","belle_photo",$res["belle_photo"],1,"pa1 borderGray","left mr1"); ?>


<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
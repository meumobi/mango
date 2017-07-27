<?php echo $input = input("Tag Id (xx-xx-xx) - Affiche des tags sur la page vidéo <a href='/admin/tag/ajout.php?id_rubrique=18' target='_blank'>Ajouter un Tag</a>","id_tag","text","180",$res['id_tag'],"w100 pa1 borderGray","mb1");?>


<?php echo $input = input("Titre<span class='alerte'>*</span>","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>

<?php 
			
$req = "SELECT id,nom FROM m_cat WHERE id_rubrique=9 ORDER BY id";
$query = mysqli_query($mysql_link,$req);

				
echo $liste = liste("Thème<span class='alerte'>*</span>","id_cat",$res['id_cat'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1"); 
	
			
?>

<?php echo $textarea = textarea("Chapeau<span class='alerte'>*</span>","chapeau",$res["chapeau"],"2","w100 pa1 borderGray mb1"); ?>

<?php echo $textarea = textarea("Texte (pas obligatoire)","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); ?>

<?php echo $textarea = textarea("Code de la vidéo<span class='alerte'>*</span>","video_article",$res["video_article"],"5","w100 pa1 borderGray mb1"); ?>

<?php echo $input = input("ID article - Renseigner les ID article pour afficher des articles relatifs","id_news","text","180",$res["id_news"],"pa1 borderGray w100",""); ?>

<?php echo $input = input("Date Publication <span class='alerte'>*</span>","date_publication","text","255",$date_publication,"w100 pa1 borderGray","mb1"); ?>




<?php 

$req = "SELECT id,nom FROM m_emplacement ORDER BY nom";
$query = mysqli_query($mysql_link,$req);

echo $liste = liste("Mettre en avant l'article","id_emplacement",$res['id_emplacement'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1"); 

?>

<?php echo $input = input("Image Grande <span class='alerte'>*</span> - 1000x500px","userfile2","file","180","","w100 pa1 borderGray","mb1"); ?>




<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>
<?php echo $checkbox = checkbox("Vérifié","verifie",$res["verifie"],1,"pa1 borderGray","left mr1"); ?>



<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
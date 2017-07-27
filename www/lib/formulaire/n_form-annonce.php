<?php echo $input = input("Titre<span class='alerte'>*</span>","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>

<?php 
$req = "SELECT id,nom FROM m_cat WHERE id_rubrique = 19 ORDER BY id";
$query = mysqli_query($mysql_link,$req);
		
echo $liste = liste("Type d'annonce<span class='alerte'>*</span>","id_cat",$res["id_cat"],"",$query,"",$query2,"w100 pa1 borderGray","mb1");
				
?>

<?php echo $textarea = textarea("Texte<span class='alerte'>*</span>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); ?>


<section class="line mb1 grid">
	<div class="grid2">
<?php echo $input = input("Prix","prix","text","255",$res["prix"],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("E-mail<span class='alerte'>*</span>","email","text","255",$res['email'],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>


<?php if(empty($internaute)){ ?>

<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Date d'échéance <span class='alerte'>*</span>","date_publication","text","255",$date_publication,"w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("Image Grande","userfile3","file","180","","w100 pa1 borderGray","mb1"); ?>
	</div>
</section>

	
	<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>
	<?php echo $checkbox = checkbox("Pas diffuser sur Iphone","no_iphone",$res["no_iphone"],1,"pa1 borderGray","left mr1"); ?>
	<?php echo $checkbox = checkbox("Pas de commentaire","no_comment",$res["no_comment"],1,"pa1 borderGray","left mr1"); ?>

<?php }else{ ?>

	<?php echo $input = input("Image Grande","userfile3","file","180","","w100 pa1 borderGray","mb1"); ?>

<?php } ?>

<?php
	if(!empty($_GET["id"]))$id_content_tempo = $_GET["id"];
	if(!empty($_POST["id"]))$id_content_tempo = $_POST["id"];
	
	echo $input = input("","id","hidden","180",$id_content_tempo,"","");

?>
<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
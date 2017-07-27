<?php echo $input = input("","link","text","180","","","desktop-hidden phone-hidden"); ?>

<?php echo $input = input("Nom de votre entreprise<span class='alerte'>*</span>","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>

<?php 

if (($_GET['id_cat'] == 29) OR ($res["id_cat"] == 29)){
			
	$req = "SELECT id,nom FROM m_pays ORDER BY nom";
	$query = mysqli_query($mysql_link,$req);
	echo $liste = liste("Localisation<span class='alerte'>*</span>","id_pays",$res["id_pays"],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1");
}else{
	
	$req = "SELECT id,nom FROM m_region WHERE id_pays=67 AND indicatif='dom-tom' ORDER BY nom";
	$query = mysqli_query($mysql_link,$req);
		
	
	$req2 = "SELECT id,nom FROM m_region WHERE id_pays=67 AND indicatif!='dom-tom' ORDER BY nom";
	$query2 = mysqli_query($mysql_link,$req2);
		
	echo $liste = liste("Localisation<span class='alerte'>*</span>","id_region",$res["id_region"],"Dom - Com",$query,"Région",$query2,"w100 pa1 borderGray","mb1");
}
				
?>


<?php echo $textarea = textarea("Présentation de votre activité<span class='alerte'>*</span>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); ?>

<section class="line mb1 grid">
	<div class="grid2">
<?php echo $input = input("Adresse<span class='alerte'>*</span>","adresse","text","255",$res['adresse'],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Code Postale<span class='alerte'>*</span>","cp","text","180",$res["cp"],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>

<section class="line mb1 grid">
	<div class="grid2">
<?php echo $input = input("Ville<span class='alerte'>*</span>","ville","text","255",$res['ville'],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("E-mail<span class='alerte'>*</span>","email","text","180",$res["email"],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>

<section class="line mb1 grid">
	<div class="grid2">
<?php echo $input = input("Téléphone","telephone","text","255",$res['telephone'],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Site internet (http://)","url_lien","text","255",$res['url_lien'],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>

<?php if(!empty($internaute)){ ?>
	
	<?php //echo $input = input("Photo : 800x800px maximum","userfile2","file","180","","w100 pa1 borderGray","mb1"); ?>
	

<?php }else{ ?>
<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Logo - 90x90px","userfile1","file","180","","w100 pa1 borderGray","mb1"); ?>
	<?php echo $input = input("Photo - 1000x500px","userfile2","file","180","","w100 pa1 borderGray","mb1"); ?>
	</div>
</section>



	<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>


<? } ?>




<?php 

	if(!empty($_GET["id"]))$id_content_tempo = $_GET["id"];
	if(!empty($_POST["id"]))$id_content_tempo = $_POST["id"];
	
	echo $input = input("","id","hidden","180",$id_content_tempo,"",""); 

	if(!empty($_GET["id_cat"]))$id_rubrique_tempo = $_GET["id_cat"];
	if(!empty($res["id_cat"]))$id_rubrique_tempo = $res["id_cat"];
	
	echo $input = input("","id_cat","hidden","180",$id_rubrique_tempo,"","");
	echo $input = input("","id_rubrique","hidden","180","14","","");

?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
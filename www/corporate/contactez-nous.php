<?php 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/f-formulaire.php");

$no_photo = 1;
$no_sky = 1;

if (!empty($_POST['email_contact'])){

	$emailmango = "romain@mango-surf.com";
	$sujet = categorie($_POST['id_cat']);
	$header = "From:".$_POST['email_contact']."\nreply-To:".$email_exp."\nContent-Type: text/plain; charset=iso-8859-1\n";	
	mail($emailmango, stripslashes($sujet), stripslashes($_POST['message']), $header);
}


$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id= 22";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);

?>

<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Vous avez une questions ? Contactez-nous !</title>
<meta name="robots" content="noindex,follow">
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
			
	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1">Vous avez une questions ? Contactez-nous !</div>
			<div class="line">
			
			<?php echo fil_ariance("Accueil","../","Contactez-nous","contactez-nous.php","","","",""); ?>
			
			
			<?php if(empty($_POST['email_contact'])){ ?>
			
			<div class="line mb2">
				<h1 class="h2-like"><?php echo $res_introduction['titre']; ?></h1>
				<?php echo $res_introduction['presentation'];?>
			</div>

			
			
				<form method="POST" action="contactez-nous.php" name="contact" id="contact" method="POST">
				<?php
				$req = "SELECT id,nom FROM m_cat WHERE id_rubrique=22 ORDER BY nom";
				$query = mysqli_query($mysql_link,$req);
				echo $liste = liste("Quelle est l'objet de votre demande<span class='alerte'>*</span>","id_cat","",$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray mb1",""); 
				?>
				
				<?php echo $input = input("Votre e-mail<span class='alerte'>*</span>","email_contact","text","255","","w100 pa1 borderGray","mb1"); ?>
				<?php echo $textarea = textarea("Votre message<span class='alerte'>*</span>","message","","5","w100 pa1 borderGray mb1"); ?>
				<?php echo $bouton = bouton("Valider","contact","submit","bouton"); ?>
				</form>
			
			<?php }else{ ?>
				
				<div class="mt2 mb2"><strong>Votre demande a bien été envoyée ! Nous vous répondrons d'ici quelques jours.</strong></div>
				
				<?php echo dernierephoto("","",$option2,$valeur2,$option3,$valeur3,"/galerie-photo/",$valeur4,$mysql_link); ?>				

			<?php } ?>
			
			
			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>
	

</div>
</body>

</html>
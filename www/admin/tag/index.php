<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");
require("../../lib/fonction/f-formulaire.php");


// Supprime la news
if ($_GET['supp'] == 1){
	$req = "DELETE FROM m_tag WHERE id = ".$_GET['id'];
	$query = mysqli_query($mysql_link,$req);
}


//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) $p = 1; else $p = $_GET['p'];
$par_page = 31;

$req_tag = "SELECT * FROM m_tag WHERE id_rubrique = 18";



if(!empty($_GET['identifiant'])){
	$req_tag .= " AND id = ".$_GET['identifiant'];
	$param_pager .= " AND id = ".$_GET['identifiant'];
}

if(!empty($_GET['mot_cle'])){
	$req_tag .= " AND nom like '%".$_GET['mot_cle']."%'";
	$param_pager .= " AND nom like '%".$_GET['mot_cle']."%'";
}

if(!empty($_GET['id_cat'])){
	$req_tag .= " AND id_cat = ".$_GET['id_cat'];
	$param_pager .= " AND id_cat = ".$_GET['id_cat'];
}

$req_tag .= " ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;

$query_tag = mysqli_query($mysql_link,$req_tag);

?>



<?php require("../../lib/include/n_i-meta.php") ?>	

<title>Tag - Back Office</title>	
</head>
	
<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">

		<?php require("../../lib/include/i-partie-droite-admin.php") ?>

		<div class="mod wColCentre">
		
		<div class="titreRubrique line mb1">Tag - Back Office</div>
	<div class="content bloc_arrondie">
	<?php echo $ariane = fil_ariance("admin","../","Tag","index.php?id_rubrique=18","","","",""); ?>
	
	
	<form method="GET" enctype="multipart/form-data" action="index.php?id_rubrique=<?php echo $_GET['id_rubrique']; ?>" name="admin" id="admin" method="POST" onsubmit="return valid();">
	
		<section class="bgGrisClair line mb2 pa1">
	
		<h1 class="h2-like m-reset">Moteur de recherche</h1>
		<section class="line grid">
			<div class="grid2">
			<?php echo $input = input("Mot clé","mot_cle","text","255",$_POST["mot_cle"],"borderGray w100 pa1","mb1" ); ?>
			<?php echo $input = input("Identifiant","identifiant","text","255",$_POST["identifiant"],"borderGray w100 pa1","mb1"); ?>
			</div>
		</section>
		
		<?php 

		$req = "SELECT id,nom FROM m_cat WHERE id_rubrique=18 ORDER BY id";
		$query = mysqli_query($mysql_link,$req);
		
						
		echo $liste = liste("Catgorie<span class='alerte'>*</span>","id_cat",$_GET['id_cat'],$optgroup1,$query,$optgroup2,$query2,"borderGray w100 pa1","mb1"); 
				
		?>
		
		<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
		<div class="line txt center"><?php echo $bouton = bouton("Valider","admin","submit","bouton"); ?></div>		
		
	</section>
	</form>
	
	<div class="line bouton txtcenter mb2"><a class="fontWhite"  href="ajout.php?id_rubrique=18" title="Ajouter un produit">Ajouter un Tag</a></div>

	
	
	
	
	<section class="mb2">
	<?php
	
	$i="";
	while ($res_tag = mysqli_fetch_array($query_tag)){ 
	
	if($i%2 != 1)$classimpaire = "bggrisclair";
	
	if($res_tag['id_cat'] == 32){
		$url_tag = "../../shopping/marque/".$res_tag['nom_fichier'].'--'.$res_tag['id'].'-1.html';
	}elseif($res_tag['id_cat'] == 33){
		$url_tag = "../../galerie-photo/photographe/".$res_tag['nom_fichier'].'--'.$res_tag['id'].'-1.html';
	}else{
		$url_tag = "../../tag/".$res_tag['nom_fichier']."--".$res_tag['id']."-1.html";
	}
	
	
	?>
	<div class="line zebre pa1">

		<div class="left"><?php echo substr($res_tag['nom'],0,80); ?></div>
			<div class="right">
			
			<a href="<?php echo $url_tag; ?>" target="_blank"><img src="/lib/image/template/a-voir.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="voir" /></a>
			
			<a href="ajout.php?id=<?php echo $res_tag['id']; ?>&id_rubrique=<?php echo $res_tag['id_rubrique']; ?>" title="Modifier"><img src="/lib/image/template/a-modifier.png" class="ImgNoBorder mrgD10" height="20" width="20" valign="middle" alt="modifier" /></a>
			<a onClick="if (confirm('Etes vous certain de vouloir suprimer ! ')) document.location.href='index.php?supp=1&id=<? echo $res_tag["id"]; ?>&id_rubrique=<?php echo $res_tag['id_rubrique']; ?>&identifiant=<?php echo $_GET['identifiant']; ?>&mot_cle=<?php echo $_GET['mot_cle']; ?>&id_cat=<?php echo $_GET['id_cat']; ?>'; else return false;" href="#"><img src="/lib/image/template/a-supprimer.png" alt="supprimer" class="ImgNoBorder" height="20" width="20" valign="middle" /></a>
		</div>
	
	</div>
	<?php } ?>

	</section>
	
	<?php 
	
	//on compte le nombre de ligne
	$exist = nbrcontent("m_tag","id_rubrique",$_GET['id_rubrique'],"","",$param_pager,$mysql_link);
	echo $pager = pager($exist,$par_page,$p,"id_rubrique",$_GET['id_rubrique'],"identifiant",$_GET['identifiant'],"mot_cle",$_GET['mot_cle'],"id_cat",$_GET['id_cat'],"id_marque",$_GET['id_marque']); 

	
	?>
	</div>
	
	</div>
			
	<?php require("../../lib/include/n_i-footer.php") ?>	
	

</div>
</body>

</html>
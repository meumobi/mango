<?php 
$categorie = 48;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');


//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)){
	$p = 1;
}else{
	$p = $_GET['p'];
}

$par_page = 16;


?>

<?php require("../../lib/include/n_i-meta.php"); ?>	

<title>Outdoor</title>
<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />

</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">
	?>
	
	<?php 
	
	$req = "SELECT id, id_rubrique, userfile2, userfile3, titre, chapeau, date_publication FROM m_editorial WHERE date_publication < NOW() AND en_ligne = 1 AND id_cat IN (48,49) ORDER BY date_publication DESC LIMIT 0,".$par_page;
	$query = mysqli_query($mysql_link,$req);
			
	$i=0;
		
	while($res = mysqli_fetch_array($query)){
		
		//On initialise les bon path et rubrique
		if( (!empty($res['id_photographe'])) OR  (!empty($res['id_photographe'])) ){
			$id_rubrique_article1 = $res['id_rubrique']."-".$res['id_photographe'];
			$chemin_image1 = "lib/image/photo/";

		}else{
			$id_rubrique_article1 = $res['id_rubrique'];
			$chemin_image1 = "lib/image/editorial/";
		}
		
		//Initialisation du tableau pour smarty
		$resultat[$i]['date_publication']  = $res['date_publication'];
		$resultat[$i]['titre'] 	= stripslashes($res['titre']);
		$resultat[$i]['chapeau']  = stripslashes($res['chapeau']);
		$resultat[$i]['url'] 		= '/'.urlFichier($res['id'],$id_rubrique_article1,$mysql_link);
		$resultat[$i]['image_une'] 	= '/'.$chemin_image1.$res['userfile3'];
		$resultat[$i]['image'] 	= '/'.$chemin_image1.$res['userfile2'];
		$resultat[$i]['legende']	= stripslashes($res['legende']);
		$resultat[$i]['iz']		= $i;
		$resultat[$i]['rubrique'] = $rubrique;
		$resultat[$i]['bloc1'] = true;
		
		
		$i++;
	}
		
	
	
	$smarty = new Smarty;
	$smarty->assign('resultat',$resultat);
	$smarty->display('../../lib/template/p-sommaire.tpl');
		
	//Pager
	$exist = nbrcontent("m_editorial","id_rubrique","1","","","AND id_cat IN (48,49)",$mysql_link);
	echo $pager = pager($exist,$par_page,$p,"","",$param2,$valeur2,$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 

	
	?> 
			
</div>
			
<?php require("../../lib/include/n_i-footer.php") ?>	


</div>
</body>

</html>
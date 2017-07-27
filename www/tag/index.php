<?php 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");

$no_sky = 1;

//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) {
	$p = 1; 
}else{
	$p = $_GET['p'];
} 

$par_page = 100;


$req = "SELECT * FROM m_tag WHERE en_ligne = 1 ORDER BY nbr_content DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);

?>

<?php require("../lib/include/n_i-meta.php"); ?>	
<title>Tags</title>

</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
			
	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1">Tags</div>
			<div class="big">
			
			<?php echo fil_ariance("Accueil","../","Tags",".","","","",""); ?>
			
			<?php 
			$i ="";
			while($res = mysqli_fetch_array($query)){ 
				
				if($res['id_cat'] == 32){
					$url_tag = "../shopping/marque/".$res['nom_fichier'].'--'.$res['id'].'-1.html';
				}elseif($res['id_cat'] == 33){
					$url_tag = "../galerie-photo/photographe/".$res['nom_fichier'].'--'.$res['id'].'-1.html';
				}else{
					$url_tag = "../tag/".$res['nom_fichier']."--".$res['id']."-1.html";
				}
			
			$nbr_rand = rand(0,3);
			
			$fontsize = array("big","small","smaller","bigger");
			
			$nbr_rand_color = rand(0,4);
			$fontcolor = array("font-gray","font-black","font-red","font-grisclair","font-red")

			?>
			
			<a href="<?php echo $url_tag; ?>" title="<?php echo $res['nom']; ?>" class="<?php echo $fontsize[$nbr_rand]." ".$fontcolor[$nbr_rand_color]; ?>"><?php echo $res['nom']; ?></a> 
				
			
			<?php
			$i++;
			} 
			
			?>
			<div class="mt2">
			<?php	
			
			//Pager
			$exist = nbrcontent("m_tag","id_rubrique","18","en_ligne","1","",$mysql_link);
			echo $pager = pager($exist,$par_page,$p,"","",$param2,$valeur2,$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
						
			?>
</div>
			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>
	

</div>
</body>

</html>
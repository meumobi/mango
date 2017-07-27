<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/f-all.php");
require("../../lib/fonction/f-formulaire.php");

?>



<?php require("../../lib/include/i-meta.php") ?>	

<title>Rechercher / Générer un Tag - Back Office - Back Office</title>	

<script type="text/javascript" src="../../lib/js/ckeditor/ckeditor.js"></script>

</head>

<body>

<div id="conteneur">

	<?php require("../../lib/include/i-header.php"); ?>
			
	<div id="article">
	
		<div class="titre bloc_arrondie">Rechercher / Générer un Tag - Back Office</div>
		<div class="content bloc_arrondie">
		<?php echo $ariane = fil_ariance("admin","../","Tag","../tag/","","","",""); ?>

		<form method="POST" enctype="multipart/form-data" action="tag.php" name="tag" id="tag" method="POST" onsubmit="return valid();">
			<?php 
			echo $input = input("Trouver un tag <span class='alerte'>*</span>","nom_tag","text","255",$_POST['nom_tag'],"","");
			
			$req = "SELECT id,nom FROM m_cat WHERE id_rubrique = 18 ORDER BY nom";
			$query = mysqli_query($mysql_link,$req);
				
			echo $liste = liste("Type de tag","id_type_tag",$_POST["id_type_tag"],$optgroup1,$query,$optgroup2,$query2,"input","");
			
			echo $bouton = bouton("Valider","tag","submit","button bloc_arrondie"); 
			
			
			
			?>		
		</form>
		
		<?php
		if(!empty($_POST['tag'])){
			
			$req_tag = "SELECT nom, id, id_cat, nom_fichier FROM m_tag WHERE nom LIKE \"%".$_POST['nom_tag']."%\"";
			
			if(!empty($_POST['id_type_tag'])){
				$req_tag .= " AND id_cat = ".$_POST['id_type_tag'];
			
			}
			
			$query_tag = mysqli_query($mysql_link,$req_tag);
			
			
			while($res_tag = mysqli_fetch_array($query_tag)){
			
				if($res_tag['id_cat'] == 32){
					$url_tag = "/shopping/marque/".$res_tag['nom_fichier'].'--'.$res_tag['id'].'-1.html';
				}elseif($res_tag['id_cat'] == 33){
					$url_tag = "/galerie-photo/photographe/".$res_tag['nom_fichier'].'--'.$res_tag['id'].'-1.html';
				}else{
					$url_tag = "/tag/".$res_tag['nom_fichier'].'--'.$res_tag['id'].'-1.html';
				}

			
			echo '<a href="../..'.$url_tag.'" title="'.$res_tag['nom'].'" target="_blank">'.$res_tag['nom'].'</a><br />';

			
		?>
				
			<input value='<?php echo $res_tag['id']; ?>' /><br />
			
			
		<?php
			}

		
		}
		
		?>
		
		
		</div>
	</div>
			
	<?php require("../../lib/include/i-partie-droite.php") ?>
	

</div>
<?php require("../../lib/include/i-footer.php") ?>	
</body>

</html>
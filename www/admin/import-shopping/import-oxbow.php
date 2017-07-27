<?php 
$admin = true;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-nom-fichier.php");
require("../../lib/include/n_i-meta.php");
require("../../lib/fonction/f-recadre-photo.php");





?>	

<title>-Bienvenue sur l'administration de mango-surf.com --</title>	
		
</head>

<body>

<div class="wSite pa2">
<?php

$urlObow = "http://flux.netaffiliation.com/feed.php?maff=64C53CA0P3C034ADC5221513573114v33";

        
/*echo "<strong>ID produit : </strong>".$data[12]."<br />";
echo "<strong>Nom Produit : </strong>".$nomProduit[0]."<br />";
echo "<strong>Marque : </strong>".$data[18]."<br />";
echo "<strong>Catégorie : </strong>".$data[0]."<br />";
echo "<strong>ID Catégorie : </strong>".$data[1]."<br />";
echo "<strong>Descriptif : </strong>".$data[6]."<br />";
echo "<strong>Prix : </strong>".$data[22]."<br />";
echo "<strong>URL : </strong>".$data[28]."<br />";
echo "<strong>URL image : </strong>".$data[30]."<br />";
echo "<br />";*/

$bdd = "m_hawaii_surf";
$cheminimage = "test";


/*$bdd = "m_shopping";
$cheminimage = "shopping";*/

if (($handle = fopen($urlObow, "r")) !== FALSE) {
    $lignecsv = 0;
    $nbrProduitImporte = 0;
    $nbrProduitdejaBDD = 0;
    
    while (($data = fgetcsv($handle,'',';','"')) !== FALSE) {
        
      
        //Ne pas traiter la première ligne
        if($lignecsv != 0){
        
        	// on teste si le produit existe déjà en BDD
        	$req_exist = "SELECT id_affiliation FROM ".$bdd." WHERE id_affiliation=\"".$data[12]."\" ";       	
        	$query_exist = mysqli_query($mysql_link,$req_exist);
        	$res_exist = mysqli_num_rows($query_exist);
        					echo 'test';

        	   	
        	if(($res_exist == 0) AND (($lignecsv > 1) AND ($lignecsv < 5)) AND (strlen($data[6]) > 10) ){
        	
				echo 'test';
        		
        		//On récupère le dernière ID dans la base
        		$last_id = last_id($bdd,$mysql_link);
        		
        		//On décompose le nom du produit
      			$nomProduit = explode("-",$data[21]);
        		
       			$req = "INSERT INTO ".$bdd." SET ";
				$req .= "id =\"".$last_id."\" ";
				$req .= ",id_affiliation =\"".$data[12]."\" ";
				$req .= ",id_rubrique = 15 ";
				
				//On récupère la catégorie via une table de correspondance		
				$req_cat = "SELECT id_mango FROM m_correspondance WHERE id_type_correspondance = 2 AND label_partenaire LIKE '".trim($data[4])."'";
				$query_cat = mysqli_query($mysql_link,$req_cat);
				$res_cat = mysqli_fetch_array($query_cat);
				
				$req .= ",id_cat =\"".$res_cat['id_mango']."\" ";
				
				//On récupère la catégorie via une table de correspondance		
				$req_marque = "SELECT id_mango FROM m_correspondance WHERE id_type_correspondance = 1 AND label_partenaire LIKE '".trim($data[18])."'";
				$query_marque = mysqli_query($mysql_link,$req_marque);
				$res_marque = mysqli_fetch_array($query_marque);
				
				
				$req .= ",id_marque =\"".$res_marque['id_mango']."\" ";
				$req .= ",date_publication =\"".date("Y-m-d")."\" ";
				$req .= ",titre  =\"".addslashes($nomProduit[0])."\" ";
				$req .= ",corps  =\"".addslashes($data[6])."\" ";
				$req .= ",prix  =\"".$data[22]."\" ";
				$req .= ",nom_shop  =\"".$data[18].' shop'."\" ";
				$req .= ",url_shop  =\"".$data[28]."\" ";

				////GESTION DES IMAGES////
					
				//ON PREPRARE LE NOM DU FICHIER//
					
				$nom_image = prepare_url(filtre_url(nom_fichier_define($nomProduit[$i]))).'-'.$last_id.'.jpg'; 
					
				$url_image=$data[30];
				
				
				
				$copieImage="../../lib/image/".$cheminimage."/".$nom_image;
				$img= file_get_contents($url_image);
				file_put_contents($copieImage,$img);

				//on réduit la taille de l'image à 300x300
				
				$thumb = new Image("../../lib/image/".$cheminimage."/".$nom_image);
				$thumb->width(250);
				$thumb->height(250);
				$thumb->save();
		
				// on prepare la petite image
				copy("../../lib/image/".$cheminimage."/".$nom_image,"../../lib/image/".$cheminimage."/150x150-".$nom_image);
		
				$thumb = new Image("../../lib/image/".$cheminimage."/150x150-".$nom_image);
				$thumb->width(150);
				$thumb->height(150);
				$thumb->save();
		
				// On integre le nom de l'image en bdd
				$req .= ",userfile1 =\"150x150-".$nom_image."\" ";
				$req .= ",userfile2 =\"".$nom_image."\" ";
				$req .= ",userfile3 =\"150x150-".$nom_image."\" ";
				$req .= ",en_ligne  = 1";
					
				$nom_fichier = prepare_url(filtre_url(nom_fichier_define($nomProduit[0]))); 
				$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
				echo $req;
				
				
				$query = mysqli_query($mysql_link,$req);        		
        
       			$nbrProduitImporte++;
       		
       		}else{
       		
       			$nbrProduitdejaBDD++;
       			echo $data[30].'<br />';
       		}
        }
        
        
       	$lignecsv++;
    }
    
    fclose($handle);
}
	echo $nbrProduitImporte.'produit importé<br />';
	echo $nbrProduitdejaBDD.'déjà en BDD<br />';

?>
</div>
</body>

</html>

                                            
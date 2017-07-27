<?php 
$admin = true;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-nom-fichier.php");
require("../../lib/include/n_i-meta.php");
require("../../lib/fonction/f-recadre-photo.php");


	/*echo $products->product[$i]->reference.'<br />';
	echo $products->product[$i]->libelle.'<br />';
	echo $products->product[$i]->categorie.'<br />';
	echo $products->product[$i]->marque.'<br /><br />';
	echo $products->product[$i]->prixttc.'<br />';
	echo $products->product[$i]->categorie.'<br />';
	echo $products->product[$i]->description.'<br />';
	echo $products->product[$i]->image1.'<br />';
	echo $products->product[$i]->url.'<br />';*/

/*$bdd = "m_hawaii_surf";
$cheminimage = "test";*/


$bdd = "m_shopping";
$cheminimage = "shopping";

?>


<title>-Bienvenue sur l'administration de mango-surf.com --</title>	
		
</head>

<body>

<div class="wSite pa2">
<?php

$url = "http://export.shopping-feed.com/SGF3YWlpUFgyNTdoZl9leHBvcnRfbWFuZ290ZXN0LnhtbA==";

$products = simplexml_load_file($url);

$i=0;

foreach($products as $produit){
	
	
		// On test pour savoir si le produit existe déjà en BDD
		$req_exist = "SELECT id_netaffiliation FROM ".$bdd." WHERE id_netaffiliation=".$products->product[$i]->reference;        	     	
    	$query_exist = mysqli_query($mysql_link,$req_exist);
    	$res_exist = mysqli_num_rows($query_exist);
    	
    	
    	
		//On récupère la catégorie via une table de correspondance		
		$req_cat = "SELECT id_mango FROM m_correspondance WHERE id_type_correspondance = 2 AND id_partenaire = 2 AND label_partenaire LIKE '".trim($products->product[$i]->categorie)."'";
		$query_cat = mysqli_query($mysql_link,$req_cat);
		$res_cat = mysqli_fetch_array($query_cat);
				
		//On récupère la marque via une table de correspondance		
		$req_marque = "SELECT id_mango FROM m_correspondance WHERE id_type_correspondance = 1 AND id_partenaire = 2 AND label_partenaire LIKE '".trim($products->product[$i]->marque)."'";
		$query_marque = mysqli_query($mysql_link,$req_marque);
		$res_marque = mysqli_fetch_array($query_marque);
		
		
		
		
		
		if(($res_exist == NULL) AND (($i > 3500) AND ($i < 4000)) AND (strlen($products->product[$i]->description) > 10) AND ($res_cat['id_mango'] > 0) AND ($res_marque['id_mango'] > 0)){
			
			echo $res_exist['id_netaffiliation'].' - '.$res_cat['id_mango'].' - '.$res_marque['id_mango'].'<br /><br />';
			
			//On récupère le dernière ID dans la base
        	$last_id = last_id($bdd,$mysql_link);
			
			
			$req = "INSERT INTO ".$bdd." SET ";
			$req .= "id =\"".$last_id."\" ";
			$req .= ",id_netaffiliation =\"".$products->product[$i]->reference."\" ";
			$req .= ",id_rubrique = 15 ";
			$req .= ",id_cat =\"".$res_cat['id_mango']."\" ";
			
			$req .= ",id_marque =\"".$res_marque['id_mango']."\" ";
			$req .= ",date_publication =\"".date("Y-m-d")."\" ";
			$req .= ",titre  =\"".addslashes($products->product[$i]->libelle)."\" ";
			$req .= ",corps  =\"".addslashes($products->product[$i]->description)."\" ";
			$req .= ",prix  =\"".$products->product[$i]->prixttc."\" ";
			$req .= ",nom_shop = 'Hawaii surf'";
			$req .= ",url_shop  =\"".$products->product[$i]->url."\" ";
			
			
			////GESTION DES IMAGES////
					
			//ON PREPRARE LE NOM DU FICHIER//
					
			$nom_image = prepare_url(filtre_url(nom_fichier_define($products->product[$i]->libelle))).'-'.$last_id.'.jpg'; 
					
			$url_image=$products->product[$i]->image1;
				
			$copieImage="../../lib/image/".$cheminimage."/".$nom_image;
			$img= file_get_contents($url_image);
			file_put_contents($copieImage,$img);

			//on réduit la taille de l'image à 300x300
			
			$thumb = new Image("../../lib/image/".$cheminimage."/".$nom_image);
			$thumb->width(300);
			$thumb->height(300);
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
				
			$nom_fichier = prepare_url(filtre_url(nom_fichier_define($products->product[$i]->libelle))); 
			$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
			
			
			$query = mysqli_query($mysql_link,$req);        		
    
   			$nbrProduitImporte++;
   		}else{
   			$nbrProduitdejaBDD++;
   		}
			
			
		
	$i++;

}

	echo $nbrProduitImporte.'produit importé<br />';
	echo $nbrProduitdejaBDD.'déjà en BDD<br />';





?>   
</div>
</body>

</html>

                                            
<?php 
$admin = true;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-nom-fichier.php");
require("../../lib/include/n_i-meta.php");
require("../../lib/fonction/f-recadre-photo.php");

	
	


//Pour faire des tests
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





$url = "http://www.uwl-workshop.com/romain.php?chemin=uwl";
$products = simplexml_load_file($url);
$i=0;





foreach($products as $produit){
	 
		 /*echo 'reference '.$products->product[$i]->reference.'<br />';
		 echo 'libelle '.$products->product[$i]->libelle.'<br />';
		 echo 'categorie '.$products->product[$i]->categorie.'<br />';
		 echo 'marque '.$products->product[$i]->marque.'<br />';
		 echo 'description '.$products->product[$i]->description.'<br />';
		 echo 'image1 '.$products->product[$i]->image1.'<br />';
		 echo 'url '.$products->product[$i]->url.'<br /><br />';*/
	
		
		
		
		if( (($i > 300) AND ($i < 450)) AND (strlen($products->product[$i]->description) > 10)){
			
			
			// On test pour savoir si le produit existe déjà en BDD
			$req_exist = "SELECT id, id_affiliation FROM ".$bdd." WHERE id_affiliation=\"".trim($products->product[$i]->reference)."\" ";        	     	  	
    		$query_exist = mysqli_query($mysql_link,$req_exist);
    		$res_exist = mysqli_num_rows($query_exist);
    		$res_produit = mysqli_fetch_array($query_exist);

			
			if($res_exist == NULL){
				$action_requette = "INSERT INTO";
				$last_id = last_id($bdd,$mysql_link);
			}else{
				$action_requette = "UPDATE";	
				$last_id = $res_produit['id'];
			}			
     	
			
			
			$req  = $action_requette." ".$bdd." SET ";
			$req .= "id =\"".$last_id."\" ";
			$req .= ",id_affiliation =\"".trim($products->product[$i]->reference)."\" ";
			$req .= ",id_rubrique =15";
			$req .= ",id_cat =\"".trim($products->product[$i]->categorie)."\" ";
			
			$req .= ",id_marque =\"".trim($products->product[$i]->marque)."\" ";
			$req .= ",date_publication =\"".date("Y-m-d")."\" ";
			$req .= ",titre  =\"".addslashes(trim($products->product[$i]->libelle))."\" ";
			$req .= ",corps  =\"".addslashes(trim($products->product[$i]->description))."\" ";
			$req .= ",prix  =\"".$products->product[$i]->prixttc."\" ";
			$req .= ",nom_shop = \"".marque(trim($products->product[$i]->marque),$mysql_link)."\" ";
			$req .= ",url_shop  =\"".trim($products->product[$i]->url)."\" ";
			
			
			
			////GESTION DES IMAGES////
					
			//ON PREPRARE LE NOM DU FICHIER//
					
			$nom_image = prepare_url(filtre_url(nom_fichier_define(trim($products->product[$i]->libelle)))).'-'.$last_id.'.jpg'; 
					
			$url_image=trim($products->product[$i]->image1);
				
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
				
			$nom_fichier = prepare_url(filtre_url(nom_fichier_define(trim($products->product[$i]->libelle)))); 
			$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
			
			if($res_exist != NULL){ $req .= "WHERE id_affiliation=\"".trim($products->product[$i]->reference)."\" "; }


			echo $req.'<br /><br />';
			
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

                                            
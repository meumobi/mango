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





$url = "http://flux.netaffiliation.com/feed.php?maff=6EAFD111P447FD4ADC5217344353374v33";
$products = simplexml_load_file($url);
$i=0;




foreach($products as $produit){
	 
	
		
		
		
		if( (($i > 1) AND ($i < 10)) AND (strlen($products->product[$i]->Descriptif) > 255)){
			
			
		 echo 'reference '.$products->product[$i]->Id_produit.'<br />';
		 echo 'libelle '.$products->product[$i]->Nom.'<br />';
		 echo 'categorie '.$products->product[$i]->categorie.'<br />';
		 echo 'marque '.$products->product[$i]->Marque.'<br />';
		 echo 'description '.$products->product[$i]->Descriptif.'<br />';
		 echo 'image1 '.$products->product[$i]->Url_image_grande.'<br />';
		 echo 'Prix '.$products->product[$i]->Prix.'<br />';
		 echo 'url '.$products->product[$i]->Url.'<br /><br />';

			
			
			// On test pour savoir si le produit existe déjà en BDD
			$req_exist = "SELECT id, id_affiliation FROM ".$bdd." WHERE id_affiliation=\"".trim($products->product[$i]->Id_produit)."\" ";        	     	  	
            $query_exist = mysqli_query($mysql_link,$req_exist);
    		$res_exist = mysqli_num_rows($query_exist);
    		$res_produit = mysqli_fetch_array($query_exist);

			
			if($res_exist == NULL){
				$action_requette = "INSERT INTO";
				$last_id = last_id($bdd,$mysql_link);
			}else{
				$action_requette = "UPDATE";	
				$last_id = $res_produit['id'];
				echo "modif";
			}			
     	
			
			
			$req  = $action_requette." ".$bdd." SET ";
			$req .= "id =\"".$last_id."\" ";
			$req .= ",id_affiliation =\"".trim($products->product[$i]->Id_produit)."\" ";
			$req .= ",id_rubrique =15";
			$req .= ",id_cat =15";
			
			$req .= ",id_marque =\"".trim($products->product[$i]->Marque)."\" ";
			$req .= ",date_publication =\"".date("Y-m-d")."\" ";
			$req .= ",titre  =\"".addslashes(trim($products->product[$i]->Nom))."\" ";
			$req .= ",corps  =\"".addslashes(trim($products->product[$i]->Descriptif))."\" ";
			$req .= ",prix  =\"".$products->product[$i]->Prix."\" ";
			$req .= ",nom_shop = \"".marque(trim($products->product[$i]->Marque),$mysql_link)."\" ";
			$req .= ",url_shop  =\"".trim($products->product[$i]->Url)."\" ";
			
			
			
			////GESTION DES IMAGES////
					
			//ON PREPRARE LE NOM DU FICHIER//
					
			$nom_image = prepare_url(filtre_url(nom_fichier_define(trim($products->product[$i]->Nom)))).'-'.$last_id.'.jpg'; 
					
			$url_image=trim($products->product[$i]->Url_image_grande);
				
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
				
			$nom_fichier = prepare_url(filtre_url(nom_fichier_define(trim($products->product[$i]->Nom)))); 
			$req .= ",nom_fichier  =\"".$nom_fichier."\" ";
			
			if($res_exist != NULL){ $req .= "WHERE id_affiliation=\"".trim($products->product[$i]->Id_produit)."\" "; }


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

                                            
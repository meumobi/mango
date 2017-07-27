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
	echo $products->product[$i]->trackinglink.'<br />';*/

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
		$req_exist = "SELECT id FROM ".$bdd." WHERE url_shop LIKE '".$products->product[$i]->url."'";        	     	
    	$query_exist = mysqli_query($mysql_link,$req_exist);
    	$res_tab = mysqli_fetch_array($query_exist);
    	$res_exist = mysqli_num_rows($query_exist);	
		
		//AND (($i > 1) AND ($i < 2000))
		
		
		if(($res_exist != NULL)){
						
			//On récupère le dernière ID dans la base
        	$last_id = last_id($bdd,$mysql_link);
			
			
			$req = "UPDATE ".$bdd." SET ";
			$req .= "id_netaffiliation =\"".$products->product[$i]->reference."\" ";
			$req .= ",url_shop  =\"".$products->product[$i]->trackinglink."\" ";
			$req .= "WHERE id = ".$res_tab['id'];
				
			
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

                                            
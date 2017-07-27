<?php 
$admin = true;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-nom-fichier.php");
require("../../lib/include/n_i-meta.php");
require("../../lib/fonction/f-recadre-photo.php");


	/*echo $products->product[0]->reference.'<br />';
	echo $products->product[$i]->libelle.'<br />';
	echo $products->product[$i]->categorie.'<br />';
	echo $products->product[$i]->marque.'<br /><br />';
	echo $products->product[0]->prixttc.'<br />';
	echo $products->product[0]->categorie.'<br />';
	echo $products->product[0]->description.'<br />';
	echo $products->product[0]->image1.'<br />';
	echo $products->product[0]->url.'<br />';*/



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
	
	// On teste si la catégorie existe déjà
	$req_exist = "SELECT id FROM m_correspondance WHERE id_partenaire = 2 AND label_partenaire LIKE '".trim(addslashes($products->product[$i]->marque))."'";   	
	$query_exist = mysqli_query($mysql_link,$req_exist);
	$res_exist = mysqli_num_rows($query_exist);
	
	
	// On intègre si 
	if($res_exist == 0){
	    		
		$req = "INSERT INTO m_correspondance SET ";
	    
	    //1 pour le marque - 2 pour les catégorie
	    
	    $req .= "id_type_correspondance = 1 ";
	    
	    //2 pour hawaii surf
	    
	    $req .= ",id_partenaire = 2 ";
	    $req .= ",label_partenaire =\"".trim(addslashes($products->product[$i]->marque))."\" ";
	    	 	
	    $query = mysqli_query($mysql_link,$req);
    	
	    $nbrCorrespondanceCree++;
	    
	    //echo $req.'<br />';
	    //echo $products->product[$i]->categorie.'<br />';			
	    //echo $products->product[$i]->marque.'<br /><br />';
	}	
	
	$i++;

}



echo "Nombre de marque créé : ".$nbrCorrespondanceCree;



?>   
</div>
</body>

</html>

                                            
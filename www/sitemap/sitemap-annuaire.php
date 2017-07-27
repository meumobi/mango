<?php 
Header("content-type: application/xml"); 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/f-all.php");

$cache = '../lib/cache/corporate/sitemap-annuaire.html';
$expire = time() -43200 ; // valable une journee

if((file_exists($cache)) AND (filemtime($cache) > $expire)){
	readfile($cache);
}else{

	$map = 
	'<?xml version="1.0" encoding="UTF-8" ?>
	<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';
	
	
	//contenu Tag
	$req_annuaire = "SELECT * FROM m_annuaire WHERE en_ligne = 1"; 
	$query_annuaire = mysqli_query($mysql_link,$req_annuaire);
	
	while ($res_annuaire = mysqli_fetch_array($query_annuaire)){ 
	
	$map .= '<url>
	<loc>http://www.mango-surf.com/'.urlFichier($res_annuaire['id'],$res_annuaire['id_rubrique'],$mysql_link).'</loc>
	<changefreq>weekly</changefreq>
	<priority>0.3</priority>
	</url>';
	}
	
	$map .= '</urlset>';
	
	
	//mettre en cache le fichier
	ob_start(); 
	echo $map;

    $content_map = ob_get_contents(); 
    ob_end_clean(); 
        
    file_put_contents($cache, $content_map); 
    echo $content_map;
}




?>

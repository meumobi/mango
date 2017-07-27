<?php 
Header("content-type: application/xml"); 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/f-all.php");

$cache = '../lib/cache/corporate/sitemap-edito.html';
$expire = time() -43200 ; // valable une journee

if((file_exists($cache)) AND (filemtime($cache) > $expire)){
	readfile($cache);
}else{

	$map = 
	'<?xml version="1.0" encoding="UTF-8" ?>
	<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
	
	<url>
	<loc>http://www.mango-surf.com/</loc>
	<changefreq>daily</changefreq>
	<priority>1</priority>
	</url>
	
	<url>
	<loc>http://www.mango-surf.com/news/</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/agenda/</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/agenda/index-archive.php</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/news/locale/</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/trip-surf/</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/session/</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/video/</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/video/video-surf-1-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/video/video-bodyboard-2-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/video/teaser-3-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/video/plus-de-video-4-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/galerie-photo/</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/galerie-photo/photo-surf-5-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/galerie-photo/photo-bodyboard-6-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/galerie-photo/photo-spirit-7-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/galerie-photo/photo-paysage-8-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/galerie-photo/photo-vague-vierge-9-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/galerie-photo/plus-de-photo-10-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/shopping/</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/shopping/surfwear-15-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/shopping/board-16-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/shopping/wetsuit-18-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/shopping/high-tech-19-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/shopping/librairie-20-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/annuaire/</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/annuaire/surf-shop-26-0-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/annuaire/shaper-27-0-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/annuaire/surf-camp-29-0-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url> 
	
	<url>
	<loc>http://www.mango-surf.com/annuaire/surf-school-28-0-1.html</loc>
	<changefreq>weekly</changefreq>
	<priority>0.5</priority>
	</url>';
	
	
	//contenu editorial
	$req =  "SELECT id,id_rubrique FROM m_editorial WHERE en_ligne = 1 AND id_rubrique IN (1,2,3,4,5,6,7,8) AND date_publication < NOW() ORDER BY date_publication";
	$query = mysqli_query($mysql_link,$req);
	
	while ($res = mysqli_fetch_array($query)){ 
	
	$map .= '<url>
	<loc>http://www.mango-surf.com/'.urlFichier($res['id'],$res['id_rubrique'],$mysql_link).'</loc>
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

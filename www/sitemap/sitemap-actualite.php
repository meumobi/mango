<?php Header("content-type: application/xml"); require("../lib/fonction/f-connection.php"); require("../lib/fonction/f-all.php");
$map ='
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';
	//contenu editorial
	$req =  "SELECT id,id_rubrique,date_publication,titre FROM m_editorial WHERE (en_ligne = 1 AND id_rubrique IN (1,2,7) AND date_publication < NOW()) AND (TO_DAYS(NOW()) - TO_DAYS(date_publication) <= 25) ORDER BY date_publication DESC";
	$query = mysqli_query($mysql_link,$req);
	while ($res = mysqli_fetch_array($query)){
	$map .= '
	<url>
    <loc>http://www.mango-surf.com/'.urlFichier($res['id'],$res['id_rubrique'],$mysql_link).'</loc>
    <news:news>
      <news:publication>
        <news:name>mango-surf</news:name>
        <news:language>fr</news:language>
      </news:publication>
      <news:publication_date>'.$res['date_publication'].'</news:publication_date>
      <news:title>'.stripslashes($res['titre']).'</news:title>
    </news:news>
  </url>';
	}
	$map .= '</urlset>';
	echo $map;
?>
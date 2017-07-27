<?

require("../lib/fonction/f-connection.php");

if (($page == "") || ($page == 0)){
	$page = 1;
}

$PAR_PAGE = 10;

$req = "SELECT * from m_editorial WHERE en_ligne=1 AND date_publication < NOW() AND no_iphone=0 AND id_rubrique IN (1,2,4,6,7,8) ORDER BY date_publication DESC limit ".(($page-1)*$PAR_PAGE).",".$PAR_PAGE;
$query = mysqli_query($mysql_link,$req);
$nbr_news = mysqli_num_rows($query);

$json_news = '{"news":[';

$i = 1;

while($res = mysqli_fetch_array($query)){

	$json_news .= '{';
	$json_news .= '"id" : "'.$res["id"].'",';
	$json_news .= '"date_publi" : "'.$res["date_publication"].'",';
	$json_news .= '"titre" : "'.stripslashes($res["titre"]).'",';
	$json_news .= '"chapeau" : "'.stripslashes(str_replace('"','',strip_tags($res["chapeau"]))).'",';
	$json_news .= '"corps" : "'.stripslashes(str_replace('"','',strip_tags($res["corps"]))).'",';
	$json_news .= '"imagept" : "http://www.mango-surf.com/lib/image/editorial/'.$res['userfile1'].'",';
	$json_news .= '"imagegd" : "http://www.mango-surf.com/lib/image/editorial/iphone/'.$res['userfile3'].'",';
	$json_news .= '"legende" : "'.$res["legende3"].'",';
	$json_news .= '"copyright" : "'.$res["copyright3"].'",';
	$json_news .= '"signature" : "'.$res["signature"].'",';
	
	if($res['id_rubrique'] == 1) $url = "news";
	elseif ($res['id_rubrique'] == 2) $url = "interview";
	elseif ($res['id_rubrique'] == 4) $url = "trip-surf";
	elseif ($res['id_rubrique'] == 6) $url = "news/culture";
	elseif ($res['id_rubrique'] == 7) $url = "news/locale";
	elseif ($res['id_rubrique'] == 8) $url = "session";

	$json_news .= '"urlsite" : "http://www.mango-surf.com/'.$url.'/'.$res["nom_fichier"].'--'.$res["id"].'.html"';
	$json_news .= '}';
	
	
	if ($i != $nbr_news) { $json_news .= ','; }
	$json_news .= '';


	$i++;
	$affiche="";
}

$json_news .= ']}';

echo $json_news;

mysqli_close($mysql_link);

?>
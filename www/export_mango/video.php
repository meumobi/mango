<?

require("../lib/fonction/f-connection.php");

if (($page == "") || ($page == 0)){
	$page = 1;
}

$PAR_PAGE = 15;

$req = "SELECT * FROM m_editorial WHERE id_rubrique = 9 AND date_publication < NOW() AND no_iphone = 0 AND en_ligne = 1 ORDER BY id DESC limit ".(($page-1)*$PAR_PAGE).",".$PAR_PAGE;
$query = mysqli_query($mysql_link,$req);
$nbr_shopping = mysqli_num_rows($query);

$json_video = '{"video":[';

$i = 1;

while($res = mysqli_fetch_array($query)){

	$json_video .= '{';
	$json_video .= '"id" : "'.$res["id"].'",';
	$json_video .= '"nom" : "'.stripslashes($res["titre"]).'",';
	$json_video .= '"description" : "'.stripslashes(str_replace('"','',strip_tags($res["chapeau"]))).'",';
	$json_video .= '"imagept" : "http://www.mango-surf.com/lib/image/editorial/'.$res["userfile3"].'",';
	$json_video .= '"lien_video" : "'.$res["lien_video_iphone"].'",';
	$json_video .= '"urlsite" : "http://www.mango-surf.com/video/'.$res["nom_fichier"].'--'.$res["id"].'.html"';
	$json_video .= '}';
	
	
	if ($i != $nbr_shopping) { $json_video .= ','; }
	$json_video .= '';


	$i++;
}

$json_video .= ']}';

echo $json_video;

mysqli_close($mysql_link);

?>
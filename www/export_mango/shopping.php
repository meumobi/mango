<?

require("../lib/fonction/f-connection.php");

if (($page == "") || ($page == 0)){
	$page = 1;
}

$PAR_PAGE = 25;

$req = "SELECT * FROM m_shopping WHERE id_rubrique = 15 AND no_iphone=0 AND en_ligne=1 AND id_cat != 24 ORDER BY id DESC limit ".(($page-1)*$PAR_PAGE).",".$PAR_PAGE;
$query = mysqli_query($mysql_link,$req);
$nbr_shopping = mysqli_num_rows($query);

$json_shopping = '{"shopping":[';

$i = 1;

while($res = mysqli_fetch_array($query)){


	$req8 = "SELECT nom FROM m_tag WHERE id_cat = 32 AND id=".$res['id_marque'] ; 
	$query8 = mysqli_query ($mysql_link,$req8);
	$res8 = mysqli_fetch_array($query8);

	$json_shopping .= '{';
	$json_shopping .= '"id" : "'.$res["id"].'",';
	$json_shopping .= '"nom" : "'.stripslashes($res["titre"]).'",';
	$json_shopping .= '"marque" : "'.stripslashes($res8["nom"]).'",';
	$json_shopping .= '"imagegd" : "http://www.mango-surf.com/lib/image/shopping/'.$res["userfile2"].'",';
	$json_shopping .= '"imagept" : "http://www.mango-surf.com/lib/image/shopping/'.$res["userfile1"].'",';
	$json_shopping .= '"collection" : "'.date('Y').'",';
	$json_shopping .= '"prix" : "'.$res["prix"].' euros",';
	$json_shopping .= '"acheter" : "'.$res["url_shop"].'",';
	$json_shopping .= '"urlsite" : "http://www.mango-surf.com/shopping/'.$res["nom_fichier"].'--'.$res["id"].'.html"';
	$json_shopping .= '}';
	
	
	if ($i != $nbr_shopping) { $json_shopping .= ','; }
	$json_shopping .= '';


	$i++;
}

$json_shopping .= ']}';

echo $json_shopping;

mysqli_close($mysql_link);

?>
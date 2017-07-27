<?

require("../lib/fonction/f-connection.php");

if (($page == "") || ($page == 0)){
	$page = 1;
}

$PAR_PAGE = 16;

$req = "SELECT * from m_photo WHERE no_iphone=0 ORDER BY id desc limit ".(($page-1)*$PAR_PAGE).",".$PAR_PAGE;
$query = mysqli_query($mysql_link,$req);
$nbr_photo = mysqli_num_rows($query);



$json_photo = '{"photo":[';

$i = 1;

while($res = mysqli_fetch_array($query)){

	
	
	$json_photo .= '{';
	$json_photo .= '"id" : "'.$res["id"].'",';
	$json_photo .= '"legende" : "'.stripslashes($res["legende"]).'",';
	$json_photo .= '"copyright" : "'.stripslashes($res["copyright"]).'",';
	$json_photo .= '"image_gd" : "http://www.mango-surf.com/lib/image/photo/'.$res["userfile2"].'",';
	$json_photo .= '"image_pt" : "http://www.mango-surf.com/lib/image/photo/'.$res["userfile1"].'",';
	$json_photo .= '"urlsite" : "http://www.mango-surf.com/galerie-photo/'.$res["nom_fichier"].'--'.$res["id"].'-'.$res["id_cat"].'.html"';
	$json_photo .= '}';
	
	
	if ($i != $nbr_photo) { $json_photo .= ','; }
	$json_photo .= '';


	$i++;
}

$json_photo .= ']}';

echo $json_photo;


mysqli_close($mysql_link);

?>
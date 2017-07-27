<?

require("../lib/fonction/f-connection.php");

if (($page == "") || ($page == 0)){
	$page = 1;
}

$PAR_PAGE = 20;

$req = "SELECT * from m_agenda WHERE en_ligne=1 AND no_iphone=0 AND date_debut>='".$_GET['annee']."-01-01' AND date_debut<='".$_GET['annee']."-12-31' AND mois=".$_GET['mois_menu']." ORDER BY date_debut ASC limit ".(($page-1)*$PAR_PAGE).",".$PAR_PAGE;
$query = mysqli_query($mysql_link,$req);
$nbr_agenda = mysqli_num_rows($query);

$json_agenda = '{"agenda":[';

$i = 1;

while($res = mysqli_fetch_array($query)){

	if ($res['legende'] != ""){ $affiche = "http://www.mango-surf.com/lib/image/agenda/".$res["userfile1"];} else $affiche = "";

	$json_agenda .= '{';
	$json_agenda .= '"id" : "'.$res["id"].'",';
	$json_agenda .= '"titre" : "'.stripslashes($res["titre"]).'",';
	$json_agenda .= '"date_debut" : "'.$res["date_debut"].'",';
	$json_agenda .= '"date_fin" : "'.$res["date_fin"].'",';
	$json_agenda .= '"lieu" : "'.$res["lieu"].'",';
	$json_agenda .= '"affiche" : "'.$affiche.'",';
	$json_agenda .= '"description" : "'.stripslashes(str_replace('"','',strip_tags($res["corps"]))).'",';
	$json_agenda .= '"urlsite" : "http://www.mango-surf.com/agenda/'.$res["nom_fichier"].'--'.$res["id"].'.html"';
	$json_agenda .= '}';
	
	
	if ($i != $nbr_agenda) { $json_agenda .= ','; }
	$json_agenda .= '';


	$i++;
	$affiche="";
}

$json_agenda .= ']}';

echo $json_agenda;


mysqli_close($mysql_link);

?>
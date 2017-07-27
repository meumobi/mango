<?php
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/f-all.php");


$req_tag = "SELECT * FROM m_tag";
$query_tag = mysqli_query($mysql_link,$req_tag);

while($res_tag = mysqli_fetch_array($query_tag)){

	/*On teste si on a du contenu pour mettre la page en ligne*/
	$req_news = "SELECT * FROM m_editorial WHERE id_rubrique IN (1,2,4,6,7,8,9) AND ((titre LIKE '%".trim($res_tag['nom'])."%') OR (chapeau LIKE '%".trim($res_tag['nom'])."%'))";
	$query_news = mysqli_query($mysql_link,$req_news);
	$nbr_news = mysqli_num_rows($query_news);
	
	$req_update = "UPDATE m_tag SET nbr_content=".$nbr_news." WHERE id=".$res_tag['id'];
	$query_update = mysqli_query($mysql_link,$req_update);
}

?>
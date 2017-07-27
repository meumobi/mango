<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/f-all.php");


$req = "SELECT id,nom,mot_cle FROM m_tag WHERE id_cat IN(34,35)";
$query = mysqli_query($mysql_link,$req);

while($res = mysqli_fetch_array($query)){ 

	$req_news = "SELECT * FROM m_editorial WHERE (id_rubrique IN (1,2,4,6,7,8)) AND ";
	$req_news .= "((titre LIKE '%".trim($res['nom'])."%') OR (chapeau LIKE '%".trim($res['nom'])."%'))";
	
	$decoupe_mc = explode("-",$res['mot_cle']);
	$count_nbr = count($decoupe_mc);
	
	/*$i=1;
	foreach($decoupe_mc as $mc){
		$req_news .= "((titre LIKE '%".trim($mc)."%') OR (chapeau LIKE '%".trim($mc)."%'))";
		if($i != $count_nbr) $req_news .= " OR ";
		$i++;
	}*/
			
	$req_news .= "ORDER BY date_publication";
	
	$query_news = mysqli_query($mysql_link,$req_news);
	$nbr_news = mysqli_num_rows($query_news);
				
	if(!empty($nbr_news)){
		$req_update = "UPDATE m_tag SET en_ligne = 1 WHERE id = ".$res['id'];
		$i++;
	}else{
		$req_update = "UPDATE m_tag SET en_ligne = 0 WHERE id = ".$res['id'];
		$j++;
	}
	
	$query_update = mysqli_query($mysql_link,$req_update);
}

header("Location:index.php");
?>
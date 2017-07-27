<?php 
$admin=true;

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/n_f-pager.php");
require("../../lib/fonction/f-formulaire.php");



/*$req = "SELECT id, id_news, id_video FROM m_editorial";
$query = mysqli_query($mysql_link,$req);


while($res = mysqli_fetch_array($query)){

	//si j'ai des vidéos
	if(!empty($res['id_video'])){

		//si j'ai pas de news
		if(empty($res['id_news'])){
			$news_id = $res['id_video'];
		
		}else{
			$news_id = $res['id_news'].'-'.$res['id_video'];
		}
	

	$req_update = "UPDATE m_editorial SET id_news='".$news_id."', id_video='' WHERE id=".$res['id'];
	$query_update = mysqli_query($mysql_link,$req_update);
	
	echo $req_update."<br /><br />";
	
	}
}*/

$req = "SELECT id, userfile1, userfile3 FROM m_editorial WHERE id_rubrique = 9";
$query = mysqli_query($mysql_link,$req);

	while($res = mysqli_fetch_array($query)){

		if(empty($res['userfile1'])){
		
		$req_update = "UPDATE m_editorial SET userfile1='".$res['userfile3']."' WHERE id=".$res['id'];
		$query_update = mysqli_query($mysql_link,$req_update);
		
		echo $req_update."<br />";

		}
	}

?>




<title></title>	
</head>
	
<body>

</body>

</html>
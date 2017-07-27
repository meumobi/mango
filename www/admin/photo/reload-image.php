<?php

require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require("../../lib/fonction/f-recadre-photo.php");

$req = "SELECT * FROM m_photo ORDER BY id DESC LIMIT 5750 ,250";
$query = mysqli_query($mysql_link,$req);

while($res = mysqli_fetch_array($query)){
	
	copy("../../lib/image/photo/".$res['userfile2'],"../../lib/image/photo/320x160-".$res['userfile2']);

	$thumb = new Image("../../lib/image/photo/320x160-".$res['userfile2']);
	$thumb->width(320);
	$thumb->save();
			
	$thumb = new Image("../../lib/image/photo/320x160-".$res['userfile2']);
	$thumb->crop = true;
	$thumb->width(320);
	$thumb->height(160);
	$thumb->save();
	
	$req_insert = "UPDATE m_photo SET userfile3 = '320x160-".$res['userfile2']."' WHERE id =".$res['id'];
	$query_insert = mysqli_query($mysql_link,$req_insert);

}
?>
<?php
function upload_fichier($table,$userfile,$destination,$nom_fichier_image,$i,$supprimer_image,$last_id){

	require("f-connection.php");
	require("f-connection-ftp.php");
	
	// Je supprime les anciennes image
	if ($supprimer_image == 1){
	
		$req = "SELECT userfile".$i." FROM ".$table." WHERE id=".$last_id;
		$query = mysqli_query($mysql_link,$req);
		$res = mysqli_fetch_array($query);
		
		ftp_delete($conn_id, $destination.$res['nom_image'.$i]);
	}
	
	// Je teste le type de fichier
	if ($_FILES['userfile'.$i]['type'] == "image/jpeg")$type_fichier = "-".$i.".jpg";
	if ($_FILES['userfile'.$i]['type'] == "image/jpg") $type_fichier = "-".$i.".jpg";
	if ($_FILES['userfile'.$i]['type'] == "image/gif") $type_fichier = "-".$i.".gif"; 
	if ($_FILES['userfile'.$i]['type'] == "image/png") $type_fichier = "-".$i.".png"; 

	// Je determine le chemin
	$fichier_image = $nom_fichier_image.$type_fichier;
	$destination = $destination.$fichier_image;

	// J'upload le fichier
	$upload = ftp_put($conn_id, $destination,$_FILES['userfile'.$i]['tmp_name'], FTP_BINARY);
	unlink($_FILES['userfile'.$i]['tmp_name']);
	
	ftp_close($conn_id);

	return $fichier_image;

}
?>
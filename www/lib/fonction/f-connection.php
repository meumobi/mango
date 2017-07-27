<?php

// Fonction de connexion  la BDD

$server="localhost"; 
$user="mangosurf"; 
$r_password="6Bx8el5%";
$bdd="mangosurf";

$mysql_link = new mysqli($server,$user,$r_password,$bdd);
$mysql_link->query("SET NAMES 'utf8'");

if ($mysql_link== false){
	echo("Erreur interne : Connexion avec le serveur de base de donnes impossible");
	exit;
}

mysqli_select_db($mysql_link,$bdd);


if($admin!=true){

	//Pour afficher le bon path
	$pathSideBar = explode("/",$_SERVER['PHP_SELF']);
	$nbrChemin = count($pathSideBar);

	if ($nbrChemin == 2) $cheminSideBar="";
	elseif ($nbrChemin == 3) $cheminSideBar .= "../";
	elseif ($nbrChemin == 4) $cheminSideBar .= "../../";
	elseif ($nbrChemin == 5) $cheminSideBar .= "../../../";

	//Mobile detect
	require($cheminSideBar."lib/fonction/f_mobile_detect.php");

}



 
?>

<?php 

require("../../lib/fonction/f-connection.php");


$req_com = "SELECT id FROM m_commentaire WHERE etat = 0";
$query_com = mysqli_query($mysql_link,$req_com);
$nbr_com = mysqli_num_rows($query_com);

$req = "UPDATE m_commentaire SET ";
$req .= "nom =\"".addslashes($_POST['nom'])."\" ";
$req .= ",corps =\"".addslashes($_POST['corps'])."\" ";
$req .= ",etat  = 1";

$req .= " WHERE id  =\"".$_POST['id']."\" ";

$query = mysqli_query($mysql_link,$req);

if(($nbr_com-1) == 0) $etat_com = 1; else $etat_com = 0;


header("Location:index.php?etat=".$etat_com);


?>
<?php 
$admin = true;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");

/*Supprime les produits qui ont pas un texte de merde :-) */

$req = "DELETE FROM m_shopping WHERE corps LIKE '%HawaiiSurf, le spécialiste de tous les sports de%'";
//$query = mysqli_query($mysql_link,$req);

echo "toto";

?>
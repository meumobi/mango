<?php
$ftp_serveur = "cloud03-27.netsample.com";
$ftp_login = "mangosurf";
$ftp_password ="48q6%kOu";

$conn_id = ftp_connect($ftp_serveur);
$login_result = ftp_login($conn_id, $ftp_login, $ftp_password);
?>
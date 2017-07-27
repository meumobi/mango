<?php
require("../lib/fonction/f-connection.php");
require("../lib/fonction/f-all.php");


$req = "SELECT url_shop FROM m_shopping WHERE id = ".$_POST['id'];
$query = mysqli_query($mysql_link,$req);
$res = mysqli_fetch_array($query);



$ua = $_SERVER['HTTP_USER_AGENT'];
$uaGoogle="Googlebot/2.1 (+http://www.google.com/bot.html)";

if($ua!=$uaGoogle){
	header("Status: 301 Moved Permanently");
	header("Location:".$res['url_shop']);
}else{
echo "toto";
}




require("../lib/include/i-meta.php");	

?>

<title></title>	
<meta name="robots" content="noindex,nofollow">
</head>

<body>
</body>

</html>

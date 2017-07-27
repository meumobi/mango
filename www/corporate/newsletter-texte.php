<?php 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/f-all.php");

$url_site="http://www.mango-surf.com/";

if (!empty($_GET['id'])){

//test pour savoir si l'identifiants existe déjà dans la BDD
$req = "select * from m_newsletter where id=\"".$_GET['id']."\"";
$query = mysqli_query($mysql_link,$req);
$res = mysqli_fetch_array($query);
}else{
header("Status: 301 Moved Permanently", false, 301);
header("Location: ".$url_site);
exit();
}
?>


<html>
<head>
<meta charset="UTF-8" />
</head>
<body>




*|MC:SUBJECT|*	
<br /><br />				
			
			
<?php

if(!empty($res['news'])){

	$article = explode("-",$res['news']);
	$i=1;
	
	echo 'L\'actualité du surf';
	echo '<br />--------------------------------------------------<br /><br />';
	
	foreach ($article as $a){
	
	$req_article = "select * from m_editorial where id=\"".$a."\"";
	$query_article = mysqli_query($mysql_link,$req_article);
	$res_article = mysqli_fetch_array($query_article);
	
	echo dateformat($res_article["date_publication"],"en","fr").'<br />'; 
	echo stripslashes(htmlspecialchars($res_article['titre'])).'<br />'; 
	echo stripslashes(tronquer($res_article['chapeau'],240)).'<br />';
	echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link).'<br /><br />';
	
	}
}

if(!empty($res['shopping'])) {

	$produit = explode("-",$res['shopping']);
	$i=1;
	
	echo 'Les dernières tendances du monde de la glisse';
	echo '<br />--------------------------------------------------<br /><br />';
	
	foreach ($produit as $p){
	
	if($i == 1) $align = "left";
	elseif ($i == 2)$align="center";
	else $align="right";
	
	$req_produit = "select * from m_shopping where id=\"".$p."\"";
	$query_produit = mysqli_query($mysql_link,$req_produit);
	$res_produit = mysqli_fetch_array($query_produit);
	
	echo stripslashes($res_produit['titre']).'<br />';
	echo $url_site.urlFichier($res_produit['id'],$res_produit['id_rubrique'],$mysql_link).'<br /><br />'; 
	
	}
}

if(!empty($res['shopping'])) {

	echo 'L\'agenda des évènements surf';
	echo '<br />--------------------------------------------------<br /><br />';


	$req_agenda = "select * from m_agenda where en_ligne = 1 AND date_debut > NOW() ORDER BY date_debut ASC LIMIT 0,3";
	$query_agenda = mysqli_query($mysql_link,$req_agenda);

	while($res_agenda = mysqli_fetch_array($query_agenda)){
		
		echo dateformat($res_agenda["date_debut"],"en","fr").'<br />';
		echo stripslashes($res_agenda['titre']).' - '.stripslashes($res_agenda['lieu']).'<br />';
		echo $url_site.urlFichier($res_agenda['id'],$res_agenda['id_rubrique'],$mysql_link).'<br /><br />';
	}
}

?>

<br /><br />
Liker-nous sur Facebook : https://www.facebook.com/mang0surf<br />
Suivez-nous sur Twitter : http://twitter.com/mangosurf<br />
Encerclez-nous sur Google + : https://plus.google.com/b/111072983114894355573/111072983114894355573/posts<br /><br /><br />
Si vous ne souhaitez plus recevoir d'e-mail, <a href="*|UNSUB|*">suivez ce lien</a><br /><br />
Sent to *|EMAIL|*  why did I get this? (*|ABOUT_LIST|*)<br />
unsubscribe from this list (*|UNSUB|*) | update subscription preferences (*|UPDATE_PROFILE|*)<br />
*|LIST_ADDRESSLINE_TEXT|* *|REWARDS_TEXT|*

</body>
</html>

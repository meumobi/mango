<?php


require("../lib/fonction/f-connection.php");
require("../lib/fonction/f-all.php");

//$trans = get_html_translation_table(HTML_ENTITIES);


if(!empty($_GET['nbr_news'])){
	$nbr_news = $_GET['nbr_news'];
}else{
	$nbr_news = 5;
}

$req = "SELECT id,id_rubrique,titre,chapeau,auteur,date_publication,userfile1 FROM m_editorial WHERE en_ligne = 1 AND id_rubrique IN (1,2,4,7,8,9) AND date_publication < NOW()  ORDER BY date_publication DESC LIMIT 0,".$nbr_news;


$query = mysqli_query($mysql_link,$req);


$liste_last_news = "";

while ($res = mysqli_fetch_array($query)){
	$date_publi = explode("-",$res["date_publication"]);
		
	$titre = $res["titre"];

	$liste_last_news .= "<tr><td> </td></tr><tr><td align='justify'>";
	
	if($_GET['image'] == 1) { 
		$liste_last_news .="<img border='0' src='http://www.mango-surf.com/lib/image/editorial/".$res['userfile1']."' align='left' style='margin-right:10px;'>"; 
	}
	
	$liste_last_news .="<a style='font-family:verdana;  color:#333333; font-size:12px; text-decoration:none;' href='http://www.mango-surf.com/".urlFichier($res['id'],$res['id_rubrique'],$mysql_link)."' target='_blank'><strong>".addslashes($res['titre'])."</strong></a>";
	
	if($_GET['description'] == 1){
		$chapeau = $res["chapeau"];
		$liste_last_news .="<br />".addslashes($chapeau); 
	}
	$liste_last_news .= "<br></td></tr>";
	}

$actus = "<table widht='100%' style='font-family:verdana; color:#444444; font-size:11px; border:none;'>".$liste_last_news."<tr><td align='center'><a title='Mango-surf.com, actualité du surf' href='http://www.mango-surf.com' target='_blank'><img alt='Mango-surf.com, actualité du surf' title='Mango-surf.com, actualité du surf' src='http://www.mango-surf.com/lib/image/template/logo.jpg' border='0' style='border:0px;' /></a></td></tr></table>";
$actus = ereg_replace("\n","",$actus);


?>



document.write("<? echo($actus); ?>");
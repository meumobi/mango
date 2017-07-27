<?php Header("content-type: application/xml"); 

require("../lib/fonction/f-all.php");
require("../lib/fonction/f-connection.php");

	
	$req_rss = "SELECT id,id_rubrique,titre,chapeau,auteur,date_publication FROM m_editorial WHERE en_ligne = 1 AND id_rubrique IN (1,2,4,6,7,8,9) AND date_publication <= NOW()  ORDER BY date_publication DESC LIMIT 0,20";
	$query_rss = mysqli_query($mysql_link,$req_rss);
	
	$rss .= '<rss version="2.0">';
	$rss .=	'<channel>';
	$rss .=	'<link>http://www.mango-surf.com/</link>';
	$rss .=	'<title>Mango-surf.com</title>';
	$rss .=	'<description>L\'actualité du surf depuis 2006 !</description>';
	$rss .=	'<image>';
	$rss .=	'<url>http://www.mango-surf.com/img/mango-template/general/logo-mango-surf.png</url>';
	$rss .=	'<title>L\'actualité du surf</title>';
	$rss .=	'<link>http://www.mango-surf.com/</link>';
	$rss .=	'</image>';
	$rss .=	'</channel>';
	
		
	while ($res_rss = mysqli_fetch_array($query_rss)){ 
		
		$titre = $res_rss['titre'];
		$titre = ereg_replace("&", " ",$titre);
		$titre = ereg_replace("â", "'",$titre);
		$titre = ereg_replace("â", "-",$titre);
			
		$chapeau = $res_rss['chapeau'];
		$chapeau = ereg_replace("&", " ",$chapeau);
		$chapeau = ereg_replace("â", "'",$chapeau);
		$chapeau = ereg_replace("â", "-",$chapeau);
	
		$rss .=	'<item>';
		$rss .=	'<title>'.$titre.'</title>';
		$rss .=	'<link>http://www.mango-surf.com/'.urlFichier($res_rss['id'],$res_rss['id_rubrique'],$mysql_link).'</link>';
		$rss .=	'<description>'.$chapeau.'</description>';
		
		if(!empty($res_rss['auteur'])) {
			$rss .=	'<author>'.$res_rss['auteur'].'</author>';
		}
		      
		$date_publication = dateformat($res_rss["date_publication"],"en","fr"); 
				
		if($date_publication != "00-00-0000"){
			$rss .=	'<pubDate>'.$date_publication.'</pubDate>';
		}  
		
		$rss .=	'<source>www.mango-surf.com</source>';
		$rss .=	'</item>';
	} 
	$rss .=	'</rss>';	


    echo $rss;   

?>

	

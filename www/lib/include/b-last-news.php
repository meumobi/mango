<?php

$cache = '../lib/cache/template/last_news.html';
$expire = time() -10800 ; // 10800 valable 1/4 journee

if((file_exists($cache)) AND (filemtime($cache) > $expire)){
	readfile($cache);
}else{

$req_last_news = "SELECT id, id_rubrique, NULL AS id_photographe, id_emplacement, userfile1, titre, date_publication FROM m_editorial WHERE id_emplacement IN (1,2,3) AND date_publication < NOW() UNION ALL SELECT id, id_rubrique, id_photographe, id_emplacement, userfile1, titre, date_publication FROM m_photo WHERE id_emplacement IN (1,2,3) AND date_publication < NOW() ORDER BY date_publication DESC LIMIT 0,5";
$query_last_news = mysqli_query($mysql_link,$req_last_news);

ob_start();

?>


<div class="titreN bloc_arrondie">Les dernières news</div>

<div class="newsletter bgblanc bloc_arrondie pad20 mrgB20">

	<?php 
	
	while($res_last_news = mysqli_fetch_array($query_last_news)){ 
	
	
	if(!empty($res_last_news['id_photographe'])){
		$id_rubrique_last_news = $res_last_news['id_rubrique']."-".$res_last_news['id_photographe'];
		$lien_last_news = "/".urlFichier($res_last_news['id'],$id_rubrique_last_news,$mysql_link);
	}else{
		$id_rubrique_last_news = $res_last_news['id_rubrique'];
		$lien_last_news = "/".urlFichier($res_last_news['id'],$id_rubrique_last_news,$mysql_link);
	}

	
	?>
		<div class="clearB borderLastNews padLastNews">
			<a class="font12 fontBold" href="<?php echo $lien_last_news; ?>" title="<?php echo $res_last_news['titre']; ?>"><?php echo rubrique($res_last_news['id_rubrique'],$mysql_link).' - '.$res_last_news['titre']; ?></a>
		</div>

	<?php 
	
	$id_rubrique_last_news ="";
	$lien_last_news="";
	}
	?>

	<div class="mrgT10"><a class="font12 fontGriClair fontBold" href="/news/" title="Voir toutes les news" rel="nofollow">Voir toutes les news</a></div>

</div>

<?php
$last_news = ob_get_contents(); 
ob_end_clean(); 
        
file_put_contents($cache, $last_news); 
echo $last_news;
}
?>


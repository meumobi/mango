<?php

$cache = '../lib/cache/template/last_news.html';
$expire = time() -10800 ; // 10800 valable 1/4 journee

if((file_exists($cache)) AND (filemtime($cache) > $expire)){
	readfile($cache);
}else{

$req_last_news = "SELECT id, id_rubrique, NULL AS id_photographe, id_emplacement, userfile0 AS photo, titre, date_publication FROM m_editorial WHERE id_emplacement IN (1,2,3,4) AND date_publication < NOW() UNION ALL SELECT id, id_rubrique, id_photographe, id_emplacement, userfile3 AS photo, titre, date_publication FROM m_photo WHERE id_emplacement IN (1,2,3,4) AND date_publication < NOW() ORDER BY date_publication DESC LIMIT 0,5";
$query_last_news = mysqli_query($mysql_link,$req_last_news);

ob_start();

?>

<section class="mb2">

<div class="titreRubrique line mb2">Les dernières news</div>


	<?php 
	$i="";
	while($res_last_news = mysqli_fetch_array($query_last_news)){ 
	
	if(!empty($res_last_news['id_photographe'])){
		$id_rubrique_last_news = $res_last_news['id_rubrique']."-".$res_last_news['id_photographe'];
		$lien_last_news = "/".urlFichier($res_last_news['id'],$id_rubrique_last_news,$mysql_link);
		$chemin = "/lib/image/photo/";
	}else{
		$id_rubrique_last_news = $res_last_news['id_rubrique'];
		$lien_last_news = "/".urlFichier($res_last_news['id'],$id_rubrique_last_news,$mysql_link);
		$chemin = "/lib/image/editorial/";

	}

	
	?>
		<div class="line pa1 zebre">
			<a href="<?php echo $lien_last_news; ?>" title="<?php echo $res_last_news['titre']; ?>"><img src="<?php echo $chemin.$res_last_news['photo']; ?>" alt="<?php echo $res['titre']; ?>" class="clear" /></a>
			<a href="<?php echo $lien_last_news; ?>" title="<?php echo $res_last_news['titre']; ?>"><strong class="small"><?php echo rubrique($res_last_news['id_rubrique'],$mysql_link).' - '.$res_last_news['titre']; ?></strong></a>
		</div>

	<?php
	$bg=""; 
	$i++;
	$id_rubrique_last_news ="";
	$lien_last_news="";
	}
	?>

</section>
<?php
$last_news = ob_get_contents(); 
ob_end_clean(); 
        
file_put_contents($cache, $last_news); 
echo $last_news;
}
?>


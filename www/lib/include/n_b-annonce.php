<?php

$cache = ' /lib/cache/template/last_annonce.html';
$expire = time() -10800 ; // 10800 valable 1/4 journee

if((file_exists($cache)) AND (filemtime($cache) > $expire)){
	readfile($cache);
}else{

$req_annonce = "SELECT * FROM m_editorial WHERE id_rubrique= 19 AND en_ligne = 1 ORDER BY date_publication DESC LIMIT 0,3";
$query_annonce = mysqli_query($mysql_link,$req_annonce);


ob_start();

?>

<section class="mb2">

<div class="titreRubrique line mb2">Petites annonces</div>

	<?php 
	while($res_annonce = mysqli_fetch_array($query_annonce)){ 
	?>
	
		<div class="line pa1 zebre">
			<a href="<?php echo "/".urlFichier($res_annonce['id'],$res_annonce['id_rubrique'],$mysql_link) ?>" title="<?php echo $res_annonce['titre']; ?>"><strong class="small"><?php echo categorie($res_annonce['id_cat'],$mysql_link)." - ".$res_annonce['titre']; ?></strong></a>
		</div>

	<?php } ?>

</section>

<a href="/annonce/ajout.php" title="Postez une annonce"><div class="bouton txtcenter mb2">Postez une annonce</div></a>

<?php
$last_annonce = ob_get_contents(); 
ob_end_clean(); 
        
file_put_contents($cache, $last_annonce); 
echo $last_annonce;
}
?>


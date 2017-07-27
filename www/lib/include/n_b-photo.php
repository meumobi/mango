<?php

$req_photo_side_bar = "SELECT id, id_cat, userfile2, legende, nom_fichier FROM m_photo ORDER BY rand() LIMIT 0,1";
$query_photo_side_bar = mysqli_query($mysql_link,$req_photo_side_bar);
$res_photo_side_bar = mysqli_fetch_array($query_photo_side_bar);
?>


<section class="mb2">

<div class="titreRubrique line mb2">Zoom</div>

	<a href="/galerie-photo/<?php echo $res_photo_side_bar['nom_fichier']; ?>--<?php echo $res_photo_side_bar['id']."-".$res_photo_side_bar['id_cat']; ?>.html" title="<?php echo $res_photo_side_bar['legende']; ?>">
	<img src="/lib/image/photo/<?php echo $res_photo_side_bar['userfile2']; ?>" alt="<?php echo $res_photo_side_bar['legende']; ?>" border="0" />
	</a>
	
</section>


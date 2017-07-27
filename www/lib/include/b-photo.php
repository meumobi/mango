<?php

$req_photo_side_bar = "SELECT id, id_cat, userfile3, legende, nom_fichier FROM m_photo ORDER BY rand() LIMIT 0,6";
$query_photo_side_bar = mysqli_query($mysql_link,$req_photo_side_bar);

?>


<div class="titreN bloc_arrondie">Zoom</div>

<div class="newsletter bgblanc bloc_arrondie pad20 mrgB20">

	<?php 
	$i="1";
	$z="1";
	while($res_photo_side_bar = mysqli_fetch_array($query_photo_side_bar)){ 
	if($i==4)$i=1;
	if($i!=3)$mrgDphoto = "mrgD10";
	if($z!=4)$mrgBphoto = "mrgB10";
	?>
		<?php if($i == 1) echo '<div class="clearB '.$mrgBphoto.'">'; ?>
		<a href="/galerie-photo/<?php echo $res_photo_side_bar['nom_fichier']; ?>--<?php echo $res_photo_side_bar['id']."-".$res_photo_side_bar['id_cat']; ?>.html" title="<?php echo $res_photo_side_bar['legende']; ?>">
		<img class="<?php echo $mrgDphoto;?>" src="/lib/image/photo/<?php echo $res_photo_side_bar['userfile3']; ?>" alt="<?php echo $res_photo_side_bar['legende']; ?>" width="76" height="76" border="0" />
		</a>
		<?php if($i == 3) echo '</div>'; ?>

	<?php 
	$i++;
	$z++;
	$mrgDphoto="";
	$mrgBphoto="";
	
	} 
	
	?>

</div>


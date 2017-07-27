<div class="titreN bloc_arrondie">Event On !</div>

<div class="newsletter bgblanc bloc_arrondie pad20 mrgB20 alignC">

	<?php 
	$i="1";
	while($res_affiche_agenda = mysql_fetch_array($query_affiche_agenda)){ 
	
	if($i==1) $mrgDphoto="mrgD15";
	
	?>
		<a href="/agenda/<?php echo $res_affiche_agenda['nom_fichier']; ?>--<?php echo $res_affiche_agenda['id']; ?>.html" title="<?php echo $res_affiche_agenda['titre']; ?>">
		<img class="<?php echo $mrgDphoto;?>" src="/lib/image/agenda/<?php echo $res_affiche_agenda['userfile1']; ?>" alt="<?php echo $res_affiche_agenda['titre']; ?>" width="120" height="130" />
		</a>

	<?php 
	$i++;
	$mrgDphoto="";
	} 
	
	?>

</div>


<h1 class="h2-like m-reset"><?php echo stripslashes($res['nom']); ?></h1>

<?php if(!empty($res['corps'])){ ?>
	<div itemscope itemtype="http://schema.org/Person">
	
	
	<?php 
	
	if($res['userfile1'] != NULL){
	
		$image  = "<figure class='right'>";
		$image .= "<img src='/lib/image/surfeur/".$res['userfile1']."' alt='".$res['nom']."' itemprop='image' class='right' /><br />";
		$image .= "<figcaption class='right'><em>".$res['legende']." - ".$res['copyright']."</em></figcaption>";
		$image .= "</figure>";
	
	}	
	?>


	<p itemprop="description"><?php echo $image.nl2br(stripslashes($res['corps'])); ?></p> 
				
	</div>

<?php } ?>
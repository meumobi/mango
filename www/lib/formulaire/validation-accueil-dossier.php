<script language="JavaScript" type="text/JavaScript">
<!--
function valid(){

	<?php echo $validation = validationinput("edito","titre","==","0","Attention ! Vous avez oublié de saisir le titre","false"); ?>
	
	<?php
	
	if($_GET['id_rubrique'] == 3){ echo $validation = validationinput("edito","id_pays","==","\" \"","Attention ! Vous avez oublié de saisir votre pays","false"); } ?>
	
	<?php echo $validation = validationinput("edito","chapeau","==","0","Attention ! Vous avez oublié de saisir le chapeau","false"); ?>
	<?php echo $validation = validationinput("edito","chapeau",">","255","Attention ! Votre chapeau dépasse les 255 caractères","false"); ?>

	
	<?php echo $validation = validationinput("edito","legende3","==","0","Attention ! Vous avez oublié de saisir la légende","false"); ?>
	<?php echo $validation = validationinput("edito","copiryght3","==","0","Attention ! Vous avez oublié de saisir le copiryght","false"); ?>

}

-->
</script>
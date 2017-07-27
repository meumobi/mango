<script language="JavaScript" type="text/JavaScript">
<!--
function valid(){

	<?php echo $validation = validationinput("edito","titre","==","0","Attention ! Vous avez oublié de saisir le titre","false"); ?>
	<?php echo $validation = validationinput("edito","id_cat","==","\" \"","Attention ! Vous avez oublié de saisir le thème de la vidéo","false"); ?>

	<?php echo $validation = validationinput("edito","chapeau","==","0","Attention ! Vous avez oublié de saisir le chapeau","false"); ?>
	<?php echo $validation = validationinput("edito","chapeau",">","255","Attention ! Votre chapeau dépasse les 255 caractères","false"); ?>
	
	<?php echo $validation = validationinput("edito","video_article","==","0","Attention ! Vous avez oublié de saisir le code de la vidéo","false"); ?>
}

-->
</script>
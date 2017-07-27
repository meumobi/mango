<script language="JavaScript" type="text/JavaScript">
<!--
function valid(){

	<?php echo $validation = validationinput("edito","titre","==","0","Attention ! Vous avez oublié de saisir le titre","false"); ?>
	<?php echo $validation = validationinput("edito","id_pays","==","\" \"","Attention ! Vous avez oublié de saisir le pays de votre session","false"); ?>
	<?php echo $validation = validationinput("edito","spot","==","0","Attention ! Vous avez oublié de saisir le nom du spot","false"); ?>

	<?php echo $validation = validationinput("edito","chapeau","==","0","Attention ! Vous avez oublié de saisir le chapeau","false"); ?>
	<?php echo $validation = validationinput("edito","chapeau",">","255","Attention ! Votre chapeau dépasse les 255 caractères","false"); ?>
	
	<?php echo $validation = validationinput("edito","corps","==","0","Attention ! Vous avez oublié de saisir le texte","false"); ?>
	<?php echo $validation = validationinput("edito","auteur","==","0","Attention ! Vous avez oublié de saisir l'auteur de la session","false"); ?>
	
	if(document.edito.userfile3.value.length != 0){
		<?php echo $validation = validationinput("edito","copyright3","==","0","Attention ! Vous avez oublié de saisir le copyright","false"); ?>
		<?php echo $validation = validationinput("edito","legende3","==","0","Attention ! Vous avez oublié de saisir la légende","false"); ?>
	}
	
}

-->
</script>
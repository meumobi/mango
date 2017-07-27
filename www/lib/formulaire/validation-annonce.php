<script language="JavaScript" type="text/JavaScript">
<!--
function valid(){

	<?php echo $validation = validationinput("edito","titre","==","0","Attention ! Vous avez oublié de saisir le titre","false"); ?>
	<?php echo $validation = validationinput("edito","id_cat","==","\" \"","Attention ! Vous avez oublié de saisir le type d'annonce","false"); ?>
	<?php echo $validation = validationinput("edito","corps","==","0","Attention ! Vous avez oublié de saisir le texte","false"); ?>
	<?php echo $validation = validationinput("edito","email","==","0","Attention ! Vous avez oublié de saisir votre e-mail","false"); ?>

}

-->
</script>
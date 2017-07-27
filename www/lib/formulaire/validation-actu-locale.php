<script language="JavaScript" type="text/JavaScript">
<!--
function valid(){

	<?php echo $validation = validationinput("edito","titre","==","0","Attention ! Vous avez oublié de saisir le titre","false"); ?>
	<?php echo $validation = validationinput("edito","id_region","==","\" \"","Attention ! Vous avez oublié de saisir votre région","false"); ?>

	<?php echo $validation = validationinput("edito","chapeau","==","0","Attention ! Vous avez oublié de saisir le chapeau","false"); ?>
	<?php echo $validation = validationinput("edito","chapeau",">","255","Attention ! Votre chapeau dépasse les 255 caractères","false"); ?>
	
	<?php echo $validation = validationinput("edito","corps","==","0","Attention ! Vous avez oublié de saisir le texte","false"); ?>
	
	if(document.edito.userfile3.value.length != 0){

		<?php echo $validation = validationinput("edito","legende3","==","0","Attention ! Vous avez oublié de saisir la légende","false"); ?>
		<?php echo $validation = validationinput("edito","copyright3","==","0","Attention ! Vous avez oublié de saisir le copyright","false"); ?>
	}

}

-->
</script>



	
	
	
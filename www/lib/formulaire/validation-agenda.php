<script language="JavaScript" type="text/JavaScript">
<!--
function valid(){

	<?php echo $validation = validationinput("edito","titre","==","0","Attention ! Vous avez oublié de saisir le titre de la manifestation","false"); ?>
	<?php echo $validation = validationinput("edito","date_debut","==","0","Attention ! Vous avez oublié de saisir la date de début de la manifestation","false"); ?>
	<?php echo $validation = validationinput("edito","date_fin","==","0","Attention ! Vous avez oublié de saisir la date de fin de la manifestation","false"); ?>
	<?php echo $validation = validationinput("edito","corps","==","0","Attention ! Vous avez oublié de saisir le texte","false"); ?>
	
	
	<?php echo $validation = validationinput("edito","lieu","==","0","Attention ! Vous avez oublié de saisir le lieu de la manifestation","false"); ?>

	if(document.edito.userfile2.value.length != 0){
		
			<?php echo $validation = validationinput("edito","legende","==","0","Attention ! Vous avez oublié de saisir une legende","false"); ?>
			<?php echo $validation = validationinput("edito","copyright","==","0","Attention ! Vous avez oublié de saisir le copyright","false"); ?>
	}
	
}

-->
</script>
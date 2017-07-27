<script language="JavaScript" type="text/JavaScript">
<!--

function valid(){

	
	<?php echo $validation = validationinput("edito","legende","==","0","Attention ! Vous avez oublié de saisir la légende","false"); ?>
	<?php echo $validation = validationinput("edito","copyright","==","0","Attention ! Vous avez oublié de saisir le copiryght","false"); ?>
	<?php echo $validation = validationinput("edito","chapeau",">","255","Attention ! Votre chapeau dépasse les 255 caractères","false"); ?>
	<?php echo $validation = validationinput("edito","id_cat","==","\" \"","Attention ! Vous avez oublié de saisir la catégorie","false"); ?>


		
	
}

-->
</script>



	
	
	
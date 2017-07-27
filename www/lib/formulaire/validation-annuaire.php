<script language="JavaScript" type="text/JavaScript">
<!--

function valid(){

	<?php echo $validation = validationinput("edito","titre","==","0","Attention ! Vous avez oublié de saisir le nom de votre entreprise","false"); ?>
	
	
	<?php 
	
	if ($_GET['id_rubrique']!= 14){
		echo $validation = validationinput("edito","id_region","==","\" \"","Attention ! Vous avez oublié de saisir votre région","false"); 
	}else{
		echo $validation = validationinput("edito","id_pays","==","\" \"","Attention ! Vous avez oublié de saisir votre pays","false"); 
	}
	
	
	
	?>


	<?php echo $validation = validationinput("edito","corps","==","0","Attention ! Vous avez oublié de saisir la présentation de votre entreprise","false"); ?>
	<?php echo $validation = validationinput("edito","adresse","==","0","Attention ! Vous avez oublié de saisir l'adresse","false"); ?>
	<?php echo $validation = validationinput("edito","cp","==","0","Attention ! Vous avez oublié de saisir le code postal","false"); ?>
	<?php echo $validation = validationinput("edito","ville","==","0","Attention ! Vous avez oublié de saisir la ville","false"); ?>
	<?php echo $validation = validationinput("edito","email","==","0","Attention ! Vous avez oublié de saisir votre e-mail","false"); ?>
	
	if(document.edito.userfile3.value.length != 0){

		<?php echo $validation = validationinput("edito","legende3","==","0","Attention ! Vous avez oublié de saisir la légende","false"); ?>
		<?php echo $validation = validationinput("edito","copyright3","==","0","Attention ! Vous avez oublié de saisir le copyright","false"); ?>
	}
}

-->
</script>



	
	
	
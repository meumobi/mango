<?php echo $input = input("Nom de la rubrique<span class='alerte'>*</span>","nom","text","255",$res['nom'],"input",""); ?>


<?php echo $input = input("Chemin URL<span class='alerte'>*</span>","chemin","text","180",$res["chemin"],"gauche","flotG mrgD10"); ?>
<?php echo $input = input("Ancien chemin URL<span class='alerte'>*</span>","old_chemin","text","255",$res['old_chemin'],"gauche",""); ?>

<?php echo $input = input("Titre de la rubrique<span class='alerte'>*</span>","titre","text","255",$res['titre'],"input",""); ?>
<?php echo $textarea = textarea("Introduction de la rubrique","presentation",$res["presentation"],"10",""); ?>

<?php echo $textarea = textarea("Information caractéristique d'ajout","info_complementaire",$res["info_complementaire"],"10",""); ?>

<?php echo $input = input("Formulaire<span class='alerte'>*</span>","formulaire","text","180",$res["formulaire"],"gauche","flotG mrgD10"); ?>
<?php echo $input = input("Validation formulaire<span class='alerte'>*</span>","validation_formulaire","text","255",$res['validation_formulaire'],"gauche",""); ?>

<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","button bloc_arrondie"); ?>
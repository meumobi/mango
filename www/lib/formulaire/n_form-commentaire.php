<?php echo $input = input("Auteur<span class='alerte'>*</span>","nom","text","255",$res["nom"],"borderGray pa1 w100",""); ?>
<?php echo $textarea = textarea("Commentaire<span class='alerte'>*</span>","corps",$res["corps"],"2","borderGray pa1 w100"); ?>
<?php echo $input = input("","link","text","180","","","desktop-hidden tablet-hidden phone-hidden"); ?>
<?php echo $input = input("","ajout","hidden","180","1","",""); ?>
<?php echo $input = input("","id","hidden","180",$res["id"],"",""); ?>
<?php echo $bouton = bouton("Postez votre commentaire","commentaire","submit","bouton mt1"); ?>
<?php echo $input = input("Auteur<span class='alerte'>*</span>","nom","text","255",$res["nom"],"formCommentaire",""); ?>
<?php echo $textarea = textarea("Commentaire<span class='alerte'>*</span>","corps",$res["corps"],"2","formCommentaire"); ?>
<?php echo $input = input("","link","text","180","","","dispalyNone"); ?>
<?php echo $input = input("","ajout","hidden","180","1","",""); ?>
<?php echo $input = input("","id","hidden","180",$res["id"],"",""); ?>
<?php echo $bouton = bouton("Valider","commentaire","submit","boutonC bloc_arrondie"); ?>
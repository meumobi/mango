<?php echo $input = input("Titre <span class='alerte'>*</span>","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>
<?php echo $textarea = textarea("Texte <span class='alerte'>*</span>","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); ?>
<?php echo $input = input("","date_publication","hidden","255",$date_publication,"w100 pa1 borderGray","mb1"); ?>

<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>


<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
<?php echo $input = input("Nom du partenaire<span class='alerte'>*</span>","titre","text","255",$res['titre'],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Lien<span class='alerte'>*</span>","url","text","255",$res['url'],"w100 pa1 borderGray","mb1"); ?>

<?php echo $textarea = textarea("Présentation","corps",$res["corps"],"10","w100 pa1 borderGray mb1"); ?>
<?php echo $input = input("Photo","userfile1","file","180","","w100 pa1 borderGray","mb1"); ?>

<?php echo $checkbox = checkbox("Mettre en avant","promo",$res["promo"],1,"pa1 borderGray","left mr1"); ?>
<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
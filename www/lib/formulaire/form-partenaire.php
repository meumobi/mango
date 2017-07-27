<?php echo $input = input("Nom du partenaire<span class='alerte'>*</span>","titre","text","255",$res['titre'],"input",""); ?>
<?php echo $input = input("Lien<span class='alerte'>*</span>","url","text","255",$res['url'],"input",""); ?>

<?php echo $textarea = textarea("Présentation","corps",$res["corps"],"10",""); ?>
<?php echo $input = input("Photo","userfile1","file","180","","input",""); ?>
<?php echo $checkbox = checkbox("Mettre en avant","promo",$res["promo"],1,"checkbox","flotG mrgD10"); ?>
<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","button bloc_arrondie"); ?>
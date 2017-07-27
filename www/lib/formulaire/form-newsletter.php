<?php echo $input = input("News (3 x ID)<span class='alerte'>*</span>","news","text","255",$res['news'],"gauche","flotG mrgD10"); ?>
<?php echo $input = input("Shopping (3 x ID)","shopping","text","255",$res['shopping'],"gauche",""); ?>
<?php echo $input = input("Url pub","url_pub","text","255",$res['url_pub'],"input",""); ?>

<?php echo $input = input("Pub","userfile1","file","180","","gauche",""); ?>


<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","button bloc_arrondie"); ?>
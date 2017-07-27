<section class="line mb1 grid">
	<div class="grid2">
<?php echo $input = input("News (3 x ID)<span class='alerte'>*</span>","news","text","255",$res['news'],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Shopping (Exemple 2152,2154,2152)","shopping","text","255",$res['shopping'],"w100 pa1 borderGray","mb1"); ?>
	</div>
</section>
<?php echo $input = input("Photo (1 X ID)","photo","text","255",$res['photo'],"w100 pa1 borderGray","mb1"); ?>

<?php echo $input = input("Url pub","url_pub","text","255",$res['url_pub'],"w100 pa1 borderGray","mb1"); ?>
<?php echo $input = input("Pub","userfile1","file","180","","w100 pa1 borderGray","mb1"); ?>


<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
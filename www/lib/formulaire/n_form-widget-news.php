<?php echo $input = input("<h2>Nombre de news à afficher sur votre site</h2>","nbr_news","text","255",$_POST['nbr_news'],"w100 pa1 borderGray","mb1"); ?>
<?php echo $checkbox = checkbox("<strong>Cocher pour afficher les photos</strong>","photo_widget",$_POST['photo_widget'],1,"pa1 borderGray","left mr1"); ?>
<?php echo $checkbox = checkbox("<strong>Cocher pour afficher afficher le chapeau</strong>","chapeau_widget",$_POST['chapeau_widget'],1,"pa1 borderGray","left mr1"); ?>
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>


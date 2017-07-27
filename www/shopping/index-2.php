<?php
$rubrique = 15;

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");


require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');

//Pour ne pas afficher le bloc photo + sky + business dans la sideBar
$no_photo = 1;
$no_sky = 1;



//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 1)){
    $p = 1;
}else{
    $p = $_GET['p'];
}
$par_page = 15;

//WHERE id_cat=".$_GET['id']."
$req = "SELECT * FROM m_shopping WHERE id_cat != 16 ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);
$nbr_shopping = mysqli_num_rows($query);


while($res = mysqli_fetch_array($query)){


    //Initialisation du tableau pour smarty
    $resultat[$i]['titre'] 	= stripslashes($res['titre']);
    $resultat[$i]['chapeau']  = stripslashes($res['corps']);
    $resultat[$i]['url'] 		= '/'.urlFichier($res['id'],$res['id_rubrique'],$mysql_link);
    $resultat[$i]['image_une'] 	= '../lib/image/shopping/'.$res['userfile2'];
    $resultat[$i]['image'] 	= '../lib/image/shopping/'.$res['userfile2'];
    $resultat[$i]['image-pt'] 	= '../lib/image/shopping/'.$res['userfile2'];
    $resultat[$i]['iz']		= $i;
    $resultat[$i]['rubrique'] = $rubrique;
    $resultat[$i]['device'] = $device[1];

    $i++;
}

?>



<?php require("../lib/include/n_i-meta.php"); ?>

<title><?php echo categorie($_GET['id']); ?></title>
<meta name="description" content="<?php echo $res_introduction['presentation'];?>" />


</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../",rubrique(15,$mysql_link),".",categorie($_GET['id'],$mysql_link),UrlCategorie($_GET['id'],$mysql_link).'-'.$_GET['id'].'-1.html',"",""); ?>

            <?php

            $smarty = new Smarty;

            $smarty->assign('resultat',$resultat);

            $smarty->display('../lib/template/p-sommaire-shopping.tpl');
            ?>

            <?php

            //Pager
            $exist = nbrcontent("m_shopping","id_rubrique","15","id_cat",$_GET['id'],"",$mysql_link);
            echo $pager = pager($exist,$par_page,$p,"","","keyword",$_GET['keyword'],$param3,$valeur3,$param4,$valeur4,$param5,$valeur5);
            ?>



    <?php require("../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>
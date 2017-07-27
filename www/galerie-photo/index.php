<?php
$rubrique = 17;
$nopave = 1;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');


//Pour ne pas afficher le bloc photo + sky + business dans la sideBar
$no_photo = 1;

//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 1)){
    $google_index = "index, follow";
    $p = 1;
}else{
    $google_index = "noindex, follow";
    $p = $_GET['p'];
}
$par_page = 32;


$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id= 17";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);


?>



<?php require("../lib/include/n_i-meta.php"); ?>

<title>Photos de surf</title>
<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />
<meta name="robots" content="<?php echo $google_index; ?>">


</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../",rubrique(17,$mysql_link),".","","","","",""); ?>

    <?php

    $req =  "SELECT * FROM m_editorial WHERE id_rubrique = 1 AND diaporama = 1 AND id_cat != 48 AND en_ligne = 1 AND date_publication < NOW()";
    $req .= "ORDER BY date_publication DESC LIMIT ".(($p-1)*$par_page).",".$par_page;

    $query = mysqli_query($mysql_link,$req);


    $i=0;

    while($res = mysqli_fetch_array($query)){

        //On initialise les bon path et rubrique
        if( (!empty($res['id_photographe'])) OR  (!empty($res['id_photographe'])) ){
            $id_rubrique_article1 = $res['id_rubrique']."-".$res['id_photographe'];
            $chemin_image1 = "lib/image/photo/";

        }else{
            $id_rubrique_article1 = $res['id_rubrique'];
            $chemin_image1 = "../lib/image/editorial/";
        }

        //Initialisation du tableau pour smarty
        $resultat[$i]['date_publication']  = $res['date_publication'];
        $resultat[$i]['titre'] 	= stripslashes($res['titre']);
        $resultat[$i]['chapeau']  = stripslashes($res['chapeau']);
        $resultat[$i]['url'] 		= '/'.urlFichier($res['id'],$id_rubrique_article1,$mysql_link);
        $resultat[$i]['image_une'] 	= '/'.$chemin_image1.$res['userfile3'];
        $resultat[$i]['image'] 	= '/'.$chemin_image1.$res['userfile2'];
        $resultat[$i]['image-pt'] 	= $chemin_image1.$res['userfile1'];
        $resultat[$i]['legende']	= stripslashes($res['legende']);
        $resultat[$i]['iz']		= $i;
        $resultat[$i]['rubrique'] = $rubrique;
        $resultat[$i]['device'] = $device[1];





        $i++;
    }

    $smarty = new Smarty;
    $smarty->assign('resultat',$resultat);
    $smarty->display('../lib/template/p-sommaire.tpl');


    //Pager
    $exist = nbrcontent("m_editorial","id_rubrique","1","diaporama","1","",$mysql_link);
    echo $pager = pager($exist,$par_page,$p,"","",$param2,$valeur2,$param3,$valeur3,$param4,$valeur4,$param5,$valeur5);


    ?>
</div>



<?php require("../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>
<?php

$id_rubrique = 18;

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');


//on rérupére les donnees
$res = donnee("m_tag","id",$_GET['id'],"","",$mysql_link);

//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) {
    $p = 1;
}else{
    $p = $_GET['p'];
}

$par_page = 20;


if($res['id_cat'] == 40){
    $fil_rub = "Lexique";
    $url_rub = "../lexique/";
}else{
    $fil_rub = "Tag";
    $url_rub = ".";
}


?>

<?php require("../lib/include/n_i-meta.php"); ?>

<title><?php echo $res['nom']; ?></title>
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../",$fil_rub,$url_rub,tronquer(stripslashes($res['nom']),80),"","",""); ?>

    <h1 class="m-reset mb2 articleh1"><?php echo stripslashes($res['nom']); ?></h1>

        <?php
        // Les dernieres Photos du Tag
        $req_photo = "SELECT * FROM m_photo WHERE id_rubrique = 17 AND legende LIKE '%".trim($res['nom'])."%' OR id_tag LIKE '%".trim($res['id'])."%' ORDER BY id DESC LIMIT 0,5";
        $query_photo = mysqli_query($mysql_link,$req_photo);
        $nbr_photo = mysqli_num_rows($query_photo);

        if($nbr_photo>=1){

        ?>

    <div class="line mt2 mb3 big">
        <?php

        $nbr_photo_diaporama = count($nbr_photo);

        $gallerie = '<div class="flexslider"><ul class="slides">';

        while($res_photo = mysqli_fetch_array($query_photo)){

            $gallerie .= '<li><figure><img src="../lib/image/photo/' . $res_photo["userfile2"] . '" /><figcaption class="small bold mts"><strong>' . $res_photo["legende"] . ' - ' . $res_photo["copyright"] . '</strong></figcaption></figure></li>';
        }

        $gallerie .= '</ul></div>';


        echo $gallerie;
        }

        ?>
    </div>

    <div class="line W680 center mt2 pa1">

        <?php if(!empty($res['corps'])){ ?><p><?php echo nl2br(stripslashes($res['corps'])); ?></p><?php } ?>


        <?php

        //on rérupère les donnees
        $res = donnee("m_tag","id",$_GET['id'],"","",$mysql_link);
        $mot_cles = explode("-",$res['mot_cle']);
        $nbr_mot_cle = count($mot_cles);


        // Les dernieres News du Tag

        $req_news = "SELECT * FROM m_editorial WHERE (id_rubrique IN (1,2,4,6,7,8)) AND ((titre LIKE '%".trim($res['nom'])."%') OR (chapeau LIKE '%".trim($res['nom'])."%')) OR id_tag LIKE '%".trim($res['id'])."%' ORDER BY date_publication DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
        $query_news = mysqli_query($mysql_link,$req_news);
        $nbr_news = mysqli_num_rows($query_news);

        if(!empty($nbr_news)){

            $i = "";
            while ($res_news = mysqli_fetch_array($query_news)){


                //On initialise les bon path et rubrique
                if( (!empty($res_news['id_photographe'])) OR  (!empty($res_news['id_photographe'])) ){
                    $id_rubrique_article1 = $res_news['id_rubrique']."-".$res_news['id_photographe'];
                    $chemin_image1 = "../lib/image/photo/";

                }else{
                    $id_rubrique_article1 = $res_news['id_rubrique'];
                    $chemin_image1 = "../lib/image/editorial/";
                }


                //Initialisation du tableau pour smarty
                $resultat[$i]['date_publication']  = $res_news['date_publication'];
                $resultat[$i]['titre'] 	= stripslashes($res_news['titre']);
                $resultat[$i]['chapeau']  = stripslashes($res_news['chapeau']);
                $resultat[$i]['url'] 		= '/'.urlFichier($res_news['id'],$id_rubrique_article1,$mysql_link);
                $resultat[$i]['image_une'] 	= $chemin_image1.$res_news['userfile3'];
                $resultat[$i]['image'] 	= $chemin_image1.$res_news['userfile2'];
                $resultat[$i]['image-pt'] 	= $chemin_image1.$res_news['userfile1'];
                $resultat[$i]['legende']	= stripslashes($res_news['legende']);
                $resultat[$i]['iz']		= $i;
                $resultat[$i]['rubrique'] = $res_news['id_rubrique'];
                $resultat[$i]['device'] = $device[1];


                $i++;
            }

            echo '<div class="line W680 center mt2"><div class="titreplusarticle">Les articles sur '.$res['nom'].'</div>';
            $smarty = new Smarty;
            $smarty->assign('resultat',$resultat);
            $smarty->display('../lib/template/p-sommaire-article.tpl');
            echo '</div>';


            //Pager
            $exist = nbrcontent("m_editorial","","","",""," WHERE (id_rubrique IN (1,2,4,6,7,8)) AND ((titre LIKE '%".trim($res['nom'])."%') OR (chapeau LIKE '%".trim($res['nom'])."%'))",$mysql_link);
            echo $pager = pager_rewriting($exist,$par_page,$_GET['p'],$res['nom_fichier']."-",$_GET['id'],"","");
        }

        ?>

    </div>

</div>
<?php require("../lib/include/n_i-footer.php") ?>


</body>

</html>
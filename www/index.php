<?php

require("lib/fonction/f-connection.php");
require("lib/fonction/n_f-all.php");
require("lib/fonction/f-pager.php");

require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');


?>


<?php require("lib/include/n_i-meta.php"); ?>

<title>L'Actualité du surf - photo - vidéo - shopping</title>
<meta name="description" content="Retrouvez tous les jours l'actualité du surf, des interviews exclusives, des dossiers thématiques, des photos et vidéos de surf exceptionnelles. Et aussi l'actualité en direct des régions... Abonnez vous à la newsletter et recevez chaque semaine les dernières news de la planète surf !">
<meta name="robots" content="index, follow">
<style>

    *{-webkit-overflow-scrolling: touch;}


    .titrehome {

        text-transform: uppercase;
        font-size: 3em;
        color: #222;
        font-weight: bold;
        display: block;
        padding-bottom: 5px;
        border-bottom: 5px solid #222;
        margin: 20px 0;

    }
    @media (max-width: 640px) {

        .titrehome {

            text-transform: uppercase;
            font-size: 1.5em;
            color: #222;
            font-weight: bold;
            display: block;
            padding-bottom: 5px;
            border-bottom: 3px solid #222;
            margin: 20px 0;

        }

        .small-phone{
            font-size:10px;

        }
    }



    a{

        color:#2276af;
    }





</style>
</head>

<body>
<!-- Publicite -->
<div id="6494071"></div>
<!-- Publicite -->

<?php require("lib/include/n_i-header.php"); ?>

<div class="wSite">



    <!-- Bloc une -->
    <?php


    $req = "SELECT id, id_rubrique, userfile2, userfile3, titre, chapeau, date_publication, nom_fichier FROM m_editorial WHERE date_publication < NOW() AND id_emplacement = 1 AND en_ligne = 1 AND id_cat NOT IN (11,12,13,14,48,49) ORDER BY date_publication DESC LIMIT 0,1";
    $query = mysqli_query($mysql_link,$req);

    $i=0;

    while($res = mysqli_fetch_array($query)){

        //Initialisation du tableau pour smarty
        $resultat[$i]['date_publication']  = $res['date_publication'];
        $resultat[$i]['titre'] 	= stripslashes($res['titre']);
        $resultat[$i]['chapeau']  = stripslashes($res['chapeau']);


        if($res['id_rubrique'] == 17){
            $resultat[$i]['url'] = '/news/photo/'.$res['nom_fichier']."--".$res['id'].".html";

        }else{
            $resultat[$i]['url'] = '/'.urlFichier($res['id'],$res['id_rubrique'],$mysql_link);
        }


        $resultat[$i]['image_une'] 	= '/lib/image/editorial/'.$res['userfile3'];
        $resultat[$i]['image'] 	= '/lib/image/editorial/'.$res['userfile2'];;
        $resultat[$i]['legende']	= stripslashes($res['legende']);
        $resultat[$i]['iz']		= $i;
        $resultat[$i]['rubrique'] = $rubrique;
        $resultat[$i]['bloc1'] = false;
        $resultat[$i]['device'] = $device[1];

        /*Pour afficher la catégorie de la news*/

        if(($res['id_rubrique'] > 1) AND ($res['id_rubrique'] < 9)){
            $resultat[$i]['type_news'] = rubrique($res['id_rubrique'],$mysql_link);
        }

        /*Pour afficher le player vidéo*/
        if($res['id_rubrique'] == 9){
            $resultat[$i]['video'] = true;
        }

        $i++;


        $req_news = "SELECT id, id_rubrique, userfile2, userfile3, titre, chapeau, date_publication, nom_fichier FROM m_editorial WHERE id NOT IN (".$res['id'].") AND date_publication < NOW() AND en_ligne = 1 AND id_rubrique NOT IN (4) AND id_cat NOT IN (11,12,13,14) ORDER BY date_publication DESC LIMIT 0,9";
        $query_news = mysqli_query($mysql_link,$req_news);


        while($res_news = mysqli_fetch_array($query_news)){

            //Initialisation du tableau pour smarty
            $resultat[$i]['date_publication']  = $res_news['date_publication'];
            $resultat[$i]['titre'] 	= stripslashes($res_news['titre']);
            $resultat[$i]['chapeau']  = stripslashes($res_news['chapeau']);

            if($res_news['id_rubrique'] == 17){
                $resultat[$i]['url'] = '/news/photo/'.$res_news['nom_fichier']."--".$res_news['id'].".html";
            }else{
                $resultat[$i]['url'] = '/'.urlFichier($res_news['id'],$res_news['id_rubrique'],$mysql_link);
            }


            $resultat[$i]['image_une'] 	= '/lib/image/editorial/'.$res_news['userfile3'];
            $resultat[$i]['image'] 	= '/lib/image/editorial/'.$res_news['userfile2'];;
            $resultat[$i]['legende']	= stripslashes($res_news['legende']);
            $resultat[$i]['iz']		= $i;
            $resultat[$i]['rubrique'] = $rubrique;
            $resultat[$i]['bloc1'] = false;
            $resultat[$i]['device'] = $device[1];

            /*Pour afficher la catégorie de la news*/

            if(($res_news['id_rubrique'] > 1) AND ($res_news['id_rubrique'] < 9)){
                $resultat[$i]['type_news'] = rubrique($res_news['id_rubrique'],$mysql_link);
            }

            /*Pour afficher le player vidéo*/
            if($res_news['id_rubrique'] == 9){
                $resultat[$i]['video'] = true;
            }

            $i++;

        }



    }
    ?>

<?php
    $smarty = new Smarty;
    $smarty->assign('resultat',$resultat);
    $smarty->display($_SERVER['DOCUMENT_ROOT'].'/lib/template/p-sommaire-home.tpl');
?>


    <!-- Bloc une -->

    <!-- Bloc photo -->

    <div class="line W100  mt2 txtcenter"><h2 class="titrehome">surf Zoom</h2></div>

    <div class="big mb2">
        <?php


        $req_photo = "SELECT * FROM m_photo WHERE belle_photo = 1 ORDER BY id DESC LIMIT 0,10";
        $query_photo = mysqli_query($mysql_link,$req_photo);


        $gallerie = '<div class="flexslider"><ul class="slides">';

        while($res_photo = mysqli_fetch_array($query_photo)){

            $gallerie .= '<li><figure><img src="/lib/image/photo/'.$res_photo["userfile2"].'" /><figcaption><div class="txtcenter small-phone line bgBlack fontWhite pa1"><strong>'.$res_photo["legende"].' - '.$res_photo["copyright"].'</strong></div></figcaption></figure></li>';
        }

        $gallerie .= '</ul></div>';


        echo $gallerie;

        ?>
    </div>
    <!-- Bloc photo -->



    <!-- Bloc shopping -->

    <div class="line W100  mt3 txtcenter"><h2 class="titrehome">Surf tendance</h2></div>

    <div class="big mb2">
        <?php
        //WHERE id_cat=".$_GET['id']."
        $req_shopping = "SELECT * FROM m_shopping ORDER BY id DESC LIMIT 0,9";
        $query_shopping = mysqli_query($mysql_link,$req_shopping);
        $nbr_shopping = mysqli_num_rows($query_shopping);

        $i = 0;

        while($res_shopping = mysqli_fetch_array($query_shopping)){

            //Initialisation du tableau pour smarty
            $shopping[$i]['titre'] 	= stripslashes($res_shopping['titre']);
            $shopping[$i]['chapeau']  = stripslashes($res_shopping['corps']);
            $shopping[$i]['url'] 		= '/'.urlFichier($res_shopping['id'],$res_shopping['id_rubrique'],$mysql_link);
            $shopping[$i]['image_une'] 	= '/lib/image/shopping/'.$res_shopping['userfile2'];
            $shopping[$i]['image'] 	= '/lib/image/shopping/'.$res_shopping['userfile2'];
            $shopping[$i]['image-pt'] 	= '/lib/image/shopping/'.$res_shopping['userfile2'];
            $shopping[$i]['iz']		= $i;
            $shopping[$i]['rubrique'] = $rubrique;
            $shopping[$i]['device'] = $device[1];

            $i++;
        }

        $smarty = new Smarty;
        $smarty->assign('resultat',$shopping);
        $smarty->display($_SERVER['DOCUMENT_ROOT'].'/lib/template/p-sommaire-shopping.tpl');

        ?>
        <!-- Bloc shopping -->

    </div>


    <!-- Bloc vidéo -->

    <div class="line W100  mt3 txtcenter"><h2 class="titrehome">Vidéo</h2></div>

    <?php
    $req = "SELECT video_article FROM m_editorial WHERE id_rubrique= 9 AND en_ligne = 1 AND date_publication < NOW() AND id_cat != 49 ORDER BY id DESC";
    $query = mysqli_query($mysql_link,$req);
    $res_video = mysqli_fetch_array($query)


    ?>


    <div class="video-container mb2"><?php echo stripslashes(nl2br($res_video['video_article'])); ?></div>
    <!-- Fin Bloc vidéo -->



</div>
<?php require("lib/include/n_i-footer.php") ?>


</body>

</html>
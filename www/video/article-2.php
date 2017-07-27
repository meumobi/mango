<?php
$rubrique = 9;

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');


//on rÃ©rupÃ¨re les donnees
$res = donnee("m_editorial","id",$_GET['id'],"","",$mysql_link);
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?>



<?php require("../lib/include/n_i-meta.php"); ?>

<title><?php echo $res['titre']; ?> - Vidéo</title>
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/video/'.$res['nom_fichier'].'--'.$res['id'].'.html'; ?>" />
<meta name="description" content="<?php echo stripslashes($res['chapeau']); ?>" />

<meta property="og:title" content="Vidéo - <?php echo stripslashes($res['titre']); ?>" />
<meta property="og:description" content="<?php echo stripslashes($res['chapeau']); ?>" />
<meta property="og:image" content="http://www.mango-surf.com/lib/image/editorial/<?php echo $res['userfile3']; ?>" />

</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">

    <?php

    if($res['id_cat'] == 49){
        $lien_categorie_ariane = "../news/outdoor/";
    }else{
        $lien_categorie_ariane = UrlCategorie($res['id_cat'],$mysql_link).'-'.$res['id_cat'].'-1.html';
    }

    echo fil_ariance("Accueil","../",rubrique(9,$mysql_link),".",categorie($res['id_cat'],$mysql_link),$lien_categorie_ariane,"","");
    ?>

    <article class="content" itemprop="video" itemscope itemtype="http://schema.org/VideoObject">

    <h1 itemprop="headline" class="m-reset mb2 articleh1"><?php echo stripslashes($res['titre']); ?></h1>

    <div class="video-container mt2 mb2"><?php echo stripslashes(nl2br($res['video_article'])); ?></div>



    <div class="line W680 center mt2 pa1">


        <meta itemprop="thumbnail" content="http://www.mango-surf.com/lib/image/editorial/<?php echo $res['userfile3']; ?>" />
        <h2 class="articleh2" itemprop="description"><?php echo stripslashes($res['chapeau']); ?></h2>

        <!-- Tag -->
        <div class="mb1 phone-hidden mt2"><?php echo afficheTag($res["id_tag"], $mysql_link); ?></div>
        <!-- Fin Tag -->

        <?php if($res['corps'] != NULL) {echo '<p class="article mt1 big" itemprop="text">'.stripslashes(nl2br($res['corps'])).'</p>'; }?>



        <?php
        if (!empty($res['nom_lien'])) {
            $lien = lien($res['nom_lien'], $res['url_lien'], "_blank", "", "", $mysql_link);
            echo '<strong>' . $lien . '</strong>';
        }
        ?>

        <!-- Auteur -->
        <div class="mt2">
            <?php
            if (!empty($res["auteur"])) {

                echo '<strong class="font-gray bold" itemprop="creator">' . stripslashes($res['auteur']) . ' - </strong>';

            }
            ?>


            <?php

            $date_publication = dateformat($res["date_publication"], "en", "fr");
            if ($date_publication != "00-00-0000") {
                echo '<strong class="font-gray bold">Publié le <time itemprop="dateCreated" datetime="' . $res["date_publication"] . 'T08:00">' . $date_publication . '</strong>';
            }

            ?>
        </div>
        <!-- Fin Auteur -->




    </div>
    </article>

    <?php

    if(!empty($res['id_news'])){

        $i = 0;
        $id_news = explode("-",$res['id_news']);
        $titre = "A ne pas manquer !";

        while ($id_news[$i] != ""){

            $req_news = "SELECT id, id_rubrique, date_publication, titre, chapeau, nom_fichier, userfile1, userfile2, userfile3 FROM m_editorial WHERE id=".$id_news[$i];
            $query_news = mysqli_query($mysql_link,$req_news);
            $res_news = mysqli_fetch_array($query_news);

            //On initialise les bon path et rubrique
            if( (!empty($res['id_photographe'])) OR  (!empty($res['id_photographe'])) ){
                $id_rubrique_article1 = $res['id_rubrique']."-".$res['id_photographe'];
                $chemin_image1 = "../lib/image/photo/";

            }else{
                $id_rubrique_article1 = $res['id_rubrique'];
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

    }else{

        $i = 0;
        $titre = "A ne pas manquer !";


        $req_news = "SELECT id, id_rubrique, date_publication, titre, chapeau, nom_fichier, userfile1, userfile2, userfile3 FROM m_editorial WHERE en_ligne = 1 AND id_rubrique = 9 AND date_publication < NOW() AND id < ".$res['id']." ORDER BY date_publication DESC LIMIT 0,5";
        $query_news = mysqli_query($mysql_link,$req_news);

        while($res_news = mysqli_fetch_array($query_news)){


            //On initialise les bon path et rubrique
            if( (!empty($res['id_photographe'])) OR  (!empty($res['id_photographe'])) ){
                $id_rubrique_article1 = $res['id_rubrique']."-".$res['id_photographe'];
                $chemin_image1 = "../lib/image/photo/";

            }else{
                $id_rubrique_article1 = $res['id_rubrique'];
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

    }

    echo '<div class="line W680 center mt2"><div class="titreplusarticle">'.$titre.'</div>';
    $smarty = new Smarty;
    $smarty->assign('resultat',$resultat);
    $smarty->display('../lib/template/p-sommaire-article.tpl');
    echo '</div>';

    ?>

    <?php require("../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>
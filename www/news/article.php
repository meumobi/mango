<?php
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');



$res = donnee("m_editorial", "id", $_GET['id'], "", "", $mysql_link);
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if ($res['id_cat'] == 48) {
    $categorie = 48;
} else {
    $rubrique = 1;
}
?>



<?php require("../lib/include/n_i-meta.php"); ?>

<title><?php echo $res['titre']; ?></title>

<link rel="canonical" href="<?php echo $url; ?>"/>
<meta name="description" content="<?php echo stripslashes($res['chapeau']); ?>"/>
<meta property="og:title" content="Surf - <?php echo stripslashes($res['titre']); ?>"/>
<meta property="og:description" content="<?php echo stripslashes($res['chapeau']); ?>"/>
<meta property="og:image" content="http://www.mango-surf.com/lib/image/editorial/<?php echo $res['userfile3']; ?>"/>
<meta property="og:tag" content="<? echo afficheTagFacebook($res['id_tag'], $mysql_link); ?>"/>



</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">

    <!-- fil d'arianne -->
    <?php

    if ($res['diaporama'] == 1) {
        $diaponom = "En image";
        $diapolien = "../galerie-photo/";

    }

    echo fil_ariance("L'actualité du surf", "../", rubrique(1, $mysql_link), "/news/", $diaponom, $diapolien, "", "");

    ?>
    <!-- fin fil d'arianne -->



    <article class="content" itemscope itemtype="http://schema.org/Article">

        <h1 itemprop="headline" class="m-reset mb2 articleh1"><?php echo stripslashes($res['titre']); ?></h1>

        <!-- Zone image -->

        <?php if ((($res['diaporama'] == 1) OR ($res['diapo_news'] == 1)) AND $device[1] != "_3") { ?>

            <div class="line mt2 mb3 big">
                <?php

                $id_photo_diaporama = explode("-", $res["id_content_objets"]);

                $nbr_photo_diaporama = count($id_photo_diaporama);

                $gallerie = '<div class="flexslider"><ul class="slides">';

                for ($i = 0; ($i + 1) <= $nbr_photo_diaporama; $i++) {

                    $req_photo = "SELECT * FROM m_photo WHERE id = " . $id_photo_diaporama[$i];
                    $query_photo = mysqli_query($mysql_link, $req_photo);
                    $res_photo = mysqli_fetch_array($query_photo);

                    $gallerie .= '<li><figure><img src="../lib/image/photo/' . $res_photo["userfile2"] . '" /><figcaption class="small bold mts"><strong>' . $res_photo["legende"] . ' - ' . $res_photo["copyright"] . '</strong></figcaption></figure></li>';
                }

                $gallerie .= '</ul></div>';


                echo $gallerie;

                ?>
            </div>

        <?php } else {

            echo $image = image($res['userfile3'], "w100", $res['legende3'], $res['copyright3'], "", "editorial", $res['titre_photo'], $res['id_photo'], $mysql_link);

        } ?>

        <!-- Fin zone image -->


        <?php require("../lib/include/n_i_publicite_aside.php") ?>

        <div class="mod wColCentre">

            <!-- Chapo -->
            <?php if (!empty($res['chapeau'])) { ?>
                <h2 class="articleh2" itemprop="description"><?php echo stripslashes($res['chapeau']); ?></h2>
            <?php } ?>
            <!-- Fin chapo -->


            <!-- Tag -->
            <div class="mb1 phone-hidden mt2"><?php echo afficheTag($res["id_tag"], $mysql_link); ?></div>
            <!-- Fin Tag -->


            <!-- Texte -->
            <?php if (!empty($res['corps'])) { ?>
                <p class="article mt1 big" itemprop="text"><?php echo stripslashes(nl2br($res['corps'])); ?></p>
            <?php } ?>
            <!-- Fin Texte -->

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
                    echo '<strong class="font-gray bold">Publié le<span itemprop="datePublished">'.$date_publication.'</span></strong>';
                }

                ?>
            </div>
            <!-- Fin Auteur -->
        </div>
    </article>

    <!-- Inscription NL -->
    <div class="line W680 center">
        <?php     $smarty->display($_SERVER['DOCUMENT_ROOT'].'/lib/template/inscription-nl.tpl'); ?>
    </div>
    <!-- Inscription NL -->





    <!-- Vidéo -->
    <?php if (!empty($res['video_article'])) { ?>
        <div class="center video-container mt2 mb3"><?php echo stripslashes(nl2br($res['video_article'])); ?></div>
    <?php } ?>
    <!-- Fin Vidéo -->

    <?php

    if(!empty($res['id_news'])){

        $i = 0;
        $id_news = explode("-",$res['id_news']);
        $titre = "Sur le même sujet";

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

        echo '<div class="line W680 center mt2"><div class="titreplusarticle">'.$titre.'</div>';
        $smarty = new Smarty;
        $smarty->assign('resultat',$resultat);
        $smarty->display('../lib/template/p-sommaire-article.tpl');
        echo '</div>';

    }




    ?>







</div>
<?php require("../lib/include/n_i-footer.php") ?>

</body>
</html>
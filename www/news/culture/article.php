<?php 
$rubrique = 1;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');


//on rÃ©rupÃ¨re les donnees
$res = donnee("m_editorial","id",$_GET['id'],"","",$mysql_link);
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?>



<?php require("../../lib/include/n_i-meta.php"); ?>	

<title><?php echo $res['titre']; ?></title>	
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/news/culture/'.$res['nom_fichier'].'--'.$res['id'].'-'.$res['id_sommaire'].'.html'; ?>" />
<meta name="description" content="<?php echo stripslashes($res['chapeau']); ?>" />
<meta property="og:title" content="Surf - <?php echo stripslashes($res['titre']); ?>" /> 
<meta property="og:description" content="<?php echo stripslashes($res['chapeau']); ?>" />  
<meta property="og:image" content="http://www.mango-surf.com/lib/image/editorial/<?php echo $res['userfile3']; ?>" /> 
	
</head>

<body>

<?php require("../../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php  $tab = titresommaire($_GET['dossier'],$mysql_link); echo fil_ariance("L'actualité du surf","../../","News","../",$tab[0],$tab[1],tronquer(stripslashes($res['titre']),80),""); ?>


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


        <?php require("../../lib/include/n_i_publicite_aside.php") ?>

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


            <?php

            $i = 0;
            $titre = "Sommaire";


            $req_sommaire = "SELECT id, id_rubrique, date_publication, id_sommaire, titre, chapeau, nom_fichier, userfile1, userfile2, userfile3 FROM m_editorial WHERE id_sommaire=".$res['id_sommaire']." ORDER BY classement ASC";
            $query_sommaire = mysqli_query($mysql_link,$req_sommaire);

            while($res_news = mysqli_fetch_array($query_sommaire)){

                //On initialise les bon path et rubrique
                if( (!empty($res['id_photographe'])) OR  (!empty($res['id_photographe'])) ){
                    $id_rubrique_article1 = $res['id_rubrique']."-".$res['id_photographe'];
                    $chemin_image1 = "../../lib/image/photo/";

                }else{
                    $id_rubrique_article1 = $res['id_rubrique'];
                    $chemin_image1 = "../../lib/image/editorial/";
                }


                //Initialisation du tableau pour smarty
                $resultat[$i]['date_publication']  = $res_news['date_publication'];
                $resultat[$i]['titre'] 	= stripslashes($res_news['titre']);
                $resultat[$i]['chapeau']  = stripslashes($res_news['chapeau']);
                $resultat[$i]['url'] 		=  $res_news["nom_fichier"].'--'.$res_news["id"].'-'.$res_news["id_sommaire"].'.html';
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
            $smarty->display('../../lib/template/p-sommaire-article.tpl');
            echo '</div>';


            ?>



            <?php


            //Pour afficher une publicité qui est paramétré dans les tags
            if(!empty($res["id_publicite"])){

                $res_pub = donnee("m_tag","id",$res["id_publicite"],"","",$mysql_link);
                echo $res_pub['corps'];

            }

            ?>
        </div>
    </article>



    <!-- Vidéo -->
    <?php if (!empty($res['video_article'])) { ?>
        <div class="center video-container mt2 mb3"><?php echo stripslashes(nl2br($res['video_article'])); ?></div>
    <?php } ?>
    <!-- Fin Vidéo -->







</div>
<?php require("../../lib/include/n_i-footer.php") ?>
</body>
</html>
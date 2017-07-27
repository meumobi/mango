<?php 
$rubrique = 3;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');


//on rÃ©rupÃ¨re les donnees
$res = donnee("m_editorial","id",$_GET['id'],"","",$mysql_link);
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title><?php echo $res['titre']; ?> - Surf Trip</title>	
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/trip-surf/s-'.$res['nom_fichier'].'--'.$res['id'].'.html'; ?>" />
<meta name="description" content="<?php echo stripslashes($res['chapeau']); ?>" />

<meta property="og:title" content="Surf - <?php echo stripslashes($res['titre']); ?>" /> 
<meta property="og:description" content="<?php echo stripslashes($res['chapeau']); ?>" />  
<meta property="og:image" content="http://www.mango-surf.com/lib/image/editorial/<?php echo $res['userfile3']; ?>" /> 
		
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">


    <?php echo fil_ariance("Accueil","../",rubrique(3,$mysql_link),".",tronquer(stripslashes($res['titre']),80),"","",""); ?>

    <article class="content" itemscope itemtype="http://schema.org/Article">

        <h1 itemprop="headline" class="m-reset mb2 articleh1"><?php echo stripslashes($res['titre']); ?></h1>

        <?php echo $image2 = image($res['userfile3'], "w100", $res['legende3'], $res['copyright3'], "", "editorial", $res['titre_photo'], $res['id_photo'], $mysql_link); ?>


        <div class="line W680 center mt2 pa1">

            <!-- Chapo -->
            <?php if (!empty($res['chapeau'])) { ?>
                <h2 class="articleh2" itemprop="description"><?php echo stripslashes($res['chapeau']); ?></h2>
            <?php } ?>
            <!-- Fin chapo -->

            <!-- Auteur -->
            <div class="mt2">
                <?php
                if (!empty($res["auteur"])) {

                    echo '<strong class="font-gray bold" itemprop="creator">'.stripslashes($res['auteur']).'- </strong>';

                }
                ?>


                <?php

                $date_publication = dateformat($res["date_publication"], "en", "fr");
                if ($date_publication != "00-00-0000") {
                    echo '<strong class="font-gray bold">Publié le <time itemprop="dateCreated" datetime="'.$res["date_publication"].'T08:00">'.$date_publication.'</strong>';
                }

                ?>
            </div>
            <!-- Fin Auteur -->


            <?php

            $i = 0;
            $titre = "Le sommaire du surf-trip";


            $req_sommaire = "SELECT id, id_rubrique, date_publication, id_sommaire, titre, chapeau, nom_fichier, userfile1, userfile2, userfile3 FROM m_editorial WHERE id_sommaire=".$res['id']." ORDER BY classement ASC";
            $query_sommaire = mysqli_query($mysql_link,$req_sommaire);

            while($res_news = mysqli_fetch_array($query_sommaire)){

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
            $smarty->display('../lib/template/p-sommaire-article.tpl');
            echo '</div>';


            ?>


        </div>
    </article>


</div>
<?php require("../lib/include/n_i-footer.php") ?>


</body>

</html>
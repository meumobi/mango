<?php
$rubrique = 16;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');


//on rÃ©rupÃ¨re les donnees
$res = donnee("m_agenda","id",$_GET['id'],"","",$mysql_link);

if ((empty($_GET['p'])) || ($_GET['p'] == 0)) {
    $p = 1;
}else{
    $p = $_GET['p'];
}

$par_page = 14;


?>



<?php require("../lib/include/n_i-meta.php"); ?>

<title><?php echo $res['titre']; ?></title>
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/agenda/'.$res['nom_fichier'].'--'.$res['id'].'.html'; ?>" />
<meta name="description" content="<?php echo $res['titre'];?> - Retrouvez tous ce qu'il faut savoir sur cet évènement !" />


<meta property="og:title" content="Surf - <?php echo stripslashes($res['titre']); ?>" />
<meta property="og:description" content="<<?php echo $res['titre'];?> - Retrouvez tous ce qu'il faut savoir sur cet évènement !" />

<?php if (file_exists("http://www.mango-surf.com/lib/image/agenda/".$res['userfile2'])) { ?>
    <meta property="og:image" content="http://www.mango-surf.com/lib/image/agenda/<?php echo $res['userfile2']; ?>" />
<?php } ?>


</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">


    <?php echo fil_ariance("L'actualité du surf","../",rubrique($res['id_rubrique'],$mysql_link),".",tronquer(stripslashes($res['titre']),80),"","",""); ?>

    <article class="content" itemscope itemtype="http://schema.org/Event">

        <h1 class="m-reset mb2 articleh1" itemprop="name"><?php echo stripslashes($res['titre']); ?></h1>

        <?php
        // Les dernieres Photos du Tag
        $req_photo = "SELECT * FROM m_photo WHERE id_rubrique = 17 AND (legende LIKE '%".trim($res['titre'])."%' OR id_tag LIKE '%".trim($res['id_tag'])."%') AND id > 5297 ORDER BY id DESC LIMIT 0,15";
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

        <?php require("../lib/include/n_i_publicite_aside.php") ?>

        <div class="mod wColCentre">

            <?php if(!empty($res['lieu'])){ echo '<strong>Lieu : </strong><span itemprop="location">'.stripslashes($res['lieu']).'</span><br />'; } ?>
            <strong>Date :</strong> <time itemprop="startDate" datetime="<?php echo $res["date_debut"]; ?>T00:00"><?php echo $date_publication = dateformat($res["date_debut"],"en","fr"); ?></time> au <time itemprop="endDate" datetime="<?php echo $res["date_fin"]; ?>T00:00"><?php echo $date_publication = dateformat($res["date_fin"],"en","fr"); ?><br />
                <?php if(!empty($res['email'])){ echo '<strong>Email contact : </strong>'.stripslashes($res['email']).'<br />'; } ?>




                <p itemprop="description"><?php if(!empty($res['corps']))echo stripslashes(nl2br($res['corps'])); ?></p>

                <?php
                if((!empty($res['nom_lien'])) AND (dateFR2Time($res['date_fin']) > dateFR2Time(date("20".'y-m-d'))) ){

                    $lien = lien($res['nom_lien'],$res['url_lien'],"_blank","","");
                    echo $lien.'<br />';

                }
                ?>


                <?php
                if(!empty($res['id_news'])){
                    // Les dernieres News du Tag
                    $req_news = "SELECT * FROM m_editorial WHERE (id_rubrique IN (1,2,4,6,7,8,9)) AND (id_tag LIKE '%".trim($res['id_news'])."%') ORDER BY date_publication DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
                    $query_news = mysqli_query($mysql_link,$req_news);
                    $nbr_news = mysqli_num_rows($query_news);

                    if(!empty($nbr_news)) {

                        $i = "";
                        while ($res_news = mysqli_fetch_array($query_news)) {


                            //On initialise les bon path et rubrique
                            if ((!empty($res_news['id_photographe'])) OR (!empty($res_news['id_photographe']))) {
                                $id_rubrique_article1 = $res_news['id_rubrique'] . "-" . $res_news['id_photographe'];
                                $chemin_image1 = "../lib/image/photo/";

                            } else {
                                $id_rubrique_article1 = $res_news['id_rubrique'];
                                $chemin_image1 = "../lib/image/editorial/";
                            }


                            //Initialisation du tableau pour smarty
                            $resultat[$i]['date_publication'] = $res_news['date_publication'];
                            $resultat[$i]['titre'] = stripslashes($res_news['titre']);
                            $resultat[$i]['chapeau'] = stripslashes($res_news['chapeau']);
                            $resultat[$i]['url'] = '/' . urlFichier($res_news['id'], $id_rubrique_article1, $mysql_link);
                            $resultat[$i]['image_une'] = $chemin_image1 . $res_news['userfile3'];
                            $resultat[$i]['image'] = $chemin_image1 . $res_news['userfile2'];
                            $resultat[$i]['image-pt'] = $chemin_image1 . $res_news['userfile1'];
                            $resultat[$i]['legende'] = stripslashes($res_news['legende']);
                            $resultat[$i]['iz'] = $i;
                            $resultat[$i]['rubrique'] = $res_news['id_rubrique'];
                            $resultat[$i]['device'] = $device[1];


                            $i++;
                        }

                        echo '<div class="line W680 center mt2"><div class="titreplusarticle">'.$res['titre'].'</div>';
                        $smarty = new Smarty;
                        $smarty->assign('resultat', $resultat);
                        $smarty->display('../lib/template/p-sommaire-article.tpl');
                        echo '</div>';
                    }

                }

                ?>

    </article>

</div>

<?php require("../lib/include/n_i-footer.php") ?>

</body>

</html>
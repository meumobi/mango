<?php 
$rubrique = 14;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');

//on rÃ©rupÃ¨re les donnees
$res = donnee("m_annuaire","id",$_GET['id'],"","",$mysql_link);

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title><?php echo $res['titre']." - ".categorie($res['id_cat'],$mysql_link); ?></title>	
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/annuaire/'.$res['nom_fichier'].'--'.$res['id'].'.html'; ?>" />
<meta name="description" content="<?php echo stripslashes(tronquer($res['corps'],200)); ?>" />

<meta property="og:title" content="<?php echo categorie($res['id_cat'])." - ".stripslashes($res['titre']); ?>" /> 
<meta property="og:description" content="<?php echo stripslashes(tronquer($res['corps'],200)); ?>" />  
<meta property="og:image" content="http://www.mango-surf.com/lib/image/annuaire/<?php echo $res['userfile2']; ?>" /> 
	
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("L'actualité du surf","../",rubrique(14,$mysql_link),".",categorie($res['id_cat'],$mysql_link),UrlCategorie($res['id_cat'],$mysql_link).'-'.$res['id_cat'].'-0-1.html',tronquer(stripslashes($res['titre']),80),""); ?>


    <article class="content" itemscope itemtype="http://data-vocabulary.org/Organization">

        <h1 itemprop="name" class="m-reset mb2 articleh1"><?php echo stripslashes($res['titre']); ?> - <?php echo categorie($res['id_cat'],$mysql_link); ?></h1>

        <div class="line w100 txtcenter bgGrisClair mbm">
            <img src="/lib/image/annuaire/<?php echo $res['userfile2'] ;?>" alt="<?php echo stripslashes($res['titre']) ;?>" class="center" />
        </div>

        <?php require("../lib/include/n_i_publicite_aside.php") ?>

        <div class="mod wColCentre">

            <p itemprop="description"><?php if(!empty($res['corps']))echo stripslashes(nl2br($res['corps'])); ?></p>

            <div itemscope itemtype="http://schema.org/LocalBusiness" class="alingJ mtm">


                <strong>Contact <?php echo categorie($res['id_cat'],$mysql_link); ?></strong><br />
                <span itemprop="name"><?php echo stripslashes($res['titre']); ?></span><br />
                <?php if(!empty($res['ouverture'])){ echo stripslashes($res['ouverture']).'<br />'; } ?>


                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <?php if(!empty($res['adresse'])){ echo '<span itemprop="streetAddress">'.stripslashes($res['adresse']).'</span><br />'; } ?>
                    <?php if(!empty($res['cp'])){ echo '<span itemprop="postalCode">'.stripslashes($res['cp']).'</span> - '; } ?>
                    <?php if(!empty($res['ville'])){ echo '<span itemprop="addressLocality">'.stripslashes($res['ville']).'</span><br />'; } ?>
                </div>

                <?php if(!empty($res['telephone'])){ echo '<span itemprop="telephone">'.stripslashes($res['telephone']).'</span><br />'; } ?>
                <?php if(!empty($res['email'])){ echo '<span itemprop="email">'.stripslashes($res['email']).'</span><br />'; } ?>
                <?php if(!empty($res['url_lien'])){ echo 'Visitez le site : <a itemprop="url" href="'.$res['url_lien'].'" target="_blank">'.stripslashes($res['titre']).'</a><br />'; } ?>
                <br />
            </div>



        </div>
    </article>

    <?php
    $i = 0;
    $titre = "A ne pas manquer !";


    $req_news = "SELECT * FROM m_editorial WHERE date_publication < NOW() AND en_ligne = 1 AND id_rubrique NOT IN (4) AND id_cat NOT IN (11,12,13,14,48,49) ORDER BY date_publication DESC LIMIT 0,5";
    $query_news = mysqli_query($mysql_link,$req_news);

    while($res_news = mysqli_fetch_array($query_news)){


        //On initialise les bon path et rubrique
        if( (!empty($res['id_photographe'])) OR  (!empty($res['id_photographe'])) ){
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

        echo '<div class="line W680 center mt2"><div class="titreplusarticle">'.$titre.'</div>';
        $smarty = new Smarty;
        $smarty->assign('resultat',$resultat);
        $smarty->display('../lib/template/p-sommaire-article.tpl');
        echo '</div>';

    ?>






</div>
<?php require("../lib/include/n_i-footer.php") ?>

</body>

</html>
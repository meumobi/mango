<?php
$rubrique = 15;

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');

//on rÃ©rupÃ¨re les donnees
$res = donnee("m_shopping","id",$_GET['id'],"","",$mysql_link);

?>

<?php require("../lib/include/n_i-meta.php"); ?>

<title><?php echo $res['titre'].' - '.marque($res['id_marque'],$mysql_link); ?></title>
<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/shopping/'.$res['nom_fichier'].'--'.$res['id'].'.html'; ?>" />
<meta name="description" content="<?php echo stripslashes(tronquer($res['corps'],150)); ?>" />

<meta property="og:title" content="Shop'in - <?php echo stripslashes($res['titre']); ?>" />
<meta property="og:description" content="<?php echo stripslashes(tronquer($res['corps'],150)); ?>" />
<meta property="og:image" content="http://www.mango-surf.com/lib/image/shopping/<?php echo $res['userfile2']; ?>" />

</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../",rubrique(15,$mysql_link),".",tronquer(stripslashes($res['titre']),80),"","",""); ?>


    <article class="content" itemscope itemtype="http://schema.org/Product">

        <h1 itemprop="headline" class="m-reset mb2 articleh1"><?php echo stripslashes($res['titre']); ?></h1>

        <div class="line w100 txtcenter bgGrisClair mbm">
            <img src="/lib/image/shopping/<?php echo $res['userfile2'] ;?>" alt="<?php echo stripslashes($res['titre']) ;?>" class="center" />
        </div>


        <?php require("../lib/include/n_i_publicite_aside.php") ?>

        <div class="mod wColCentre">

            <?php if(!empty($res['corps'])){ ?><?php echo "<span itemprop='description'>".stripslashes(nl2br($res['corps']))."</span>"; ?><?php } ?>

            <p>

                <?php if((!empty($res['prix'])) AND ($res['prix'] > 0)) { ?>
                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
						<strong><span itemprop="price"><?php echo $res['prix']; ?></span> €</strong><br />
					</span>
                <?php } ?>
                <?php if(!empty($res['id_marque'])){ ?>
                    <strong><span itemprop="brand"><?php echo $marque = marque($res['id_marque'],$mysql_link); ?></span></a></strong><br />
                <?php } ?>


            </p>

            <?php if($res['url_shop']){ ?>

                <a href="<?php echo $res['url_shop']; ?>" target="_blank" title="Acheter en ligne">Acheter sur <?php echo $res['nom_shop']; ?></a>

            <?php } ?>

        </div>


    </article>

    <!-- Inscription NL -->
    <div class="line W680 center">
        <?php     $smarty->display($_SERVER['DOCUMENT_ROOT'].'/lib/template/inscription-nl.tpl'); ?>
    </div>
    <!-- Inscription NL -->


    <?php


    $req_shopping = "SELECT * FROM m_shopping WHERE en_ligne = 1 AND id < ".$res['id']." ORDER BY id DESC LIMIT 0,9";
    $query_shopping = mysqli_query($mysql_link,$req_shopping);

    while($res_shopping = mysqli_fetch_array($query_shopping)){


        //Initialisation du tableau pour smarty
        $resultat[$i]['titre'] 	= stripslashes($res_shopping['titre']);
        $resultat[$i]['chapeau']  = stripslashes($res_shopping['corps']);
        $resultat[$i]['url'] 		= '/'.urlFichier($res_shopping['id'],$res_shopping['id_rubrique'],$mysql_link);
        $resultat[$i]['image_une'] 	= '../lib/image/shopping/'.$res_shopping['userfile2'];
        $resultat[$i]['image'] 	= '../lib/image/shopping/'.$res_shopping['userfile2'];
        $resultat[$i]['image-pt'] 	= '../lib/image/shopping/'.$res_shopping['userfile2'];
        $resultat[$i]['iz']		= $i;
        $resultat[$i]['rubrique'] = $rubrique;
        $resultat[$i]['device'] = $device[1];

        $i++;
    }

    echo '<div class="line mt2"><div class="titreplusarticle">Inside surf shop</div>';
    $smarty = new Smarty;
    $smarty->assign('resultat',$resultat);
    $smarty->display('../lib/template/p-sommaire-shopping.tpl');
    echo '</div>';


    ?>




</div>
<?php require("../lib/include/n_i-footer.php") ?>

</body>

</html>
<?php
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");


$res = donnee("m_editorial","id",$_GET['id'],"","",$mysql_link);
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if($res['id_cat'] == 48){
    $categorie = 48;
}else{
    $rubrique = 1;
}
?>



<?php require("../lib/include/n_i-meta.php"); ?>

<title><?php echo $res['titre']; ?></title>

<link rel="canonical" href="<?php echo $url; ?>" />
<meta name="description" content="<?php echo stripslashes($res['chapeau']); ?>" />
<meta property="og:title" content="Surf - <?php echo stripslashes($res['titre']); ?>" />
<meta property="og:description" content="<?php echo stripslashes($res['chapeau']); ?>" />
<meta property="og:image" content="http://www.mango-surf.com/lib/image/editorial/<?php echo $res['userfile3']; ?>" />
<meta property="og:tag" content="<? echo afficheTagFacebook($res['id_tag'],$mysql_link); ?>" />

<link rel="stylesheet" href="../lib/css/flexslider.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="../lib/js/jquery.flexslider.js"></script>
<script type="text/javascript" charset="utf-8">
    $(window).load(function() {


        $('.flexslider').flexslider({
            animation: "fade",
            controlNav: false,
            slideshow: true,
        });

    });
</script>
</head>

<body>

<div class="wSite">

    <?php require("../lib/include/n_i-header.php"); ?>

    <!-- fil d'arianne -->
    <?php

    if($res['id_cat'] == 48){

        $fil_outdoor_nom = "Outdoor";
        $fil_outdoor_lien = "/news/outdoor/";


    }

    echo fil_ariance("L'actualité du surf","../",rubrique(1,$mysql_link),"/news/",$fil_outdoor_nom,$fil_outdoor_lien,"","");

    ?>
    <!-- fin fil d'arianne -->


    <!-- Début diaporama -->

    <?php if($res['diaporama'] == 1) { ?>

        <h1 itemprop="headline" class="m-reset"><?php echo stripslashes($res['titre']); ?></h1>

        <div class="line mt2 mb3 big">
            <?php

            $id_photo_diaporama = explode("-",$res["id_content_objets"]);

            $nbr_photo_diaporama = count($id_photo_diaporama);

            $gallerie = '<div class="flexslider"><ul class="slides">';

            for($i=0;($i+1)<=$nbr_photo_diaporama;$i++){

                $req_photo = "SELECT * FROM m_photo WHERE id = ".$id_photo_diaporama[$i];
                $query_photo = mysqli_query($mysql_link,$req_photo);
                $res_photo = mysqli_fetch_array($query_photo);

                $gallerie .= '<li><figure><img src="../lib/image/photo/'.$res_photo["userfile2"].'" /><figcaption class="small bold mts"><strong>'.$res_photo["legende"].' - '.$res_photo["copyright"].'</strong></figcaption></figure></li>';
            }

            $gallerie .= '</ul></div>';


            echo $gallerie;

            ?>
        </div>

    <? } ?>

    <!-- Fin diaporama -->









    <div class="mod wColCentre left">


        <article class="content" itemscope itemtype="http://schema.org/Article">




            <article>



                <?php if($res['diaporama'] != 1){ ?><h1 itemprop="headline" class="m-reset"><?php echo stripslashes($res['titre']); ?></h1><?php } ?>
                <?php if(!empty($res['chapeau'])){ ?><h2 class="h2-like" itemprop="description"><?php echo stripslashes($res['chapeau']); ?></h2><?php } ?>



                <?php

                if($res['diaporama'] != 1){

                    //si on a plusieurs photos
                    if( (!empty($res["id_content_objets"])) AND ($res["id_objet_rubrique"] == 17)){

                        $id_photo_diaporama = explode("-",$res["id_content_objets"]);


                        $gallerie = '<div class="flexslider mb3"><ul class="slides">';


                        $nbr_photo_diaporama = count($id_photo_diaporama);


                        for($i=0;($i+1)<=$nbr_photo_diaporama;$i++){

                            $req_photo = "SELECT * FROM m_photo WHERE id = ".$id_photo_diaporama[$i];
                            $query_photo = mysqli_query($mysql_link,$req_photo);
                            $res_photo = mysqli_fetch_array($query_photo);

                            $gallerie .= '<li><figure><img src="../lib/image/photo/'.$res_photo["userfile2"].'" /><figcaption class="small bold mts"><strong>'.$res_photo["legende"].' - '.$res_photo["copyright"].'</strong></figcaption></figure></li>';
                        }

                        $gallerie .= '</ul></div>';


                        echo $gallerie;



                    }else{

                        echo $image = image($res['userfile3'],"",$res['legende3'],$res['copyright3'],"","editorial",$res['titre_photo'],$res['id_photo'],$mysql_link);

                    }



                }
                ?>

                <div class="big mt1">

                    <?php if(!empty($res['userfile4'])){ $image2 = image($res['userfile4'],"",$res['legende4'],$res['copyright4'],"1","editorial","","",$mysql_link);} ?>

                    <?php if(!empty($res['corps'])){ ?><p itemprop="text" <?php if(!empty($res['corps'])){ ?>class="center"<? } ?>><?php echo stripslashes(nl2br(ereg_replace("image2",$image2,$res['corps']))); ?></p> <?php } ?>



                    <?php
                    if(!empty($res['nom_lien'])){
                        $lien = lien($res['nom_lien'],$res['url_lien'],"_blank","","",$mysql_link);
                        echo '<strong>'.$lien.'</strong>';
                    }
                    ?>

                    <?php if(!empty($res['video_article'])){ ?><div class="center video-container mt2 mb3"><?php echo stripslashes(nl2br(ereg_replace("image2",$image2,$res['video_article']))); ?></div> <?php } ?>

                    <div class="mb1 phone-hidden mt2"><?php echo afficheTag($res["id_tag"],$mysql_link); ?></div>



                    <div class="line mt2">
                        <?php
                        if(!empty($res["auteur"])) {

                            echo '<span class="small font-grisclair" itemprop="creator">'.stripslashes($res['auteur']).' - </span>';

                        }
                        ?>


                        <?php

                        $date_publication = dateformat($res["date_publication"],"en","fr");
                        if($date_publication != "00-00-0000"){
                            echo '<span class=" small font-grisclair">Publié le <time itemprop="dateCreated" datetime="'.$res["date_publication"].'T08:00">'.$date_publication.'</span>';
                        }

                        ?>
                    </div>




                    <p>



                    <div class="small">

                        <?php
                        if(!empty($res['titre_news'])){
                            $plusdenews = plusdecontenu($res['titre_news'],$res['id_news'],"m_editorial",$mysql_link);
                            echo $plusdenews;
                        }
                        ?>



                    </div>





                    <?php //echo pubshopping($res['id'],$res['id_produit'],$mysql_link);?>

                    </p>


                    <?php echo genere_commentaire($res["id_rubrique"],$res["id"],$_POST['ajout'],$_POST['nom'],$_POST['corps'],$res["nom_fichier"],$_GET['p'],"","",$_POST['link'],$mysql_link); ?>
                    <?php echo dernierenews("id_rubrique","('1,5')","id",$res["id"],$option3,$valeur3,$option4,$valeur4,$mysql_link); ?>
            </article>

    </div>
    <?php require("../lib/include/n_i-partie-droite-2.php") ?>

    <?php require("../lib/include/n_i-footer.php") ?>

</div>
</body>
</html>
<?php


$admin = true;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/f-nom-fichier.php");
require("../lib/fonction/f-recadre-photo.php");

echo "tets <br />";

//on selectionne les article diaporama
$req = "SELECT * FROM m_photo WHERE id_emplacement > 0 AND id_portfolio > 0 GROUP BY id_portfolio LIMIT 0,15";
$query = mysqli_query($mysql_link,$req);


    // on boucle article par article
    while($res = mysqli_fetch_array($query)) {


        //On construite la chaine avec le id photo

        $req_photo = "SELECT id FROM m_photo WHERE id_portfolio = ".$res['id_portfolio'];
        $query_photo = mysqli_query($mysql_link,$req_photo);
        $count_photo = mysqli_num_rows($query_photo);

        $i = 1;

        while($res_photo = mysqli_fetch_array($query_photo)) {

            $id_photo .= $res_photo['id'];

            if ($i != $count_photo){
                $id_photo .= "-";
            }

            $i++;
        }


        //on insère dans la base de donnée avec un tag diaporama (à creer)
        $action_requette = "INSERT INTO ";
        $last_id = last_id("m_editorial",$mysql_link);

        // on prépare le nom du fichier
        $nom_fichier = prepare_url(filtre_url(nom_fichier_define($res['titre'])));




        $req  = "INSERT INTO m_editorial SET ";
        $req .= "id =\"".$last_id."\" ";
        $req .= ",id_rubrique = 1 ";
        $req .= ",id_cat =\"".$res['id_cat']."\" ";
        $req .= ",id_tag =\"".$res['id_tag']."\" ";
        $req .= ",date_publication =\"".$res['date_publication']."\" ";
        $req .= ",titre  =\"".addslashes($res['titre'])."\" ";
        $req .= ",chapeau  =\"".addslashes($res['chapeau'])."\" ";
        $req .= ",corps  =\"".addslashes($res['corps'])."\" ";
        $req .= ",auteur  =\"".addslashes($res['copyright'])."\" ";



        $req .= ",id_objet_rubrique = 17 ";
        $req .= ",id_content_objets =\"".$id_photo."\" ";
        $req .= ",diaporama = 1 ";


        // on prépare le nom des images
        $nom_fichier_image[1] = prepare_url(filtre_url(nom_fichier_define($res['legende']))).'-'.$last_id.'.jpg';


        // copy l'image 660x330
        copy("../lib/image/photo/".$res['userfile2'],"../lib/image/editorial/".$nom_fichier_image[1]);

        // copy l'image 320 X 160
        copy("../lib/image/photo/".$res['userfile3'],"../lib/image/editorial/320x160-".$nom_fichier_image[1]);

        // copy et création de l'image 120x70

        $nom_fichier_image1 = "pt-".$nom_fichier_image[1];
        copy("../lib/image/editorial/".$nom_fichier_image[1],"../lib/image/editorial/".$nom_fichier_image1);


        $thumb = new Image("../lib/image/editorial/".$nom_fichier_image1);
        $thumb->height(70);
        $thumb->save();

        $thumb = new Image("../lib/image/editorial/".$nom_fichier_image1);

        $thumb->crop = true;
        $thumb->width(120);
        $thumb->height(70);
        $thumb->save();



        $req .= ",userfile0 =\"".$nom_fichier_image[1]."\" ";
        $req .= ",userfile1 =\"".$nom_fichier_image1."\" ";
        $req .= ",userfile2 =\"320x160-".$nom_fichier_image[1]."\" ";
        $req .= ",userfile3 =\"".$nom_fichier_image[1]."\" ";

        $req .= ",legende3  =\"".addslashes($res['legende'])."\" ";
        $req .= ",copyright3  =\"".addslashes($res['copyright'])."\" ";

        $nom_fichier = prepare_url(filtre_url(nom_fichier_define($res['titre'])));

        $req .= ",en_ligne = 1";
        $req .= ",nom_fichier  =\"".$nom_fichier."\" ";
        $req .= ",verifie = 1 ";


        $query_news = mysqli_query($mysql_link,$req);

        echo $res['titre']."<br />";



    }



?>
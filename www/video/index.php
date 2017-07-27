<?php 
$rubrique = 9;

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/php/smarty.php');


$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id= 9";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);


//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 1)){
	$p = 1;
}else{
	$p = $_GET['p'];
} 

$par_page = 25;

//AND id_cat=".$_GET['id']."

$req = "SELECT * FROM m_editorial WHERE id_rubrique= 9 AND en_ligne = 1 AND date_publication < NOW() AND id_cat != 49 ORDER BY id DESC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);


?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Vidéo de surf</title>

<link rel="canonical" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/video/'; ?>" />
<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />
<meta name="robots" content="index,follow">

		
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <div class="line mb1"><?php echo fil_ariance("Accueil","../",rubrique(9,$mysql_link),".","","","",""); ?></div>





    <?php

    while($res = mysqli_fetch_array($query)){

        //On initialise les bon path et rubrique
        if( (!empty($res['id_photographe'])) OR  (!empty($res['id_photographe'])) ){
            $id_rubrique_article1 = $res['id_rubrique']."-".$res['id_photographe'];
            $chemin_image1 = "../lib/image/photo/";

        }else{
            $id_rubrique_article1 = $res['id_rubrique'];
            $chemin_image1 = "../lib/image/editorial/";
        }

        //Initialisation du tableau pour smarty
        $resultat[$i]['date_publication']  = $res['date_publication'];
        $resultat[$i]['titre'] 	= stripslashes($res['titre']);
        $resultat[$i]['chapeau']  = stripslashes($res['chapeau']);
        $resultat[$i]['url'] 		= '/'.urlFichier($res['id'],$id_rubrique_article1,$mysql_link);
        $resultat[$i]['image_une'] 	= $chemin_image1.$res['userfile3'];
        $resultat[$i]['image'] 	= $chemin_image1.$res['userfile2'];
        $resultat[$i]['image-pt'] 	= $chemin_image1.$res['userfile1'];
        $resultat[$i]['legende']	= stripslashes($res['legende']);
        $resultat[$i]['iz']		= $i;
        $resultat[$i]['rubrique'] = $rubrique;
        $resultat[$i]['device'] = $device[1];

        $i++;
    }



    $smarty = new Smarty;
    $smarty->assign('resultat',$resultat);
    $smarty->display('../lib/template/p-sommaire-home.tpl');

    ?>
			
			<?php	
			//Pager
			$exist = nbrcontent("m_editorial","id_rubrique","9","","","",$mysql_link);
			//echo $pager = pager_rewriting($exist,$par_page,$_GET['p'],UrlCategorie($_GET['id'],$mysql_link),$_GET['id'],"",""); 
			
			echo $pager = pager($exist,$par_page,$p,"","","keyword",$_GET['keyword'],$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 

			
			
			?>

			

			</div>
			
		</div>
			
	

</div>
<?php require("../lib/include/n_i-footer.php") ?>	
</body>

</html>
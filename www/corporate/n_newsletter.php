<?php 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");

$url_site="http://www.mango-surf.com/";

if (!empty($_GET['id'])){

	//test pour savoir si l'identifiants existe déjà dans la BDD
	$req = "select * from m_newsletter where id=\"".$_GET['id']."\"";
	$query = mysqli_query($mysql_link,$req);
	$res = mysqli_fetch_array($query);
}else{
	header("Status: 301 Moved Permanently", false, 301);
	header("Location: ".$url_site);
	exit();
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <title>*|MC:SUBJECT|*</title>
        <style type="text/css" media="screen">
        /* Boilerplate Reset */
        body, p{margin:0; padding:0; margin-bottom:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;} img{line-height:100%; outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;} a img{border: none;} #backgroundTable {margin:0; padding:0; width:100% !important; } a, a:link{color:#2A5DB0; text-decoration: underline;} .ExternalClass {display: block !important; width:100%;} .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; } table td {border-collapse:collapse;} sup{position: relative; top: 4px; line-height:7px !important;font-size:11px !important;} .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {text-decoration: default; color: #a9a9a9 !important; /* set link color */ pointer-events: auto; cursor: default;} .no-detect a{text-decoration: none; color: #666; /* set text color */ pointer-events: auto; cursor: default;} .no-detect-local a{color: #a9a9a9;} span {color: inherit; border-bottom: none;} span:hover { background-color: transparent; }

        /* Base CSS */
        @media only screen and (max-width: 599px) {
            td[class="wrap"] { padding: 0 10px; }
            .logo{
	            width: 120px;
	            height: 106px;
	        }
        }
        
		/* 2 Equal-Width Columns V2 Layout Pattern CSS */
		@media only screen and (max-width: 599px) {
	        td[class="pattern"] table { width: 100%; }
	        td[class="pattern"] .hero_image img {
	            width: 100%;
	            height: auto !important;
	        }
		}
	    @media only screen and (max-width: 599px) {
	        td[class="pattern"] .spacer { display: none; }
	        td[class="pattern"] .col{
	            width: 100%;
	            display: block;
	        }
	        td[class="pattern"] .col:first-child { margin-bottom: 30px; }
	        td[class="pattern"] .hero_image img { width: 100%; }
	    }
	    
	    
	    /* Basic Fluid Image Pattern CSS */
	    @media only screen and (max-width: 599px) {
	        td[class="pattern"] img{
	            width: 100%;
	            height: auto !important;
	        }
	    }
	    
	    
	        
	    
	    
	    
	   	/* 3 equal-width columns Layout Pattern CSS */
		@media only screen and (max-width: 599px) {
	        td[class="pattern3"] table { width: 100%; }
		    td[class="pattern3"] .col{
		        width: 33%;
		    }
		    
		    
		}
	    @media only screen and (max-width: 599px) {
	        td[class="pattern3"] .col{
	            width: 100%;
	            display: block;
	        }
	        td[class="pattern3"] .col-left,
	        td[class="pattern3"] .col-mid {
	            margin-bottom: 15px;
	        }
	        td[class="pattern3"] img{
	            max-width: 100%;
	            height: auto !important;
	        }
	        
	     }
	        
	      @media only screen and (min-width: 600px) {
	        td[class="pattern3"] .col-left,
	        td[class="pattern3"] .col-mid {
	            padding-right:12px;
	        }
	      }

</style>

        
</head>
<body style="background: #fff;font-family:Arial, Helvetica, sans-serif; font-size:12px;">
    <table id="backgroundTable" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fff;">
        <tr>
            <td class="wrap" align="center" valign="top" style="background:#fff;" width="100%">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="header" style="padding:20px 0 15px 0; ">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center"><a href="http://www.mango-surf.com"><img src="http://www.mango-surf.com/lib/image/template/logo-mango-surf.png" alt="L'actualité du surf" class="logo" style="display: block; border: 0;" /></a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <?php
                    // ARTICLES
                    $article = explode("-",$res['news']);
                    
                    $req_article = "select * from m_editorial where id=\"".$article[0]."\"";
					$query_article = mysqli_query($mysql_link,$req_article);
					$res_article = mysqli_fetch_array($query_article);
                    
                    ?>
                    <tr>
                    	<td class="pattern" width="580" bgcolor="#000000" style="background-color:#000000; color:#fff; font-size:16px; text-transform:uppercase; padding:10px;">L'actualité du surf</td>
                    <tr>
                    
                    
                    <tr>
                        <td class="pattern" width="600" style="padding-top:15px;">
                          <a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" title="<?php echo stripslashes($res_article['titre']); ?>"><img src="<?php echo $url_site; ?>/lib/image/editorial/<?php echo $res_article['userfile3']; ?>" alt="<?php echo stripslashes($res_article['titre']); ?>" width="600" height="300" style="display: block; border: 0; padding-bottom:10px;" />
                          <a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" style="font-family: arial,sans-serif; font-size: 22px; color: #333; padding-top: 15px; text-decoration:none;"><?php echo stripslashes($res_article['titre']); ?></a><br />
                          <a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" style="font-family: arial,sans-serif; font-size: 16px; line-height: 20px !important; color: #555; padding-top: 10px; text-decoration:none;"><?php echo stripslashes($res_article['chapeau']); ?></a>
                        </td>
                    </tr>
                    <tr>
	                    <td class="pattern" width="600">
							<table cellpadding="0" cellspacing="0">
							    <tr>
							        <td width="600" align="center" style="padding: 15px 0;">
							            <table cellpadding="0" cellspacing="0">
							                <tr>
							                    <td class="col" width="290" valign="top">
							                        <table cellpadding="0" cellspacing="0">
							                            <tr>
							                                <td class="hero_image">
							                                <?php
									                        //ARTICLE2
									                        $req_article = "select * from m_editorial where id=\"".$article[1]."\"";
									                        $query_article = mysqli_query($mysql_link,$req_article);
									                        $res_article = mysqli_fetch_array($query_article);
									                        ?>
							                                <a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" title="<?php echo stripslashes($res_article['titre']); ?>"><img src="<?php echo $url_site; ?>/lib/image/editorial/<?php echo $res_article['userfile3']; ?>" width="290" alt="<?php echo stripslashes($res_article['titre']); ?>" style="display: block; border: 0; padding-bottom:10px;" /></a>
								                            <a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" style="font-family: arial,sans-serif; font-size: 18px; color: #333; padding-top: 15px; text-decoration:none;"><?php echo stripslashes($res_article['titre']); ?></a><br />
								                            <a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #555; padding-top: 10px; text-decoration:none;"><?php echo stripslashes($res_article['chapeau']); ?></a>

							                                </td>
							                            </tr>
							                        </table>
							                    </td>
							                    <td class="spacer" width="20" style="font-size: 1px;">&nbsp;</td>
							                    <td class="col" width="290" valign="top">
							                        <table cellpadding="0" cellspacing="0">
							                            <tr>
							                                <td class="hero_image">
							                                <?php
									                        //ARTICLE3
									                        $req_article = "select * from m_editorial where id=\"".$article[2]."\"";
									                        $query_article = mysqli_query($mysql_link,$req_article);
									                        $res_article = mysqli_fetch_array($query_article);
									                        ?>
							                                <a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" title="<?php echo stripslashes($res_article['titre']); ?>"><img src="<?php echo $url_site; ?>/lib/image/editorial/<?php echo $res_article['userfile3']; ?>" width="290" alt="<?php echo stripslashes($res_article['titre']); ?>" style="display: block; border: 0; padding-bottom:10px;" /></a>
								                            <a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" style="font-family: arial,sans-serif; font-size: 18px; color: #333; padding-top: 15px; text-decoration:none;"><?php echo stripslashes($res_article['titre']); ?></a><br />
								                            <a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #555; padding-top: 10px; text-decoration:none;"><?php echo stripslashes($res_article['chapeau']); ?></a>
							                                </td>
							                            </tr>
							                        </table>
							                    </td>
							                </tr>
							            </table>
							        </td>
							    </tr>
							</table>
                        </td>
                    </tr>
                    <tr>
                    	<td class="pattern3" bgcolor="#000000" width="580" style="background-color:#000000; color:#fff; font-size:16px; text-transform:uppercase; padding:10px;">Shop'in</td>
                    <tr>
                    <?php
                    if($res['shopping'] != NULL){
	                    
	                    //Si j'ai renseigné des produits
	                	$req_produit = "select id, id_rubrique, titre, userfile2 from m_shopping where id IN (".$res['shopping'].")";
	                	$query_produit = mysqli_query($mysql_link,$req_produit);
	                	
	                	$i=0;
	                    
	                    while($res_produit = mysqli_fetch_array($query_produit)){
	                    
		                   	 $tab_shopping[$i] = array($res_produit[0],$res_produit[1],$res_produit[2],$res_produit[3]);
		                   	 $i++ ; 
	                    }
	                	
                    }else{
	                    
	                    //Sinon on tire 3 
	                    
	                    $req_produit = "SELECT id, id_rubrique, titre, userfile2 FROM m_shopping WHERE (id > ((SELECT id FROM m_shopping ORDER BY id DESC LIMIT 0,1) - 1000)) ORDER BY RAND() LIMIT 0,3";
	                    $query_produit = mysqli_query($mysql_link,$req_produit);
	                    
	                    //$tab_shopping = array();
	                    $i=0;
	                    
	                    while($res_produit = mysqli_fetch_array($query_produit)){
	                    
		                   	 $tab_shopping[$i] = array($res_produit[0],$res_produit[1],$res_produit[2],$res_produit[3]);
		                   	 $i++ ; 
	                    }
	                    
                    }
                    
                    
                    ?>
                    
                    <tr>
                    	<td class="pattern3" width="600" style="padding: 15px 0;">
                    	<table cellpadding="0" cellspacing="0">
						    <tr>
						        <td width="600" align="center">
						            <table cellpadding="0" cellspacing="0">
						                <tr>
						                    <td class="col col-left" width="200" align="left" valign="top">
						                        <table cellpadding="0" cellspacing="0">
						                            <tr>
						                                <td align="left">
						                                    <table cellpadding="0" cellspacing="0" align="center">
						                                        <tr>
						                                            <td align="center" style="border:1px solid #222;">
						                                           	<a href="<?php echo $url_site.urlFichier($tab_shopping[0][0],$tab_shopping[0][1],$mysql_link);?>" title="<?php echo stripslashes($tab_shopping[0][2]); ?>"><img src="<?php echo $url_site; ?>lib/image/shopping/<?php echo $tab_shopping[0][3]; ?>" width="190" alt="<?php echo stripslashes($res_produit[0][2]); ?>" style="display: block; border: 0;" /></a>
						                                            </td>
						                                        </tr>
						                                        <tr>
							                                        <td style="padding-top:10px;" align="center"><a href="<?php echo $url_site.urlFichier($tab_shopping[0][0],$tab_shopping[0][1],$mysql_link);?>" title="<?php echo stripslashes($tab_shopping[0][2]); ?>" style="font-size: 14px; color: #333; text-decoration:none;"><?php echo stripslashes($tab_shopping[0][2]); ?></a></td>
						                                        </tr>
						                                    </table>
						                                </td>
						                            </tr>
						                        </table>
						                    </td>
						                    <td class="col col-mid" width="200" align="center" valign="top">
						                        <table cellpadding="0" cellspacing="0" align="center">
						                            <tr>
						                                <td align="left">
						                                    <table cellpadding="0" cellspacing="0">
						                                        <tr>
						                                            <td align="center" style="border:1px solid #222;">
						                                           	<a href="<?php echo $url_site.urlFichier($tab_shopping[1][0],$tab_shopping[1][1],$mysql_link);?>" title="<?php echo stripslashes($tab_shopping[1][2]); ?>"><img src="<?php echo $url_site; ?>lib/image/shopping/<?php echo $tab_shopping[1][3]; ?>" width="190" alt="<?php echo stripslashes($res_produit[1][2]); ?>" style="display: block; border: 0;" /></a>
						                                            </td>
						                                        </tr>
						                                        <tr>
							                                        <td style="padding-top:10px;" align="center"><a href="<?php echo $url_site.urlFichier($tab_shopping[1][0],$tab_shopping[1][1],$mysql_link);?>" title="<?php echo stripslashes($tab_shopping[1][2]); ?>" style="font-size: 14px; color: #333; text-decoration:none;"><?php echo stripslashes($tab_shopping[1][2]); ?></a></td>
						                                        </tr>

						                                    </table>
						                                </td>
						                            </tr>
						                        </table>
						                    </td>
						                    <td class="col" width="200" align="center" valign="top">
						                        <table cellpadding="0" cellspacing="0" align="center">
						                            <tr>
						                                <td align="left">
						                                    <table cellpadding="0" cellspacing="0">
						                                        <tr>
						                                            <td align="center" style="border:1px solid #222;">
						                                           	<a href="<?php echo $url_site.urlFichier($tab_shopping[2][0],$tab_shopping[2][1],$mysql_link);?>" title="<?php echo stripslashes($tab_shopping[2][2]); ?>"><img src="<?php echo $url_site; ?>lib/image/shopping/<?php echo $tab_shopping[2][3]; ?>" width="190" alt="<?php echo stripslashes($res_produit[2][2]); ?>" style="display: block; border: 0;" /></a>
						                                            </td>
						                                        </tr>
						                                        <tr>
							                                        <td style="padding-top:10px;" align="center"><a href="<?php echo $url_site.urlFichier($tab_shopping[2][0],$tab_shopping[2][1],$mysql_link);?>" title="<?php echo stripslashes($tab_shopping[2][2]); ?>" style="font-size: 14px; color: #333; text-decoration:none;"><?php echo stripslashes($tab_shopping[2][2]); ?></a></td>
						                                        </tr>

						                                    </table>
						                                </td>
						                            </tr>
						                        </table>
						                    </td>
						                </tr>
						            </table>
						        </td>
						    </tr>
						   </table>

                    	
                    	</td>
                    </tr>
                    
                    <tr>
                    	<td class="pattern" bgcolor="#000000" width="580" style="background-color:#000000; color:#fff; font-size:16px; text-transform:uppercase; padding:10px;">Zoom</td>
                    <tr>
                    <?php
                    
      	            if($res['photo'] != NULL){
      	            	$req_photo = "SELECT id, id_rubrique, id_cat, userfile2, legende, nom_fichier FROM m_photo WHERE id=".$res['photo'];
	      	        	$query_photo = mysqli_query($mysql_link,$req_photo);
	      	        	$res_photo = mysqli_fetch_array($query_photo);
      	            
      	            }else{
	      	        	$req_photo = "SELECT id, id_cat, id_rubrique, userfile2, legende, nom_fichier FROM m_photo WHERE id > 5503 ORDER BY RAND() LIMIT 0,1";
	      	        	$query_photo = mysqli_query($mysql_link,$req_photo);
	      	        	$res_photo = mysqli_fetch_array($query_photo);
      	            }
                    ?>
                    
                    
                    <tr>
                        <td class="pattern" width="600" style="padding: 15px 0;">
                          <a href="<?php echo $url_site.urlFichier($res_photo['id'],$res_photo['id_rubrique'],$mysql_link);?>" title="<?php echo $res_photo['legende']; ?>"><img src="<?php echo $url_site.'/lib/image/photo/'.$res_photo['userfile2']; ?>" alt="<?php echo $res_photo['legende']; ?>" width="600" height="300" style="display: block; border: 0; padding-bottom:10px;" /></a>
                          <a href="<?php echo $url_site.urlFichier($res_photo['id'],$res_photo['id_rubrique'],$mysql_link);?>" style="font-size: 18px; color: #333; padding-top: 15px; text-decoration:none;" title="<?php echo $res_photo['legende']; ?>"><?php echo $res_photo['legende']; ?></a>
                        </td>
                    </tr>
                    
                    <?php
                    
                    $req_agenda = "select * from m_agenda where en_ligne = 1 AND date_debut > NOW() ORDER BY date_debut ASC LIMIT 0,3";
					$query_agenda = mysqli_query($mysql_link,$req_agenda);
					$nbr_agenda = mysqli_num_rows($query_agenda);
					
					if ($nbr_agenda != NULL){
                    ?>
                    
	                    <tr>
	                    	<td class="pattern" bgcolor="#000000" width="580" style="background-color:#000000; color:#fff; font-size:16px; text-transform:uppercase; padding:10px;">L'agenda de la glisse</td>
	                    <tr>
	                    <tr>
	                    	<td style="padding-top:5px;">&nbsp;</td>
	                    </tr>
	                    
	                    <?php
	                    
	                    $i=1;
							
						while($res_agenda = mysqli_fetch_array($query_agenda)){
							
						if($i == 2) $color = "#ecf0f1";
						else $color = "#f1f4f5";
						
						?>
	                    
	                    <tr>
		                    <td class="pattern" width="580" style="padding:10px; background-color:<?php echo $color; ?>;">
								<strong style="font-size:12px"><?php echo dateformat($res_agenda["date_debut"],"en","fr"); ?></strong><br />
								<strong><a href="<?php echo $url_site.urlFichier($res_agenda['id'],$res_agenda['id_rubrique'],$mysql_link);?>" title="<?php echo stripslashes($res_agenda['titre']); ?>" target="_blank" style="color:#df0033; text-decoration:none;"><?php echo stripslashes($res_agenda['titre']); ?></a></strong><br /><?php echo stripslashes($res_agenda['lieu']); ?>
							</td>
	                    </tr>
	                    <?php $i++; } ?>
	                <?php } ?>
	                
	                
	                <tr>
	                
	                <td class="pattern" width="600" style="padding: 30px 0; font-size:11px; color:#333;" align="center">Si vous ne souhaitez plus recevoir d'e-mail, <a href="*|UNSUB|*">suivez ce lien</td>
	                </tr>
                    
                    
                  
                    
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
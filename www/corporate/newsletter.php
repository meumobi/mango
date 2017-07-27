<?php 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/f-all.php");

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

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>*|MC:SUBJECT|*</title>
	</head>
    <body  bgcolor="#F7F7F7">

	<center>
	<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF">
		<tr>
			<td>
			<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
					
					<tr>
						<td colspan="3"><a href="http://www.mango-surf.com/" title="L'actualité du surf" target="_blank"><img src="<?php echo $url_site; ?>lib/image/template/n-titre-actualite-surf.jpg" alt="<?php echo utf8_encode("L'actualité du surf"); ?>" width="600" height="210" border="0" /></a></td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<?php if(!empty($res['url_pub'])){ ?>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><a href="<?php echo $res['url_pub']; ?>" title="Cliquez-ici" target="_blank"><img src="<?php echo $url_site; ?>/lib/image/publicite/<?php echo $res['userfile1']; ?>" alt="Cliquez-ici" width="600" height="90" /></a></td>
					
					</tr>
					
					
					<?php } ?>

					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					
					<?php
					
					$article = explode("-",$res['news']);
					$i=1;
					foreach ($article as $a){
					
					$req_article = "select * from m_editorial where id=\"".$a."\"";
					$query_article = mysqli_query($mysql_link,$req_article);
					$res_article = mysqli_fetch_array($query_article);
					
					?>
					<tr>
						<td colspan="3" style="font-size:13px; font-family:arial; color:#333333;">
						
						<a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" title="<?php echo stripslashes($res_article['titre']); ?>" target="_blank"><img src="<?php echo $url_site; ?>/lib/image/editorial/<?php echo $res_article['userfile3']; ?>" alt="<?php echo stripslashes($res_article['titre']); ?>" height="143" width="280" style="border:1px solid #333333; margin-right:10px;" align="left" /></a>
						<strong><?php echo dateformat($res_article["date_publication"],"en","fr"); ?></strong><br />
						<a href="<?php echo $url_site.urlFichier($res_article['id'],$res_article['id_rubrique'],$mysql_link);?>" title="<?php echo stripslashes($res_article['titre']); ?>" target="_blank" style="color:#df0033; font-size:17px;"><strong font-color=""><?php echo stripslashes($res_article['titre']); ?></strong></a><br />
						<?php echo stripslashes(tronquer($res_article['chapeau'],240)); ?>
						</td>
					</tr>
					
					<?php if($i!=3){ ?>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<?php } ?>
					
					
					
					<? $i++; } ?>
					<?php if(!empty($res['shopping'])) { ?>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					
					<tr>
						<td colspan="3"><img src="<?php echo $url_site; ?>lib/image/template/n-titre-shopin.jpg" alt="Shop'in" width="600" height="53" /></td>
					</tr>
					
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					
					
					<tr>
						<?php
						$produit = explode("-",$res['shopping']);
						$i=1;
						
						foreach ($produit as $p){
						
						if($i == 1) $align = "left";
						elseif ($i == 2)$align="center";
						else $align="right";
						
						$req_produit = "select * from m_shopping where id=\"".$p."\"";
						$query_produit = mysqli_query($mysql_link,$req_produit);
						$res_produit = mysqli_fetch_array($query_produit);
				
						?>
						<td width="200" align="<?php echo $align; ?>">
						<a href="<?php echo $url_site.urlFichier($res_produit['id'],$res_produit['id_rubrique'],$mysql_link);?>" title="<?php echo stripslashes($res_produit['titre']); ?>" target="_blank"><img src="<?php echo $url_site; ?>lib/image/shopping/<?php echo $res_produit['userfile2']; ?>" alt="<?php echo stripslashes($res_produit['titre']); ?>" height="190" width="190" style="border:1px solid #333333;" /></a>
						</td>
						<?php $marginD=""; $i++; } ?>
		
					</tr>
					
					<? } ?>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><img src="<?php echo $url_site; ?>lib/image/template/n-titre-agenda.jpg" alt="L'agenda de la glisse" width="600" height="53" /></td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					
					<tr>
					<?php
						$req_agenda = "select * from m_agenda where en_ligne = 1 AND date_debut > NOW() ORDER BY date_debut ASC LIMIT 0,3";
						$query_agenda = mysqli_query($mysql_link,$req_agenda);
						
						$i=1;
						
						while($res_agenda = mysqli_fetch_array($query_agenda)){
						
						if($i == 2) $color = "#dddddd";
						else $color = "#ffffff";
					
					?>
					
						<td style="font-size:13px; font-family:arial; color:#333333; padding:10px; background-color:<?php echo $color; ?>;">
						<br />
						<strong><?php echo dateformat($res_agenda["date_debut"],"en","fr"); ?></strong><br />
						<strong><a href="<?php echo $url_site.urlFichier($res_agenda['id'],$res_agenda['id_rubrique'],$mysql_link);?>" title="<?php echo stripslashes($res_agenda['titre']); ?>" target="_blank" style="color:#df0033;"><?php echo stripslashes($res_agenda['titre']); ?></a></strong> - <?php echo stripslashes($res_agenda['lieu']); ?>
						<br /><br />
						</td>
					
					
					<?php $i++; $color=""; } ?>
					</tr>
					
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					
					<tr>
						<td colspan="3" align="center" style="font-size:13px; font-family:arial; color:#333333;">Si vous ne souhaitez plus recevoir d'e-mail, <a href="*|UNSUB|*">suivez ce lien</a></td>
					</tr>
				</table>

			
			</td>
		
		</tr>
	</table>
	
	
	


	</center>
    </body>
</html>
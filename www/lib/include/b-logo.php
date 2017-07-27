<?php
$req_logo_business = "SELECT * FROM m_annuaire WHERE client = 1 AND date_debut <= NOW() AND date_fin >= NOW() ORDER BY rand() DESC LIMIT 0,5";
$query_logo_business = mysqli_query($mysql_link,$req_logo_business);
 
while($res_logo_business = mysqli_fetch_array($query_logo_business)){ ?>


	<a href="/annuaire/<?php echo $res_logo_business['nom_fichier'].'--'.$res_logo_business['id'].'.html'; ?>" title="<?php echo $res_logo_business['titre']; ?>" rel="nofollow"><img class="imgBorder mrgB23" src="/lib/image/annuaire/<?php echo $res_logo_business['userfile1']; ?>" alt="<?php echo $res_logo_business['titre']; ?>" width="90" height="90" /></a>

<?php } ?>
<?php
$req_shop = "SELECT * FROM m_shopping WHERE (id > ((SELECT id FROM m_shopping ORDER BY id DESC LIMIT 0,1) - 20)) ORDER BY RAND() LIMIT 0,5";
$query_shop = mysqli_query($mysql_link,$req_shop);
 
while($res_shop = mysqli_fetch_array($query_shop)){ ?>


	<a href="/<?php echo urlFichier($res_shop['id'],$res_shop['id_rubrique'],$mysql_link); ?>" title="<?php echo $res_shop['titre']; ?>" rel="nofollow"><img class="imgBorder mrgB23" src="/lib/image/shopping/<?php echo $res_shop['userfile1']; ?>" alt="<?php echo $res_shop['titre']; ?>" width="90" height="90" /></a>

<?php } ?>
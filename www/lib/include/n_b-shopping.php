<?php
$req_shop_aside = "SELECT * FROM m_shopping WHERE (id > ((SELECT id FROM m_shopping ORDER BY id DESC LIMIT 0,1) - 20)) ORDER BY RAND() LIMIT 0,1";
$query_shop_aside = mysqli_query($mysql_link,$req_shop_aside);
$res_shop_aside = mysqli_fetch_array($query_shop_aside);
?>

<section class="mb2">

<div class="titreRubrique line mb2">Tendance !</div>
<div class="borderGray txtcenter w100">
	<a href="/<?php echo urlFichier($res_shop_aside['id'],$res_shop_aside['id_rubrique'],$mysql_link); ?>" title="<?php echo $res_shop_aside['titre']; ?>" rel="nofollow"><img src="/lib/image/shopping/<?php echo $res_shop_aside['userfile2']; ?>" alt="<?php echo $res_shop_aside['titre']; ?>" width="250" height="250" /></a>
</div>
</section>
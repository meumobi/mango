<?php 
$rubrique = 10;
require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");



//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) $p = 1; else $p = $_GET['p'];


$par_page = 18;


$req = "SELECT id FROM m_tag WHERE id_cat = 40 ";

	if(!empty($_GET['alpha'])){
		$req .= "AND nom like '".$_GET['alpha']."%'";
		$req_nbr_content = " AND nom like '".$_GET['alpha']."%'";
	}


$req .= "ORDER BY nom ASC LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);
$nbr_lexique = mysqli_num_rows($query);

$req_introduction = "SELECT titre, presentation FROM m_rubrique WHERE id= 10";
$query_introduction = mysqli_query($mysql_link,$req_introduction);
$res_introduction = mysqli_fetch_array($query_introduction);


?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Lexique du surf</title>
<meta name="description" content="<?php echo strip_tags($res_introduction['presentation']);?>" />
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
    <?php echo fil_ariance("Accueil","../",rubrique(10,$mysql_link),".",$_GET['alpha'],"","",""); ?>

    <?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="line">
			

			<?php
			?>
			
			
			<div class="line bgGrisClair pa2 mb2 phone-hidden">				
					<h1 class="h2-like m-reset"><?php echo $res_introduction['titre']; ?></h1>
					<?php echo $res_introduction['presentation'];?>
			</div>
			<div class="line mb2 phone-hidden">				
						<?php
						$i=0;
						$alpha = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
						
						foreach ($alpha as $value) {
			
	
						if($_GET['alpha'] == $alpha[$i]) $background='bgBlack"';else $background='bgRed';
						
						
						$exist_alpha = nbrcontent("m_editorial","id_rubrique","10","",""," AND titre like '".$value."%'");
						
						?>
						
						<li class="inbl pa05 <?php echo $background; ?>"><a class="fontWhite" href="?alpha=<?php echo $alpha[$i]; ?>" <?php echo $hover; ?> title="<?php echo $value; ?>" ><?php echo $value; ?></a></li>
						
						<?php $hover=""; $i++; }	?>
					</div>

			
			
			
			
			
			<?php 
			
			$i = "";
			while ($res = mysqli_fetch_array($query)){ 
							
				echo listing_lexique($res['id'],$i,$nbr_lexique,$mysql_link);				
				$i++;
			} 
			
			if(empty($nbr_lexique)){
				echo "<div align='center' class='mt3 mb2'>Aucune définition n'a été enregistrée pour cette lettre de l'alphabet<br /><br />
				<a href='/corporate/index.php?id_rubrique=10' title='Proposer une définition' rel='nofollow'>Soyer le premier à proposer une définition !</a></div>";
			}
			
			
			?>
			<?php	
			
			//Pager
			$exist = nbrcontent("m_tag","id_cat","40","","",$req_nbr_content,$mysql_link);
			echo $pager = pager($exist,$par_page,$p,"","","alpha",$_GET['alpha'],$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
						
			?>

			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>


</div>
</body>

</html>
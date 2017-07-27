<?php 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");
require("../lib/fonction/n_f-pager.php");

$no_sky = 1;

//initialisation pager
if ((empty($_GET['p'])) || ($_GET['p'] == 0)) {
	$p = 1; 
}else{
	$p = $_GET['p'];
} 

$par_page = 8;


$req = "SELECT * FROM m_partenaire LIMIT ".(($p-1)*$par_page).",".$par_page;
$query = mysqli_query($mysql_link,$req);

?>

<?php require("../lib/include/n_i-meta.php"); ?>	
<title>Les amis !</title>

</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
			
	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1">Les amis !</div>
			<div class="line">
			
			<?php echo fil_ariance("Accueil","../","Les amis","partenaire.php","","","",""); ?>
			
			<?php 
			$i ="";
			while ($res = mysqli_fetch_array($query)){ 
				

			?>
			
				<div class="line zebre pa1">
					<img src="/lib/image/partenariat/<?php echo $res['userfile1']; ?>" alt="<?php echo $res['titre']; ?>" class="left" />
					<a href="<?php echo $res['url']; ?>" title="<?php echo $res['titre']; ?>" target="_blank"><strong class="font12"><?php echo $res['titre']; ?></a></strong><br />
					<?php echo $res['corps']; ?>
				</div>
			
			<?php
			$i++;
			$classimpaire="";
			} 
			
			?>
			
			<?php	
			
			//Pager
			$exist = nbrcontent("m_editorial","id_rubrique","23","","","",$mysql_link);
			echo $pager = pager($exist,$par_page,$p,"","",$param2,$valeur2,$param3,$valeur3,$param4,$valeur4,$param5,$valeur5); 
						
			?>

			</div>
			
		</div>
			
<?php require("../lib/include/n_i-footer.php") ?>
	

</div>
</body>

</html>
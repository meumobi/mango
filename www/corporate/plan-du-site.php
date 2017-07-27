<?php 

require("../lib/fonction/f-connection.php");
require("../lib/fonction/n_f-all.php");

$no_photo = 1;
$no_sky = 1;

?>



<?php require("../lib/include/n_i-meta.php"); ?>	

<title>Plan du site</title>
<meta name="robots" content="index,follow">

		
</head>

<body>

<?php require("../lib/include/n_i-header.php"); ?>
<div class="wSite">
			
	<?php require("../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
			<div class="titreRubrique line mb1">Plan du site</div>
			<div>
			
			<?php echo fil_ariance("Accueil","../","Plan du site","plan-du-site.php","","","",""); ?>
			<div class="grid">
			<div class="grid2">
				<div class="mt1">
					<h2>Editorial</h2>
					
					<a href="../news/" title="L'actualité du surf">L'actualité du surf</a><br />
					<a href="../trip-surf/" title="Trip surf">Trip surf</a><br />
					<a href="../lexique/" title="Lexique">Lexique</a><br />
					<a href="../agenda/" title="L'agenda des manifestations">L'agenda des manifestations</a><br />
					<br />
					<h2>Photo</h2>
					<a href="../galerie-photo/" title="Galerie photo">Galerie photo</a><br />
					<a href="../galerie-photo/photographe/" title="Photographes de surf">Photographes de surf</a>
					
					<h2>Annonce</h2>
					
					<a href="../annonce/" title="Petites annonces">Petites annonces</a><br />
					
				
				</div>
				
				<div>
					<h2>Annuaire</h2>
					<a href="../annuaire/" title="Annuaire du business">Annuaire du business</a><br />
					<a href="../annuaire/surf-shop-26-0-1.html" title="Surf shop">Surf shop</a><br />
					<a href="../annuaire/surf-school-28-0-1.html" title="Ecole de surf">Ecole de surf</a><br />
					<a href="../annuaire/shaper-27-0-1.html" title="Shaper">Shaper</a><br />
					<a href="../annuaire/surf-camp-29-0-1.html" title="Surf camp">Surf camp</a>
					<br />
					<h2>Vidéo</h2>					
					<a href="../video/" title="Vidos">Vidéos de surf</a><br />
					<br />
					<h2>Shop'in</h2>
					<a href="../shopping/" title="Soyer tendantes !">Soyer tendantes !</a><br />
					
				</div>
			</div>
			</div>
				
				
				
			</div>
			
		</div>
			
	<?php require("../lib/include/n_i-footer.php") ?>	


</div>
</body>

</html>
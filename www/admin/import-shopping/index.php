<?php

$admin = true;
require("../../lib/fonction/f-connection.php");
require("../../lib/fonction/n_f-all.php");




require("../../lib/include/n_i-meta.php");


?>	

<title>-- Corespondance Shopping --</title>	
		
</head>

<body>

<div class="wSite">

	<?php require("../../lib/include/n_i-header.php"); ?>	
			
	<?php require("../../lib/include/n_i-partie-droite.php") ?>

		<div class="mod wColCentre">
		
		<?php
		$URLSHOP = array("http://flux.netaffiliation.com/feed.php?maff=85B5E4FFP447F34ADC5151");
		/*,
		"http://flux.netaffiliation.com/feed.php?maff=20DE0824P411D14ADC5161",
		"http://flux.netaffiliation.com/feed.php?maff=45258332P447F14ADC5151",
		"http://flux.netaffiliation.com/feed.php?maff=85B5E4FFP447F34ADC5151"
		);*/
		
		
		/*POUR INFORMATION*/
		
		// $data[18] = marque
		// $data[4]  = catégorie produit
		

		$nbrCorrespondanceCree = 0;

		foreach ($URLSHOP as &$value){

			if (($handle = fopen($value, "r")) !== FALSE) {
	    
	    	$lignecsv = 0;
	
	    		while (($data = fgetcsv($handle,'',';','"')) !== FALSE) {
	    		
				
	    		
		    		//Ne pas traiter la première ligne
		    		if($lignecsv != 0){
		    
		    		// On teste si la catégorie existe déjà
		    		$req_exist = "SELECT id FROM m_correspondance WHERE label_partenaire LIKE '".trim(addslashes($data[4]))."'";   	    		
		    		
					// On teste si la marque existe déjà
		    		//$req_exist = "SELECT id FROM m_correspondance WHERE label_partenaire LIKE '".trim(addslashes($data[18]))."'";   	    		

		    		
		    		
		    		$query_exist = mysqli_query($mysql_link,$req_exist);
		    		$res_exist = mysqli_num_rows($query_exist);
		    					
		    			// On intègre si 
		    			if($res_exist == 0){
		    		
		    				$req = "INSERT INTO m_correspondance SET ";
		    				$req .= "id_type_correspondance = 2 ";
		    				$req .= ",label_partenaire =\"".trim($data[4])."\" ";
		    	 	
		    				$query = mysqli_query($mysql_link,$req);
	    			
		    				$nbrCorrespondanceCree++;
		    				
		    				echo $data[4]."<br />";
							echo $data[18]."<br /><br />";
		    			}
		    		}
		    
		    		$lignecsv++;
				} 
		
		   
	    	fclose($handle);
			}

		}
		?>
		
		<?php echo $nbrCorrespondanceCree; ?>
		
		</div>
	
	<?php require("../lib/include/n_i-footer.php") ?>

		
</div>
</body>

</html>

                                            
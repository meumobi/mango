<?php echo $input = input("Tag Id (xx-xx-xx) - Affiche des tags sur la page article <a href='/admin/tag/ajout.php?id_rubrique=18' target='_blank'>Ajouter</a>","id_tag","text","",$res['id_tag'],"pa1 borderGray w100","");?>

<?php echo $input = input("Titre <span class='alerte'>*</span> - 180 caractères maximum","titre","text","180",$res['titre'],"w100 pa1 borderGray","mb1"); ?>

<?php echo $textarea = textarea("Chapeau <span class='alerte'>*</span> - 255 caractères maximum","chapeau",$res["chapeau"],"2","w100 pa1 borderGray mb1"); ?>

<?php echo $textarea = textarea("Texte <span class='alerte'>*</span>","corps",$res["corps"],"50","w100 pa1 borderGray mb1"); ?>


<section class="line mb1 grid">
	<div class="grid2">

	<?php 
	if (($_GET['id_rubrique'] != 4) AND ($_GET['id_rubrique'] != 6)){
		echo $input = input("Signature <span class='alerte'>*</span>","auteur","text","255",$res["auteur"],"pa1 borderGray w100",""); 
	}else{
		echo $input = input("Classement","classement","text","255",$res["classement"],"pa1 borderGray w100",""); 
	}
	?>
	
	<?php echo $input = input("Date Publication <span class='alerte'>*</span>","date_publication","text","255",$date_publication,"pa1 borderGray w100",""); ?>
	</div>
</section>


<section class="line mb1 grid">
	<div class="grid2">
	<?php 
	
	$req = "SELECT id,nom FROM m_emplacement ORDER BY nom";
	$query = mysqli_query($mysql_link,$req);
	
	echo $liste = liste("Mettre en avant l'article","id_emplacement",$res['id_emplacement'],$optgroup1,$query,$optgroup2,$query2,"pa1 borderGray w100",""); 
	
	$req = "SELECT id,nom FROM m_cat WHERE id_rubrique=1 ORDER BY id";
	$query = mysqli_query($mysql_link,$req);

				
	echo $liste = liste("Catégorie<span class='alerte'>*</span>","id_cat",$res['id_cat'],$optgroup1,$query,$optgroup2,$query2,"w100 pa1 borderGray","mb1"); 
	
	
	?>
	</div>
</section>


<section class="line mb1 grid">
	<div class="grid2">
	<?php echo $input = input("Lien Externe","nom_lien","text","180",$res["nom_lien"],"pa1 borderGray w100",""); ?>
	<?php echo $input = input("URL lien externe","url_lien","text","255",$res['url_lien'],"pa1 borderGray w100",""); ?>
	</div>
</section>

<?php echo $input = input("Renseigner les ID article pour afficher des articles dans le bloc Sur le même sujet","id_news","text","180",$res["id_news"],"pa1 borderGray w100",""); ?>

<?php echo $textarea = textarea("Code de la vidéo","video_article",$res["video_article"],"5","w100 pa1 borderGray mb1"); ?>


<section class="line mb1 ">



    <div>
        <label>Type objet éditoriaux<span class="alerte">*</span></label>
            <select name="id_objet_rubrique" id="id_objet_rubrique" class="w100 pa1 borderGray">
                <option value="">Séléctionner un type de contenu</option>
                <option value="17"  <?php if($valeur == $res["id_objet_rubrique	"]) echo 'selected="selected"'; ?>>Photos</option>
            </select>

    </div>


</section>


        <?php echo $input = input("ID photo (XX-XX ) Pour afficher des photos en mode diaporama au début de l'article","id_content_objets","text","180",$res["id_content_objets"],"pa1 borderGray w100",""); ?>



	<?php echo $input = input("Image Grande <span class='alerte'>*</span> - 1000x500px","userfile2","file","180","","pa1 borderGray w100",""); ?>
	<?php echo $input = input("Légende image 1 <span class='alerte'>*</span>","legende3","text","180",$res["legende3"],"pa1 borderGray w100",""); ?>
	<?php echo $input = input("copyright image 1 <span class='alerte'>*</span>","copyright3","text","180",$res["copyright3"],"pa1 borderGray w100",""); ?>


<?php echo $checkbox = checkbox("En ligne","en_ligne",$res["en_ligne"],1,"pa1 borderGray","left mr1"); ?>
<?php echo $checkbox = checkbox("Diaporama (apparait dans la rubrique ZOOM)","diaporama",$res["diaporama"],1,"pa1 borderGray","left mr1"); ?>
<?php echo $checkbox = checkbox("News Diapo","diapo_news",$res["diapo_news"],1,"pa1 borderGray","left mr1"); ?>
<?php echo $checkbox = checkbox("Vérifié","verifie",$res["verifie"],1,"pa1 borderGray","left mr1"); ?>

<?php echo $input = input("","id_sommaire","hidden","180",$_GET["id_sommaire"],"",""); ?>
<?php echo $input = input("","id_rubrique","hidden","180",$_GET["id_rubrique"],"",""); ?>
<?php echo $input = input("","id","hidden","180",$_GET["id"],"",""); ?>
<?php echo $input = input("","a","hidden","180","1","",""); ?>
				
<?php echo $bouton = bouton("Valider","edito","submit","bouton mt2"); ?>
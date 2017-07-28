

<footer id="footer" class="line pa1 mt2 mb2 mt2 txtcenter bgBlack">
	<a href="/corporate/widget-news.php" title="Afficher les news sur votre site" rel="nofollow" class="fontWhite">Widget news</a> -
	<a href="/corporate/partenaire.php" title="Partenaire" class="fontWhite">Les amis</a> -
	<a href="/corporate/contactez-nous.php" title="Contactez-nous" rel="nofollow" class="fontWhite">Contactez-nous</a> -
	<a href="/corporate/plan-du-site.php" title="Plan du site" class="fontWhite">Plan du site</a> -
	<a href="/corporate/mentions-legales.php" title="Mentions légales" rel="nofollow" class="fontWhite">Mentions légales</a> - 
	<a href="/tag/" title="Tags" class="fontWhite">Tags</a> 

</footer>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
<script src="http://www.mango-surf.com/lib/js/jquery.flexslider.js"></script>
<script type="text/javascript" charset="utf-8">
    $(window).load(function() {


        $('.flexslider').flexslider({
            animation: "fade",
            controlNav: false,
            slideshow: false,
        });

    });
</script>
<?php if($admin != true){ ?>

<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5311ef49281f95d5"></script>
<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'left',
      'services' : 'facebook,twitter,google_plusone_share,email,more',
      'numPreferredServices' : 5
    }
  });
</script>
<!-- AddThis Smart Layers END -->


<?php } ?>



<?php mysqli_close($mysql_link); ?>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-4026363-1', 'auto');
    ga('send', 'pageview');

</script>


<script>
    ADTECH.config.page = { protocol: 'http', server: 'adserver.adtech.de', network: '1502.1', siteid: '670202', params: { loc: '100' }};
    ADTECH.config.placements[6033207] = { responsive : { useresponsive: true, bounds: [{id: 6033208, min: 0, max: 499 }, {id: 6033207, min: 500, max: 9999 }]}, sizeid: '3055', params: { alias: '', target: '_blank', }};
    ADTECH.config.placements[5008877] = { responsive : { useresponsive: true, bounds: [{id: 6035346, min: 0, max: 499 }, {id: 5008877, min: 500, max: 9999 }]}, sizeid: '225', params: { alias: '', target: '_blank' }};
    ADTECH.config.placements[5008876] = { responsive : { useresponsive: true, bounds: [{id: 6035345, min: 0, max: 499 }, {id: 5008876, min: 500, max: 9999 }]}, sizeid: '170', params: { alias: '', target: '_blank' }};
</script>


<?php if($nopave == 1){ ?>

    <script>
        ADTECH.loadAd(6033207);
        ADTECH.loadAd(5008877);
    </script>

<?php }else{ ?>

    <script>
        ADTECH.loadAd(6033207);
        ADTECH.loadAd(5008877);
        ADTECH.loadAd(5008876);
    </script>
<?php } ?>



<!doctype html>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!--><html class="no-js" lang="fr"> <!--<![endif]-->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->

    <link rel="alternate" type="application/rss+xml" title="RSS" href="http://www.mango-surf.com/corporate/rss.xml" />
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700|Roboto:400,500,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/lib/css/style-mango-test-2.css" />



    <?php
    // Pour afficher un habillage
    if($device[1] == "_1"){
        //echo '<style media="all" type="text/css">body {background:url("/lib/image/publicite/20140703-rote.jpg") no-repeat top center;} .mb-hab{margin-bottom:35px;}</style>';
    }
    ?>

    <!--[if lt IE 9]>
    <script src="/lib/js/html5shiv.js"></script>
    <![endif]-->


    <?php if($admin != true){ ?>
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-4026363-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <? } ?>
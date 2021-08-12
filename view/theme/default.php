<?php
$siteInfo = $_SESSION['site_info'];
/* die(debug($_SESSION)); */
?>

<!DOCTYPE HTML>

<html lang="fr">

<head prefix="og: http://ogp.me/ns#">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gauvin jonathan Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Voici mon portfolio avec tout les services que je propose" />
    <meta name="author" content="gauvin jonathan" />

    <meta property="og:description" content="Site portfolio dévelopment Web & Application Mobile">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:title" content="Accueil">
    <meta property="og:site_name" content="Jo-développement">
    <meta property="og:image" content="<?= Router::webroot('img/avatar/1591621853385 (1).jfif') ?>">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="<?= Router::theme('default/css/animate.css') ?>">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="<?= Router::theme('default/css/icomoon.css') ?>">
    <!-- Themify Icons-->
    <link rel="stylesheet" href="<?= Router::theme('default/css/themify-icons.css') ?>">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="<?= Router::theme('default/css/bootstrap.css') ?>">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?= Router::theme('default/css/magnific-popup.css') ?>">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="<?= Router::theme('default/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= Router::theme('default/css/owl.theme.default.min.css') ?>">

    <!-- Theme style  -->
    <link rel="stylesheet" href="<?= Router::theme('default/css/style.css') ?>">

    <!-- Modernizr JS -->
    <script src="<?= Router::theme('default/js/modernizr-2.6.2.min.js') ?>"></script>


</head>

<body>

    <div class="gtco-loader"></div>

    <div id="page">


        <div class="page-inner">

            <div id="head-top" style="position: absolute; width: 100%; top: 0; ">
                <div class="gtco-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div id="gtco-logo"><a href="<?= Router::url('pages/accueil') ?>"><?= $siteInfo->name_site ?> <em>.</em></a></div>
                            </div>
                            <div class="col-md-6 col-xs-6 social-icons">
                                <ul class="gtco-social-top">

                                    <?php if (!empty($siteInfo->url_facebook)) : ?>
                                        <li><a href="<?= $siteInfo->url_facebook ?>"><i class="icon-facebook"></i></a></li>
                                    <?php endif ?>

                                    <?php if (!empty($siteInfo->url_tweeter)) : ?>
                                        <li><a href="<?= $siteInfo->url_tweeter ?>"><i class="icon-twitter"></i></a></li>
                                    <?php endif ?>

                                    <?php if (!empty($siteInfo->url_Linkedin)) : ?>
                                        <li><a href="<?= $siteInfo->url_Linkedin ?>"><i class="icon-linkedin"></i></a></li>
                                    <?php endif ?>

                                    <?php if (!empty($siteInfo->url_insta)) : ?>
                                        <li><a href="<?= $siteInfo->url_insta ?>"><i class="icon-instagram"></i></a></li>
                                    <?php endif ?>

                                    <?php if (!empty($siteInfo->url_youtube)) : ?>
                                        <li><a href="<?= $siteInfo->url_youtube ?>"><i class="icon-youtube"></i></a></li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="gtco-nav sticky-banner" role="navigation">
                    <div class="gtco-container">

                        <div class="row">
                            <div class="col-xs-12 text-center menu-1">
                                <ul>
                                    <li class="active"><a href="<?= Router::url('pages/accueil') ?>">Accueil</a></li>
                                    <li class="has-dropdown">
                                        <a style="cursor: pointer;">Services</a>
                                        <ul class="dropdown">
                                            <li><a href="<?= Router::url('pages/site_static') ?>">Site static</a></li>
                                            <li><a href="<?= Router::url('pages/site_dynamique') ?>">Site Dynamique</a></li>
                                            <li><a href="<?= Router::url('pages/application_mobile') ?>">Application Mobile</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?= Router::url('portfolio/index') ?>">Portfolio</a></li>
                                    <li><a href="<?= Router::url('blog/index') ?>">Blog</a></li>
                                    <li><a href="<?= Router::url('pages/contact') ?>">Contact</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </nav>
            </div>


            <?php echo $content_for_theme; ?>

        </div>

        <footer id="gtco-footer" role="contentinfo">
            <div class="gtco-container">
                <div class=" infoFooter">



                    <div class="col-md-4 col-md-push-1" style="display: inline-block;">
                        <div class="gtco-widget">
                            <h3>Nos Services</h3>
                            <ul class="gtco-footer-links">
                                <li><a href="<?= Router::url('pages/site_static') ?>">Site static</a></li>
                                <li><a href="<?= Router::url('pages/site_dynamique') ?>">Site Dynamique</a></li>
                                <li><a href="<?= Router::url('pages/application_mobile') ?>">Application Mobile</a></li>

                            </ul>
                        </div>
                    </div>



                    <div class="col-md-3 col-md-push-1" style="display: inline-block;">
                        <div class="gtco-widget">
                            <h3>Nous contacter</h3>
                            <ul class="gtco-quick-contact">

                                <?php if (!empty($siteInfo->mobile_number)) : ?>
                                    <li><a href="#"><i class="icon-phone"></i><?= $siteInfo->mobile_number  ?></li>
                                <?php endif ?>

                                <?php if (!empty($siteInfo->site_email)) : ?>
                                    <li><a href="#"><i class="icon-mail2"></i><?= $siteInfo->site_email  ?></a></li>
                                <?php endif ?>

                            </ul>
                        </div>
                    </div>

                </div>

                <div class="row copyright">
                    <div class="col-md-12">
                        <p class="pull-left">
                            <small class="block">&copy;2021 Jonathan.</small>

                        </p>
                        <p class="pull-right">
                        <ul class="gtco-social-icons pull-right">
                            <?php if (!empty($siteInfo->url_facebook)) : ?>
                                <li><a href="<?= $siteInfo->url_facebook ?>"><i class="icon-facebook"></i></a></li>
                            <?php endif ?>

                            <?php if (!empty($siteInfo->url_tweeter)) : ?>
                                <li><a href="<?= $siteInfo->url_tweeter ?>"><i class="icon-twitter"></i></a></li>
                            <?php endif ?>

                            <?php if (!empty($siteInfo->url_Linkedin)) : ?>
                                <li><a href="<?= $siteInfo->url_Linkedin ?>"><i class="icon-linkedin"></i></a></li>
                            <?php endif ?>

                            <?php if (!empty($siteInfo->url_insta)) : ?>
                                <li><a href="<?= $siteInfo->url_insta ?>"><i class="icon-instagram"></i></a></li>
                            <?php endif ?>

                            <?php if (!empty($siteInfo->url_youtube)) : ?>
                                <li><a href="<?= $siteInfo->url_youtube ?>"><i class="icon-youtube"></i></a></li>
                            <?php endif ?>

                        </ul>
                        </p>
                    </div>
                </div>

            </div>
        </footer>
    </div>

    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>

    <!-- jQuery -->
    <script src="<?= Router::theme('default/js/jquery.min.js') ?>"></script>
    <!-- jQuery Easing -->
    <script src="<?= Router::theme('default/js/jquery.easing.1.3.js') ?>"></script>
    <!-- Bootstrap -->
    <script src="<?= Router::theme('default/js/bootstrap.min.js') ?>"></script>
    <!-- Waypoints -->
    <script src="<?= Router::theme('default/js/jquery.waypoints.min.js') ?>"></script>
    <script src="<?= Router::theme('default/js/sticky.js') ?>"></script>
    <!-- Carousel -->
    <script src="<?= Router::theme('default/js/owl.carousel.min.js') ?>"></script>
    <!-- countTo -->
    <script src="<?= Router::theme('default/js/jquery.countTo.js') ?>"></script>

    <!-- Stellar Parallax -->
    <script src="<?= Router::theme('default/js/jquery.stellar.min.js') ?>"></script>

    <!-- Magnific Popup -->
    <script src="<?= Router::theme('default/js/jquery.magnific-popup.min.js') ?>"></script>
    <script src="<?= Router::theme('default/js/magnific-popup-options.js') ?>"></script>

    <!-- Main -->
    <script src="<?= Router::theme('default/js/main.js') ?>"></script>


</body>

</html>
<style>
    .infoFooter {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    @media (max-width:490px) {
        .infoFooter {
            justify-content: space-between;
        }
    }
</style>
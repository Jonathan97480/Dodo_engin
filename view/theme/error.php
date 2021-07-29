<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= Router::webroot('js/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= Router::webroot('theme/admin/sb-admin-2.min.css') ?>" rel="stylesheet">

</head>

<body >

    <div class="container">

        <!-- affiche les info de la flach -->
        <div aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <?php echo $this->Session->flash(); ?>
            <?php echo $content_for_theme; ?>
        </div>

    </div>

    <script src="<?= Router::theme('default/js/jquery.min.js') ?>"></script>
    <!-- jQuery Easing -->
    <script src="<?= Router::theme('default/js/jquery.easing.1.3.js') ?>"></script>
    <!-- Bootstrap -->
    <script src="<?= Router::theme('default/js/bootstrap.min.js') ?>"></script>

</body>

</html>
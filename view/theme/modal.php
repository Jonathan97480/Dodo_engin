<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administration</title>

    <!-- Custom fonts for this template-->
    <link href="<?= Router::webroot('js/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= Router::webroot('js/vendor/slim-select/slimselect.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= Router::webroot('theme/admin/sb-admin-2.min.css') ?>" rel="stylesheet">

    <!-- lightbox -->
    <link href="<?= Router::webroot('js/vendor/lightbox/css/lightbox.css') ?>" rel="stylesheet">

    <!-- Data tables -->
    <link href="<?= Router::webroot('js/vendor/datatables/datatables.css') ?>" rel="stylesheet">
    <!-- jquery -->
    <script src="<?= Router::webroot('js/vendor/jquery/jquery.js') ?>"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- affiche les info de la flach -->
        <div aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <?php echo $this->Session->flash(); ?>
            <?php echo $content_for_theme; ?>
        </div>



        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; My Website 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->





    <!-- Bootstrap core JavaScript-->
    <script src="<?= Router::webroot('theme/admin/sb-admin/jquery.min.js') ?>"></script>
    <script src="<?= Router::webroot('theme/admin/sb-admin/bootstrap/js/bootstrap.bundle.min.js ') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= Router::webroot('theme/admin/sb-admin/jquery-easing/jquery.easing.min.js ') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= Router::webroot('theme/admin/sb-admin/sb-admin-2.min.js') ?>"></script>

    <!-- Page level plugins -->
    <script src="<?= Router::webroot('js/vendor/chartjs/Chart.min.js') ?>"></script>
    <script type="text/javascript" src="<?= Router::webroot('js/vendor/tinymce/tinymce.min.js') ?> "></script>
    <script type="text/javascript" src="<?= Router::webroot('js/vendor/tinymce/integration.js') ?>"></script>
    <script type="text/javascript" src="<?= Router::webroot('js/vendor/slim-select/slimselect.js') ?>"></script>
    <!-- data tables -->
    <script type="text/javascript" src="<?= Router::webroot('js/vendor/datatables/datatables.js') ?>"></script>
    <!-- lightbox -->
    <script type="text/javascript" src="<?= Router::webroot('js/vendor/lightbox/js/lightbox.js') ?>"></script>
    <!-- tooljs -->
    <script src="<?= Router::webroot('js/vendor/jquery/MyAjax.js') ?>"></script>




</body>

</html>
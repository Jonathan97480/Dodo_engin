<?php
$user = $_SESSION['User'];


?>

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

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo Router::url(conf::$admin_prefixe); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Administration</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo Router::url('systeme/admin_index'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tableau de bord</span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                <i class="fas fa-tools"></i>
                Générale
            </div>


            <li class="nav-item">
                <a class="nav-link " href="<?= Router::url(''); ?>" aria-expanded="true">
                    <i class="fas fa-globe-europe"></i>
                    <span>Retour au site</span>
                </a>
                <a class="nav-link " href="<?= Router::url('admin/systeme/infoGenerale') ?>" aria-expanded="true">
                    <i class="far fa-address-card"></i>
                    <span>Identité du site</span>
                </a>
                <a class="nav-link " href="<?= Router::url('systeme/admin_rgpd') ?>" aria-expanded="true">
                    <i class="fas fa-crosshairs"></i>
                    <span>Mentions l'egales & RGPD</span>
                </a>
                <a class="nav-link " href="<?= Router::url('admin/posts/settings/value:email') ?>" aria-expanded="true">
                    <i class="fas fa-mail-bulk"></i>
                    <span>Gestion des email</span>
                </a>
                <a class="nav-link " href="<?= Router::url('systeme/admin_message') ?>" aria-expanded="true">
                    <i class="fas fa-envelope"></i>

                    <span>Message<span class="badge badge-danger m-span notif-m"></span></span>

                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <i class="fas fa-edit"></i>
                Édition
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link " href="<?php echo Router::url('systeme/admin_post_index') ?>" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-newspaper"></i>
                    <span>Post</span>
                </a>

                <a class="nav-link " href="<?php echo Router::url('systeme/admin_tag_list'); ?>" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-tags"></i>
                    <span>Liste Des Tag</span>
                </a>
                <a class="nav-link " href="<?php echo Router::url('systeme/admin_categorie_list'); ?>" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-tags"></i>
                    <span>Liste Des Catégories</span>
                </a>

                <a class="nav-link " href="<?php echo Router::url('admin/medias/galerie'); ?>" aria-expanded="true" aria-controls="collapsePages">
                    <i class="far fa-images"></i>
                    <span>Galerie d'images</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                <i class="fas fa-users-cog"></i>
                Utilisateurs
            </div>
            <!-- Nav Item - Posts Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo Router::url('systeme/admin_users_list'); ?>" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-users"></i>
                    <span>Liste des utilisateurs</span>
                </a>
                <a class="nav-link collapsed" href="<?php echo Router::url('systeme/admin_add_user'); ?>" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-user"></i>
                    <span>ajouter un utilisateur</span>
                </a>
                <a class="nav-link collapsed" href="<?php echo Router::url('systeme/admin_roles_list'); ?>" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-user-tag"></i>
                    <span>Liste des roles</span>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">




                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter notif-m"></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header" id="">
                                    Centre Des Messages
                                </h6>
                                <small style="display: none;" id="notif-id"></small>

                                <a class="dropdown-item text-center small text-gray-500" href="<?= Router::url('systeme/admin_message') ?>">Lire plus de messages</a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user->login ?> </span>
                                <img class="img-profile rounded-circle" src="<?php echo Router::webroot('img/' . $user->avatar)  ?>">
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo Router::url('systeme/admin_add_user/id:' . $user->id) ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo Router::url('users/logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnection
                                </a>
                            </div>
                        </li>


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- affiche les info de la flach -->

                    <?php echo $this->Session->flash(); ?>
                    <?php echo $content_for_theme; ?>


                    <!-- Content Row -->

                    <div class="row">



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

            </div>
            <!-- End of Page Wrapper -->




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

<style>
    .m-span {
        margin-left: 5px;
    }
</style>
<script>
    let baseUrl = <?= Router::webroot('') ?>;
    let notif = document.getElementById('notif-id');

    $(function() {


        let tool = new toolJs();

        tool.postAjax(baseUrl + 'systeme/getNewMessage', null, (data) => {

            var results = data['results'];

            console.log(results)

            for (let index = 0; index < results['info'].length; index++) {

                const element = results['info'][index];
                var myLink = document.createElement('a');
                myLink.setAttribute('class', 'dropdown-item d-flex align-items-center');
                myLink.setAttribute('href', baseUrl + 'systeme/admin_message/id:' + element['id'])

                let message = '';
                message += '              <div class="dropdown-list-image mr-3">';
                message += '                 <img class="rounded-circle" src="' + baseUrl + 'webroot/img/avatar/img_603a29e434bc0.png' + '" alt="">';
                message += '              </div>';
                message += '              <div class="font-weight-bold">';
                message += '                <div class="text-truncate">' + element['objet_message'] + '</div>';
                message += '                    <div class="small text-gray-500">' + element['date'] + '</div>';
                message += '             </div>';

                myLink.innerHTML = message;

                notif.before(myLink);

            }

            var notifCount = document.getElementsByClassName('notif-m');
            console.log(notifCount);
            if (results['count'] > 0) {

                for (let index = 0; index < notifCount.length; index++) {

                    const element = notifCount[index];

                    element.innerHTML = '' + results['count'];

                }
            } else {
                for (let index = 0; index < notifCount.length; index++) {

                    const element = notifCount[index];

                    element.setAttribute('class', '');

                }
            }

        });
    });
</script>
<?php
    ini_set('display_errors', 'On');
    ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Como lo quieras llamar</title>

    <!-- Custom fonts for this template-->
    <link href="views/assets/StartBoots/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="views/assets/StartBoots/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="views/assets/vendor/alertify/alertify.core.css">
    <link rel="stylesheet" href="views/assets/vendor/alertify/alertify.default.css">
    <link rel="stylesheet" href="views/assets/vendor/sweetalert/sweetalert.css">
    <link rel="icon" href="views/assets/img/theme/lOGO_2_GRANDE.jpg" type="image/jpg">
</head>

<body id="page-top sidebar-toggled">
    <script src="views/assets/StartBoots/vendor/jquery/jquery.min.js"></script>
    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php
        include 'modulos/menu.php';
echo '
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">';

        include 'modulos/nav.php';
        echo '
          <!-- Begin Page Content -->
          <div class="container-fluid">';

        if(isset($_GET['ruta'])){
            switch ($_GET['ruta']) {
                case 'dashboard':
                    include "modulos/dashboard/index.php";
                    echo "<script>$('#inicio').addClass('active');</script>";
                    break;

                case 'carpetas':
                    include "modulos/carpetas/index.php";
                    echo "<script>$('#inicio').addClass('active');</script>";
                    break;

                case 'salir':
                    include "modulos/salir.php";
                    break;
            }
        }else{
            include "modulos/dashboard/index.php";
            echo "<script>$('#inicio').addClass('active');</script>";
        }
    ?>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; MyWorky 2021</span>
                </div>
            </div>
        </footer>
      <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- hASTA Aqui -->
    
    <!-- Bootstrap core JavaScript-->
    
    <script src="views/assets/StartBoots/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="views/assets/StartBoots/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="views/assets/StartBoots/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="views/assets/StartBoots/vendor/chart.js/Chart.min.js"></script>

    <script src="views/assets/vendor/blockui/blockUI.js"></script>

    <script src="views/assets/vendor/alertify/alertify.min.js"></script>

    <script src="views/assets/vendor/sweetalert/sweetalert.min.js"></script>
</body>

</html>
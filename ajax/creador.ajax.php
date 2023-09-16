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

    <title>GeneradorSosKy</title>

    <!-- Custom fonts for this template-->
    <link href="../views/assets/StartBoots/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../views/assets/StartBoots/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/assets/vendor/alertify/alertify.core.css">
    <link rel="stylesheet" href="../views/assets/vendor/alertify/alertify.default.css">
    <link rel="stylesheet" href="../views/assets/vendor/sweetalert/sweetalert.css">
    <link rel="icon" href="../views/assets/img/theme/lOGO_2_GRANDE.jpg" type="image/jpg">
</head>

<body id="page-top sidebar-toggled">
    <script src="../views/assets/StartBoots/vendor/jquery/jquery.min.js"></script>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <form action="generador.ajax.php" method="post" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Datos Para Generar</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label>Nombre del Archivo</label>
                                            <input type="text" name="txtNombreArchivo" id="txtNombreArchivo" placeholder="Nombre del Archivo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label>Singular</label>
                                            <input type="text" name="txtNombreSingular" id="txtNombreSingular" placeholder="Singular" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label>Plural</label>
                                            <input type="text" name="txtNombrePlural" id="txtNombrePlural" placeholder="Plural" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label>Nombre AJAX</label>
                                            <input type="text" name="txtNombreAjax" id="txtNombreAjax" placeholder="Nombre AJAX" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label>Campo a mostrar en tabla 1</label>
                                            <input type="text" name="txtNombreTabla1" id="txtNombreTabla1" placeholder="Campo a mostrar en tabla 1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label>Campo a mostrar en tabla 2</label>
                                            <input type="text" name="txtNombreTabla2" id="txtNombreTabla2" placeholder="Campo a mostrar en tabla 2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label>Campo a mostrar en tabla 3</label>
                                            <input type="text" name="txtNombreTabla3" id="txtNombreTabla3" placeholder="Campo a mostrar en tabla 3" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label>Campo a mostrar en tabla 4</label>
                                            <input type="text" name="txtNombreTabla4" id="txtNombreTabla4" placeholder="Campo a mostrar en tabla 4" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div id="ocultoPorLaLuna">
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <button type="submit" class="btn btn-primary btn-block">Generar</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <button type="button" id="btnGenerarMas" class="btn btn-primary btn-block">Agregar</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <input type="text" name="txtIdTabla" id="txtIdTabla" placeholder="ID Tabla" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.container-fluid -->
            </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Mythology Systems 2021</span>
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
    
    <script src="../views/assets/StartBoots/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../views/assets/StartBoots/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../views/assets/StartBoots/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../views/assets/StartBoots/vendor/chart.js/Chart.min.js"></script>

    <script src="../views/assets/vendor/blockui/blockUI.js"></script>

    <script src="../views/assets/vendor/alertify/alertify.min.js"></script>

    <script src="../views/assets/vendor/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript">
        var contador = 0;
        $(function(){
            $("#btnGenerarMas").click(function(){
                var contenedor = '<div class="row">'+
                                    '<div class="col-md-2">'+
                                        '<div class="form-group"> '+
                                            '<label>Nombre Campo Form</label>'+
                                            '<input type="text" name="txtNombreCampo'+contador+'" id="txtNombreCampo'+contador+'" placeholder="Nombre Campo Form" class="form-control">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-2">'+
                                        '<div class="form-group"> '+
                                            '<label>Tabla Campo</label>'+
                                            '<input type="text" name="txtTablaCampo'+contador+'" id="txtTablaCampo'+contador+'" placeholder="Tabla Campo" class="form-control">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-2">'+
                                        '<div class="form-group"> '+
                                            '<label>Tipo Campo</label>'+
                                            '<select name="txtTipoCampo'+contador+'" id="txtTipoCampo'+contador+'" placeholder="Tipo Campo" class="form-control">'+
                                                '<option value="TEXT">TEXT</option>'+
                                                '<option value="SELECT">SELECT</option>'+
                                                '<option value="TEXTAREA">TEXTAREA</option>'+
                                            '</select>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-2">'+
                                        '<div class="form-group"> '+
                                            '<label>Tabla que Muestra</label>'+
                                            '<input type="text" name="txtTablaMuestra'+contador+'" id="txtTablaMuestra'+contador+'" placeholder="Tabla que Muestra" class="form-control">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-2">'+
                                        '<div class="form-group"> '+
                                            '<label>ID Tabla</label>'+
                                            '<input type="text" name="txtTablaID'+contador+'" id="txtTablaID'+contador+'" placeholder="ID Tabla" class="form-control">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-2">'+
                                        '<div class="form-group"> '+
                                            '<label>Desc Tabla</label>'+
                                            '<input type="text" name="txtTablaDesc'+contador+'" id="txtTablaDesc'+contador+'" placeholder="Desc Tabla" class="form-control">'+
                                        '</div>'+
                                    '</div>'+
                               '</div>';
                $("#ocultoPorLaLuna").append(contenedor);
                contador++;
            })
        })
    </script>
</body>

</html>
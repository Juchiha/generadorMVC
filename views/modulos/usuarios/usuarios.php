<?php
    $fecha_actual = "01-".date("m-Y");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuarios / Bienvenido <?php echo $_SESSION['nombres']; ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-users"></i> Usuarios</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <input type="hidden" name="faltante" id="faltante" value="<?php echo date("d/m/Y",strtotime($fecha_actual."+ 1 month"));?> 00:00 AM">
        <div class="box box-solid box-primary">
                    <div class="box-header box-with-title">
                        <h3 class="box-title">Usuarios registrados en el sistema</h3>
                        <div class="tools pull-right" >
                            <a href="index.php?exportar=si" class="btn btn-success btn-sm" title="exportar a Excel" type="button">
                                <i class="fa fa-file-excel-o"></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <table id="tablaPagos" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px;">#</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Estado</th>
                                            <th>U. Login</th> 
                       
                                            <th>Pais</th>
                                            <th>Ciudad</th>
                                            <th style="width: 15%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
    $strCampos__ ='user_id_i, user_nombre_v, user_correo_v, user_estado_v, user_ultimo_login_d, user_ultimo_navegador_v, user_wallet_v';
    $strTablas__ = " go_users ";
    $strWhere___ = " user_estado_v = 'ACTIVADO' ";
										//echo "SELECT ".$strCampos__." FROM ".$strTablas__;
    $arrayRespue = ModeloDAO::mdlMostrarGroupAndOrder($strCampos__,$strTablas__,$strWhere___, null, "ORDER BY user_nombre_v DESC");
   // print_r($arrayRespue);
    foreach ($arrayRespue as $key => $value) {

    echo '<tr>';
    echo '<td>'.($key+1).'</td>
    <td>'.$value['user_nombre_v'].'</td>
    <td>'.$value['user_correo_v'].'</td>
    <td>'.$value['user_estado_v'].'</td>
    <td>'.$value['user_ultimo_login_d'].'</td>
    <td></td>
    <td></td>';
    echo '<td style="text-align:center;">';
    echo '&nbsp;<button title="Delete User" class="btn btn-danger btnEliminarArchivo" idUser="'.$value["user_id_i"].'"><i class="fa fa-times"></i></button>';
    echo '</td>';
    echo '</tr>';
    }
                            ?>
                            
                            </tbody>
                            <tfoot>
                                <tr>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Estado</th>
                                        <th>U. Login</th>
                                 
                                        <th>Pais</th>
                                        <th>Ciudad</th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                </tr>
                            </tfoot>
                        </table>  
                    </div>
                </div>
    </section>
</div>

<script type="text/javascript">
    $(function(){
        $('#tablaPagos').DataTable();

        $('#tablaPagos tbody').on("click", ".btnEditarArchivo", function(){
            var x = $(this).attr('idTransfer');
            swal({
                title: '¿Are you sure to release this payment?',
                text: "¡If it is not, you can cancel the action!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Close',
                confirmButtonText: 'Yes, release this payment'
            },function(isConfirm) {
                if (isConfirm) {
                    window.location = "index.php?ruta=buy&idTransfer="+x+"&release=true" ;
                }
            });
        });

        /* Eliminar Solicitud */
        $('#tablaPagos tbody').on("click", ".btnEliminarArchivo", function(){
            var x = $(this).attr('idUser');
            swal({
                title: '¿Are you sure to delete this user?',
                text: "¡If it is not, you can cancel the action!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Close',
                confirmButtonText: 'Yes, delete the user'
            },function(isConfirm) {
                if (isConfirm) {
                    window.location = "index.php?ruta=users&idUser="+x ;
                }
            })
        });

    });
</script>
<?php
    $usuarios = new ControladorPlantilla();
    $usuarios->deleteUsers();
?>
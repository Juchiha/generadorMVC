<?php
    
    /*Validamso que el tipo pagara*/
    $strCampos = "user_pago_v, user_fecha_ultimo_pago";
    $strTablas = "go_users";
    $strWhere_ = "user_id_i = ".$_SESSION['codigo'];
    
    $arrayRepuesta = ModeloDAO::mdlMostrarUnitario($strCampos, $strTablas, $strWhere_);
?>


<style type="text/css">
    .info-box{
        cursor: pointer;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inicio / Bienvenido <?php echo $_SESSION['nombres']; ?> 
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <?php if($arrayRepuesta['user_fecha_ultimo_pago'] != null || $arrayRepuesta['user_fecha_ultimo_pago'] != '' ){ 
                $fecha_actual = $arrayRepuesta['user_fecha_ultimo_pago'];
            ?>
            <?php } ?>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <input type="hidden" name="faltante" id="faltante" value="<?php echo date("m/d/Y",strtotime($fecha_actual."+ 21 days"));?> 00:00 AM">
        <?php
            /*Valor de la moneda*/
            $strCampo = "conf_valor_gocoin_usd_v, conf_wallet_bitcoin_pago_v";
            $strTabla = "go_configuracion";
            $arrGocoi = ModeloDAO::mdlMostrarUnitario($strCampo,$strTabla,"");
        ?>
        <div class="row">
            <div class="col-lg-3">
                <div class="info-box">
                    <?php if($arrayRepuesta['user_pago_v'] == 0) { ?>
                    <span class="info-box-icon bg-red">
                    <i class="fa fa-thumbs-o-down"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Estado</span>
                        <span class="info-box-number">
                            No activado
                        </span>
                    </div>
                    <?php }else{ ?>
                    <span class="info-box-icon bg-green">
                    <i class="fa fa-thumbs-o-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Estado</span>
                        <span class="info-box-number">
                            Activado
                        </span>
                    </div>
                    <?php }?>
                    <!-- /.info-box-content -->
                </div>

                <!-- /.info-box -->
                <div class="info-box">
                    <span class="info-box-icon bg-green">
                        <i class="fa fa-dollar"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Saldo Actual</span>
                        <?php 
                            $valor_Plata = 0;
                            $boolPuedeRetirar = false;
                            $intNumberRef = ControladorPlantilla::getNumberReferidos($_SESSION['codigo']); 
                            if($intNumberRef > 0){
                                /*Tiene Referidos*/ 
                                $arrReferidosDirectos = ControladorPlantilla::getReferidos($_SESSION['codigo']);
                                $i = 0;
                                foreach ($arrReferidosDirectos as $key => $value) {   
                                    /*Aqui vamos sacando los referidos mios y preguntamos si tienene referidos y si tienen minimo 2 vamos sumando plata*/
                                    $referidos = ControladorPlantilla::getNumberReferidos($value['user_id_i']);
                                    if($referidos > 1){
                                        $valor_Plata += $referidos * 1000;
                                        $boolPuedeRetirar = true;
                                    }else{
                                        $valor_Plata += $referidos * 1000;
                                    }
                                }
                            }
                        ?>
                        <span class="info-box-number"><?php echo number_format($valor_Plata, 0);?> USD</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                <!-- /.info-box -->
                <div class="info-box">
                    <span class="info-box-icon bg-blue">
                        <i class="fa fa-dollar"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Valor de Membrecia</span>
                        <span class="info-box-number">1,100 USD</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                <!-- /.info-box -->
                <div class="info-box">
                    <span class="info-box-icon bg-yellow">
                        <i class="ion ion-ios-people-outline"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Referidos</span>
                        <span class="info-box-number">
                            <?php 
                                $saldo = ControladorPlantilla::getNumberReferidos($_SESSION['codigo']); 
                                echo $saldo;
                            ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
             
            </div>
            <div class="col-lg-9 col-xs-12">
                <div class="box box-solid box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Información de mi cuenta
                        </h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="text-align:center;">Link Referidos</th>
                                    <th style="text-align:center;">
                                       <a href="<?php echo $_SESSION['user_url_referidos_v'];?>" target="_blank"><?php echo $_SESSION['user_url_referidos_v'];?></a>
                                        &nbsp;&nbsp;

                                        <!--<a class="btn btn-default btn-xs pull-right" target='_blank' href='http://twitter.com/share?url=<?php echo $_SESSION['user_url_referidos_v'];?>&text="Ingresa a mi comunidad en K21"' alt="Compartir en Twitter"><i class="fa fa-twitter"></i></a>-->
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">Referidos</th>
                                    <td style="text-align:center;">
                                        <?php 
                                            $saldo = ControladorPlantilla::getNumberReferidos($_SESSION['codigo']); 
                                            echo $saldo;
                                        ?>
                                    </td >
                                </tr>
                                
                                <tr>
                                    <th style="text-align:center;">Ultimo login</th>
                                    <td style="text-align:center;"><?php echo $_SESSION['ultimaSession']." / ".$_SESSION['browser']; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">Correo</th>
                                    <td style="text-align:center;"><?php echo $_SESSION['correo'];?></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;">
                                        <?php if($arrayRepuesta['user_fecha_ultimo_pago'] != null || $arrayRepuesta['user_fecha_ultimo_pago'] != '' ){ 
            ?>
                                        <span id="contadorAtras"></span>
            <?php } ?>
                                    </th>                          
                                    <td>
                                        <?php 
                                            if($arrayRepuesta['user_pago_v'] == 0) { 
                                                echo "<button class='btn btn-danger btn-block' id='btnCallFormPagos' type='button' data-toggle=\"modal\" data-target=\"#ModalActivarseBitCoins\" ><i class='fa fa-thumbs-o-up'></i>&nbsp;Activarse</button>";
                                            }else{
                                                /*Aqui va lo delos retiros*/
                                                if($boolPuedeRetirar){
                                                    echo "<button class='btn btn-info btn-block' type=\"button\" ><i class='fa fa-btc'></i>&nbsp;Puedes Retirar</button>";
                                                }else{
                                                    echo "<button class='btn btn-success btn-block' type=\"button\" ><i class='fa fa-thumbs-o-up'></i>&nbsp;Estas Activo</button>";    
                                                }
                                                
                                            }
                                        ?>
                                    </td>
                                </tr>    
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>
        
    </section>
</div>


<div id="ModalActivarseBitCoins" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" id="title_opciones_avanzadas" style="background: #00a65a;color: white;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="nombre_campo_h4">Activarse en el sistema</h4>
            </div>
            <form method="post" id="envioPagos" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Total membrecía</label>
                        <div class="input-group">
                            <input type="text" name="txtTotalCoins" required id="txtTotalCoins" readonly value="<?php echo $arrGocoi['conf_valor_gocoin_usd_v'];?>" class="form-control" placeholder="Amount of coins">
                            <span class="input-group-addon">USD</span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label>Valor Bitcoins</label>
                        <div class="input-group">
                        <input type="text" name="amount" required readonly="true" id="amount" class="form-control" placeholder="Price">
                            <span class="input-group-addon">BTC</span>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Billetera donde enviar los Bitcoins</label>
                                <input type="text" required="true" readonly="true" name="txtWalletToSend" id="txtWalletToSendPay" class="form-control" placeholder="Wallet to send Bitcoins" value="<?php echo $arrGocoi['conf_wallet_bitcoin_pago_v'];?>">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <img id="codigoQrLoad" src="" style="width: 100%; display: none;">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Copiar link de pago</label>
                                <input type="text" name="txtEvidence" required id="txtEvidencePay" class="form-control" placeholder="Copiar link de pago">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>
                                Una vez que se realiza el pago, adjunte la referencia de pago para validar y activar su membrecía
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="SavePassword">Enviar</button>
                </div>
                <?php 
                    $pagos = new ControladorPlantilla();
                    $pagos->buyGocoinsByBitcoin();
                ?>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
</div>

<?php
    function getUrlShort($id){
        $server = 'https';
         
        $longUrl = $server.'://'.$_SERVER['SERVER_NAME'].'/index.php?ruta=registro&rf='.base64_encode($id);

        $ch = curl_init();
        // set url
        curl_setopt($ch, CURLOPT_URL, "https://api-ssl.bitly.com/v3/shorten?access_token=97e4185f3823d380d27239ac1afd3150d2bf5771&longUrl=".urlencode($longUrl));
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        // $output contains the output string
        $output = curl_exec($ch);
        // close curl resource to free up system resources
        curl_close($ch);  
        $json = json_decode($output);
        return $json->data->url;
    }
?>
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
            Inicio / Bienvenido <?php echo $_SESSION['nombres'];?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-clock-o"></i> Inicio</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
       

        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="box box-solid box-primary">
                    <div class="box-header box-with-title">
                        <h3 class="box-title">Account Movements</h3>
                        <div class="tools pull-right" >
                            <a href="#" title="Add Movements">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Monto</th>
                                            <th>Tipo</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                              
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xs-12">
                <div class="box box-solid box-primary">
                    <div class="box-header box-with-title">
                        <h3 class="box-title">Account Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-9 col-xs-8">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <th>User ID</th>
                                        <td><?php echo $_SESSION['codigo'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Sessions</th>
                                        <td><?php echo $_SESSION['ultimaSession']." / ".$_SESSION['browser']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo $_SESSION['nombres'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $_SESSION['correo'];?></td>
                                    </tr>
                                </table>  
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <br/>
                                <img src="<?php echo $_SESSION['imagen'];?>" class="user-image" style="width: 100%;">
                            </div>
                        </div>
                              
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>


<div id="ModalComprarCoins" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" id="title_opciones_avanzadas" style="background: #367fa9;color: white;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="nombre_campo_h4">Buy GoCoins</h4>
            </div>
            <form method="post" id="envioPagos">

                <input name="merchantId"    type="hidden"  value="508029"   >
                <input name="accountId"     type="hidden"  value="512321" >
                <input name="description"   type="hidden"  value="Buy of GoCoins" >
                <input name="referenceCode" id="referenceCode" type="hidden"  value="VentaDeGocoins-<?php echo time();?>" >
                <input name="tax"           type="hidden"  value="0"  >
                <input name="currency"      type="hidden"  value="USD" >
                <input name="signature"     id="signature" type="hidden"  value="">
                <input name="test"          type="hidden"  value="1" >
                <input name="buyerEmail"    type="hidden"  value="<?php echo $_SESSION['correo']; ?>" >
                <input name="responseUrl"   type="hidden"  value="http://platform.gocoin.com.co/index.php" >
                <input name="confirmationUrl" type="hidden"  value="http://platform.gocoin.com.co/index.php" >
                <div class="modal-body">
                    <div class="form-group">
                        <label>Amount of coins</label>
                        <input type="text" name="txtTotalCoins" required id="txtTotalCoins" class="form-control" placeholder="Amount of coins">
                    </div>
                    <div class="form-group">
                        <label>Price USD</label>
                        <input type="text" name="amount" required readonly="true" id="amount" class="form-control" placeholder="Price">
                    </div>
                    <input id="taxReturnBase" name="taxReturnBase" type="hidden"  value="0" >
                    <div class="form-group">
                        <div class="radio">
                            <label>
                                <input type="radio" name="optPagos" id="pagoPayu" value="payu">
                                Pay with PaYu
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optPagos" id="pagoBitcoins" value="Bitcoin">
                                Pay with Bitcoin
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="SavePassword">Buy</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
</div>


<?php
    $plantilla = new ControladorPlantilla();
    $plantilla->getEstateTransaction();
?>
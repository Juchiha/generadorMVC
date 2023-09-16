<?php
	if(isset($_POST['txtNombreArchivo'])){
		$ruta = "../views/modulos/".$_POST['txtNombreSingular'];
		if (!file_exists($ruta)) {
            mkdir($ruta, 0755);
        }

		$archivo = fopen($ruta.'/'.$_POST['txtNombreArchivo'].".php", "w+b");
	    if( $archivo == false ){
	      	echo "Error al crear el archivo";
	    }
	    else
	    {

	    	$camposInsertar = '';
	    	$camposEditar = '';
	    	$camposJson = '';
	    	for($i = 0; $i < 20; $i++ ){
	    		if(isset($_POST['txtNombreCampo'.$i]) && $_POST['txtNombreCampo'.$i] != ''){
	    			/*vienen campos*/
	    			switch($_POST['txtTipoCampo'.$i]){
	    				case 'TEXT':
		    				$camposInsertar .=  '
		    				<div class="form-group"> 
                                <label>'.$_POST['txtNombreCampo'.$i].'</label>
                                <input type="text" name="'.$_POST['txtTablaCampo'.$i].'_i" id="'.$_POST['txtTablaCampo'.$i].'_i" placeholder="'.$_POST['txtNombreCampo'.$i].'" class="form-control">
                            </div>';
	                        $camposEditar .=  '
	                        <div class="form-group"> 
                                <label>'.$_POST['txtNombreCampo'.$i].'</label>
                                <input type="text" name="'.$_POST['txtTablaCampo'.$i].'_e" id="'.$_POST['txtTablaCampo'.$i].'_e" placeholder="'.$_POST['txtNombreCampo'.$i].'" class="form-control">
                            </div>';
                            $camposJson .= '
                            $("#'.$_POST['txtTablaCampo'.$i].'_e").val(data.'.$_POST['txtTablaCampo'.$i].');
                            ';
	    				break;

	    				case 'SELECT':
	    					$camposInsertar .=  '
	    					<div class="form-group">
                                <label>'.$_POST['txtNombreCampo'.$i].'</label>
                                <select name="'.$_POST['txtTablaCampo'.$i].'_i" id="'.$_POST['txtTablaCampo'.$i].'_i" placeholder="'.$_POST['txtNombreCampo'.$i].'" class="form-control">
                                	<option value="0">Seleccione una opción</option>
                                	<?php 
										$bancos = ControladorUtilidades::getData(\''.$_POST['txtTablaMuestra'.$i].'\', null, null);
										foreach($bancos as $key => $value){
											echo \'<option value="\'.$value[\''.$_POST['txtTablaID'.$i].'\'].\'">\'.$value[\''.$_POST['txtTablaDesc'.$i].'\'].\'</option>\';
										}
									?>
                                </select>
                            </div>';
                        	$camposEditar .=  '
                        	<div class="form-group"> 
                                <label>'.$_POST['txtNombreCampo'.$i].'</label>
                                <select name="'.$_POST['txtTablaCampo'.$i].'_e" id="'.$_POST['txtTablaCampo'.$i].'_e" placeholder="'.$_POST['txtNombreCampo'.$i].'" class="form-control">
                                	<option value="0">Seleccione una opción</option>
                                	<?php 
										$bancos = ControladorUtilidades::getData(\''.$_POST['txtTablaMuestra'.$i].'\', null, null);
										foreach($bancos as $key => $value){
											echo \'<option value="\'.$value[\''.$_POST['txtTablaID'.$i].'\'].\'">\'.$value[\''.$_POST['txtTablaDesc'.$i].'\'].\'</option>\';
										}
									?>
                                </select>
                            </div>';

                            $camposJson .= '
                            $("#'.$_POST['txtTablaCampo'.$i].'_e").val(data.'.$_POST['txtTablaCampo'.$i].').change();
                            ';

	    				break;

	    				case 'TEXTAREA':
	    					$camposInsertar .=  '
	    					<div class="form-group">
                                <label>'.$_POST['txtNombreCampo'.$i].'</label>
                                <textarea name="'.$_POST['txtTablaCampo'.$i].'_i" id="'.$_POST['txtTablaCampo'.$i].'_i" placeholder="'.$_POST['txtNombreCampo'.$i].'" class="form-control"></textarea>
                            </div>';
                        	$camposEditar .=  '
                        	<div class="form-group"> 
                                <label>'.$_POST['txtNombreCampo'.$i].'</label>
                                <textarea name="'.$_POST['txtTablaCampo'.$i].'_e" id="'.$_POST['txtTablaCampo'.$i].'_e" placeholder="'.$_POST['txtNombreCampo'.$i].'" class="form-control"></textarea>
                            </div>';

                            $camposJson .= '
                            $("#'.$_POST['txtTablaCampo'.$i].'_e").val(data.'.$_POST['txtTablaCampo'.$i].');
                            ';

	    				break;
	    			}
	    		}
	    	}

	    	$contenido = '
<!-- Page Heading -->
<link href="views/assets/StartBoots/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  	<h1 class="h3 mb-0 text-gray-800">'.mb_strtoupper($_POST['txtNombrePlural']).'</h1>
  	<?php 
  		if ($_SESSION["perf_add_i"]==1) {	
  	?>
  	<button class="btn btn-circle btn-default dropdown no-arrow" title="Opciones" 
  		data-toggle="dropdown" 
  		aria-haspopup="true" 
  		aria-expanded="true">
  		<i class="fas fa-ellipsis-v"></i>
  	</button>
  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalIngresar'.$_POST['txtNombrePlural'].'">
        	Ingresar '.$_POST['txtNombreSingular'].'
    	</a>
    </div>
    <?php 
		}
	?>
</div>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">INFORMACIÓN - '.mb_strtoupper($_POST['txtNombrePlural']).'</h6>
        </div>
        <div class="card-body">
        	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>'.$_POST['txtNombreTabla1'].'</th>
                        <th>'.$_POST['txtNombreTabla2'].'</th>
                        <th>'.$_POST['txtNombreTabla3'].'</th>
                        <th>'.$_POST['txtNombreTabla4'].'</th>
                        <th ></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                     	<th >'.$_POST['txtNombreTabla1'].'</th>
                        <th >'.$_POST['txtNombreTabla2'].'</th>
                        <th >'.$_POST['txtNombreTabla3'].'</th>
                        <th >'.$_POST['txtNombreTabla4'].'</th>
                        <th ></th>
                    </tr>
                   
                </tfoot>
           	</table>
        </div>
    </div>
</div>


<!-- Creacion de '.$_POST['txtNombrePlural'].' -->
<div class="modal" tabindex="-1" role="dialog" id="modalIngresar'.$_POST['txtNombrePlural'].'">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form id="nuevoCliente" autocomplete="off" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Nuevo '.$_POST['txtNombreSingular'].'</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				  	<div class="card shadow mb-4">
				        <div class="card-header py-3">
				            <h6 class="m-0 font-weight-bold text-primary">Datos del '.$_POST['txtNombreSingular'].'</h6>
				        </div>
        				<div class="card-body">
							'.$camposInsertar.'
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="insertR" value="1">
					<button type="button" class="btn btn-primary" id="enviarFormNuevo">Guardar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</form>
		</div>
	</div>
</div>
					

<!--edicion de '.$_POST['txtNombrePlural'].'-->

<div class="modal" tabindex="-1" role="dialog" id="modalEditar'.$_POST['txtNombrePlural'].'">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form id="editarCliente" autocomplete="off" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Editar '.$_POST['txtNombreSingular'].'</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				  	<div class="card shadow mb-4">
				        <div class="card-header py-3">
				            <h6 class="m-0 font-weight-bold text-primary">Datos del '.$_POST['txtNombreSingular'].'</h6>
				        </div>
        				<div class="card-body">
							'.$camposEditar.'
						</div>
					</div>	
				</div>
				<div class="modal-footer">
					<input type="hidden" name="'.$_POST['txtIdTabla'].'_e" id="'.$_POST['txtIdTabla'].'_e" value="0">
					<input type="hidden" name="editarR" value="1">
					<button type="button" class="btn btn-primary" id="btnActualizar'.$_POST['txtNombrePlural'].'">Guardar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- Page level plugins -->
<script src="views/assets/StartBoots/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="views/assets/StartBoots/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
	'.$_POST['txtNombrePlural'].' = {
		insert'.$_POST['txtNombrePlural'].':function(dataTableEmpresas){
			var FormInsert = new FormData($("#nuevoCliente")[0]);
	        $.ajax({
	            url: \'ajax/'.$_POST['txtNombreAjax'].'\',
	            type  : \'post\',
	            data: FormInsert,
	            dataType : \'json\',
	            cache: false,
	            contentType: false,
	            processData: false,
	            beforeSend:function(){
	                $.blockUI({ 
	                    message : \'<h3>Un momento por favor....</h3>\',
	                    baseZ: 2000,
	                    css: { 
	                        border: \'none\', 
	                        padding: \'1px\', 
	                        backgroundColor: \'#000\', 
	                        \'-webkit-border-radius\': \'10px\', 
	                        \'-moz-border-radius\': \'10px\', 
	                        opacity: .5, 
	                        color: \'#fff\' 
	                    } 
	                }); 
	            },
	            complete:function(){
	                $.unblockUI();
	            },
	            //una vez finalizado correctamente
	            success: function(data){
	                if(data.code == 0){
	                    alertify.error(\'Proceso terminado, \'+data.message);
	                }else{
	                    alertify.success(\'Proceso terminado, \'+data.message);
	                }
	                dataTableEmpresas.ajax.reload();
	                $("#nuevoCliente")[0].reset();
	                $("#modalIngresar'.$_POST['txtNombrePlural'].'").modal(\'hide\');
	            },
	            //si ha ocurrido un error
	            error: function(){
	                alertify.error(\'Error al realizar el proceso\');
	            }
	        });
		},

		update'.$_POST['txtNombrePlural'].':function(dataTableEmpresas){
			var FormUpdate = new FormData($("#editarCliente")[0]);
	        $.ajax({
	            url: \'ajax/'.$_POST['txtNombreAjax'].'\',
	            type  : \'post\',
	            data: FormUpdate,
	            dataType : \'json\',
	            cache: false,
	            contentType: false,
	            processData: false,
	            beforeSend:function(){
	                $.blockUI({ 
	                    message : \'<h3>Un momento por favor....</h3>\',
	                    baseZ: 2000,
	                    css: { 
	                        border: \'none\', 
	                        padding: \'1px\', 
	                        backgroundColor: \'#000\', 
	                        \'-webkit-border-radius\': \'10px\', 
	                        \'-moz-border-radius\': \'10px\', 
	                        opacity: .5, 
	                        color: \'#fff\' 
	                    } 
	                }); 
	            },
	            complete:function(){
	                $.unblockUI();
	            },
	            //una vez finalizado correctamente
	            success: function(data){
	                if(data.code == 0){
	                    alertify.error(\'Proceso terminado, \'+data.message);
	                }else{
	                    alertify.success(\'Proceso terminado, \'+data.message);
	                }
	                dataTableEmpresas.ajax.reload();
	                $("#editarCliente")[0].reset();
	                $("#modalEditar'.$_POST['txtNombrePlural'].'").modal(\'hide\');
	            },
	            //si ha ocurrido un error
	            error: function(){
	                alertify.error(\'Error al realizar el proceso\');
	            }
	        });
		},

		delete'.$_POST['txtNombrePlural'].':function(idBancos, dataTableEmpresas){
			$.ajax({
	            url: \'ajax/'.$_POST['txtNombreAjax'].'\',
	            type  : \'post\',
	            data: { eliminarR : idBancos},
	            dataType : \'json\',
	            beforeSend:function(){
	                $.blockUI({ 
	                    message : \'<h3>Un momento por favor....</h3>\',
	                    baseZ: 2000,
	                    css: { 
	                        border: \'none\', 
	                        padding: \'1px\', 
	                        backgroundColor: \'#000\', 
	                        \'-webkit-border-radius\': \'10px\', 
	                        \'-moz-border-radius\': \'10px\', 
	                        opacity: .5, 
	                        color: \'#fff\' 
	                    } 
	                }); 
	            },
	            complete:function(){
	                $.unblockUI();
	            },
	            //una vez finalizado correctamente
	            success: function(data){
	                if(data.code == 0){
	                    alertify.error(\'Proceso terminado, \'+data.message);
	                }else{
	                    alertify.success(\'Proceso terminado, \'+data.message);
	                }
	                dataTableEmpresas.ajax.reload();
	            },
	            //si ha ocurrido un error
	            error: function(){
	                alertify.error(\'Error al realizar el proceso\');
	            }
	        });
		},

		get'.$_POST['txtNombrePlural'].':function(idBancos){
			$.ajax({
	            url: \'ajax/'.$_POST['txtNombreAjax'].'\',
	            type  : \'post\',
	            dataType : \'json\',
	            data: { ID : idBancos, getDatos :  true},
	            beforeSend:function(){
	                $.blockUI({ 
	                    message : \'<h3>Un momento por favor....</h3>\',
	                    baseZ: 2000,
	                    css: { 
	                        border: \'none\', 
	                        padding: \'1px\', 
	                        backgroundColor: \'#000\', 
	                        \'-webkit-border-radius\': \'10px\', 
	                        \'-moz-border-radius\': \'10px\', 
	                        opacity: .5, 
	                        color: \'#fff\' 
	                    } 
	                });  
	            },
	            complete:function(){
	                $.unblockUI();
	            },
	            //una vez finalizado correctamente
	            success: function(data){
	            	if(data != false){
	            		'.$camposJson.'
	            		$("#'.$_POST['txtIdTabla'].'_e").val(data.'.$_POST['txtIdTabla'].');
	            	}
	            },
	            //si ha ocurrido un error
	            error: function(){
	                alertify.error(\'Error al realizar el proceso\');
	            }
	        });
		}
	}

	$(function(){

		let edicion = \'<div class="btn-group">\';
        edicion += \'<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">\';
        edicion += \'<i class="fa fa-info-circle"></i>\';
        edicion += \'<span class="sr-only">Toggle Dropdown</span>\';
        edicion += \'</button>\';
        edicion += \'<ul class="dropdown-menu" role="menu">\';
     	<?php 
  			if ($_SESSION[\'perf_upd_i\'] == 1) {		
  		?>
        edicion += \'<li><a class="dropdown-item btnActual'.$_POST['txtNombrePlural'].'" title="Editar" id_'.$_POST['txtNombreSingular'].' data-toggle="modal" data-target="#modalEditar'.$_POST['txtNombrePlural'].'" href="#">EDITAR</a></li>\';
        edicion += \'<li class="divider"></li>\';
        <?php
        	}
  			if ($_SESSION[\'perf_del_i\'] == 1) {	
  		?>
        edicion += \'<li><a class="dropdown-item btnEliminar'.$_POST['txtNombrePlural'].'" title="Eliminar" id_'.$_POST['txtNombreSingular'].' href="#">ELIMINAR</a></li>\';
        edicion += \'<li class="divider"></li>\';
        <?php
        	}
    	?>
     	edicion += \'</ul>\';
    	edicion += \'</div>\';

		var dataTableEmpresas = $(\'#dataTable\').DataTable({
		    "ajax": \'ajax/'.$_POST['txtNombreAjax'].'?allDatos=true\',
		    "columnDefs": [
		        {
	        	 	"targets": -1,
            		"data": null,
        			"className": "text-center",
            		 render: {
                		display: function (data, type, row) {
                         	return edicion;
                		}
                	}
		        }
	        ],
	    	"language" : {
		        "sProcessing":     "Procesando...",
		        "sLengthMenu":     "Mostrar _MENU_ registros",
		        "sZeroRecords":    "No se encontraron resultados",
		        "sEmptyTable":     "Ningún dato disponible en esta tabla",
		        "sInfo":           "Mostrando de _START_ a _END_ de _TOTAL_",
		        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		        "sInfoPostFix":    "",
		        "sSearch":         "Buscar:",
		        "sUrl":            "",
		        "sInfoThousands":  ",",
		        "sLoadingRecords": "Cargando...",
		        "oPaginate": {
		            "sFirst":    "Primero",
		            "sLast":     "Último",
		            "sNext":     "Siguiente",
		            "sPrevious": "Anterior"
		        },
		        "oAria": {
		            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		        }
		    }
		});

		$(\'#dataTable tbody\').on( \'click\', \'a\', function () {
		    var data = dataTableEmpresas.row( $(this).parents(\'tr\') ).data();
		    $(this).attr("id_'.$_POST['txtNombreSingular'].'", data[4]);
		});

		/* Esta parte es para traer los datos de la edicion */
	    $(\'#dataTable tbody\').on("click", ".btnActual'.$_POST['txtNombrePlural'].'", function(){
	        var x = $(this).attr(\'id_'.$_POST['txtNombreSingular'].'\');
	       	'.$_POST['txtNombrePlural'].'.get'.$_POST['txtNombrePlural'].'(x);
	    });

		/*Activar funcionalidad de boton eliminar*/
	    $(\'#dataTable tbody\').on("click", ".btnEliminar'.$_POST['txtNombrePlural'].'", function(){
	        var x = $(this).attr(\'id_'.$_POST['txtNombreSingular'].'\');
			swal({
	            title: \'¿Está seguro de borrar el '.$_POST['txtNombreSingular'].'?\',
	            text: "¡Si no lo está puede cancelar la accíón!",
	            type: \'warning\',
	            showCancelButton: true,
	            confirmButtonColor: \'#3085d6\',
	            cancelButtonColor: \'#d33\',
	            cancelButtonText: \'Cancelar\',
	            confirmButtonText: \'Si, Eliminar Registro!\'
	        },function(isConfirm) {
	            if (isConfirm) {
					'.$_POST['txtNombrePlural'].'.delete'.$_POST['txtNombrePlural'].'(x,dataTableEmpresas);
				}
			});			
	    });


		$("#enviarFormNuevo").click(function(){
			'.$_POST['txtNombrePlural'].'.insert'.$_POST['txtNombrePlural'].'(dataTableEmpresas);
		});

		$("#btnActualizar'.$_POST['txtNombrePlural'].'").click(function(){
			'.$_POST['txtNombrePlural'].'.update'.$_POST['txtNombrePlural'].'(dataTableEmpresas);
		});

	});
</script>';

			fwrite($archivo, $contenido);
			// Fuerza a que se escriban los datos pendientes en el buffer:
			fflush($archivo);
		}
		// Cerrar el archivo:
		fclose($archivo);
	}
	
?>
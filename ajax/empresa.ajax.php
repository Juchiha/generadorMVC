<?php
	session_start();
	ini_set('display_errors', 'On');
    ini_set('display_errors', 1);
   	require_once '../ext/PHPMailer/class.phpmailer.php';
   	require_once '../ext/PHPMailer/class.smtp.php';

	require_once '../controllers/mail.controller.php';
	require_once '../controllers/plantilla.controller.php';
	require_once '../controllers/empresa.controller.php';

	require_once '../models/dao.modelo.php';
	require_once '../models/datatables.modelo.php';
	require_once '../models/empresa.modelo.php';

	class AjaxEmpresa
	{
		public function ajaxDataTable(){
			$table = 'documentos_recibidos_view';
			$primaryKey = 'doc_id_i';
			$columns = array(
			    array( 'db' => 'doc_descripcion_v', 		'dt' => 'doc_descripcion_v' ),
			    array( 'db' => 'doc_fecha_d',  		 		'dt' => 'doc_fecha_d' ),
			    array( 'db' => 'doc_user_registrador_i',   	'dt' => 'doc_user_registrador_i' ),
			    array( 'db' => 'doc_ruta_v',    			'dt' => 'doc_ruta_v' ),
		     	array( 'db' => 'doc_id_i',     				'dt' => 'doc_id_i' ),
		     	array( 'db' => 'doc_tipo_v',     			'dt' => 'doc_tipo_v' )
			);
			if($_SESSION['perfil'] != '7'){
				echo json_encode(
			    	SSP::complex( 
			    		$_POST, 
			    		$table, 
			    		$primaryKey, 
			    		$columns, 
			    		null, 
			    		'user_cliente_id = '.$_SESSION['cliente_id']." AND doc_carp_id_i = 0"
			    	)
				);
			}else{
				echo json_encode(
		    		SSP::simple( $_POST, $table, $primaryKey, $columns )
				);
			}
			
		}

		public function ajaxDataTableCarpetas($valorBusqueda){
			$table = 'documentos_recibidos_view';
			$primaryKey = 'doc_id_i';
			$columns = array(
			    array( 'db' => 'doc_descripcion_v', 		'dt' => 'doc_descripcion_v' ),
			    array( 'db' => 'doc_fecha_d',  		 		'dt' => 'doc_fecha_d' ),
			    array( 'db' => 'doc_user_registrador_i',   	'dt' => 'doc_user_registrador_i' ),
			    array( 'db' => 'doc_ruta_v',    			'dt' => 'doc_ruta_v' ),
		     	array( 'db' => 'doc_id_i',     				'dt' => 'doc_id_i' ),
		     	array( 'db' => 'doc_tipo_v',     			'dt' => 'doc_tipo_v' )
			);
			echo json_encode(
		    	SSP::complex( 
		    		$_POST, 
		    		$table, 
		    		$primaryKey, 
		    		$columns, 
		    		null, 
		    		'doc_carp_id_i = '.$valorBusqueda
		    	)
			);
		}

		public function insertDatos(){
			echo ControladorEmpresa::subirArchivos();
		}

		public function deleteDatos(){
			echo ControladorEmpresa::deleteDatos();
		}

		public function createCarpeta(){
			echo ControladorEmpresa::createCarpeta();
		}
		
	}


	if(isset($_GET['getDataUsuario'])){
		$ajaxEmpresa = new AjaxEmpresa();
		$ajaxEmpresa->ajaxDataTable();
	}

	if(isset($_GET['getDataCarpeta'])){
		$ajaxEmpresa = new AjaxEmpresa();
		$ajaxEmpresa->ajaxDataTableCarpetas($_GET['getDataCarpeta']);
	}

	

	if(isset($_POST['I_emp_nit_v'])){
		$ajaxEmpresa = new AjaxEmpresa();
		$ajaxEmpresa->insertDatos();
	}

	if(isset($_POST['D_emp_id_i'])){
		$ajaxEmpresa = new AjaxEmpresa();
		$ajaxEmpresa->deleteDatos();
	}

	if(isset($_POST['I_doc_tipo_v'])){
		$ajaxEmpresa = new AjaxEmpresa();
		$ajaxEmpresa->createCarpeta();
	}
?>
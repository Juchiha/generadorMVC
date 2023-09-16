<?php
	/*Controlador para CRUD de TablaNombre, se reciben las peticiones por POST*/
	/*Los metodos para hacer consultas o SELECT estan en plantilla, asi que se heredan*/
	/*Fecha Creacion: 11/11/2021 */
	/*Autor Nombre del Autor: Jose Giron */
	class ControladorTablaNombre extends ControladorPlantilla // Siempre extiende de Plantilla
	{
		/*
		*Funcion para Insertar los datos, se invoca por Form, Method POST
		*Return JSON => Code 1 Exito, 0 Error, message con el mensaje a mostrar en cada caso
		**/
		public static function insertDatos(){
			if(isset($_POST[''])){ /*Variable que se espera para validar que se esta insertando*/
				/*Array con los valores de los campos en la tabla y los valores que vienen por POST*/
				$datos = array(
					'' 		=> $_POST[''], 
					'' 		=> $_POST[''],
				);
				/*
					Se invoca el modelo de esa tabla y se manda a insertar, con el array que ser llena en la parte superior
				*/
				$respuesta = TablaNombreModelo::insertDatos($datos);
				/*Solo puede haber dos respuesta este metodo, el Id insertado o error, por eso este IF - ELSE */
				/*Retornamos la respuesta en json*/
				if($respuesta != "error"){
					/*Inserto Correctamente*/
					return json_encode(array('code' => 1, 'message' => 'Aqui va el nombre de lo que se este Guardando (Banco, box, sector, etc...) guardadado con exito'));
				}else{	
					/*No Correctamente*/
					return json_encode(array('code' => 0, 'message' => 'Aqui va el nombre de lo que se este Guardando (Banco, box, sector, etc...) no guardadado'));
				}
			}
		}

		/*
		*Funcion para Actualizar los datos, se invoca por Form, Method POST
		*Return JSON => Code 1 Exito, 0 Error, message con el mensaje a mostrar en cada caso
		**/
		public static function UpdateDatos(){
			if(isset($_POST[''])){ /*Variable que se espera para validar que se esta insertando*/
				/*Array con los valores de los campos en la tabla y los valores que vienen por POST*/
				/*Lleva el ID del registro que se esta Actualizando */
				$datos = array(
					'' 					=> $_POST[''], 
					''			        => $_POST[''],
					''			        => $_POST[''],
					
				);
				/*
					Se invoca el modelo de esa tabla y se manda a actualizar, con el array que ser llena en la parte superior
				*/
				$respuesta = TablaNombreModelo::UpdateDatos($datos);
				/*Solo puede haber dos respuesta este metodo, ok o error, por eso este IF - ELSE */
				/*Retornamos la respuesta en json*/
				if($respuesta == "ok"){
					/*Actualizo Correctamente*/
					return json_encode(array('code' => 1, 'message' => 'Aqui va el nombre de lo que se este Editandi (Banco, box, sector, etc...) actualizado con exito'));
				}else{	
					/*No Actualizo Correctamente*/
					return json_encode(array('code' => 0, 'message' => 'Aqui va el nombre de lo que se este Editandi (Banco, box, sector, etc...) no actualizado'));
				}
			}
		}


		/*
		*Funcion para Eliminar los datos, se invoca por Form, Method POST
		*Return JSON => Code 1 Exito, 0 Error, message con el mensaje a mostrar en cada caso
		**/
		public static function deleteDatos(){
		    if(isset($_POST[''])){ /*Variable que se espera para validar que se esta insertando*/
			    $datos = $_POST[""];/*Variable con el ID que vamos a eliminar*/
			    /*
					Se invoca el modelo de esa tabla y se manda a eliminar, con la variable que recibimos en la parte superior
				*/
			    $respuesta = TablaNombreModelo::deleteDatos($datos);
			    /*Solo puede haber dos respuesta este metodo, ok o error, por eso este IF - ELSE */
				/*Retornamos la respuesta en json*/
				if($respuesta == "ok"){
					/*Se Borro Correctamente*/
					return json_encode(array('code' => 1, 'message' => 'Aqui va el nombre de lo que se este Borrando (Banco, box, sector, etc...) Eliminada con exito'));
			    }else{	
			    	/*No Se Borro Correctamente*/
					return json_encode(array('code' => 0, 'message' => 'Aqui va el nombre de lo que se este Borrando (Banco, box, sector, etc...) no Eliminada'));
				}
			}
		}
	}
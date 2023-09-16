<?php
	/**
	* Este archivo se encarga de controlar el inicio de sessiones
	*/
	class ControladorAuth
	{
		
		public static function inicoSession(){
			//Validamos que vengan los campos
			if(isset($_POST['ingCorreo']) && isset($_POST['ingPassword'])){
				/*Validamos que no intenten hacer Inyeccion sql o meter caracteres extraños */
				if($_POST['ingCorreo'] != '' && $_POST['ingPassword'] != ''){
						
						$item 	= "usu_correo_v";
						$valor	= $_POST['ingCorreo'];
						//Encriptamos la contraseña
						$pass = crypt($_POST['ingPassword'], '$2a$07$usesomesillystringforsalt$');
						//Mandamos a preguntar la información
						$respuesta = ModeloAuth::getDatosUsuarioLogin($item, $valor);
						
						if($respuesta['usu_correo_v'] == $_POST['ingCorreo'] && $respuesta['user_password'] == $pass){

							$imagen = 'views/assets/img/usuarios/default/anonymous.png';
							$_SESSION['SessionWorky'] 				= 'ok';
							$_SESSION['codigo']						= $respuesta['user_id'];
							$_SESSION['perfil']						= $respuesta['user_perfil_id'];
							$_SESSION['nombres'] 					= $respuesta['user_nombre'].' '.$respuesta['user_apellidos'];
							$_SESSION['correo'] 					= $respuesta['usu_correo_v'];
							$_SESSION['cliente_id']					= $respuesta['user_cliente_id'];
							$_SESSION['idSession'] 					= Time().rand();


							/*=============================================
								REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN, AUDIORIA
							=============================================*/
							date_default_timezone_set('America/Bogota');
							$fecha = date('Y-m-d');
							$hora = date('H:i:s');
							$fechaActual = $fecha.' '.$hora;
							$_SESSION['ultimaSession'] = $fechaActual;
							$item1 = "user_ultimo_login";
							$valor1 = $fechaActual;
							$item2 = "user_id";
							$valor2 = $respuesta["user_id"];
							/*Enviamos la carga de informacion para guardar la ultima vez que esta persona se logeo en el sistema */
							$ultimoLogin = ModeloAuth::actualizarUsuarioPostLogin('gi_usuario', $item1, $valor1, $item2, $valor2);
							if($ultimoLogin == "ok"){
								/*No paso nada y guardo todo bien, la mandamos al inicio*/
								echo '<script>
										window.location = "dashboard";
									</script>';
							}else{
								var_dump($ultimoLogin);
								/*ALgo paso y no actualizo el campo de fecha del ultimo login*/
							}
							
						}else{
							echo "<br>";
							echo "<div class='alert alert-danger'>Error al ingresar, correo y/o contraseña incorrectos</div>";
						}

					
				}else{
					echo "<br>";
					echo "<div class='alert alert-danger'>Error al ingresar, se enviaron caracteres extraños</div>";
				}
			}
		}

	}	



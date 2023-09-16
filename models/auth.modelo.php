<?php
	/*
	* Obtener los datos de los usuarios del sistema, para permitir o no su ingreso a este
	*/
	
	class ModeloAuth
	{
		static public function getDatosUsuarioLogin($item, $valor){
			if(!is_null($item)){
				//echo "SELECT * FROM go_users WHERE $item = '$valor'";
				$stmt = Conexion::conectar()->prepare("SELECT * FROM gi_usuario WHERE $item = :$item");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				$object = $stmt->fetch();
				//print_r($object);
				return $object;
			}
		}

		static public function actualizarUsuarioPostLogin($tabla, $item1, $valor1, $item2, $valor2){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  $item1 = :$item1 WHERE $item2 = :$item2");
			$stmt->bindParam(":".$item1, 	$valor1, 	PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, 	$valor2, 	PDO::PARAM_STR);
			if($stmt->execute()){
				return 'ok';
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}


		static public function ingresarUsuario($data){
			$pdo = Conexion::conectar();
			$stmt = $pdo->prepare("INSERT INTO go_users (user_nombre_v, user_correo_v, user_password_v, user_estado_v, user_token_validacion, user_wallet_v) VALUES (:user_nombre_v , :user_correo_v, :user_password_v, :user_estado_v, :user_token_validacion, :user_wallet_v);");
			$stmt->bindParam(":user_nombre_v", 	$data['user_nombre_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":user_correo_v", 	$data['user_correo_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":user_password_v", 	$data['user_password_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":user_estado_v", 	$data['user_estado_v'], 	PDO::PARAM_STR);
			$stmt->bindParam(":user_token_validacion", 	$data['user_token_validacion'], 	PDO::PARAM_STR);
			$stmt->bindParam(":user_wallet_v", 	$data['user_wallet_v'], 	PDO::PARAM_STR);
			if($stmt->execute()){
				$ultimoId = $pdo->lastInsertId();
				/*$stmt = $pdo->prepare("INSERT INTO go_balance (balance_user_id_i,  balance_gocoin_v) VALUES (".$ultimoId.", 0);");
				$stmt->execute()*/
				return 'ok';
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}
	}
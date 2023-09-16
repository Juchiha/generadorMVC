<?php
	class EmpresaModelo extends ModeloDAO
	{
		public static function insertDatos($datos){
			$pdo  = Conexion::conectar();
			$stmt = $pdo->prepare("INSERT INTO gi_documentos_recibidos(
				doc_descripcion_v, 
				doc_fecha_d, 
				doc_user_registrador_i, 
				doc_ruta_v,
				doc_tipo_v,
				doc_carp_id_i) 
				VALUES (
				:doc_descripcion_v, 
				:doc_fecha_d, 
				:doc_user_registrador_i, 
				:doc_ruta_v,
				:doc_tipo_v,
				:doc_carp_id_i)");
			$stmt->bindParam(":doc_descripcion_v", $datos['doc_descripcion_v'], PDO::PARAM_STR);
			$stmt->bindParam(":doc_fecha_d", $datos['doc_fecha_d'], PDO::PARAM_STR);
			$stmt->bindParam(":doc_user_registrador_i", $datos['doc_user_registrador_i'], 					  PDO::PARAM_STR);
			$stmt->bindParam(":doc_ruta_v", 	$datos['doc_ruta_v'], PDO::PARAM_STR);
			$stmt->bindParam(":doc_tipo_v", 	$datos['doc_tipo_v'], PDO::PARAM_STR);
			$stmt->bindParam(":doc_carp_id_i", 	$datos['doc_carp_id_i'], PDO::PARAM_STR);
			if($stmt->execute()){
				$stmt = null;
				return $pdo->lastInsertId();
			}else{
				self::logError('2404', "Error insertando Empresa.modelo.php => " + $stmt->errorInfo());
				return 'error';
				//return $stmt->errorInfo();
			}	
		}

		public static function deleteDatos($datos){
			$pdo  = Conexion::conectar();
			$stmt = $pdo->prepare("DELETE FROM gi_documentos_recibidos WHERE doc_id_i  = :doc_id_i ");
			$stmt->bindParam(":doc_id_i", $datos, PDO::PARAM_STR);
			if($stmt->execute()){
				$stmt = null;
				return 'ok';
			}else{
				self::logError('2404', "Error borrando Empresa.modelo.php => " + $stmt->errorInfo());
				return 'error';
			}
		}

	}


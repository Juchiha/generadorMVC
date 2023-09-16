<?php
	require_once "conexion.php";
	
	class ModeloDAO
	{

		public static function getDatos($tabla, $item, $value){
			if(!is_null($item)){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt->execute();
				return $stmt->fetchAll();
			}
		}

		static public function mdlMostrar($tabla, $item, $value){
			if($item==""){
				//si no tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}else{
				//si tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarUnitario($campo,$tabla,$condicion){
			if($condicion==""){
				//si no tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla");
				$stmt->execute();
				return $stmt->fetch();
			}else{
				//si tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion");
				$stmt->execute();
				return $stmt->fetch();
			}
			
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarGroupAndOrder($campo,$tabla,$condicion = null, $groupBy = null, $orderBy = null, $limit=null){
			if($condicion==""){
				//si no tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla $groupBy $orderBy $limit");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}else{
				//si tiene condicion
				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion $groupBy $orderBy $limit");
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			
			$stmt->close();
			$stmt = null;
		}

		static public function mdlGetNumrows_number($tabla, $condicion){
			if($condicion==""){
				$stmt = Conexion::conectar()->prepare("SELECT count(*) as cantidad FROM $tabla");
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT count(*) as cantidad FROM $tabla WHERE $condicion");
			}

			$stmt -> execute();
			$totales = $stmt->fetch();
			return $totales['cantidad'];
			$stmt -> close();
			$stmt = null;
		}

		static public function mdlCrear($tabla, $campos, $valores){
			$pdo  = Conexion::conectar();
			$stmt = $pdo->prepare("INSERT INTO $tabla ($campos) VALUES($valores)");
			if($stmt->execute()){
				return $pdo->lastInsertId();
			}else{
				return 'error';
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlEditar($tabla, $datos, $condicion){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $datos WHERE $condicion");
			if($stmt->execute()){
				return 'ok';
			}else{
				return $stmt->errorInfo();
			}
			$stmt->close();
			$stmt = null;
		}

		static public function mdlBorrar($tabla, $condicion){
			if($condicion==""){
				$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla");
			}else{
				$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $condicion");
			}
			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}

		static public function logError($numero, $texto){ 
		 	$ddf = fopen('error.log','a'); 
		 	fwrite($ddf,"[".date("r")."] Error $numero: $texto\r\n"); 
		 	fclose($ddf); 
		} 

	}
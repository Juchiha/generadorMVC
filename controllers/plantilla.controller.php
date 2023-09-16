<?php
	/**
	* 
	*/
	class ControladorPlantilla extends ctrMail
	{
		
		static public function ctrPlantilla(){
            if(isset($_SESSION['SessionWorky']) && $_SESSION['SessionWorky'] == 'ok'){
                include "views/plantilla.php";
            }else{
                include "views/modulos/login/login.php";
            }
			
		}

        static public function getData($table, $item, $value){
            return ModeloDAO::getDatos($table, $item, $value);
        }

        static public function getDataFromLsql($campos, $tabla, $where = null, $group = null, $order = null, $limit = null){
                return ModeloDAO::mdlMostrarGroupAndOrder($campos, $tabla, $where, $group, $order, $limit);
        }

		static public function putImage($fila, $typo, $ruta, $extension = null){
			list($ancho, $alto) = getimagesize($fila);
            $nuevoAncho = 900;
            $nuevoAlto  = 500;
            if (!file_exists($ruta)) {
                mkdir($ruta, 0755);
            }

            if($typo == "image/jpeg"){
                $aleatorio = mt_rand(1000, 9999);
                $ruta =  $ruta.$aleatorio.".jpg";
                $origen  = imagecreatefromjpeg($fila);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $ruta);
            }elseif($typo == "image/png"){
                $aleatorio = mt_rand(1000, 9999);
                $ruta = $ruta.$aleatorio.".png";
                $origen  = imagecreatefrompng($fila);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, $ruta);
            }else{
                $aleatorio = mt_rand(100, 999);
                $ruta =   $ruta.$aleatorio.$extension;
                copy($fila, $ruta);
            }
            return $ruta;
		}

        
        public static function getBrowser($user_agent){

            if(strpos($user_agent, 'MSIE') !== FALSE)
                   return 'Internet explorer';
                elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
                   return 'Microsoft Edge';
                elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
                    return 'Internet explorer';
                elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
                   return "Opera Mini";
                elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
                   return "Opera";
                elseif(strpos($user_agent, 'Firefox') !== FALSE)
                   return 'Mozilla Firefox';
                elseif(strpos($user_agent, 'Chrome') !== FALSE)
                   return 'Google Chrome';
                elseif(strpos($user_agent, 'Safari') !== FALSE)
                   return "Safari";
                else
                   return 'No hemos podido detectar su navegador';
        }

	}
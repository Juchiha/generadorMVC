<?php
    $archivo = fopen($_GET['controller'].".ajax.php", "w+b");    // Abrir el archivo, creándolo si no existe
    if( $archivo == false ){
      echo "Error al crear el archivo";
    }
    else
    {
      $contenido = '<?php
    /*Clase para asignar seguridad a el controlador de '.$_GET['controller'].', se reciben las peticiones por POST y por GET*/
    /*Fecha Creacion: '.date('d/m/Y').' */
    /*Autor Nombre del Autor: Richard Fonseca - Creator BoT (o__0) */
    /*Seccion para llamar a la session activa, con session start algunas veces no va pero colocar siempre*/
    session_start();
    /*Seccion de llamado a controladores, mail y plantilla son obligatorios*/
    require_once \'../controllers/mail.controller.php\';
    require_once \'../controllers/plantilla.controller.php\';
    /*Seccion de los controladores que se vallan a utilizar*/ 
    require_once \'../controllers/'.$_GET['controller'].'.controller.php\';

    /*Seccion modelos, DAO es obligatorio, asu qye debe quedarse*/
    require_once \'../models/dao.modelo.php\';
    /*Modelos que se vallan a utilizar, generalmente los de la tabla a usar*/
    require_once \'../models/datatables.modelo.php\';
    require_once \'../models/'.$_GET['modelo'].'.modelo.php\'; 

    /*Clase para manipular el controlador*/
    class Ajax'.ucfirst($_GET['controller']).'{ //Reemplazar nombre tabla
    
        public function insertDatos(){ /*Funcion para insercion*/
          echo Controlador'.ucfirst($_GET['controller']).'::insertDatos();
        }
        
        public function updateDatos(){/*Funcion para actualizar*/
          echo Controlador'.ucfirst($_GET['controller']).'::UpdateDatos();
        }

        public function deleteDatos(){/*Funcion para eliminar*/
          echo Controlador'.ucfirst($_GET['controller']).'::deleteDatos();
        }

        public function getDatos($IdTabla){
          /*Recibimos un parametro, puede ser cualquier cosas, pero generalmente es el ID*/
          /*
            function para obtener los datos que se llaman al editar una fila de la tabla
          */
          /*convertir array que retorna el controlador en JSON*/
          echo json_encode(Controlador'.ucfirst($_GET['controller']).'::getData(\''.$_GET['tabla'].'\', "'.$_GET['id'].'", $IdTabla));
        } 

        public function getAllDatos(){/*Funcion para obtener todos los datos de una tabla*/
      
            $registros = Controlador'.ucfirst($_GET['controller']).'::getData("'.$_GET['tabla'].'", null, null);
        }
    }    

    /*Zona de llamado de Funciones*/
    if(isset($_POST["insertR"])){ /*Invocar la funcion de insertar*/
      $Ajax'.ucfirst($_GET['controller']).' = new Ajax'.ucfirst($_GET['controller']).'(); /*Creamos el objeto de la clase AJAX*/
      $Ajax'.ucfirst($_GET['controller']).'->insertDatos(); /*Invocamos la funcion en este caso Insertar*/
    }

    if(isset($_POST["editarR"])){/*Invocar la funcion de Actualizar*/
      $Ajax'.ucfirst($_GET['controller']).' = new Ajax'.ucfirst($_GET['controller']).'();/*Creamos el objeto de la clase AJAX*/
      $Ajax'.ucfirst($_GET['controller']).'->updateDatos();/*Invocamos la funcion en este caso Actualizar*/
    }

    if(isset($_POST["eliminarR"])){/*Invocar la funcion de Borrar*/
      $Ajax'.ucfirst($_GET['controller']).' = new Ajax'.ucfirst($_GET['controller']).'();/*Creamos el objeto de la clase AJAX*/
      $Ajax'.ucfirst($_GET['controller']).'->deleteDatos();/*Invocamos la funcion en este caso Borrar*/
    }

    if(isset($_POST["getDatos"])){/*Invocar la funcion de obtener los datos de un registro*/
      $Ajax'.ucfirst($_GET['controller']).' = new Ajax'.ucfirst($_GET['controller']).'();/*Creamos el objeto de la clase AJAX*/
      $Ajax'.ucfirst($_GET['controller']).'->getDatos($_POST["ID"]);/*Invocamos la funcion en este caso Obtener los datos de un registro especifico con el ID*/
    }

    if(isset($_GET["allDatos"])){/*Invocar la funcion de tener todos los datos*/
      $Ajax'.ucfirst($_GET['controller']).' = new Ajax'.ucfirst($_GET['controller']).'();/*Creamos el objeto de la clase AJAX*/
      $Ajax'.ucfirst($_GET['controller']).'->getAllDatos();/*Invocamos la funcion en este caso Obtener Todos los datos*/
    } 
?>';
          // Escribir en el archivo:
         fwrite($archivo, $contenido);
        // Fuerza a que se escriban los datos pendientes en el buffer:
         fflush($archivo);
    }
    // Cerrar el archivo:
    fclose($archivo);
?>


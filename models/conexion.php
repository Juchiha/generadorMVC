<?php
	class Conexion 
	{
		static public function conectar()
		{	
			$link = new PDO("mysql:host=localhost;dbname=u804989890_incap", "u804989890_incap", "1143231494ABc_");
			//seteamos los caracteres latinos
			$link->exec("set names utf8");
			return $link;
		}
	}
<?php 
date_default_timezone_set('America/Bogota');

class ctrMail{
	public static function EnviarMail($asunto, $cuerpo, $correos, $adjuntos, $CopiaOculta = null, $usuario = null){
		
		$email_user = "info@incapacidades.co";
  		$email_password = "1143231494ABc_";
		
		$from_name = "Info Incapacidades";
		$phpmailer = new PHPMailer(); 
		$phpmailer->CharSet = 'UTF-8';
		// ---------- datos de la cuenta de Gmail -------------------------------
		$phpmailer->Username = $email_user;
		$phpmailer->Password = $email_password; 
		//-----------------------------------------------------------------------
		// $phpmailer->SMTPDebug = 1;
		$phpmailer->SMTPSecure = 'tls';
		$phpmailer->Host = "smtp.hostinger.co";
		$phpmailer->Port = 587;
		$phpmailer->IsSMTP();
		$phpmailer->SMTPAuth = true;
		$phpmailer->setFrom($phpmailer->Username,$from_name);
		if($correos !== null){
			$arr_correos = explode(',',$correos);
			foreach ($arr_correos as $key) {
				$phpmailer->AddAddress($key);
			}
		}
		if($CopiaOculta !== null){
			$phpmailer->AddBCC($CopiaOculta, $usuario);
		}
		$phpmailer->Subject = $asunto;	
		$phpmailer->Body = $cuerpo;
		if($adjuntos !== null){
			$arr_adjuntos = explode(',',$adjuntos);
			foreach ($arr_adjuntos as $key) {
				$nombre_archivo = explode('/', $key);
				$count = count($nombre_archivo) - 1;
				$phpmailer->AddAttachment($key, $nombre_archivo[$count]);
			}
		}
		$phpmailer->IsHTML(true);	
		if(!$phpmailer->Send()){
			return $phpmailer->ErrorInfo." \n";
		}else{
			return "ok";
		}
	}
	public function EnviarAgenda($asunto, $correos, $fecha, $hora, $duracion, $organizador, $lugar, $asistencia){

		$fechacreacion = date('Ymd');
		$horacreacion = date('His');

		if(is_null($duracion)){
			$fechainicio = date('Ymd', $fecha);
			$fechafin = date('Ymd', $fecha);
			$horainicio = '000000';
			$horafin = '235959';
		}else{
			$fechahora = $fecha.$hora;
			$fechahorafin = strtotime('+'.$duracion.' hour', strtotime($fechahora));

			$fechainicio = date('Ymd', strtotime($fechahora));
			$horainicio = date('His', strtotime($fechahora));
			$fechafin = date('Ymd', $fechahorafin);
			$horafin = 	date('His', $fechahorafin);
		}

		$email_user = "info@incapacidades.co";
  		$email_password = "1143231494ABc_";

		$from_name = "Notificaciones";
		$phpmailer = new PHPMailer(); 
		$phpmailer->CharSet = 'UTF-8';
		// ---------- datos de la cuenta de Gmail -------------------------------
		$phpmailer->Username = $email_user;
		$phpmailer->Password = $email_password; 
		//-----------------------------------------------------------------------
		// $phpmailer->SMTPDebug = 1;
		$phpmailer->SMTPSecure = 'tls';
		$phpmailer->Host = "smtp.hostinger.co";
		$phpmailer->Port = 587;
		$phpmailer->IsSMTP();
		$phpmailer->SMTPAuth = true;
		$phpmailer->setFrom($phpmailer->Username,$from_name);
		$phpmailer->Subject = $asunto;

		$ical = "BEGIN:VCALENDAR\r\n";
		$ical .= "VERSION:2.0\r\n";
		$ical .= "PRODID:-//YourCassavaLtd//EateriesDept//EN\r\n";
		$ical .= "METHOD:REQUEST\r\n";
		$ical .= "BEGIN:VEVENT\r\n";
		$ical .= 'ORGANIZER:MAILTO:'.$organizador."\r\n";
		if($correos !== null){
			$arr_correos = explode(',',$correos);
			foreach ($arr_correos as $key) {
				$phpmailer->AddAddress($key);
				if($asistencia == 1){
					$ical .= "ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=ACCEPTED;RSVP=TRUE:mailto:".$key."\r\n";
				}else{
					$ical .= "ATTENDEE;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE:mailto:".$key."\r\n";
				}
			}
		}
		$ical .= "DTSTAMPTZID=America/Bogota:".date('Ymd').'T'.date('His')."\r\n";
		$ical .= "DTSTART:".$fechainicio."T".$horainicio."\r\n";
		$ical .= "DTEND:".$fechafin."T".$horafin."\r\n";
		$ical .= "LOCATION:".$lugar."\r\n";
		$ical .= "SUMMARY:".$asunto."\r\n";
		$ical .= "DESCRIPTION:".$organizador."\r\n";
		$ical .= "BEGIN:VALARM\r\n";
		$ical .= "TRIGGER:-PT15M\r\n";
		$ical .= "ACTION:DISPLAY\r\n";
		$ical .= "DESCRIPTION:Reminder\r\n";
		$ical .= "END:VALARM\r\n";
		$ical .= "END:VEVENT\r\n";
		$ical .= "END:VCALENDAR\r\n";

		$phpmailer->Body = 'GroupGe';
		$phpmailer->IsHTML(false);
		$phpmailer->addStringAttachment($ical,'event.ics','base64','multipart/alternative');
		$phpmailer->addBCC('clientesgroup@gmail.com','encuestasjosegiron@gmail.com');
		if(!$phpmailer->Send()){
			return $phpmailer->ErrorInfo." \n";
		}else{
			return "ok";
		}
	}

	public function EnviarMailWithEmailAndPass($correo, $password, $empresa, $asunto, $cuerpo, $correos, $adjuntos, $CopiaOculta = null, $usuario = null){
		
		$email_user = $correo;
  		$email_password = $password;
		
		$from_name = $empresa;
		$phpmailer = new PHPMailer(); 
		$phpmailer->CharSet = 'UTF-8';
		// ---------- datos de la cuenta de Gmail -------------------------------
		$phpmailer->Username = $email_user;
		$phpmailer->Password = $email_password; 
		//-----------------------------------------------------------------------
		// $phpmailer->SMTPDebug = 1;
		$phpmailer->SMTPSecure = 'tls';
		$phpmailer->Host = "smtp.hostinger.co";
		$phpmailer->Port = 587;
		$phpmailer->IsSMTP();
		$phpmailer->SMTPAuth = true;
		$phpmailer->setFrom($phpmailer->Username,$from_name);
		if($correos !== null){
			$arr_correos = explode(',',$correos);
			foreach ($arr_correos as $key) {
				$phpmailer->AddAddress($key);
			}
		}
		if($CopiaOculta !== null){
			$phpmailer->AddBCC($CopiaOculta, $usuario);
		}
		$phpmailer->Subject = $asunto;	
		$phpmailer->Body = $cuerpo;
		if($adjuntos !== null){
			$arr_adjuntos = explode(',',$adjuntos);
			foreach ($arr_adjuntos as $key) {
				$nombre_archivo = explode('/', $key);
				$count = count($nombre_archivo) - 1;
				$phpmailer->AddAttachment($key, $nombre_archivo[$count]);
			}
		}
		$phpmailer->IsHTML(true);	
		if(!$phpmailer->Send()){
			return $phpmailer->ErrorInfo." \n";
		}else{
			return "ok";
		}
	}
}
?>
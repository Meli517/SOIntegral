<?php

	if (!isset($_POST)){
		die();
	}

	include('includes/class.phpmailer.php');

	$nombre = trim($_POST['nombre']);
	$teléfono = trim($_POST['teléfono']);
	$email = trim($_POST['email']);
	$mensaje = trim($_POST['mensaje']);


	$mail = new PHPMailer();

	$mail->isSMTP();    // Si el envío no anda probar cambiar "isSMTP" por "isMail"
	$mail->Host = "c8000624.ferozo.com";
	$mail->SMTPAuth = true;
	$mail->Username = "info@sointegral.com.ar";
	$mail->Password = "SOIntegral2016";
	
	$msg;
	$msg .= "<p><strong>Nombre:</strong> $nombre </p>";
	$msg .= "<p><strong>Teléfono:</strong> $teléfono </p>";
	$msg .= "<p><strong>Email:</strong> $email </p>";
	$msg .= "<p><strong>Mensaje:</strong> $mensaje </p>";

    
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Subject	= 'Contacto desde la web SOIntegral - Implantes';
	$mail->Body = $msg;
	$mail->From = "info@sointegral.com.ar";

	//Si hay que adjuntar archivos:
	if (isset($_FILES)) {
		foreach($_FILES as $file){
		   $mail->addattachment($file['tmp_name'],$file['name']);
		}
	}

	if (isset($nombre)) {
		$mail->FromName = $nombre;
	}else{
		$mail->FromName = "Contacto Web";
	}
	if (isset($email)) {
		$mail->AddReplyTo($email);
	}
	$mail->AddAddress('sointegralcba@gmail.com','Implantes');
	$mail->AddCC('ladaortiz@gmail.com','Lana');


	if($mail->Send()){
		echo '{"status":"ok","msg":"El mensaje fue enviado con éxito."}';
	}else{
		echo '{"status":"nok","msg":"Ocurrió un error al enviar los datos, intentelo nuevamente mas tarde."}';
	}

?>
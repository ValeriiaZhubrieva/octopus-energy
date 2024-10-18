<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$name = trim($_POST['name']);
	$surname = trim($_POST['surname']);
 	$email = trim($_POST['phone']);
 	$message = trim($_POST['message']);

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('en', 'phpmailer/language/');
	$mail->IsHTML(true);

	/*
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'user@example.com';                     //SMTP username
	$mail->Password   = 'secret';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	*/

	//Від кого лист
	$mail->setFrom('sales@octopusenergy.com'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('sales@octopusenergy.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'Application from the website octopusenergy.com"';

	//Тіло листа
	$body = '<h1>Application from the website octopusenergy.com</h1>';
	$body .='<p><strong>Name:</strong>'.$name.'</p>';
	$body .='<p><strong>Surname:</strong>'.$surname.'</p>';
  	$body .='<p><strong>Phone:</strong>'.$phone.'</p>';
  	$body.='<p><strong>Description:</strong>'.$message.'</p>';

	//if(trim(!empty($_POST['email']))){
		//$body.=$_POST['email'];
	//}	
	
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Error';
	} else {
		$message = 'Success!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>
<?php

// Guardar los datos recibidos en variables:
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$adicionales = $_POST['adicionales'];
// Definir el correo de destino:
// $dest = "mercadeo@teleone.com.co"; 
$dest = "cristian.rodriguez1317@gmail.com"; 


// Estas son cabeceras que se usan para evitar que el correo llegue a SPAM:
$headers = "From: $nombre <$email>\r\n";  
$headers .= "X-Mailer: PHP5\n";
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Aqui definimos el asunto y armamos el cuerpo del mensaje
$asunto = "Cotiza Contacto";
$cuerpo = "Nombre: ".$nombre."<br>";
$cuerpo .= "Email: ".$email."<br>";
$cuerpo .= "Telefono: ".$telefono."<br>";
$cuerpo .= "Adicionales: ".$adicionales."<br>";

//$secreto='6LewN-IUAAAAAEBncdgbUKviC4ISUh52Zw7H973v';
$secreto='6LeZreMUAAAAAEMwfB9Bi2TfHZ42TVsO50aybvrr';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret='.$secreto.'&response='.$_POST['response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);


$arrayF = json_decode($res);
curl_close($ch);


if($nombre != '' && $email != '' && $telefono != '' && $arrayF->success == 1){
    mail($dest,$asunto,$cuerpo,$headers);
    echo '1';
}
else{
    echo 'mal';
}

?>
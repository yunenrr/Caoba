<?php

$option = $_POST['option'];
$email = $_POST['email'];
$codigo = $_POST['codigo'];


require '../resources/PHPMailer/PHPMailerAutoload.php';
// Creamos una nueva instancia
$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com'; // Servidor SMTP (para este ejemplo utilizamos gmail) 
$mail->Port = 587; // Puerto SMTP 
$mail->SMTPSecure = 'tls'; // Tipo de encriptacion SSL ya no se utiliza se recomienda TSL 
$mail->SMTPAuth = true; // Si necesitamos autentificarnos
// Usuario del correo desde el cual queremos enviar, para Gmail recordar usar el usuario completo (usuario@gmail.com) 
$mail->Username = "gymcaobacr@gmail.com";
$mail->Password = "gymcaoba12345"; // Contraseña 
//Añadimos la direccion de quien envia el corre, en este caso 
$mail->setFrom('gymcaobacr@gmail.com', 'Gym Caoba');

if ($option == 1) {
    include './UserBusiness.php';
    $userBusiness = new UserBusiness();
    $user = $userBusiness->getPassword($email);

    if ($userBusiness->valideUserName($email) > 0) {
        $name = $user[0]['name'];
        $pass = $user[0]['pass'];
        $mail->addAddress($email, $name);
        $mail->Subject = 'Envio de contraseña'; //La linea de asunto
        $message = "Hola," . $name . "! tu contraseña para ingresar a Gym Caoba es " . $pass; //Creamos el mensaje 
        $mail->msgHTML($message); //Agregamos el mensaje al correo
        $mail->send(); // Enviamos el Mensaje 
        echo "Se envio la contraseña a tu correo de forma exitosa!!";
    } else {

        echo "Error! El nombre de usurio no es correcto.";
    }
} else {
    $mail->addAddress($email, "");
    $mail->Subject = 'Bienvenido(a)'; //La linea de asunto
    $message = '<html><head lang="es"><title>Prueba de correo</title>'
            . '</head><body><h1>Bienvenido al Gym Caoba!</h1>'
            . '<p>Este es tu código QR.</p>'.$codigo.'</body></html>'; //Creamos el mensaje 

    $mail->msgHTML($message); //Agregamos el mensaje al correo
    $mail->send(); // Enviamos el Mensaje 
    echo "Se envió una copia del código QR al correo ingresado";
}






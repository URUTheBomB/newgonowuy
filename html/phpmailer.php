<?php

// if ($_SERVER['REQUEST_METHOD'] != 'POST'); {
//     header("Location: contacto.html");
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST'); {
    $nombre = $_POST['nombre'];
    if ( empty(trim($nombre)) ) $nombre = 'anonimo';
    $apellido = $_POST['apellido'];
    if ( empty(trim($apellido)) ) $apellido = '';
    $empresa = $_POST['empresa'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    $destinatario = 'marketing@noderal.uy';
    $body = <<<HTML
        <h1 style=" background:black;">Contacto desde la web</h1>
        <p>De: $nombre $apellido / $email</p>
        <h2>Mensaje:</h2>
        $mensaje
HTML;
 }

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;

$mailer = new PHPMailer();
$mailer->setFrom( $email, "$nombre $apellido" );
$mailer->addAddress( $destinatario,"Admin");
$mailer->Subject = "Mensaje web: $asunto";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);
$mailer->CharSet = 'UTF-8';
$rta = $mailer->send( );

header("Location: ../index.html");
?>
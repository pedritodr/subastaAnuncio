#!/usr/bin/env php
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

// var_dump($argv);

define('FILE_NAME', ".dlcentergc_users");
define('PATH_CONF', "./");
define('SEPARATOR', ";");
define('START_USER', 3); // [0 - 5] index to array $users


if (in_array('-test', $argv)) {
    $users = [

        ['Pedro', 0, 'pedro@datalabcenter.com'],,
    ];
} else {
    $users = [

        ['Pedro', 0, 'pedro@datalabcenter.com'],

    ];
}



// Create tmp user follower
echo PHP_EOL;
echo date('Y-m-d h:i:s') . " - Comienza ejecucion" . PHP_EOL;
echo date('Y-m-d h:i:s') . " - Creamos archivo de seguimiento de recolectores de basura" . PHP_EOL;
if (!file_exists(PATH_CONF . FILE_NAME) || in_array('-init', $argv)) {
    write_file($users, START_USER);
}

// Read users
echo date('Y-m-d h:i:s') . " - Leemos seguimiento de usuario..." . PHP_EOL;
$users = explode(PHP_EOL, file_get_contents(PATH_CONF . FILE_NAME));
foreach ($users as $key => $user) {
    if (!empty($user)) {
        $users[$key] = explode(SEPARATOR, $user);
    } else {
        unset($users[$key]);
    }
}

$max_index_users = count($users) - 1;

$index_current_user     = 0;
echo date('Y-m-d h:i:s') . " - Identificamos usuario del dia ..." . PHP_EOL;

foreach ($users as $key => $user) {
    // Idenfity current user
    if ($user[1] == 1) {
        echo date('Y-m-d h:i:s') . " - Usuario del dia : {$user[0]}" . PHP_EOL;

        $index_current_user     = $key;
    }
}

echo date('Y-m-d h:i:s') . " - Longitud array $max_index_users" . PHP_EOL;

$prev_index_users =  $index_current_user - 1;


if ($prev_index_users < 0) {
    $prev_index_users = $max_index_users;
}


$next_index_users = $index_current_user + 1;

if ($next_index_users > $max_index_users) {
    $next_index_users = 0;
}

echo date('Y-m-d h:i:s') . " - Usuario del dia anterior: {$users[$prev_index_users][0]}" . PHP_EOL;
echo date('Y-m-d h:i:s') . " - Usuario del dia siguiente: {$users[$next_index_users][0]}" . PHP_EOL;

send_mail($users[$index_current_user][0], $users[$index_current_user][2], $users[$next_index_users][0], $users[$prev_index_users][0]);

if (in_array('-init', $argv)) {
    die('Archivo inicializado con el primer usuario - OK' . PHP_EOL);
}

if (in_array('-no-first', $argv)) {

    die('Proceso finalizado (sin mover al proximo usuario)' . PHP_EOL);
} else if (in_array('-write-next-user', $argv)) {

    // Write new user
    write_file($users, $next_index_users);
    die('Proceso finalizado (se movio al proximo usuario)' . PHP_EOL);
} else {

    die('Proceso finalizado (sin mover al proximo usuario)' . PHP_EOL);
}


// ------------------------------------------ FUNCTIONS --------------------------------------------
function write_file($array_write, $index_current_user = 0)
{
    if (file_exists(PATH_CONF . FILE_NAME)) {
        unlink(PATH_CONF . FILE_NAME);
    }

    foreach ($array_write as $key => $line) {

        // Init user
        if ($key == $index_current_user) {
            $line[1] = 1;
        } else {
            $line[1] = 0;
        }

        $row = $line[0] . SEPARATOR . $line[1] . SEPARATOR . $line[2] . PHP_EOL;
        file_put_contents(PATH_CONF . FILE_NAME,  $row, FILE_APPEND);
    }
}
function send_mail($user_name, $user_email, $next_user_name, $prev_user_name)
{
    global $mail;

    try {

        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';                                // Send using SMTP
        $mail->Host = 'ssl://smtp.zoho.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'pedro@datalabcenter.com';                     // SMTP username
        $mail->Password = '01420109811';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('luciano@datalabcenter.com', 'Datalab te informa');
        $mail->addAddress($user_email, $user_name);     // Add a recipient

        $msg = '<h1 style="color: blue;">DataLab te informa</h1>';
        $msg .= "Amigo <b>$user_name:</b><br/><br/>";
        $msg .= "Este día te toca sacar la basura! ya fuiste advertido<br><br>";
        $msg .= "Si te olvidas, tenes la obligacion de pagar <em style='color: red;'>1 pack de cervezas</em><span style='font-size:30px'>&#X1f37b;</span> para el equipo de DataLab Cener<br/>";
        $msg .= "Por favor, considera la posibilidad de olvidarte ;)<br/><br/>";
        $msg .= "Detalle adicional:<br/>";
        $msg .= "El día anterior le toco a: <b>$prev_user_name</b><br/>";
        $msg .= "El proximo día le toca a: <b>$next_user_name</b><br/>";
        $msg .= "<br/><br/>";
        $msg .= "Te desea un buen día, el equipo de DataLab!";

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'En este hermoso día, te toca sacar la basura ;)';
        $mail->Body = $msg;
        $mail->AltBody = '';

        $mail->send();
        echo 'Mensaje enviado con exito!' . PHP_EOL;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


?>
1,9 Top
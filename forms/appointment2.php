<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  $secret = "6Lf9avMrAAAAAGTTfsVeBTAzrbW5-l6xxiDt4hXX";
  $response = $_POST['token'];

  $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
  $captcha = json_decode($verify);

  if ($captcha->success && $captcha->score >= 0.5) {
      // Procesar el envío normalmente
  } else {
      echo "Error: verificación fallida";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["name"]) && !empty($_POST["name"])) {

            $nombre = htmlspecialchars($_POST["name"]);
    
        }

        if (isset($_POST["email"]) && !empty($_POST["email"])) {

            $email = htmlspecialchars($_POST["email"]);
    
        }

        if (isset($_POST["phone"]) && !empty($_POST["phone"])) {

            $telefono = htmlspecialchars($_POST["phone"]);
    
        }

        if (isset($_POST["department"]) && !empty($_POST["department"])) {

            $servicio = htmlspecialchars($_POST["department"]);
    
        }

        if (isset($_POST["doctor"]) && !empty($_POST["doctor"])) {

            $doctor = htmlspecialchars($_POST["doctor"]);
        }

        if (isset($_POST["message"]) && !empty($_POST["message"])) {

            $mensaje= htmlspecialchars($_POST["message"]);
        }


    }

  // Replace contact@example.com with your real receiving email address
  $destinatario = 'secretaria@institutodeinmunoalergia.com';

  $asunto = "Formulario de Contacto via Web";


    $cuerpoMensaje = "Nombre: $nombre<br>\n";

    $cuerpoMensaje .= "Teléfono: $telefono<br>\n";

    $cuerpoMensaje .= "Email: $email<br>\n";

    $cuerpoMensaje .= "Serviciol: $servicio<br>\n";

    $cuerpoMensaje .= "Doctor: $doctor<br>\n";

    $cuerpoMensaje .= "Mensaje:\n$mensaje<br>\n";


    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";

    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $cabeceras .= 'From: Consultas web <consultas@maximopinasco.com.ar>' . "\r\n" .

    'Reply-To: consultas@maximopinasco.com.ar' . "\r\n" .

    'X-Mailer: PHP/' . phpversion();

    // Enviar el correo

    //echo $cuerpoMensaje;

    $enviado = mail($destinatario, $asunto, $cuerpoMensaje, $cabeceras);

    if ($enviado) {

        header("Location: contact.html");

    } 

  
?>

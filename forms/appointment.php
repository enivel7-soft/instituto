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

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'secretaria@institutodeinmunoalergia.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = 'Online Appointment Form';

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'Name');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['phone'], 'Phone');
  isset($_POST['date']) && $contact->add_message($_POST['date'], 'Appointment Date');
  isset($_POST['time']) && $contact->add_message($_POST['time'], 'Appointment Time');
  isset($_POST['department']) && $contact->add_message($_POST['department'], 'Department');
  isset($_POST['doctor']) && $contact->add_message($_POST['doctor'], 'Doctor');
  $contact->add_message( $_POST['message'], 'Message');

  echo $contact->send();
?>

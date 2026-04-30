<?php
  $receiving_email_address = 'contact@abrahamaguirre.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  $contact->to = $receiving_email_address;
  $contact->from_name = htmlspecialchars(strip_tags($_POST['name'] ?? ''), ENT_QUOTES, 'UTF-8');
  $contact->from_email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
  $contact->subject = htmlspecialchars(strip_tags($_POST['subject'] ?? ''), ENT_QUOTES, 'UTF-8');

  $contact->add_message( $contact->from_name, 'From');
  $contact->add_message( $contact->from_email, 'Email');
  $contact->add_message( htmlspecialchars(strip_tags($_POST['message'] ?? ''), ENT_QUOTES, 'UTF-8'), 'Message', 10);

  echo $contact->send();
?>

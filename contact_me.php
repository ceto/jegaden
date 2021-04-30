<?php
    define( 'WP_USE_THEMES', FALSE );
    require( '../../../wp-load.php' );

if($_POST) {
  $to_Email = "prolivierjegaden@gmail.com";
  $dev_Email = "leads@vieeye.hu";
  $subject = __('drjegaden.com - Contact form','jegaden');
  $resp_subject = "drjegaden.com - Thank You";

  if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

    $output = json_encode(
    array(
      'type'=>'error',
      'text' => 'Request must come from Ajax'
    ));

    die($output);
  }

  if(!isset($_POST["userName"]) || !isset($_POST["userEmail"]) || !isset($_POST["userTel"])) {
    $output = json_encode(array('type'=>'error', 'text' => __('Some fields are missing','jegaden') ));
    die($output);
  }
  $user_Name = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
  $user_Email = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
  $user_Tel = filter_var($_POST["userTel"], FILTER_SANITIZE_STRING);

  $user_Topic = filter_var($_POST["userTopic"], FILTER_SANITIZE_STRING);
  $user_Message = filter_var($_POST["userMsg"], FILTER_SANITIZE_STRING);

  $user_Message = str_replace("\&#39;", "'", $user_Message);
  $user_Message = str_replace("&#39;", "'", $user_Message);

  if(strlen($user_Name)<4) {
    $output = json_encode(array('type'=>'error', 'text' => __('Full name is required','jegaden')));
    die($output);
  }
  if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) {
    $output = json_encode(array('type'=>'error', 'text' => __('E-mail is invalid','jegaden')));
    die($output);
  }
  if(strlen($user_Tel)<6) {
    $output = json_encode(array('type'=>'error', 'text' => __('Phone is required','jegaden')));
    die($output);
  }


  $headers = 'From: '.$user_Email.'' . "\r\n" .
  'Reply-To: '.$user_Email.'' . "\r\n" .
//  'BCC: '.$dev_Email.'' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

  $sentMail = @wp_mail($to_Email, $subject, 'Name: '.$user_Name. "\r\n". 'E-mail: '.$user_Email. "\r\n" .'Phone: '.$user_Tel. "\r\n" .'Topic: '.$user_Topic . "\r\n\n"  .' '.$user_Message, $headers);

  if(!$sentMail) {
    $output = json_encode(array('type'=>'error', 'text' => __('Message not sent. Please contact us on e-mail or phone!','jegaden')));
    die($output);
  } else {

    $resp_headers = 'From: '.$to_Email.'' . "\r\n" .
    'Reply-To: '.$to_Email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $resp_text=__('Dear','jegaden').' '.$user_Name.'!'."\r\n\n".
    __('Thank you for your message and interest. Please send attached any document appropriate (Clinical report, Echo, Angio report, CT scan...). My assistant will contact you shortly to answer your demand and organize further appointment.','jegaden')."\r\n\n".
    'In urgent issues, please call this number:  971 5892 58515'."\r\n\n".
    'Best regards,'."\r\n".'Pr Jegaden';
    @wp_mail($user_Email, $resp_subject, $resp_text, $resp_headers);
    $output = json_encode(array('type'=>'message', 'text' => _('Dear','jegaden').' '.$user_Name .__('! Your message has been sent. Thank You.','jegaden')));
    die($output);
  }
}

?>


<?php
  define( 'WP_USE_THEMES', FALSE );
  require( '../wp-load.php' );

if($_POST) {
  $to_Email = "szabogabi@gmail.com";
  $dev_Email = "orsolya.rozsnyai@vieeye.hu";
  $subject = __('Webes időpontfoglalás','optimum');
  $resp_subject = "Optimum Fogászat - Jelentkezés visszaigazolása";

  if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

    $output = json_encode(
    array(
      'type'=>'error',
      'text' => 'Request must come from Ajax'
    ));

    die($output);
  }

  if(!isset($_POST["userName"]) || !isset($_POST["userEmail"]) || !isset($_POST["userTel"])) {
    $output = json_encode(array('type'=>'error', 'text' => __('Hiányzó kötelező mező','optimum') ));
    die($output);
  }
  $user_Name = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
  $user_Email = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
  $user_Firm = filter_var($_POST["userFirm"], FILTER_SANITIZE_STRING);
  $user_Tel = filter_var($_POST["userTel"], FILTER_SANITIZE_STRING);
  $user_Message = filter_var($_POST["userMsg"], FILTER_SANITIZE_STRING);
  $user_Time = implode(', ', $_POST["userTime"]);
  $user_Konz = implode(', ',$_POST["userKonz"]);

  $user_Message = str_replace("\&#39;", "'", $user_Message);
  $user_Message = str_replace("&#39;", "'", $user_Message);

  $user_Message =  $user_Message. "\r\n". "\r\n". "\r\n". 'Időpontok: '. $user_Time. "\r\n".'Típusa: '.$user_Konz;

  if(strlen($user_Name)<4) {
    $output = json_encode(array('type'=>'error', 'text' => __('Teljes név megadása kötelező','optimum')));
    die($output);
  }
  if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) {
    $output = json_encode(array('type'=>'error', 'text' => __('Érvénytelen e-mail cím','optimum')));
    die($output);
  }
  if(strlen($user_Tel)<6) {
    $output = json_encode(array('type'=>'error', 'text' => __('Telefonszám megadása kötelező','optimum')));
    die($output);
  }


  $headers = 'From: '.$user_Email.'' . "\r\n" .
  'Reply-To: '.$user_Email.'' . "\r\n" .
  'BCC: '.$dev_Email.'' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

  $sentMail = @wp_mail($to_Email, $subject, 'Név: '.$user_Name. "\r\n". 'E-mail: '.$user_Email. "\r\n" .'Telefon: '.$user_Tel . "\r\n\n"  .' '.$user_Message, $headers);

  if(!$sentMail) {
    $output = json_encode(array('type'=>'error', 'text' => __('Üzenet küldése nem sikerült. Vegye fel velünk a kapcsolatot e-mailben vagy telefonon!','optimum')));
    die($output);
  } else {

    $resp_headers = 'From: '.$to_Email.'' . "\r\n" .
    'Reply-To: '.$to_Email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $resp_text=__('Tisztelt','optimum').' '.$user_Name.'!'."\r\n\n".
    __('Köszönjük jelentkezését! Levelét továbbítottuk az illetékes kollégánknak, aki hamarosan felveszi Önnel a kapcsolatot.','optimum')."\r\n\n".
    'Sürgős esetben az alábbi telefonszámon tud elérni minket: 06 30 5637 537'."\r\n\n".
    'Üdvözlettel,'."\r\n".'Optimum Fogászat';
    @wp_mail($user_Email, $resp_subject, $resp_text, $resp_headers);
    $output = json_encode(array('type'=>'message', 'text' => _('Tisztelt','optimum').' '.$user_Name .__('! Köszönjük. Időpontfoglalását továbbítottuk az illetékes kollégánknak, aki hamarosan felveszi Önnel a kapcsolatot.','optimum')));
    die($output);
  }
}

?>

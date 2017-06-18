<?php

require("..scripts/phpmailer/class.phpmailer.php");
include("..scripts/phpmailer/class.smtp.php");

$mail = new PHPMailer ();

$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = "doodlelewmacrame@gmail.com";
$mail->Password = "Knots1234";

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$formcontent="From: $name \n Message: $message";
$recipient = "doodlelewmacrame@gmail.com";
$subject = "New Message from DoodleLewMacrame Website";
$mailheader = "From: $email \r\n";
if($mail->Send()) {
  echo "Message sent!";
} else {
  echo "Mailer Error: " . $mail->ErrorInfo;
}
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Thank you for your message! We will be in contact with you shortly!" . "-" . <a href='contact.html' style='text-decoration:none;color:orange;font-family:'Raleway''>Return to Home Page</a>";


// define variables and set to empty values
$name_error = $email_error = "";
$name = $email = $message  = $success = "";

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $name_error = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $name_error = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $email_error = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Invalid email format";
    }
  }

  if (empty($_POST["message"])) {
    $message = "";
  } else {
    $message = test_input($_POST["message"]);
  }

  if ($name_error == '' and $email_error == '' ){
      $message_body = '';
      unset($_POST['submit']);
      foreach ($_POST as $key => $value){
          $message_body .=  "$key: $value\n";
      }
    }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>

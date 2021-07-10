<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../vendor/autoload.php';
require '../controller/config.php';
//Create a new PHPMailer instance
if(!isset($_POST['message']) ){
header("location:../email_maillist.php?oops");
exit();
}
foreach ($_POST['acs'] as $key) {
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;
$mail->Host = 'mail.esokoni-markets.com';
$mail->Port = 25;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'sales@esokoni-markets.com';
$mail->Password = 'mIke1998march';
$mail->Subject = 'ESOKONI MARKETS';
$mail->setFrom( 'sales@esokoni-markets.com');
  $email = $key;
  $sql = "select * from subscribe where email = '$email'";
  $res = mysqli_query($conn,$sql)->fetch_assoc();
  $name = $res['name'];
  $mail->addAddress($email);


$message = '<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Purchase Design</title>
<style>
* {
  box-sizing: border-box;
}
.column {
  width: 100%;
  padding: 10px;
}
.row:after {
  content: "";
  display: table;
  clear: both;
}
.button{
  background-color: rgb(40, 39, 98);
  border: none;
  padding: 12px;
  text-align: center;
  color: white;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
}
.text{
  text-align: left;
}

</style>
</head>
<body>
<br>

<div class="row" align="center">
  <div class="column" style="background-color:rgb(247, 241, 241);" align= "center">
    <img style="width:22%;margin-top: 3px;" src="https://esokonimarkets.com/esokonimarketslogo.png"><br>
    <p class="text,"; style="font-family: sans-serif; font-size: 25px; text-align: center;">Impacting the Tech Scene in Africa.</p>

  </div>
  <div class="column" style="background-color:white;">
    <p class="text"; style="font-family: sans-serif; font-size: 15px;">Dear '.$email.',</p>
    <p class="text"; style="font-family: sans-serif; font-size: 15px;">
    '.$_POST['message'].'
</p>
    
    
    
  </div>
</div>

<div class="row" align="center">
  <div class="column" style="background-color:rgb(247, 241, 241);" align= "center">
    <p class="text,"; style="font-family: sans-serif; font-size: 25px;">Taking your online business presence to the next Level.</p>
    <p class="text,"; style="font-family: sans-serif; font-size: 15px;">Impacting The Tech Scene By Offering You The Right Choices in The World of Changing Technologies to Boost your business.</p>
    <a href="vesencomputing.com" class="button bn">Visit Our Website Today</a>
  </div>
  <div class="column" style="background-color:white;">
    <p class="text"; style="font-family: sans-serif; font-size: 15px;">We would like to hear from you. For any questions, suggestions or comments, please contact us on:</p>
    <p class="text"; style="font-family: sans-serif; font-size: 15px;"><b>Mobile: +2540110002676<br>Email: info@vesencomputing.com<br>Location: View Park Towers 11th Floor<b></p>
     
      
  </div>
</div>
</body>
</html>';
$mail->Body = $message;
$mail->AltBody = $message;
$mail->send();
}
header("location:../email_subscribers.php?suc");
?>
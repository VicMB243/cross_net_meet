<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
include '../../../controller/config.php';
include '../../../vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = SMTP::DEBUG_OFF;
$mail->Host = 'mail.esokoni-markets.com';
$mail->Port = 25;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'sales@esokoni-markets.com';
//Password to use for SMTP authentication
$mail->Password = 'mIke1998march';
//Set who the message is to be sent from
$mail->setFrom('sales@esokoni-markets.com');
$sql = "select * from brand where brand_id = '$_SESSION[pendig]'";
$email = mysqli_query($conn,$sql)->fetch_assoc();
$link = "http://localhost/esokonireloaded/phone_view/evone01/admin/ver.php?id=esk$email[brand_id]";
$Body = '
<html>
<head>
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
  background-color: rgb(175, 71, 71);
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
<body style="margin: 0; padding: 0;">
<body>
<br>

<div class="row" align="center">
  <div class="column" style="background-color:rgb(247, 241, 241);" align= "center">
    <img style="width:22%;margin-top: 3px;" src="https://esokonimarkets.com/esokonimarketslogo.png"><br>
    <p class="text,"; style="font-family: `Lucida Sans`, sans-serif; font-size: 25px; text-align: center;">Your day to day markets at the palm of your hands.</p>

  </div>
  <div class="column" style="background-color:white;">
    <p class="text"; style="font-family: sans-serif; font-size: 15px;">Dear '.$email['brandname'].',</p>
    <p class="text"; style="font-family: sans-serif; font-size: 15px;">Thank you for registering with E-Sokoni Markets</b></p>
    <p class="text"; style="font-family: sans-serif; font-size: 15px;"><b>Your account will be approved after it is reviewed. please verify it using this link '.$link.' </b></p>
    
    
  </div>
</div>
<div class="row" align="center">
  <div class="column" style="background-color:rgb(247, 241, 241);" align= "center">
    <p class="text,"; style="font-family: sans-serif; font-size: 25px;">Are you ready to continue shopping?</p>
    <p class="text,"; style="font-family: sans-serif; font-size: 15px;">Get the best prices at the click of a button!</p>
    <a class="button bn" href="esokonimarkets.com">Continue shopping</a>
  </div>
  <div class="column" style="background-color:white;">
    <p class="text"; style="font-family: sans-serif; font-size: 15px;">We would like to hear from you. For any questions, suggestions or comments, please contact us on:</p>
    <p class="text"; style="font-family: sans-serif; font-size: 15px;"><b>Mobile: +2540110002676<br>Email: sales@esokonimarkets.com<br>Location: View Park Towers 11th Floor<b></p>
     
      
  </div>
</div>
</body>
</html>';
$message = "empty";
//Replace the plain text body with one created manually
$mail->AltBody = $message;
$em = $email['email'];
$mail->addAddress($em);
$mail->addAddress('ndungu.murimi@gmail.com');
$mail->Body = $Body;
//Attach an image file
//$mail->addAttachment('../uploads/bg.jpg');
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
	unset($_SESSION['pendig']);
$_SESSION['ever']="";
		//echo $em;
    header("location:../phone_view/evone01/admin/brandlogin.php");
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
?>
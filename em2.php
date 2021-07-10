<?php
use PHPMailer\PHPMailer\PHPMailer;
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
require 'controller/config.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages

$mail->SMTPDebug = SMTP::DEBUG_OFF;
//Set the hostname of the mail server
$mail->Host = 'mail.esokoni-markets.com';
$mail->Port = 25;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'esokoni@esokoni-markets.com';
$mail->Password = '.2I[mn9Ay9Wx5D';
$mail->setFrom('esokoni@esokoni-markets.com');

if (isset($_POST['email'])) {
$email = mysqli_real_escape_string($conn,$_POST['email']);
$sql = "select * from organisation where email = '$email'";
$res = mysqli_query($conn,$sql);
if (mysqli_num_rows($res) == 1) {
$res = $res->fetch_assoc();
$message1 = '<html>
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
#Product {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#Product td, #Product th {
  border: 1px solid #ddd;
  padding: 8px;
}
#Product th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: rgb(175, 71, 71);
  color: white;
}
#shipping {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top: 18px;
}

#shipping td, #shipping th {
  border: 1px solid #ddd;
  padding: 8px;
}
#shipping th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: rgb(175, 71, 71);
  color: white;
}

</style>
</head>
<body>
<br>

<div class="row" align="center">
  <div class="column" style="background-color:rgb(247, 241, 241);" align= "center">
<img style="width:22%;margin-top: 3px;" src="https://crossnetmeet.com/admin/images/logo.jpeg"><br>
<p class="text,"; style="font-family: `Lucida Sans`, sans-serif; font-size: 25px; text-align: center;">Meeting Coordination Made Easy.</p>

  </div>
  <div class="column" style="background-color:white;">
<p class="text"; style="font-family: sans-serif; font-size: 15px;">Hello '.$res['name'].'</p>';

$message2 = "
<p class='text'; style='font-family: sans-serif; font-size: 15px;''><b>follow this link to rest ypur password: 
 https://crossnetmeet.com/admin/em3.php?s=".$_POST['email']." </p></div>
";
$message_3 = '</div>

<div class="row" align="center">
  
  <div class="column" style="background-color:white;">
<p class="text"; style="font-family: sans-serif; font-size: 15px;">We would like to hear from you. For any questions, suggestions or comments, please contact us on:</p>
<p class="text"; style="font-family: sans-serif; font-size: 15px;"><b>Mobile: +2540110002676<br>Email: info@crossnetmeet.com<br>Location: Mount Kenneth Apartments, Dock Road <b></p>
 
  
  </div>
</div>
</body>
</html>' ;
$message = $message1.$message2.$message_3;

}else{
  header("location:forgot-password.php?response=wecantfindthatemailaddress");
  exit();
}}else{
    header("location:index.php?oops");
    exit();
}
//Set who the message is to be sent to
$mail->addAddress($email);

//Set the subject line
$mail->Subject = 'CHANGE PASSWORD';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body

$mail->Body = $message;
//Replace the plain text body with one created manually
$mail->AltBody = $message;
//Attach an image file
//$mail->addAttachment('../uploads/bg.jpg');
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: '. $mail->ErrorInfo;
} else {
$_SESSION['changepwd'] = "";
header("location:forgot-password.php?response=checkyouremailaddressforthelinktoresetyourpassword");
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}
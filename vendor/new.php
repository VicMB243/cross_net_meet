<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'autoload.php';
require '../controller/config.php';
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
$mail->Host = 'mail.vesencomputing.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'info@vesencomputing.com';
//Password to use for SMTP authentication
$mail->Password = 'mike!@#123';
//Set who the message is to be sent from
$mail->setFrom('info@vesencomputing.com');
if (isset($_POST['email'])) {

    $email = $_POST['email'];
     $message1 = 'your product details are as follows '.'
<table border =1>
  
  <th>Name</th>
  <th>Description</th>
  <th>Prize</th>
  ';
$message2 = "";
$total = 0;
foreach ($_POST['pid'] as $key) {
$sql_products = "select * from products where id = '$key'";
$row = mysqli_query($conn,$sql_products)->fetch_assoc();
$message2 = $message2 . "
<tr>

<td>".$row['name']."</td>
<td>".$row['description']."</td>
<td>".$row['prize']."</td>

</tr>
";
$total = $total + $row['prize'];
}

$message3 = "</table><br>";
$message = $message1." ".$message2." ".$message3."total fee is ".$total.".";

}else{
    $message = 'testing';
    $email = 'michael1998march@gmail.com';
}
//Set who the message is to be sent to
$mail->addAddress('michael1998march@gmail.com');
//Set the subject line
$mail->Subject = 'DELIVERY DETAILS';
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
    foreach ($_SESSION['cart'] as $key ) {
	unset($_SESSION['cart'][$key]);
}
    header("location:../website/checkout.php?rt");
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
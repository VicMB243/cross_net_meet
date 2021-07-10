<?php
include '../../crossnetmeet/api/m.php';
include '../../crossnetmeet/api/email_messages.php';
$r = new email();
$p = new email_messages();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../vendor/autoload.php';
require '../controller/config.php';
//Create a new PHPMailer instance
if(!isset($_POST['message']) ){
header("location:../emailusers2.php?oops");
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
$subject = 'CROSSNETMEET';
$mail->setFrom( 'sales@esokoni-markets.com');
  $email = $key;
  $sql = "select * from register where email = '$email'";
  $res = mysqli_query($conn,$sql)->fetch_assoc();
  $name = $res['name'];
  $mail->addAddress($email);


$message = '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:v="urn:schemas-microsoft-com:vml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="width=device-width" name="viewport" />
<!--[if !mso]><!-->
<meta content="IE=edge" http-equiv="X-UA-Compatible" />
<!--<![endif]-->
<title></title>
<!--[if !mso]><!-->
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css" />
<!--<![endif]-->
<style type="text/css">
    body {
        margin: 0;
        padding: 0;
    }

    table,
    td,
    tr {
        vertical-align: top;
        border-collapse: collapse;
    }

    * {
        line-height: inherit;
    }

    a[x-apple-data-detectors=true] {
        color: inherit !important;
        text-decoration: none !important;
    }
</style>
<style id="media-query" type="text/css">
    @media (max-width: 700px) {

        .block-grid,
        .col {
            min-width: 320px !important;
            max-width: 100% !important;
            display: block !important;
        }

        .block-grid {
            width: 100% !important;
        }

        .col {
            width: 100% !important;
        }

        .col_cont {
            margin: 0 auto;
        }

        img.fullwidth,
        img.fullwidthOnMobile {
            max-width: 100% !important;
        }

        .no-stack .col {
            min-width: 0 !important;
            display: table-cell !important;
        }

        .no-stack.two-up .col {
            width: 50% !important;
        }

        .no-stack .col.num2 {
            width: 16.6% !important;
        }

        .no-stack .col.num3 {
            width: 25% !important;
        }

        .no-stack .col.num4 {
            width: 33% !important;
        }

        .no-stack .col.num5 {
            width: 41.6% !important;
        }

        .no-stack .col.num6 {
            width: 50% !important;
        }

        .no-stack .col.num7 {
            width: 58.3% !important;
        }

        .no-stack .col.num8 {
            width: 66.6% !important;
        }

        .no-stack .col.num9 {
            width: 75% !important;
        }

        .no-stack .col.num10 {
            width: 83.3% !important;
        }

        .video-block {
            max-width: none !important;
        }

        .mobile_hide {
            min-height: 0px;
            max-height: 0px;
            max-width: 0px;
            display: none;
            overflow: hidden;
            font-size: 0px;
        }

        .desktop_hide {
            display: block !important;
            max-height: none !important;
        }
    }
</style>
<style id="icon-media-query" type="text/css">
    @media (max-width: 700px) {
        .icons-inner {
            text-align: center;
        }

        .icons-inner td {
            margin: 0 auto;
        }
    }
</style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #ffffff;">
<!--[if IE]><div class="ie-browser"><![endif]-->

<table bgcolor="#ffffff" cellpadding="0" cellspacing="0" class="nl-container" role="presentation"
       style="table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; width: 100%;"
       valign="top" width="100%">

<tbody>

<tr style="vertical-align: top;" valign="top">

<td style="word-break: break-word; vertical-align: top;" valign="top">

<!--[if (mso)|(IE)]>
<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#ffffff"><![endif]-->



<div style="background-color:transparent;">

<div class="block-grid"
     style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #67357a;">

<div style="border-collapse: collapse;display: table;width: 100%;background-color:#ffffff;">


<div
style="color:#000000;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div
style="line-height: 1.2; font-size: 12px; color: #f7fbec; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 14px;">
<div class="row" align="center">
  <div class="column" style="background-color:rgb(103, 53, 122);" align= "center">
    <img style="width:22%;margin-top: 3px;" src="https://crossnetmeet.com/images/main_logo_reduced.png">
    <p class="text,"; style="font-family: sans-serif; font-size: 25px; text-align: center;">Meeting Cordination Made Simpler.</p>

  </div>


</div>

<div
style="line-height: 1.5; font-size: 12px; color: #67357a; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 18px;">


<!-- <p style="text-align: center; line-height: 1.5; word-break: break-word; mso-line-height-alt: 18px; margin: 0;"><strong><span style="font-size: 38px;"> Welcome to </span></strong></p> -->
<p class="text"; style="font-family: sans-serif; font-size: 15px;">Dear:  '.$email.',</p>
<p
style="text-align: left; line-height: 1.5; word-break: break-word; mso-line-height-alt: 18px; margin: 0;">
<span style="font-size: 38px;"> '.$_POST['message'].'
                        </span></strong>
</p>


</div>

<div style="background-color:transparent;">

<div class="block-grid"
     style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #67357a;">

<div
style="border-collapse: collapse;display: table;width: 100%;background-color:#67357a;">


<div class="col num12"
     style="min-width: 320px; max-width: 680px; display: table-cell; vertical-align: top; width: 680px;">

<div class="col_cont" style="width:100% !important;">

<!--[if (!mso)&(!IE)]><!-->

<div
style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">

<!--<![endif]-->

<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->

<div
style="color:#f7fbec;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">

<div
style="line-height: 1.2; font-size: 12px; color: #f7fbec; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 14px;">

<p
style="text-align: center; line-height: 1.2; word-break: break-word; font-size: 28px; mso-line-height-alt: 34px; margin: 0;">
                              <span style="font-size: 28px;"> New To CrossNetMeet ? </span>
</p>

</div>

<div style="background-color:transparent;">
<div class="block-grid" style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #67357a;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#67357a;">
<div class="col num12" style="min-width: 320px; max-width: 680px; display: table-cell; vertical-align: top; width: 680px;">
<div class="col_cont" style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->

<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
</div>
</div>
</div>


</td>
</tr>
</tbody>
</table>
<!--[if (IE)]></div><![endif]-->
</body>
</html>
</div>

<!--[if mso]></td></tr></table><![endif]-->

<!--[if (!mso)&(!IE)]><!-->

</div>

<!--<![endif]-->

</div>

</div>

<!--[if (mso)|(IE)]></td></tr></table><![endif]-->

<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->

</div>

</div>

</div>
<div style="background-color:transparent;">

<div class="block-grid"
     style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #67357a;">

<div
style="border-collapse: collapse;display: table;width: 100%;background-color:#67357a;">

<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:680px"><tr class="layout-full-width" style="background-color:#67357a"><![endif]-->

<!--[if (mso)|(IE)]><td align="center" width="680" style="background-color:#67357a;width:680px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:10px; padding-bottom:5;"><![endif]-->

<div class="col num12"
     style="min-width: 320px; max-width: 680px; display: table-cell; vertical-align: top; width: 680px;">

<div class="col_cont" style="width:100% !important;">

<!--[if (!mso)&(!IE)]><!-->

<div
style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:5; padding-right: 0px; padding-left: 0px;">

<!--<![endif]-->

<div align="center" class="button-container"
     style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">

<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://www.example.com" style="height:33pt; width:188.25pt; v-text-anchor:middle;" arcsize="10%" strokeweight="0.75pt" strokecolor="#F7FBEC" fill="false"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#f7fbec; font-family:Tahoma, Verdana, sans-serif; font-size:16px"><![endif]--><a
href="https://www.crossnetmeet.com"
style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #f7fbec; background-color: transparent; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; width: auto; width: auto; border-top: 1px solid #F7FBEC; border-right: 1px solid #F7FBEC; border-bottom: 1px solid #F7FBEC; border-left: 1px solid #F7FBEC; padding-top: 5px; padding-bottom: 5px; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;"
target="_blank"><span
style="padding-left:50px;padding-right:50px;font-size:16px;display:inline-block;"><span
style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">Visit our Website
                  </span></span></a>


</div>


</div>


</div>

</div>


</div>

</div>

</div>
<div style="background-color:transparent;">

<div class="block-grid"
     style="min-width: 320px; max-width: 680px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; background-color: #67357a;">

<div
style="border-collapse: collapse;display: table;width: 100%;background-color:#67357a;">

<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:680px"><tr class="layout-full-width" style="background-color:#67357a"><![endif]-->

<!--[if (mso)|(IE)]><td align="center" width="680" style="background-color:#67357a;width:680px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 20px; padding-left: 20px; padding-top:5; padding-bottom:10px;"><![endif]-->

<div class="col num12"
     style="min-width: 320px; max-width: 680px; display: table-cell; vertical-align: top; width: 680px;">

<div class="col_cont" style="width:100% !important;">

<!--[if (!mso)&(!IE)]><!-->

<div
style="border-top:0px solid transparent;
border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5; padding-bottom:10px; padding-right: 20px; padding-left: 20px;">


<!--<![endif]-->




<div
style="color:#f7fbec;font-family:Lato, Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">

<div
style="line-height: 1.2; font-size: 12px; color: #f7fbec; font-family: Lato, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 14px;">

<p
style="font-size: 12px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 14px; margin: 0;">
                              <span style="font-size: 12px;">2021 &#169; All Rights
                                Reserved</span>
</p>

</div>

</div>



</div>

<!--<![endif]-->

</div>

</div>

<!--[if (mso)|(IE)]></td></tr></table><![endif]-->

<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->

</div>

</div>

</div>
</td>

</tr>

</tbody>

</table>

<!--[if (IE)]></div><![endif]-->

</body>
</html>';
$mail->Body = $message;
$mail->AltBody = $message;
$r->send_email($message,$email,$subject);
}
header("location:../emailusers2.php?suc");
?>
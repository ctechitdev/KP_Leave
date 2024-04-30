<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

session_start();



$request_id = $_SESSION["request_id"];
$Full_name = $_SESSION["Full_name"];
$reason = $_SESSION["reason"];
$leave_name = $_SESSION["leave_name"];
$start_date = $_SESSION["start_date"];
$to_date = $_SESSION["to_date"];
$app_email = $_SESSION["app_email"];

$depart_name = $_SESSION["depart_name"];
$position_name = $_SESSION["position_name"];
$line_token = $_SESSION["line_token"]; 

$_SESSION['message_request'] = "success";

//echo "$app_email";


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$mail->CharSet = 'UTF-8';
//Server settings
$mail->SMTPDebug = 0;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.kplaocompany.com';                  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = 'tuidev1919@gmail.com';             // SMTP username
// $mail->Password = 'tui@Dev2020';                           // SMTP password
$mail->Username = 'ict-noreply@kplaocompany.com';             // SMTP username
$mail->Password = 'INoRePly@ict20';
$mail->SMTPSecure = 'Auto';                            // Enable SSL encryption, TLS also accepted with port 465
$mail->Port = 25;                                    // TCP port to connect to

//Recipients
$mail->setFrom('ict-noreply@kplaocompany.com', 'ICT Leave System');          //This is the email your form sends From
$mail->addAddress($app_email); // Add a recipient address


//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = " ເລກທີຂໍລາພັກ : $request_id  ";
$mail->Body    = " 
 
	<div> ຊື່ນາມສະກຸນ: $Full_name </div> 
	<div> ຕຳແໜ່ງ:$position_name  ພະແນກ/ໜ່ວຍງານ : $depart_name </div> 
	<div> ຂໍລາພັກ: $leave_name </div> 
	<div> ເຫດຜົນ: $reason  </div> 
	<div> ຕັ້ງແຕ່ວັນທີ: $start_date </div>
	<div> ຫາວັນທີ: $to_date </div>  
	https://www.kplaocompany.com/KP_Leave/Login.php
	
	";

 

header("location:leave_request.php");


$mail->send();




$url = 'https://notify-api.line.me/api/notify';
$token      = "$line_token";
$headers    = [
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Bearer ' . $token
];
$fields     = "message=  ທ່ານມີ E-Mail ເຂົ້າ ";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

var_dump($result);
$result = json_decode($result, TRUE);

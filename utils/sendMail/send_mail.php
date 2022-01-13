<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require '../storage/framework/vendor/autoload.php';
// require '../storage/framework/phpMailer/vendor/autoload.php';
// require '../storage/framework/phpMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require '../storage/framework/phpMailer/vendor/phpmailer/phpmailer/src/SMTP.php';
// require '../storage/framework/phpMailer/vendor/phpmailer/phpmailer/src/EXception.php';

// require_once 'E:\Xamppp_Nam4\htdocs\basicPHP\BEApi\phpbasic\storage\framework\PHPMailer\src\Exception.php';
// require_once 'E:\Xamppp_Nam4\htdocs\basicPHP\BEApi\phpbasic\storage\framework\PHPMailer\src\PHPMailer.php';
// require_once 'E:\Xamppp_Nam4\htdocs\basicPHP\BEApi\phpbasic\storage\framework\PHPMailer\src\SMTP.php';


require_once dirname(dirname(__DIR__)) . '\storage\framework\PHPMailer\src\Exception.php';
require_once dirname(dirname(__DIR__)) . '\storage\framework\PHPMailer\src\PHPMailer.php';
require_once dirname(dirname(__DIR__)) . '\storage\framework\PHPMailer\src\SMTP.php';
//AAAAAAA

function sendPHPmailer($email)
{
    //Instantiation and passing 'true' enables exceptions
    $code = "";
    $mail = new PHPMailer(true);
    try {
        //Enable verbose debug ouput
        $mail->SMTPDebug = 0; // SMTP::DEBUG_SERVER'

        //Send using SMTP
        $mail->isSMTP();

        //Set the SMTP server to send throught
        $mail->Host = 'smtp.gmail.com';

        //Enable SMTP authentication
        $mail->SMTPAuth = true;

        //SMTP username
        $mail->Username = 'baophamquang0@gmail.com';

        //SMTP password
        $mail->Password = 'bao123321';

        //Enable TLS encryption;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPSecure = "tls";


        //TCP port to connect to, user 465 for 'PHPMailer""ENCRYPTON_SMTPS' above
        // $mail->Port = 465;
        $mail->Port = 587;

        //Recipoents
        $mail->setFrom('baophamquang0@gmail.com', 'FBI-Warning.com');

        //Add a recipient
        $mail->addAddress($email);
        //echo "addAddress: $this->name, $this->getEmail";

        //Set email format to HTML
        $mail->isHTML(true);

        $verify_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $code = $verify_code;
        $mail->Subject = 'Email verification';
        $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verify_code . '</b></p>';

        $mail->AltBody = 'Body in plain text for non-HTML mail clients';

        
        $mail->send();
        
        //insert table verify1

        //
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        echo "|Message error: $e|";
    }
    return $code;
}

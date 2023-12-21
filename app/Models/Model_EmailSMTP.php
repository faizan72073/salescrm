<?php namespace App\Models;

use CodeIgniter\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//
require APPPATH.'/Libraries/PHPMailer/src/Exception.php';
require APPPATH.'/Libraries/PHPMailer/src/PHPMailer.php';
require APPPATH.'/Libraries/PHPMailer/src/SMTP.php';
//
class Model_EmailSMTP extends Model {
	
	public function __construct(){

		parent::__construct();
		$this->db = \Config\Database::connect();
	}
  //
  public function email_settings($id=1){
		$db = \Config\Database::connect();
		//
		$builder = $db->table('email_settings');
		if(!empty($id)){
			$builder->where('id',$id);
		}
		return $builder;
	}
	//
	public function sendMail($to, $subject, $message,$cc=null){
    $emailConfig = $this->email_settings(1)->get()->getRow();
		$mail = new PHPMailer(true);
		try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;      //Enable verbose debug output
    $mail->isSMTP();                               //Send using SMTP
    $mail->Host       = $emailConfig->host;         //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                       //Enable SMTP authentication
    $mail->Username   = $emailConfig->email;        //SMTP username
    $mail->Password   = $emailConfig->password;      //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port       = $emailConfig->port;   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom($emailConfig->sent_email, $emailConfig->sent_title);
    $mail->addAddress($to);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('shakil.anjum@gmail.com', 'Information');
    if(!empty($cc)){
    	$mail->addCC($cc);
    }
    // $mail->addBCC('bcc@example.com');
    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name
    //Content
    $mail->isHTML(true);  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    echo ' Email also sent';
} catch (Exception $e) {
	echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
   }
 }


}
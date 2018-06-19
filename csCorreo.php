<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
   include 'src/Exception.php';
   include 'src/PHPMailer.php';
   include 'src/SMTP.php';
   
    class csCorreo
    {
        
        function correo($correo , $html ,$msn)
        {
            $mail = new PHPMailer(false);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail -> setLanguage ( ' es ' , 'src/phpmailer.lang-es.php' );
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = '';                 // SMTP username
                $mail->Password = '';                           // SMTP password
                $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('');
                $mail->addAddress($correo);     // Add a recipient
                $mail->addAddress('');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Apptivos Código de activación';
                $mail->Body    = $html;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo $msn;
                return true;
            } catch (Exception $e) {
                echo 'El Mensaje no fue enviado Error: ', $mail->ErrorInfo;
                return false;
            }
        }
    }
    //$csCorreo= new csCorreo();
    //$csCorreo->correo('macifuentes09@misena.edu.co','Migueloc22','ok');
?>
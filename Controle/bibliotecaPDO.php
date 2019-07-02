<?php


class bibliotecaPDO {

    private $pontos;

    public function __construct() {
        if (realpath("./index.php")) {
            $this->pontos = './';
        } else {
            if (realpath("../index.php")) {
                $this->pontos = '../';
            } else {
                if (realpath("../../index.php")) {
                    $this->pontos = '../../';
                }
            }
        }
    }

    function composer() {
        if (!realpath($this->pontos . "Scripts/composer.bat")) {
            header("location: " . $this->pontos . "Tela/solicitaPhp.php");
        } else {
            shell_exec("..\Scripts\composer.bat");
            header('location: ../index.php?msg=instalado');
        }
    }

    function html2pdf() {
        if (!realpath($this->pontos . "Scripts/composer.bat")) {
            header("location: " . $this->pontos . "Tela/solicitaPhp.php");
        } else {
            set_time_limit(600);
            shell_exec("..\Scripts\html2pdf.bat");
            set_time_limit(30);
            $conteudo = "<?php
    require '../vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;

    \$html2pdf = new Html2Pdf();
    \$html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
    \$html2pdf->output();";
            mkdir("../Exemplo");
            file_put_contents("../Exemplo/exemplohtml2pdf.php", $conteudo);
            header('location: ../index.php?msg=instalado');
        }
    }

    function phpmailer() {
        if (!realpath($this->pontos . "Scripts/composer.bat")) {
            header("location: " . $this->pontos . "Tela/solicitaPhp.php");
        } else {
            set_time_limit(600);
            shell_exec("..\Scripts\phpmailer.bat");
            set_time_limit(30);
            $conteudo = "<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
\$mail = new PHPMailer(true);

try {
    //Server settings
    \$mail->SMTPDebug = 2;                                       // Enable verbose debug output
    \$mail->isSMTP();                                            // Set mailer to use SMTP
    \$mail->Host       = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
    \$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    \$mail->Username   = 'user@example.com';                     // SMTP username
    \$mail->Password   = 'secret';                               // SMTP password
    \$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    \$mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    \$mail->setFrom('from@example.com', 'Mailer');
    \$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    \$mail->addAddress('ellen@example.com');               // Name is optional
    \$mail->addReplyTo('info@example.com', 'Information');
    \$mail->addCC('cc@example.com');
    \$mail->addBCC('bcc@example.com');

    // Attachments
    \$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    \$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    \$mail->isHTML(true);                                  // Set email format to HTML
    \$mail->Subject = 'Here is the subject';
    \$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    \$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    \$mail->send();
    echo 'Message has been sent';
} catch (Exception \$e) {
    echo \"Message could not be sent. Mailer Error: {\$mail->ErrorInfo}\";
}";
            mkdir("../Exemplo");
            file_put_contents("../Exemplo/exemplophpmailer.php", $conteudo);
            header('location: ../index.php?msg=instalado');
        }
    }

}

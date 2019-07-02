<?php

class scriptPDO {

    function criarTudo() {
        $local = $_POST['local'];
        $resultado = shell_exec($local . " -version");
        if (preg_match('/^PHP/', $resultado)) {

            $conteudo = "cd ..
$local -r \"copy('https://getcomposer.org/installer', 'composer-setup.php');\"
$local -r \"if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;\"
$local composer-setup.php
$local -r \"unlink('composer-setup.php');\"
";
            file_put_contents("../Scripts/composer.bat", $conteudo);

            $conteudo = "cd..
$local composer.phar require spipu/html2pdf
";
            file_put_contents("../Scripts/html2pdf.bat", $conteudo);

            $conteudo = "cd..
$local composer.phar require phpmailer/phpmailer";

            file_put_contents("../Scripts/phpmailer.bat", $conteudo);
            header("location: ../index.php?msg=phpinstalado");
        } else {
            header("location: ../Tela/solicitaPhp.php?msg=phpnaolocalizado");
        }
    }

}

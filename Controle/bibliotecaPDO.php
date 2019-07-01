<?php

$pontos = "";
if (realpath("./index.php")) {
    $pontos = './';
} else {
    if (realpath("../index.php")) {
        $pontos = '../';
    } else {
        if (realpath("../../index.php")) {
            $pontos = '../../';
        }
    }
}

class bibliotecaPDO {

    function composer() {
        shell_exec("..\Scripts\composer.bat");
        header('location: ../index.php?msg=instalado');
    }

    function html2pdf() {
        echo "<h1>Instalando...</h1>";
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

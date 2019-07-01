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
        shell_exec("..\Scripts\html2pdf.bat");
        $conteudo = "require '../vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;

    \$html2pdf = new Html2Pdf();
    \$html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
    \$html2pdf->output();";
        file_put_contents("../Exemplos/exemplohtml2pdf.php", $conteudo);
        header('location: ../index.php?msg=instalado');
    }

}

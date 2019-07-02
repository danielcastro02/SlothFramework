<?php

$conteudo = file_get_contents("./listaarquivos.txt");
$vetor = explode(";", $conteudo);
foreach ($vetor as $arquivo){
    $arquivo2 = trim($arquivo);
    unlink($arquivo2);
}
file_put_contents("../index.php", "<h1>HelloWorld</h1>");
rmdir("../Scripts");
header("location: ../index.php");
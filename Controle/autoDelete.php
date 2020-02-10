<?php
include_once '../Base/requerLogin.php';
?><?php

$conteudo = file_get_contents("./listaarquivos.txt");
$vetor = explode(";", $conteudo);
foreach ($vetor as $arquivo){
    $arquivo2 = trim($arquivo);
    unlink($arquivo2);
}
file_put_contents("../index.php", "<!DOCTYPE html>
<?php
if (isset(\$_SESSION['logado'])) {
    header('location: ../Tela/home.php');
}
?>

<html>
    <head>
        <meta charset=\"UTF-8\">
        <title>Login</title>
        <?php
        include_once './Base/header.php';
        ?>
    <body class=\"homeimg\">
        <?php
        include_once './Base/navBar.php';
        ?>
        <main>
           
        </main>
        <?php
        include_once './Base/footer.php';
        ?>
    </body>
</html>

");
rmdir("../Scripts");
header("location: ../index.php");
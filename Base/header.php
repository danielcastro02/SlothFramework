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
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" href="<?php echo $pontos; ?>css/materialize.css">
<link rel="stylesheet" href="<?php echo $pontos; ?>css/custom.css">
<link rel="shortcut icon" href="<?php echo $pontos; ?>Img/Src/favicon.png">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script type="text/javascript" src="<?php echo $pontos; ?>js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo $pontos; ?>js/materialize.js"></script>
<script type="text/javascript" src="<?php echo $pontos; ?>/js/main.js" ></script>
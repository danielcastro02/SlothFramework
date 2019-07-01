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

<footer class="center black">
    <div class="footer-copyright white-text"><a target="_blank" href="http://markeyvip.com" class="center col l10 s12 offset-l1 white-text">
            © 2019 Developed by - Markey</a>
    </div>
</footer>


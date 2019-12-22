<?php
if (!isset($_SESSION)) {
    session_start();
}

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

include_once $pontos . 'Base/header.php';

if (isset($_SESSION['toast'])) {
    $tempo = 0;
    foreach ($_SESSION['toast'] as $toast) {
        ?>
        <script>

            setTimeout(function () {
                if (typeof  interfaceAndroid !== 'undefined') {
                    toast.makeToast("<?php echo $toast ?>");

                }
                M.toast({html: '<?php echo $toast ?>', classes: 'rounded'});
            }, <?php echo $tempo ?>);
        </script>
        <?php
        $tempo = $tempo + 500;
    }
    $_SESSION['toast'] = null;
}

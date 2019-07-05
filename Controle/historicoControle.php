<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/historicoPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/historicoPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/historicoPDO.php';
        }
    }
}

$classe = new historicoPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}


<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/patrimonioPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/patrimonioPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/patrimonioPDO.php';
        }
    }
}

$classe = new patrimonioPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}


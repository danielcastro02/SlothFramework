<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/testePDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/testePDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/testePDO.php';
        }
    }
}

$classe = new testePDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}


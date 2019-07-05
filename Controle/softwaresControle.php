<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/softwaresPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/softwaresPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/softwaresPDO.php';
        }
    }
}

$classe = new softwaresPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}


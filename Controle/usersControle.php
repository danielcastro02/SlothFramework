<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/usersPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/usersPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/usersPDO.php';
        }
    }
}

$classe = new usersPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}


<?php

if (!isset($_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/evt_rotinaPDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/evt_rotinaPDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/evt_rotinaPDO.php';
        }
    }
}

$classe = new evt_rotinaPDO();

if (isset($_GET['function'])) {
    $metodo = $_GET['function'];
    $classe->$metodo();
}


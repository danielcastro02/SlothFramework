<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/scriptPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/scriptPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/scriptPDO.php";
            
        }
    }
}
$classe = new scriptPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}
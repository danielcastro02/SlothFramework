<?php

if (!isset($_SESSION)) {
    session_start();
}
if (realpath("./index.php")) {
    include_once "./Controle/bancoPDO.php";
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/bancoPDO.php";
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/bancoPDO.php";
            
        }
    }
}
$classe = new bancoPDO();

if (isset($_GET["function"])) {
    $metodo = $_GET["function"];
    $classe->$metodo("");
}
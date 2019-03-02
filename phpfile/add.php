<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$nazwa = $_POST['nazwa'];
$skladniki = $_POST['skladniki'];

$c_m = $_POST['cena_malej_pizzy'];
$c_s = $_POST['cena_sredniej_pizzy'];
$c_d = $_POST['cena_duzej_pizzy'];
$_SESSION['dodano'] = FALSE;
if($nazwa ==="" || $skladniki === "" || $c_d == "")
{
    $_SESSION['niedodano'] = false;
    header('Location: ../zalogowany.php');
    exit();
}

require_once './connect.php';
$polanczenie = new mysqli($host, $db_user, $db_password, $db_name);
if ($polanczenie->connect_errno != 0) {
    echo 'Error: ' . $polanczenie->connect_errno;
} else {
    $polanczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
    if (($rezulat = $polanczenie->query("INSERT INTO menu_pizza (id,Nazwa,Składniki,Cena_Mała,Cena_Średnia,Cena_Duża)"
            . " values (null,'$nazwa','$skladniki','$c_m','$c_s','$c_d')")) !== 0) {
        $_SESSION['dodano'] = true;
        header('Location: ../zalogowany.php');
    }
    else {
        header('Location: ../zalogowany.php');
        $_SESSION['dodano'] = FALSE;
    }
    $polanczenie->close();
}
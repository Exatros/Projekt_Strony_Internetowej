<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$id = $_POST['nrStolika'];
$mess = $_POST['mess'];

require_once './connect.php';
$polanczenie = new mysqli($host, $db_user, $db_password, $db_name);
if ($polanczenie->connect_errno != 0) {
    echo 'Error: ' . $polanczenie->connect_errno;
} else {
    $polanczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
    if (($rezulat = $polanczenie->query("UPDATE rezerwacja_miejsca SET Imie='$imie', Nazwisko='$nazwisko'"
            . ", Rezerwacja = 1, Dodatkowe_informacje='$mess' WHERE id=$id")) !== 0) {

        
        $_SESSION['zarezerwowano'] = true;
        $_SESSION['imie'] = $imie;
        $_SESSION['nazwisko'] = $nazwisko;
        $_SESSION['id'] = $id;
        $polanczenie->close();
    }
}
header('Location: ../rezerwacja.php');
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$id = $_POST['action'];
require_once './connect.php';

$polanczenie = new mysqli($host, $db_user, $db_password, $db_name);
if ($polanczenie->connect_errno != 0) {
    echo 'Error: ' . $polanczenie->connect_errno;
} else {
    $polanczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
    if (($rezulat = $polanczenie->query("UPDATE rezerwacja_miejsca SET `Imie` = '', `Nazwisko` = ''"
            . ", `Dodatkowe_informacje` = '', `Rezerwacja` = '0' WHERE id=$id")) !== 0) {
        echo 'Rezerwacja została usunieta';
        $polanczenie->close();
    }
}
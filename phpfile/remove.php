<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// call removeday() here
$id = $_POST['action'];
require_once './connect.php';

$polanczenie = new mysqli($host, $db_user, $db_password, $db_name);
if ($polanczenie->connect_errno != 0) {
    echo 'Error: ' . $polanczenie->connect_errno;
} else {
    $polanczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
    if (($rezulat = $polanczenie->query("Delete menu_pizza from menu_pizza WHERE id=$id")) !== 0) {
        echo 'Udało sie usunąć produkt';
        $polanczenie->close();
    }
}

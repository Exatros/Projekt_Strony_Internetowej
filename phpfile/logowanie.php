<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$login = $_POST['login'];
$password = $_POST['password'];
$_SESSION['zalogowano'] = FALSE;


if($login === 'admin' && $password === 'admin')
{
    header('Location: ../zalogowany.php');
    $_SESSION['zalogowano'] = true;
}
 else {
    header('Location: ../admin.php');
}
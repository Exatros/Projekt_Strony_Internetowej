<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (isset($_SESSION['zalogowano']) && $_SESSION['zalogowano'] == true) {
    header('Location: zalogowany.php');
    exit();
}
?>
<html>
    <head>
        <title>Pizza Galicja</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Pizzeria Galicja</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Strona Główna</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="rezerwacja.php">Rezerwacja</a></li>


                </ul>
            </div>

        </nav>

        <div class="container" style="text-align: center">
            <div class="row">

                    <center><img src="img/Pizza-logos.png" alt="pizza_logo" class="img-responsive" style="width: 25%;height: 25%"></center>
            <form id="formularz" method="post" action="phpfile/logowanie.php">
                <div class="form-group">
                    <label for="login">Login</label>
                    <input class="form-control-static" placeholder="Login" id="login" name="login" type="text">
                </div>

                <div class="form-group">
                    <label for="password">Hasło </label>
                    <input type="password" class="form-control-static" placeholder="password" id="password" name="password">
                    <?php
                    if (isset($_SESSION['zalogowano']) && $_SESSION['zalogowano'] == false) {
                        echo '<p>Niepoprawne dane</p>';
                    }
                    ?>
                </div>

                <button type="submit" class="btn btn-default" id="button">Zaloguj</button>
            </form>
            </div>
        </div>
    </body>
</html>

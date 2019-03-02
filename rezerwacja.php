<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
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
    <body style="background-color: #333333">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Pizzeria Galicja</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Strona Główna</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li class="active"><a href="rezerwacja.php">Rezerwacja</a></li>
                                        <?php
                    if (isset($_SESSION['zalogowano']) && $_SESSION['zalogowano'] == TRUE) {
                        echo '<li><a href="zalogowany.php">Dodawanie Produktów</a></li>
                              <li><a href="rezerwacje.php">Rezerwacje</a></li>';
                    }
                    ?>
                </ul>
                <?php
                if (isset($_SESSION['zalogowano']) && $_SESSION['zalogowano'] == TRUE) {
                    echo '<ul class = "nav navbar-nav navbar-right">
                    <li><a href = "phpfile/logout.php">Wyloguj</a></li>

                    </ul>';
                }
                ?>
            </div>
        </nav>
        <br><br>
        <div class="container">
            <img src="img/jamies-italian-cambridge-interior-desktop.jpg" class="img-responsive" alt="">
        </div>
        <div class="container" style="background-color: #cccccc">
            <br>

            <form id="formularz" method="post" action="phpfile/wyslanie_danych.php">
                <div class="form-group">
                    <label for="imie">Imie</label>
                    <input class="form-control" type="text" placeholder="Podaj Imie" id="imie" name="imie">
                    <span class="komunikat"></span>

                </div>

                <div class="form-group">
                    <label for="nazwisko">Nazwisko</label>
                    <input class="form-control" type="text" placeholder="Podaj Nazwisko" id="nazwisko" name="nazwisko">
                    <span class="komunikat"></span>
                </div>

                <div class="form-group">
                    <label>Wybierz stolik </label>
                    <select class="form-control" id="nrStolika" name="nrStolika">
                        <?php
                        require_once './phpfile/connect.php';
                        $polanczenie = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($polanczenie->connect_errno != 0) {
                            echo 'Error: ' . $polanczenie->connect_errno;
                        } else {
                            $polanczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
                            if (($rezulat = $polanczenie->query("SELECT id,Nazwa,Rezerwacja FROM rezerwacja_miejsca")) !== 0) {

                                $liczba_wierszy = $rezulat->num_rows;

                                for ($i = 1; $i <= $liczba_wierszy; $i++) {

                                    $wiersz = $rezulat->fetch_assoc();
                                    if ($wiersz['Rezerwacja'] == 0) {
                                        echo '<option value="' . $wiersz['id'] . '">' . $wiersz['Nazwa'] . '</option>';
                                    }
                                }

                                $rezulat->free_result();
                                $polanczenie->close();
                            }
                        }
                        ?>  
                    </select>
                </div>
                <div class="form-group">
                    <label for="mess">Dodatkowe informacje (Prosze tutaj podać godzine rezerwacji)</label>
                    <textarea class="form-control" rows="4" id="mess" name="mess" ></textarea>
                    <span class="komunikat"></span>
                </div>


                <button type="submit" class="btn btn-default" id="button">Wyślij!</button>
            </form>
            <br>
            <center><h3><?php
                if (isset($_SESSION['zarezerwowano']) && ($_SESSION['zarezerwowano'] === true)) {

                    echo 'Rezerwacja miejsca nr ' . $_SESSION['id'] . ' dla Pani(a) ' . $_SESSION['imie'] . ' '
                            . $_SESSION['nazwisko'] . ' została pomyślnie wysłana.';
                    session_unset();
                }
                ?></h3></center>
        </div>
    </body>
    <script src="js/myjsa.js"></script>
</html>

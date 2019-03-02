<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (!isset($_SESSION['zalogowano']) || $_SESSION['zalogowano'] == FALSE) {
    header('Location: admin.php');
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            .btn {
                background-color: DodgerBlue;
                border: none;
                color: white;
                padding: 5px 7px;
                font-size: 10px;
                cursor: pointer;
            }

            /* Darker background on mouse-over */
            .btn:hover {
                background-color: RoyalBlue;
            }
            div.form-group{
                padding-top: 10px;
                padding-left: 5px;
                padding-right: 0px;
            }
        </style>

    </head>
    <body style="background-color: #333333;">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Pizzeria Galicja</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Strona Główna</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="rezerwacja.php">Rezerwacja</a></li>
                    <li><a href="zalogowany.php">Dodawanie Produktów</a></li>
                    <li class="active"><a href="rezerwacje.php">Rezerwacje</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="phpfile/logout.php">Wyloguj</a></li>
                </ul>
            </div>
        </nav>
        <br><br><br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2" style="font-size: 16px">
                    <table class="table" style="background-color:  #ffffff"">

                        <?php
                        require_once './phpfile/connect.php';
                        $polanczenie = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($polanczenie->connect_errno != 0) {
                            echo 'Error: ' . $polanczenie->connect_errno;
                        } else {

                            $polanczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
                            if (($rezulat = $polanczenie->query("SELECT * FROM rezerwacja_miejsca Where Rezerwacja ='1'")) !== 0) {
                                $liczba_wierszy = $rezulat->num_rows;
                                echo<<<END
                            <thead style="background-color: #5b8835;color: #000000">
                                <tr>
                                    <th>Nazwa</th>
                                    <th>Imie</th>
                                    <th>Nazwisko</th>
                                    <th>Informacje</th>
                                    <th><center>Usuń<center></th>
                                </tr>
                            </thead>
END;


                                for ($i = 1; $i <= $liczba_wierszy; $i++) {
                                    $wiersz = $rezulat->fetch_assoc();
                                    echo '<tr>';
                                    echo '<td>' . $wiersz['Nazwa'] . '</td>' .
                                    '<td>' . $wiersz['Imie'] . '</td>' .
                                    '<td>' . $wiersz['Nazwisko'] . '</td>' .
                                    '<td>' . $wiersz['Dodatkowe_informacje'] . '</td>'
                                    . '<td>'
                                    . '<center>'
                                    . '<button class="btn" onclick="myAjax(' . $wiersz['id'] . ')"><i class="fa fa-close"></i></button>'
                                    . '</center>'
                                    . '</td>'
                                    . '</td>';

                                    echo '</tr>';
                                }
                                echo '<tr><td></td><td></td><td></td><td></td><td></td></tr>';

                                $rezulat->free_result();
                                $polanczenie->close();
                            }
                        }
                        ?>

                    </table>
                </div>
            </div>
        </div>
        <script>
            function myAjax($w) {
                $.ajax({
                    type: "POST",
                    url: 'phpfile/up.php',
                    data: {action: $w},
                    success: function (html) {
                        alert(html);
                        window.location.reload();
                    }

                });
            }

        </script>
    </body>
</html>

<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['zalogowano']) || $_SESSION['zalogowano'] == FALSE) {
    header('Location: admin.php');
    exit();
}
?>
<html>
    <head>
        <title> Pizza Galicja </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

    <body style="background-color: #333333">

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Pizzeria Galicja</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Strona Główna</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="rezerwacja.php">Rezerwacja</a></li>
                    <li class="active"><a href="zalogowany.php">Dodawanie Produktów</a></li>
                    <li><a href="rezerwacje.php">Rezerwacja</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="phpfile/logout.php">Wyloguj</a></li>

                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-8 col-md-offset-2" >
                    <center><img src="img/pizza-wallpaper-9.jpg" class="img-responsive" alt="Pizza"></center>
                    <table class="table"style="font-size: 15px;background-color:  #ffffff" >

                        <?php
                        require_once './phpfile/connect.php';
                        $polanczenie = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($polanczenie->connect_errno != 0) {
                            echo 'Error: ' . $polanczenie->connect_errno;
                        } else {

                            $polanczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
                            if (($rezulat = $polanczenie->query("SELECT * FROM menu_pizza")) !== 0) {
                                $liczba_wierszy = $rezulat->num_rows;
                                echo<<<END
                            <thead style="background-color: #5b8835">
                                <tr>
                                    <th>Nazwa</th>
                                    <th>Składniki</th>
                                    <th>Mała</th>
                                    <th>Średnia</th>
                                    <th>Duża</th>
                                    <th>Edycja</th>
                                </tr>
                            </thead>
END;


                                for ($i = 1; $i <= $liczba_wierszy; $i++) {
                                    $wiersz = $rezulat->fetch_assoc();
                                    echo '<tr>';
                                    echo '<td>' . $wiersz['Nazwa'] . '</td>' .
                                    '<td>' . $wiersz['Składniki'] . '</td>' .
                                    '<td>' . $wiersz['Cena_Mała'] . ' zł</td>' .
                                    '<td>' . $wiersz['Cena_Średnia'] . ' zł</td>' .
                                    '<td>' . $wiersz['Cena_Duża'] . ' zł</td>'
                                    . '<td>'
                                    . '<center>'
                                    . '<button class="btn" onclick="myAjax(' . $wiersz['id'] . ')"><i class="fa fa-close"></i></button>'
                                    . '</center>'
                                    . '</td>'
                                    . '</td>';

                                    echo '</tr>';
                                }
                                echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>';

                                $rezulat->free_result();
                                $polanczenie->close();
                            }
                        }
                        ?>
                    </table>
                    <form class="form-inline" method="post" action="phpfile/add.php" style="font-size: 15px;background-color:  #ffffff;padding-top: 0px ">
                        <div class="form-group" >
                            <label for="nazwa">Nazwa</label>
                            <input type="text" class="form-control" id="nazwa" name="nazwa" placeholder="Podaj Nazwe Pizzy">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="skladniki">Składniki</label>
                            <input type="text" class="form-control" id="skladniki" name="skladniki" placeholder="Podaj składniki">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="cena_malej_pizzy">Cena Mała</label>
                            <input type="text" class="form-control" id="cena_malej_pizzy" name="cena_malej_pizzy" placeholder="Podaj cene">
                        </div>
                        <div class="form-group">
                            <label for="cena_srednej_pizzy">Cena Średnia</label>
                            <input type="text" class="form-control" id="cena_srednej_pizzy" name="cena_sredniej_pizzy" placeholder="Podaj cene">
                        </div>
                        <div class="form-group">
                            <label for="cena_duzej_pizzy">Cena Duża</label>
                            <input type="text" class="form-control" id="cena_duzej_pizzy" name="cena_duzej_pizzy" placeholder="Podaj cene">
                        </div>
                        <br><br>
                        <center><button type="submit" class="btn btn-primary " style="font-size: 20px;background-color: green">Dodaj Pizze</button></center>
                    </form>
                    <br>

                </div>
            </div>
        </div> 
        <script>
            function myAjax($id) {
                $.ajax({
                    type: "POST",
                    url: 'phpfile/remove.php',
                    data: {action: $id},
                    success: function (html) {
                        alert(html);
                        window.location.reload();
                    }

                });
            }

        </script>
        <?php
        if(isset($_SESSION['dodano']) && $_SESSION['dodano'] == true)
        {
            echo '<script>alert("Poprawnie dodano produkt")</script>';
            $_SESSION['dodano'] = false;
        }
        if(isset($_SESSION['niedodano']) && $_SESSION['niedodano'] == false)
        {
                        echo'<script>alert("Nie dodano produktu")</script>';
        }
        ?>
    </body>
</html>
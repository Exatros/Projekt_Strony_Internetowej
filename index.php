<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
--><?php
session_start();
?>
<html>
    <head>
        <title> Pizza Galicja </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body style="background-color: #333333 ">

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Pizzeria Galicja</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Strona Główna</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="rezerwacja.php">Rezerwacja</a></li>
                    <?php
                    if (isset($_SESSION['zalogowano']) && $_SESSION['zalogowano'] == TRUE) {
                        echo '<li><a href="zalogowany.php">Dodawanie Produktów</a></li>
                                <li><a href="rezerwacje.php">Rezerwacje</a></li>';
                    }
                    ?>
                </ul> <?php
                if (isset($_SESSION['zalogowano']) && $_SESSION['zalogowano'] == TRUE) {
                    echo '<ul class = "nav navbar-nav navbar-right">
                    <li><a href = "phpfile/logout.php">Wyloguj</a></li>

                    </ul>';
                }
                ?>
            </div>
        </nav>


        <div class="container-fluid">     
            <img src="img/pizza - Kopia.jpg" class="img-responsive" alt="Pizza" style="width: 100%" height="300">
        </div>  

        <div class="container" style='color: #ffffff'>
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    <h3> Zobacz jakie to proste </h3>
                    <p>Zamawianie przez internet</p>
                </div>
            </div>
        </div>


        <div class="container" style="color: #ffffff" >

            <div class="row">
                <div class="col-sm-3" style="text-align: center">
                    <span class="glyphicon glyphicon-cutlery" style="font-size: 75px;color: #5b8835"></span>                    
                    <h3>Wybierz Danie</h3>
                    <p>Wybierz dania oraz napoje</p>
                </div>
                <div class="col-sm-1" style="text-align: center">
                    <span class="glyphicon glyphicon-chevron-right" style="font-size: 50px"></span>                    
                </div>
                <div class="col-sm-4" style="text-align: center">
                    <span class="glyphicon glyphicon-shopping-cart" style="font-size: 75px ;color: #5b8835"></span>
                    <h3>Dodaj Do Koszyka</h3>
                    <p>Bez rejestracji w mniej niż 30 sekund</p>
                </div>
                <div class="col-sm-1" style="text-align: center">
                    <span class="glyphicon glyphicon-chevron-right" style="font-size: 50px"></span>                    
                </div>
                <div class="col-sm-3" style="text-align: center">
                    <span class="glyphicon glyphicon-euro" style="font-size: 75px ;color: #5b8835"></span>
                    <h3>Zapłać</h3> 
                    <p>Karta lub szybkim przelewem</p>
                </div>
            </div>
        </div>

        <div class="container-fluid">     
            <img src="img/fastfood - Kopia.jpg" class="img-responsive" alt="FastFood" style="width: 100%" height="300">
        </div>  

        <div class="container" style="color: #ffffff">
            <div class="row">
                <div class="col-sm-6" style="text-align: center">
                    <br/><h4>Numer Telefonu: 846 554 789</h4><br/>

                    <h4>Adres email: GalicjaPizza@gmail.com</h4><br/>
                    <h4>Adres lokalo: 52-234 Galicja Arnolda Gina 23</h4>
                </div>
                <div class="col-sm-6" style="text-align: center">
                    <br/>
                    <p>Godziny Otwarcia:</p>
                    <p>Poniedziałek 10:00-22:30</p>
                    <p>Wtorek 10:00-22:30</p>
                    <p>Środa 10:00-22:30</p>
                    <p>Czwartek 10:00-22:30</p>
                    <p>Piątek 10:00-00:30</p>
                    <p>Sobota 10:00-23:30</p>
                    <p>Niedziela 12:00-22:30</p>

                </div>
            </div>
        </div>

    </body>
</html>

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
        <script src="js/simpleCart.js"></script>
        <style>
            .item-quantity, .item-decrement, .item-increment{
                text-align: center;
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
                    <li class="active"><a href="menu.php">Menu</a></li>
                    <li><a href="rezerwacja.php">Rezerwacja</a></li>
                    <?php
                    if (isset($_SESSION['zalogowano']) && $_SESSION['zalogowano'] == TRUE) {
                        echo '<li><a href="zalogowany.php">Dodawanie Produktów</a></li>
                                <li><a href="rezerwacje.php">Rezerwacje</a></li>';
                    }
                    ?>
                </ul>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="koszyk"><a href="#" data-toggle="modal" data-target="#myModal">
                                Koszyk (<span class="simpleCart_quantity"></span>)</a></li>
                        <?php
                        if (isset($_SESSION['zalogowano']) && $_SESSION['zalogowano'] == TRUE) {
                            echo '
                    <li><a href = "phpfile/logout.php">Wyloguj</a></li>

                    ';
                        }
                        ?>
                    </ul>
                </div>
            </div>    
        </nav>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"> Koszyk <span class="showIfEmpty">jest pusty</span></h4>
                    </div>
                    <div class="hideIfEmpty">
                        <div class="modal-body">

                            <div class="simpleCart_items"></div>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Łącznie</th>
                                        <th>Koszty przesyłki</th>
                                        <th>Do zapłaty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><div class="simpleCart_total"></div></td>
                                        <td><div class="simpleCart_shipping"></div></td>
                                        <td><div class="simpleCart_grandTotal"></div></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">

                            <!-- Opróżnij koszyk button -->
                            <a href="javascript:;" class="simpleCart_empty btn btn-default">Opróżnij koszyk</a>
                            <!-- Złożenie zamówienia  -->
                            <a href="javascript:;" class="simpleCart_checkout btn btn-primary">Złóż zamówienie</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <table class="table" style="font-size: 16px;background-color:  #ffffff">
                        <img src="img/pizza-wallpaper-9.jpg" class="img-responsive" alt="Pizza">
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
                                    <th>Wybierz</th>
                                </tr>
                            </thead>
END;

                                //Pętla do tworzenia rekordow
                                for ($i = 1; $i <= $liczba_wierszy; $i++) {
                                    $wiersz = $rezulat->fetch_assoc();
                                    echo '<tr>';
                                    echo '<td>' . $wiersz['Nazwa'] . '</td>' .
                                    '<td>' . $wiersz['Składniki'] . "</td>" .
                                    '<td>' . $wiersz['Cena_Mała'] . " zł</td>" .
                                    '<td>' . $wiersz['Cena_Średnia'] . " zł</td>" .
                                    '<td>' . $wiersz['Cena_Duża'] . " zł</td>" .
                                    '<td> ' //Tworzenie przyscisków opartych na danch z bazy oraz w sposób aby skrypt koszyka mógł z łatwością je pobrać
                                    . '<div class="btn-group btn-group-xs" role="group">'
                                    . '<button type="button" class="btn btn-default  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Wybierz Rozmiar <span class="caret"></span>
                                               </button>'
                                    . '<ul class="dropdown-menu" >'
                                    . '<li>'
                                    . '<div class="simpleCart_shelfItem">'
                                    . '<input type="hidden" value="1" class="item_Quanity">'
                                    . '<h2 hidden="true" class="item_name">' . $wiersz['Nazwa'] . ' - Mała&nbsp;&nbsp;</h2>'
                                    . '<h2 hidden="true" class="item_price">' . $wiersz['Cena_Mała'] . '</h2>'
                                    . '<input type="button" class="item_add btn btn-primary" value="Mała ' . $wiersz['Cena_Mała'] . ' zł" style="width: 160px">'
                                    . '</div>'
                                    . '</li>'
                                    . '<li>'
                                    . '<div class="simpleCart_shelfItem">'
                                    . '<input type="hidden" value="1" class="item_Quanity">'
                                    . '<h2 hidden="true" class="item_name">' . $wiersz['Nazwa'] . ' - Średnia&nbsp;&nbsp;</h2>'
                                    . '<h2 hidden="true" class="item_price">' . $wiersz['Cena_Średnia'] . '</h2>'
                                    . '<input type="button" class="item_add btn btn-primary" value="Średnia ' . $wiersz['Cena_Średnia'] . ' zł" style="width: 160px">'
                                    . '</div>'
                                    . '</li>'
                                    . '<li>'
                                    . '<div class="simpleCart_shelfItem">'
                                    . '<input type="hidden" value="1" class="item_Quanity">'
                                    . '<h2 hidden="true" class="item_name">' . $wiersz['Nazwa'] . ' - Duża&nbsp;&nbsp;</h2>'
                                    . '<h2 hidden="true" class="item_price">' . $wiersz['Cena_Duża'] . '</h2>'
                                    . '<input type="button" class="item_add btn btn-primary" value="Duża ' . $wiersz['Cena_Duża'] . ' zł" style="width: 160px">'
                                    . '</div>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>'
                                    . '</td>';

                                    echo '</tr>';
                                }


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
            simpleCart({
                // array representing the format and columns of the cart,
                // see the cart columns documentation
                cartColumns: [
                    {attr: "name", label: "Produkt"},
                    {view: "currency", attr: "price", label: "Cena"},
                    {view: "decrement", label: false, text: '<span class="glyphicon glyphicon-minus"></span>'},
                    {attr: "quantity", label: "Ilość"},
                    {view: "increment", label: false, text: '<span class="glyphicon glyphicon-plus"></span>'},
                    {view: "currency", attr: "total", label: "Razem"},
                    {view: "remove", text: '<span class="glyphicon glyphicon-remove"></span>', label: false}
                ],

                // "div" or "table" - builds the cart as a 
                // table or collection of divs
                cartStyle: "table",

                // how simpleCart should checkout, see the 
                // checkout reference for more info 
                checkout: {
                    type: "PayPal",
                    email: "timi12-12@o2.pl"
                },

                // set the currency, see the currency 
                // reference for more info
                currency: "PLN",

                // collection of arbitrary data you may want to store 
                // with the cart, such as customer info
                data: {},

                // set the cart langauge 
                // (may be used for checkout)
                language: "english-us",

                // array of item fields that will not be 
                // sent to checkout
                excludeFromCheckout: [],

                // custom function to add shipping cost
                shippingCustom: function () {
                    if (simpleCart.quantity() > 3)
                    {
                        return 0;
                    } else
                        return 1;
                },

                // flat rate shipping option
                shippingFlatRate: 0,

                // added shipping based on this value 
                // multiplied by the cart quantity
                shippingQuantityRate: 0,

                // added shipping based on this value 
                // multiplied by the cart subtotal
                shippingTotalRate: 0,

                // tax rate applied to cart subtotal
                taxRate: 0,

                // true if tax should be applied to shipping
                taxShipping: false,

                // event callbacks 
                beforeAdd: null,
                afterAdd: null,
                load: null,
                beforeSave: null,
                afterSave: null,
                update: null,
                ready: null,
                checkoutSuccess: null,
                checkoutFail: null,
                beforeCheckout: null,
                beforeRemove: null
            });
            // basic callback example
            simpleCart.bind("afterAdd", function () {
                $(".koszyk").fadeOut(500).fadeIn(500);
            });

            simpleCart.bind('update', function () {
                if (simpleCart.quantity() == 0)
                {
                    $(".hideIfEmpty").hide();
                    $(".showIfEmpty").show();
                } else
                {
                    $(".hideIfEmpty").show();
                    $(".showIfEmpty").hide();
                }
            });
        </script>
    </body>
</html>

<?php include("admin/PDO.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="x-icon" href="images/1618672896262.png">
    <!-- Important to make website responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- For Font-Family -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Link our CSS files -->
    <link rel="stylesheet" href="css/swiper.css">
    <link rel="stylesheet" href="css/rest.css">

    <title>Document</title>

</head>

<body>
    <div class="countiner" id="countiner">

        <!-----------------------------------------Header-Start------------------------------------------------->

        <div class="navbar ">
            <a href="index.php" class="logo" id="logo">
                <img src="images/1618672896262.png" width="50px">
            </a>
            <div class="search-tab">
                <form action="food-search" method="GET">
                    <input class="search_input" name="search" type="text" placeholder="Search for food..." autofocus>
                    <input type="submit" name="submit" value="searsh" class="search-btn">
                </form>
            </div>
            <div class="humberger" id="humberger">
                <div class="khat"></div>
            </div>
            <div class="menu" id="menu">
                <a href="Rest.php">
                    <h2>SEE</h2>
                    <hr>
                </a>

                <a href="reservations.php">
                    <h2>RESERVATIONS</h2>
                    <hr>
                </a>
                <a href="pv.php">
                    <h2>PRIVATE EVENTS</h2>
                    <hr>
                </a>
                <a href="categories.php">
                    <h2>CATEGORIES</h2>
                    <hr>
                </a>
                <a href="foods.php">
                    <h2>MENU</h2>
                    <hr>
                </a>
                <a href="about.php">
                    <h2>ABOUT</h2>
                    <hr>
                </a>

            </div>
        </div>

        <!-----------------------------------------Header-End------------------------------------------------->
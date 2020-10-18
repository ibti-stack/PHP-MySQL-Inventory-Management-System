<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>

    <style>
        body{ font: 14px serif; text-align: center;
            background-color: darkturquoise; }
        h1 {
            text-align: center;
            font-size: 6.5rem;
            margin-bottom: -3px;
        }
        p {
            text-align: right;
            margin-right: 70px;
        }
        .stock-in {
            margin-left: 75rem;
        }
        td {
            padding: 15px;
            font-weight: bold;
        }
        .pro-in {
            font-weight: bold;
            font-size: 25px;
            border: 2px solid;
        }
        .pro-in-button {
            font-size: 2rem;
        }
        .pageeheader {
            background-color: #f79f36;
            padding-top: 5px;
            padding-bottom: 47px;
        }
        table {
            margin-left: 72rem;
            font-size: 3rem;
        }
        .marquee {
            width: 100%;
            overflow: hidden;
            background: mediumblue;
            height: 29px;
            color: #DCD3E5;
            font-size: 24px;
            word-spacing: 15px;
            margin-top: -3rem;
        }
        a {
            margin: 1rem;
        }
        .logo {
            margin-top: 20rem;
            margin-right: 150rem;
        }
         table {
                    margin-left: 80rem;
         }
         a {
                    margin: 1rem;
        }
         .logo {
            margin-top: -58rem;
            margin-right: 166rem;
            width: 8%;
        }
        .dashbutton {
            width: 35rem;
        }
    </style>
</head>
<body>
    <div class="pageeheader">
        <h1> WELCOME TO INVENTORY MANAGEMENT SYSTEM </h1>
    </div>
    <div class="marquee"> AHMADIYYA MUSLIM JAMAAT KdoR  SHOBA ZIAFAT INVENTORY MANAGEMENT SYSTEM *** LOVE FOR ALL HATRED FOR NONE ***</div>
    <p>
        <a href="logout.php" class="btn btn-danger">SIGN OUT</a>
    </p>
    <table>
        <tr>
            <td>
                <a href="productin.php" class="btn btn-primary btn-lg dashbutton" role="button"> PRODUCT IN </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="stock.php" class="btn btn-primary btn-lg dashbutton" role="button"> STOCK</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="productout.php" class="btn btn-primary btn-lg dashbutton" role="button"> PRODUCT OUT </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="checkouted.php" class="btn btn-primary btn-lg dashbutton" role="button"> CHECKOUTED PRODUCTS </a>
            </td>
        </tr>
    </table>
    <img class="logo" src="img/logo4.png" alt="Jamat logo">
    <script>
        $('.marquee').marquee({
    //speed in milliseconds of the marquee
    duration: 15000,
    //gap in pixels between the tickers
    gap: 100,
    //time in milliseconds before the marquee will start animating
    delayBeforeStart: 0,
    //'left' or 'right'
    direction: 'left',
    //true or false - should the marquee be duplicated to show an effect of continues flow
    duplicated: true
});
    </script>
</body>
</html>

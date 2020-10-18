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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>
    <style type="text/css">
        body{ font: 14px serif; text-align: center;
            background-color: darkturquoise; }
        h1 {
            text-align: center;
            font-size: 53px;
            padding-top: 23px;
        }
        p {
            text-align: right;
            margin-right: 70px;
        }
        .pageeheader {
            background-color: #f79f36;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .back {
            float: left;
            font-size: 2rem;
            margin-left: 3rem;
        }
        .table {
            margin-top: 1rem;
            margin-left: 26rem;
            width: 72%;
        }
        tr {
            font-size: 2rem;
            border: 1px solid;
        }
        th {
            text-align: center;
            padding-bottom: 2rem;
            border: 1px solid;
        }
        .total_inventry {
            font-size: 17px;
            color: blue;
        }
        h3 {
            margin-right: 195px;
        }
        .marquee {
        width: 100%;
        overflow: hidden;
        background: mediumblue;
        height: 29px;
        color: #DCD3E5;
        font-size: 24px;
        word-spacing: 15px;
       }
       a {
           margin-top: 1rem;
       }
       h4 {
           margin-right: 18rem;
       }
       .checkoutsearch {
           margin-right: 18rem;
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
    <a href="welcome.php" class="btn btn-primary btn-lg back" role="button"> Back to Dashboard</a>
    <h3> PRODUCTS THAT ARE CHECKOUTED </h3>
    <h4>SEARCH WITH DATE</h4>
    <form class="checkoutsearch" action="checkouted.php" method="POST">
            <input type="text" name="date" placeholder="Enter the desired Info">
            <input type="submit" name="datesearch" value="SEARCH">
        </form>
    <br>
     <a href="<?php $_SERVER['PHP_SELF']; ?>" class="btn btn-primary btn-xs" role="button">REFRESH PAGE</a>
    <br>
    <table class="table">
     <thead>
       <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Product Name</th>
        <th scope="col">Quantiy</th>
        <th scope="col">Weight/Packet</th>
        <th scope="col">Unit</th>
        <th scope="col">Total Weight</th>
        <th scope="col">Price/Packet</th>
        <th scope="col">Total Price</th>
        <th scope="col">Transfer To</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">User</th>
      </tr>
     </thead>
     <?php
require_once "config.php";
$sql_qry_out = "SELECT * FROM `stockout` ORDER BY dateout DESC";
$run = mysqli_query($link, $sql_qry_out);

if(mysqli_num_rows($run)<1)
{
    echo "No records Fund";
}
if(isset($_POST['datesearch'])){

    $date_enter = $_POST['date'];

    $query_date = "SELECT * FROM `stockout` WHERE dateout='$date_enter' OR productid='$date_enter' OR productname='$date_enter' ORDER BY dateout DESC ";
    $query_run = mysqli_query($link, $query_date);

    while($row_date = mysqli_fetch_array($query_run)){

        ?>
        <tr>
            <td><?php echo $row_date['productid']; ?></td>
            <td><?php echo $row_date['productname']; ?></td>
            <td><?php echo $row_date['quantity']; ?></td>
            <td><?php echo $row_date['weight']; ?></td>
            <td><?php echo $row_date['unit']; ?></td>
            <td><?php echo $row_date['totalweight']; ?></td>
            <td><?php echo $row_date['price']; ?></td>
            <td><?php echo $row_date['totalprice']; ?></td>
            <td><?php echo $row_date['transfer']; ?></td>
            <td><?php echo $row_date['dateout']; ?></td>
            <td><?php echo $row_date['time']; ?></td>
            <td><?php echo $row_date['user']; ?></td>
        </tr>
        <?php
    }


}
else {
    while($data = mysqli_fetch_assoc($run))
    {
        ?>
        <tr>
            <td><?php echo $data['productid']; ?></td>
            <td><?php echo $data['productname']; ?></td>
            <td><?php echo $data['quantity']; ?></td>
            <td><?php echo $data['weight']; ?></td>
            <td><?php echo $data['unit']; ?></td>
            <td><?php echo $data['totalweight']; ?></td>
            <td><?php echo $data['price']; ?></td>
            <td><?php echo $data['totalprice']; ?></td>
            <td><?php echo $data['transfer']; ?></td>
            <td><?php echo $data['dateout']; ?></td>
            <td><?php echo $data['time']; ?></td>
            <td><?php echo $data['user']; ?></td>
        </tr>
        <?php
    }
}
?>

    </table>
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

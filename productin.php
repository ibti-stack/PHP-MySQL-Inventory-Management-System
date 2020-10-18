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
    <script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>
    <style type="text/css">
        body{ font: 14px serif; text-align: center;
        background-color: darkturquoise;
        padding:0px;
        margin:0px; }
        h1 {
            text-align: center;
            font-size: 6.5rem;
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
            padding-bottom: 5px;
        }
        .back {
            float: left;
            font-size: 2rem;
            margin-left: 3rem;
        }
        .cars {
            margin-right: -8rem;
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
  .enter {
    margin-left: 56rem;
    margin-right: 57rem;
  }
  .proenter {
      text-align: center;
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
    <div class="stock-in">
    <form method="POST" action="productin.php">
    <table>
        <tr>
            <td colspan="2" class="pro-in">ENTER PRODUCT</td>
        </tr>
        <tr>
            <td>Product ID:</td>
            <td><input type="text" name="product-id" placeholder="Enter Product ID" required></td>
        </tr>
        <tr>
            <td>Product Name:</td>
            <td><input type="text" name="product-name" placeholder="Enter Product Name" required></td>
        </tr>
        <tr>
            <td>Expiry Date:</td>
            <td><input type="date"  min="2020-04-11" name="Expiry-date" required></td>
        </tr>
        <tr>
            <td>Weight/Packet : 
             </td>
            <td><input type="text" name="weight-product" placeholder="Enter Product Weight" required>
            <br>
            <br>
            <select id="cars" name="weight-name">
            <option value="gram">gram</option>
            <option value="Kg">Kg</option>
            <option value="ml">ml</option>
            <option value="Litre">Litre</option>
            </select></td>
        </tr>
        <tr>
            <td>Quantity:</td>
            <td><input type="text" name="quantity" placeholder="Enter Product Quantity" required></td>
        </tr>
        <tr>
            <td>Price/Packet:</td>
            <td><input type="text" name="price" placeholder="Enter Product Price" required></td>
        </tr>
        <tr>
            <td>Buy Place: </td>
            <td><input type="text" name="buyplace" placeholder="Enter Bought place"></td>
        </tr>
        <tr>
            <td>Invoice No: </td>
            <td><input type="text" name="invoice" placeholder="Enter Invoice #"></td>
        </tr>
        <tr>
            <td>Event Name:</td>
            <td><input type="text" value="null" name="eventname" ></td>
        </tr>
        <tr>
            <td>Event Date:</td>
            <td><input type="text" value="null" min="2020-04-11" name="Event-date" ></td>
        </tr>
        <tr>
            <td>Location:</td>
            <td><input type="text" name="drop-down" placeholder="Enter Location" required></td>
        </tr>
        <tr>
            <td class="pro-in-button">
                <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary" role="button">
            </td>
        </tr>
    </table>
    </form>
    </div>
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
<?php 
if(isset($_POST['submit']))
{
    require_once "config.php";
    $pro_id = $_POST['product-id'];
    $pro_name = $_POST['product-name'];
    $expriy_date = $_POST['Expiry-date'];
    $weight_pro = $_POST['weight-product'];
    $weight_dim = $_POST['weight-name'];
    $quant = $_POST['quantity'];
    $pro_price = $_POST['price'];
    $place_buy = $_POST['buyplace'];
    $invoice = $_POST['invoice'];
    $drop_list = $_POST['drop-down'];
    $weight_quant = $weight_pro * $quant;
    $total_price = $quant * $pro_price;
    

    $qry = "INSERT INTO `stockin`(`productid`, `productname`, `expirydate`, `weight`, `weightdim`, `quantity`, `totalweight`, `price`, `totalprice`, `bought_place`, `invoice`, `Location`) VALUES ('$pro_id', '$pro_name', '$expriy_date', '$weight_pro', '$weight_dim', '$quant', '$weight_quant', '$pro_price', '$total_price', '$place_buy', '$invoice', '$drop_list')";
    $run = mysqli_query($link, $qry);

    if($run == true)
    {
        ?>

        <div class="alert alert-success enter">
            <p class="proenter">Product Enter successfully !!</p>
        </div>
        <?php
    }
}
?>

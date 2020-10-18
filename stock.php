<?php
// Initialize the session
session_start();

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php 
    require_once "config.php";
    $query_add = "SELECT SUM(totalprice) AS sum FROM `stockin`";
    $query_result = mysqli_query($link, $query_add);

    while($row = mysqli_fetch_assoc($query_result)){
        $output = "Total Inventry Value:"." ".$row['sum']." "."Euro";
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style type="text/css">
        body{ font: 14px serif; text-align: center;
            background-color: darkturquoise; }
        h1 {
            text-align: center;
            font-size: 6.5rem;
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
            margin: 2rem;
            margin-left: 16rem;
            width: 82%;
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
            margin-top: -3rem;
        }
        h3 {
            margin-right: 19rem;
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
  .delete {
    margin-left: 18rem;
    margin-right: 24rem;
    text-align: center;
  }
  .stocksearch {
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
    <h3> PRODUCTS THAT ARE IN STOCK </h3>
    <h4>SEARCH WITH PRODUCT ID</h4>
        <form class="stocksearch" action="stock.php" method="POST">
            <input type="text" name="productid" placeholder="Enter Product ID / Buy place">
            <input type="submit" name="productsearch" value="SEARCH">
        </form>
        <br>
    <a href="<?php $_SERVER['PHP_SELF']; ?>" class="btn btn-primary btn-xs" role="button">REFRESH PAGE</a>
    <p class="total_inventry"><?php echo $output;?></p>
    <table class="table">
     <thead>
       <tr>
        <th scope="col">Product ID:</th>
        <th scope="col">Product Name</th>
        <th scope="col">Expiry Date</th>
        <th scope="col">Weight/Packet</th>
        <th scope="col">Unit</th>
        <th scope="col">Quantiy</th>
        <th scope="col">Total Weight</th>
        <th scope="col">Price/Packet</th>
        <th scope="col">Total Price</th>
        <th scope="col">Buy Place</th>
        <th scope="col">Invoice #</th>
        <th scope="col">Location</th>
        <th scope="col">Checkbox</th>
        <th scope="col">Option</th>
      </tr>
     </thead>
        <?php
require_once "config.php";
$sql_qry = "SELECT * FROM `stockin` ORDER BY productname";
$run = mysqli_query($link, $sql_qry);

if(mysqli_num_rows($run)<1)
{
    echo "No records Fund";
}
if(isset($_POST['productsearch'])){

    $product_id = $_POST['productid'];

    $query_product = "SELECT * FROM `stockin` WHERE productid='$product_id' OR bought_place='$product_id'";
    $query_run = mysqli_query($link, $query_product);

    while($row_productid = mysqli_fetch_array($query_run)){

        ?>
        <tr>
        <form action="" method="POST">
        <td><?php echo $row_productid['productid']; ?></td>
            <td><?php echo $row_productid['productname']; ?></td>
            <td><?php echo $row_productid['expirydate']; ?></td>
            <td><?php echo $row_productid['weight']; ?></td>
            <td><?php echo $row_productid['weightdim']; ?></td>
            <td><?php echo $row_productid['quantity']; ?></td>
            <td><?php
            $tot_weight = $row_productid['quantity'] * $row_productid['weight'];    
            echo $tot_weight; ?></td>
            <td><?php echo $row_productid['price']; ?></td>
            <td><?php
            $tot_price = $row_productid['price'] * $row_productid['quantity'];
            echo $tot_price; ?></td>
            <td><?php echo $row_productid['bought_place']; ?></td>
            <td><?php echo $row_productid['invoice']; ?></td>
            <td><?php echo $row_productid['Location']; ?></td>
            <td><input type="checkbox" name="deletekey" value="<?php echo $row_productid['id'];?>" required></td>
            <td>
                <input type="submit" name="submitdeletebutton" value="DELETE" class="btn btn-danger">
            </td>
    </form>
        </tr>
        <?php
    }
}

else {
    while($data = mysqli_fetch_assoc($run))
    {
        ?>
        <tr>
        <form action="" method="POST">
            <td><?php echo $data['productid']; ?></td>
            <td><?php echo $data['productname']; ?></td>
            <td><?php echo $data['expirydate']; ?></td>
            <td><?php echo $data['weight']; ?></td>
            <td><?php echo $data['weightdim']; ?></td>
            <td><?php echo $data['quantity']; ?></td>
            <td><?php
            $tot_weight = $data['quantity'] * $data['weight'];    
            echo $tot_weight; ?></td>
            <td><?php echo $data['price']; ?></td>
            <td><?php
            $tot_price = $data['price'] * $data['quantity'];
            echo $tot_price; ?></td>
            <td><?php echo $data['bought_place']; ?></td>
            <td><?php echo $data['invoice']; ?></td>
            <td><?php echo $data['Location']; ?></td>
            <td><input type="checkbox" name="deletekey" value="<?php echo $data['id'];?>" required></td>
            <td>
                <input type="submit" name="submitdeletebutton" value="DELETE" class="btn btn-danger">
            </td>
    </form>
        </tr>
        <?php
    }  
}

if(isset($_POST['submitdeletebutton'])){

    $delete_key = $_POST['deletekey'];

    $delete_query = "DELETE FROM `stockin` WHERE id='$delete_key'; ";
    $query_delete = mysqli_query($link, $delete_query);

    if($query_delete == true){
        ?>

        <div class="alert alert-success delete">
            <p>Product DELETED successfully !!</p>
        </div>
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

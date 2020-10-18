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
        
        .show_po{
            margin-left: 75rem;
            width: 25%;
        }
        h3 {
            margin-right: 18rem;
            padding-bottom: 4px;
        }
        .total_inventry {
            font-size: 17px;
            color: blue;
        }
        .space {
            margin-right: 56rem;
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
       .transfer-box {
           width: 75%;
       }
       .table {
           margin: 1rem;
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
        <h3>SEARCH FOR A PRODUCT OUT</h3>
        
    <div class="container">
        <form action="productout.php" method="POST">
            <input type="text" name="productname" placeholder="Enter Product Name">
            <input type="submit" name="search" value="SEARCH">
        </form>
        <br>
        <p class="space">OR</p>
        <form action="productout.php" method="POST">
            <input type="text" name="proid" placeholder="Enter Product ID">
            <input type="submit" name="idsearch" value="SEARCH">
        </form>
        <br>
        <a href="stock.php" class="btn btn-primary btn-xs" role="button"> STOCK </a>
        <table class="table">
        <tr>
             <th>Product ID:</th>
            <th>Product Name</th>
            <th>Expiry Date</th>
            <th>Weight/Packet</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Total Weight</th>
            <th>Price/Packet</th>
            <th>Location</th>
            <th>Transfer To</th>
            <th>Checkbox</th>
            <th>Edit Quantity</th>
            <th>Option</th>
        </tr>
        <br>
        <?php
        include "config.php";
        if(isset($_POST['search']))
        {
            $pro_name = $_POST['productname'];

    
            $query = "SELECT * FROM `stockin` WHERE productname='$pro_name'";
            $query_run = mysqli_query($link, $query);


            while($row = mysqli_fetch_array($query_run)){
                ?>
                <tr>
                    <form action="" method="POST">
                    <td><?php echo $row['productid']; ?></td>
                    <td><?php
                    $pro_out_name = $row['productname'];
                    echo $pro_out_name; ?></td>
                    <td><?php echo $row['expirydate']; ?></td>
                    <td><?php echo $row['weight']; ?></td>
                    <td><?php echo $row['weightdim']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php
                    $tot_weight = $row['quantity'] * $row['weight'];
                    echo $tot_weight; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['Location']; ?></td>
            <td><input type="text" class="transfer-box" name="transfer" placeholder="Location" required></td>
            <td><input type="checkbox" name="keytodelete" value="<?php echo $row['id'];?>" required></td>
            <td><input type="number" id="quantity" name="quantity_out" placeholder="Quantity" min="1" max="100" required></td>
            <td>
                <input type="submit" name="submitdeletebutton" value="CHECKOUT" class="btn btn-primary">
            </td>
                    </form>
            
          </tr>
                <?php
            }
            
        }

        if(isset($_POST['idsearch']))
        {
            $product_id = $_POST['proid'];

            
            $query_product_id = "SELECT * FROM `stockin` WHERE productid='$product_id'";
            $pro_query = mysqli_query($link, $query_product_id);


            while($id_pro_query = mysqli_fetch_array($pro_query)){
                ?>
                <tr>
                    <form action="" method="POST">
                    <td><?php echo $id_pro_query['productid']; ?></td>
                    <td><?php
                    $out_name = $id_pro_query['productname'];
                    echo $out_name; ?></td>
                    <td><?php echo $id_pro_query['expirydate']; ?></td>
                    <td><?php echo $id_pro_query['weight']; ?></td>
                    <td><?php echo $id_pro_query['weightdim']; ?></td>
                    <td><?php echo $id_pro_query['quantity']; ?></td>
                    <td><?php
                    $total_weight = $id_pro_query['quantity'] * $id_pro_query['weight'];
                    echo $total_weight; ?></td>
            <td><?php echo $id_pro_query['price']; ?></td>
            <td><?php echo $id_pro_query['Location']; ?></td>
            <td><input type="text" class="transfer-box" name="transfer" placeholder="Location" required></td>
            <td><input type="checkbox" name="keytodelete" value="<?php echo $id_pro_query['id'];?>" required></td>
            <td><input type="number" id="quantity" name="quantity_out" placeholder="Quantity" min="1" max="100" required></td>
            <td>
                <input type="submit" name="submitdeletebutton" value="CHECKOUT" class="btn btn-primary">
            </td>
                    </form>
            
          </tr>
                <?php
            }
            
        }
        
        
    if(isset($_POST['submitdeletebutton'])){
    
    $quantity_out = $_POST['quantity_out'];
    $del_key = $_POST['keytodelete'];
    $transfer_loc = $_POST['transfer'];

    
    $date_out  = date("d.m.Y");
    $time_out = date("H:i");
    $user_login = $_SESSION['username'];



    $check = "SELECT * FROM `stockin` WHERE id = '$del_key'; ";
   

    $check_query = mysqli_query($link, $check);
    $response = $check_query->fetch_object();

    $weight_total = $quantity_out * $response->weight;
    $price_total = $quantity_out * $response->price;

    if($quantity_out > $response->quantity){
        ?>
        <div class="alert alert-danger">
            <p>Don't Have Enough Quantity !!</p>
        </div>
        <?php
    }


    else {
    $qry_stock_out = "INSERT INTO `stockout`(`productid`, `productname`, `quantity`, `weight`, `unit`, `totalweight`, `price`, `totalprice`, `transfer`, `dateout`, `time`, `user`) VALUES ('$response->productid', '$response->productname', '$quantity_out', '$response->weight', '$response->weightdim', '$weight_total', '$response->price', '$price_total', '$transfer_loc', '$date_out', '$time_out', '$user_login')";
    $run = mysqli_query($link, $qry_stock_out);

    $sql_delete = "DELETE FROM `stockin` WHERE quantity=0";
    $delete_query = mysqli_query($link, $sql_delete);

    if(mysqli_num_rows($check_query)>0){
        
        $qyery_del = "UPDATE `stockin` SET  quantity=quantity - $quantity_out WHERE id = '$del_key';";
        $run_query = mysqli_query($link, $qyery_del);?>


        <div class="alert alert-success">
            <p>Product Checkout successfully !!</p>
        </div>
        <?php
    }
 }
    }
?>

        </table>
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

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
include "config.php";
$id = $_REQUEST['keytodelete'];
$qyery_del = "DELETE FROM `stockin` WHERE 'id'='$id';";
$run_query = mysqli_query($link, $qyery_del);

if($run_query == true){
    ?>
    <script>
        alert('Data Deleted Successfully');
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        h1 {
            text-align: center;
            font-size: 53px;
            margin-bottom: -3px;
        }
        p {
            text-align: right;
            margin-right: 70px;
        }
        .page-header {
            background-color: #f79f36;
            padding-top: 5px;
            padding-bottom: 22px;
        }
        .back {
            float: left;
            font-size: 2rem;
            margin-left: 3rem;
        }
        </style>
</head>
<body>
    <div class="page-header">
        <h1> Welcome to Inventory Management System</h1>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    </p>
    <a href="welcome.php" class="back"> Back to Dashboard</a>

    <div class="container mt-5">

    <form action="makepdf.php">
        <h2>Want to Create the PDF?</h2>
        <br>
        <button type="submit">Create Receipt</button>
    </form>

    </div>

    </body>
</html>
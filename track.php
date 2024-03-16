<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>ExPost</title>
</head>
<body>
    <header>
        <h2 class="logo" onclick="redirectToHome()"><span>Ex</span>Post</h2>
        <nav class="navigation">
            <button class="btnLogin-popup" onclick="redirectToHome()"><strong>Return</strong></button>
         </nav>
    </header>
    <div class="container modCon">
        <div class="formTab formadd">
                <div class="head1">
                <span >Shipment</span><span style="font-size:27px; font-weight:300;"> Details</span>
            </div>
            <div class="forminfo" style="margin-top:1px;">
                <div class="formcolumn">
<?php

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "dbms_project";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $order_id = $_POST["order_id"];

  
    $sql = "SELECT *
            FROM order_details o
            JOIN customer_details c ON o.customer_id = c.customer_id
            JOIN item_details i ON o.item_id = i.item_id
            WHERE o.order_id = $order_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            $placeDate = date("d-m-Y", strtotime($row["place_date"]));
        
            echo "<div class='forminfo'>";
            echo "<div class='formcolumn'>";
            echo "<p><strong>Order ID:</strong> " . $row["order_id"] . "</p>"."<br>";
            echo "<p><strong>Consignor's Name:</strong> " . $row["customer_name"] . "</p>"."<br>";
            echo "<p><strong>Consignor's Ph. No.:</strong> " . $row["customer_ph"] . "</p>"."<br>";
            echo "<p><strong>Consignor's Address:</strong> " . $row["customer_address"] . "</p>"."<br>";
            echo "<p><strong>Consignor's Email:</strong> " . $row["customer_email"] . "</p>"."<br>";
            echo "</div>";
            echo "<div class='formcolumn'>";
            echo "<p><strong>Order Placed On:</strong> " . $placeDate . "</p>"."<br>";
            echo "<p><strong>Item Weight:</strong> " . $row["weight"] . "</p>"."<br>";
            echo "<p><strong>Pickup Location:</strong> " . $row["pickup_loc"] . "</p>"."<br>";
            echo "<p><strong>Pickup Pincode:</strong> " . $row["pickup_pincode"] . "</p>"."<br>";
            echo "<p><strong>Delivery Location:</strong> " . $row["deliver_loc"] . "</p>"."<br>";
            echo "</div>";
            echo "<div class='formcolumn'>";
            echo "<p><strong>Delivery Pincode:</strong> " . $row["deliver_pincode"] . "</p>"."<br>";
            echo "<p><strong>Receiver's Phone Number:</strong> " . $row["deliver_ph"] . "</p>"."<br>";
            echo "<p><strong>ETA:</strong> " . $row["ETA"] . "</p>"."<br>";
            echo "<p><strong>Current Location:</strong> " . $row["current_loc"] . "</p>"."<br>";
            echo "<p><strong>Delivery Status:</strong> " . $row["delivery_status"] . "</p>"."<br>";
            echo "</div>";
            echo "</div>";
        }
    } else {
            echo "<script>alert('Order ID not found.'); window.location.href = 'home.html';</script>";
        }
}

$conn->close();
?>


         </div>
     </div>
<script src="script.js"></script>
</body>
</html>
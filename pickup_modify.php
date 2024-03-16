<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from the HTML form
    $order_id = $_POST["order_id"];
    $new_pickup_loc = $_POST["new_pickup_loc"];
    $new_pickup_pincode = $_POST["new_pickup_pincode"];

    // Update pickup_loc and pickup_pincode in item_details table
    $sql_update = "UPDATE item_details
                   SET pickup_loc = '$new_pickup_loc', pickup_pincode = '$new_pickup_pincode'
                   WHERE item_id = (SELECT item_id FROM order_details WHERE order_id = '$order_id')";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Update successful!'); window.location.href = 'delivery.html';</script>";
    } else {
        echo "<script>alert('Error Updating!'); window.location.href = 'delivery.html';</script>" . $conn->error;
    }
}

$conn->close();
?>

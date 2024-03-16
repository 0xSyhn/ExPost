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
    $user_id = $_POST["user_id"];
    $order_id = $_POST["order_id"];

    // Check if the provided order_id belongs to the specified user_id
    $check_order = "SELECT * FROM order_details WHERE order_id = '$order_id' AND user_id = '$user_id'";
    $result = $conn->query($check_order);

    if ($result->num_rows > 0) {
        // Order belongs to the user, proceed with deletion

        // Get item_id and customer_id associated with the order_id
        $order_info = $result->fetch_assoc();
        $item_id = $order_info["item_id"];
        $customer_id = $order_info["customer_id"];

        // Delete data from order_details
        $sql_order = "DELETE FROM order_details WHERE order_id = '$order_id' AND user_id = '$user_id'";
        $conn->query($sql_order);

        // Delete data from customer_details
        $sql_customer = "DELETE FROM customer_details WHERE customer_id = '$customer_id'";
        $conn->query($sql_customer);

        // Delete data from item_details
        $sql_item = "DELETE FROM item_details WHERE item_id = '$item_id'";
        $conn->query($sql_item);

        echo "<script>alert('Data Deleted Successfully!'); window.location.href = 'delete.html';</script>";
    } else {
        echo "<script>alert('Invalid user_id or order_id combination.'); window.location.href = 'delete.html';</script>";
    }
}

$conn->close();
?>

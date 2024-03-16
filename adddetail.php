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
    $customer_ph = $_POST["customer_ph"];
    $customer_name = $_POST["customer_name"];
    $customer_email = $_POST["customer_email"];
    $customer_address = $_POST["customer_address"];
    $user_id = $_POST["user_id"];
    $weight = $_POST["weight"];
    $place_date = $_POST["place_date"];
    $pickup_loc = $_POST["pickup_loc"];
    $pickup_pincode = $_POST["pickup_pincode"];
    $deliver_loc = $_POST["deliver_loc"];
    $deliver_pincode = $_POST["deliver_pincode"];
    $deliver_name = $_POST["deliver_name"];
    $deliver_ph = $_POST["deliver_ph"];

    // Insert data into customer_details table
    $sql_customer = "INSERT INTO customer_details (customer_name, customer_ph, customer_email, customer_address, place_date) VALUES ('$customer_name', '$customer_ph', '$customer_email', '$customer_address', '$place_date')";
    $conn->query($sql_customer);
    

    // Get the customer_id of the newly added customer
    $customer_id = $conn->insert_id;

    // Insert data into item_details table
    $sql_item = "INSERT INTO item_details (weight, pickup_loc, deliver_loc, pickup_pincode, deliver_pincode, deliver_ph, deliver_name) VALUES ('$weight', '$pickup_loc', '$deliver_loc', '$pickup_pincode', '$deliver_pincode', '$deliver_ph', '$deliver_name')";
    $conn->query($sql_item);

    // Get the item_id of the newly added item
    $item_id = $conn->insert_id;
    $locations = ["Banglore", "Mumbai", "Chennai", "Panjim"];
    $random_location = $locations[array_rand($locations)];
    $delivery_statuses = ["In-Transit" , "Pickup"];
    $random_delivery_status = $delivery_statuses[array_rand($delivery_statuses)];
    $eta = (new DateTime($place_date))->modify('+10 days')->format('Y-m-d');


    // Insert data into login_details table
    // $sql_login = "INSERT INTO login_details (user_id) VALUES ('$user_id')";
    // $conn->query($sql_login);

    // // Get the login_id of the newly added login
    // $login_id = $conn->insert_id;

    // Insert data into order_details table
    $sql_order = "INSERT INTO order_details (user_id, customer_id, item_id, current_loc, ETA, delivery_status) VALUES ('$user_id', '$customer_id', '$item_id', '$random_location', '$eta', '$random_delivery_status')";
    $conn->query($sql_order);
    $order_id = $conn->insert_id;

    echo "<script>alert('Data added successfully! Order ID: $order_id'); window.location.href = 'home.html';</script>";
}

$conn->close();
?>

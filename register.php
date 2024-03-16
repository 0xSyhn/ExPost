
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
    $user_name = $_POST["username1"];
    $pass_word = $_POST["password1"];
    $user_email = $_POST["user_email"];

    $sql = "INSERT INTO login_details (username, password, user_email) VALUES ('$user_name', '$pass_word', '$user_email')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href = 'home.html';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "\\n" . $conn->error . "'); window.location.href = 'home.html';</script>";
    }
}

$conn->close();
?>

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
    // Get username and password from the HTML form
    $user_name = $_POST["username1"];
    $pass_word = $_POST["password1"];

    $sql = "SELECT user_id, password FROM login_details WHERE username = '$user_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Verify the entered password against the hashed password
        if ($pass_word == $hashed_password) {
            echo "<script>alert('Login successful. User ID: " . $row["user_id"] . "');</script>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'pickup.html';
                }, 0);
            </script>";
            exit; // Terminate the script
        } else {
            echo "<script>alert('Invalid password');</script>";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'login.html';
                }, 0);
            </script>";
            exit;
        }
    } else {
        echo "<script>alert('User not found');</script>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'login.html';
                }, 0);
            </script>";; // Redirect to pickup.html
            exit;
    }
}

$conn->close();
?>
            header('pickup.html');
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
}

$conn->close();
?>
           
            echo "Login successful. User ID: " . $row["user_id"];
            header('pickup.html');
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>

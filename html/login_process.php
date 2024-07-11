<?php
session_start(); // Start session for storing user information

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $db_password = "Agaba@859"; // Replace with your database password
    $dbname = "agriculturedatabase";
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute query to fetch user details
    $stmt = $conn->prepare("SELECT id, firstname, lastname, categories, hashed_password FROM signup WHERE email = ?");
    // $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['hashed_password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['categories'] = $user['categories'];

            // Redirect based on category
            switch ($user['categories']) {
                case 'farmer':
                    header("Location:farmers_db.php");
                    break;
                case 'collector':
                    header("Location: dashboard.php");
                    break;
                case 'agent':
                    header("Location: dashboard.php");
                    break;
                default:
                    // Redirect to a default page or handle error
                    header("Location: logIn.php");
                    break;
            }
            exit;
        } else {
            // Incorrect password
            echo "Incorrect password";
        }
    } else {
        // User not found
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
}
?>

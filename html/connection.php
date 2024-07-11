<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $dob = $_POST['dob'];
    $categories = $_POST['categories'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];


    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "Agaba@859";
    $dbname = "agriculturedatabase";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO signup (firstname,lastname, email, phonenumber, dob, categories, gender, hashed_password) VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$dob', '$categories', '$gender', '$password')");
    //$stmt->bind_param("ssss", $firstname, $lastname, $email, $phonenumber, $dob, $categories, $gender, $password);

    if ($stmt->execute()) {
        // Close the statement
        $stmt->close();
        $conn->close();

        // Redirect to login page
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
}
?>

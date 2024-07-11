<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nameoftheproduct'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['sellingprice'];
    $stock = $_POST['numberofproductsinthestock'];
    $image = $_POST['imageoftheproduct'];
    $lacation = $_POST['locationtopicktheproduct'];



    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agriculturedatabase";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO  products (name, description, category, price, stock, image, location) VALUES (('$name', '$description', '$category', '$price', '$stock', '$image', '$location'))");
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



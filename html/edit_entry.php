<?php
// Database connection
$servername = "localhost";
$username = "root";
$db_password = ""; // Replace with your database password
$dbname = "agriculturedatabase";
$conn = new mysqli($servername, $username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST requests for editing and deleting
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = $_POST['id'];
    if ($_POST['action'] === 'edit') {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];

        $sql = "UPDATE signup SET firstname = ?, lastname = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $firstname, $lastname, $email, $id);
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif ($_POST['action'] === 'delete') {
        $sql = "DELETE FROM signup WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}
$conn->close();
header("Location: /path/to/your/main/page.php");
exit();
?>

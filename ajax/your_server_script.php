<?php
// Replace these values with your actual database credentials
$host = 'your_database_host';
$username = 'your_database_username';
$password = 'your_database_password';
$database = 'demo_reg';

// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "demo");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data
$sql = "SELECT fname FROM demo_reg"; // Replace with your table name

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array()); // Return an empty array if no data is found
}

$conn->close();
?>

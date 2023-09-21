<?php
$host = 'your_database_host';
$username = 'your_database_username';
$password = 'your_database_password';
$database = 'demo_reg';

$conn = mysqli_connect("localhost", "root", "", "demo");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fnameToDelete = $_POST['fname']; // Assuming you pass the 'fname' value from JavaScript

$deleteSql = "DELETE FROM demo_reg WHERE fname = '$fnameToDelete'"; // Replace with your table name and 'fname' field name

if ($conn->query($deleteSql) === TRUE) {
    $selectSql = "SELECT fname FROM demo_reg"; // Replace with your table name and 'fname' field name

    $result = $conn->query($selectSql);

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array()); // Return an empty array if no data is found
    }
} else {
    echo json_encode(array()); // Return an empty array if deletion fails
}

$conn->close();
?>

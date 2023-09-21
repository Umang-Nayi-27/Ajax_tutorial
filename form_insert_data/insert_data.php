<?php
$host = 'your_database_host';
$username = 'your_database_username';
$password = 'your_database_password';
$database = 'your_database_name'; // Replace with your database name

// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "demo");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form data
$fname = $_POST['fname'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$token = $_POST['token'];
$token_exp = $_POST['token_exp'];

// Handle file upload (image)
if (isset($_FILES['img'])) {
    $img = $_FILES['img']['name'];
    $img_temp = $_FILES['img']['tmp_name'];

    // Specify the directory where you want to save the uploaded images
    $img_dir = 'uploads/';
    move_uploaded_file($img_temp, $img_dir . $img);
} else {
    $img = ''; // Set to an empty string if no image is uploaded
}

// Insert data into the database
$sql = "INSERT INTO demo_reg (fname, uname, email, pass, token, token_exp, img) 
        VALUES ('$fname', '$uname', '$email', '$pass', '$token', '$token_exp', '$img')";

if ($conn->query($sql) === TRUE) {
    $response = array('success' => true);
} else {
    $response = array('success' => false);
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>

<?php
session_start();

$response = array("success" => false, "message" => "");

if (isset($_POST['fullname'])) {
    $fullname = $_POST['fullname'];

    // Establish a database connection (replace with your database credentials)
    $connection = mysqli_connect("localhost", "root", "", "demo");

    if (!$connection)
    {
        $response["message"] = "Database connection failed: " . mysqli_connect_error();
    } 
    else 
    {
        // Sanitize and validate the input (replace with your own validation logic)
        $fullname = mysqli_real_escape_string($connection, $fullname);

        // Perform the database update
        $uname = $_SESSION["uname"];
        $updateQuery = "UPDATE `demo_reg` SET `fname`='$fullname' WHERE `uname`='$uname'";
        $updateResult = mysqli_query($connection, $updateQuery);

        if ($updateResult) {
            $_SESSION["fname"] = $fullname;
            $response["success"] = true;
            $response["message"] = "Profile updated successfully!";
        } else {
            $response["message"] = "Update failed: " . mysqli_error($connection);
        }

        // Close the database connection
        mysqli_close($connection);
    }
} else {
    $response["message"] = "Invalid request.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>

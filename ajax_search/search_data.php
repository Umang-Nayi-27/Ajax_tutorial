<?php
session_start();

$response = array("success" => false, "message" => "", "data" => array());

// Establish a database connection (replace with your database credentials)
$connection = mysqli_connect("localhost", "root", "", "demo");

if (!$connection) {
    $response["message"] = "Database connection failed: " . mysqli_connect_error();
} else {
    if (isset($_GET['q'])) {
        $searchValue = mysqli_real_escape_string($connection, $_GET['q']);
        

        // Fetch data from the database based on the search query
        $selectQuery = "SELECT `fname` FROM `search` WHERE  `fname` LIKE '%$searchValue%'";
        $selectResult = mysqli_query($connection, $selectQuery);

        if ($selectResult) {
            $data = array();

            while ($row = mysqli_fetch_assoc($selectResult)) {
                $data[] = $row;
            }

            if (!empty($data)) {
                $response["data"] = $data;
                $response["success"] = true;
            } else {
                $response["message"] = "No results found.";
            }
        } else {
            $response["message"] = "Query failed: " . mysqli_error($connection);
        }
    } else {
        $response["message"] = "Invalid request.";
    }

    // Close the database connection
    mysqli_close($connection);
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

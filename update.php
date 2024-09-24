<?php
include 'db.php';
// Assuming you have retrieved $name, $address, $budget, and $projectId from the POST request
$name = $_POST['Name_of_Project'];
$address = $_POST['address'];
$budget = $_POST['budget'];
$projectId = $_POST['ProjectID'];

// Update query with LIMIT 1 to update only one row
$sql = "UPDATE projects SET Name_of_Project='$name', Address='$address', Budget='$budget' WHERE Name_of_Project='$name' ";


if ($conn->query($sql) === TRUE) {
    $response = array("success" => true);
    echo json_encode($response);
} else {
    $response = array("success" => false, "error" => $conn->error);
    echo json_encode($response);
}

$conn->close();
?>

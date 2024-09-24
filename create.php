<?php
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';

$name = $_POST['Name_of_Project'] ?? '';
$address = $_POST['address'] ?? '';
$budget = $_POST['budget'] ?? '';
$project_id = $_POST['ProjectID'] ?? '';

$response = [];

if (empty($name) && empty($address) && empty($budget)) {
    $response = ["message" => "At least one field is required."];
} else {
    $sql = "INSERT INTO projects (Name_of_Project, Address, Budget, ProjectID) VALUES ('$name', '$address', '$budget', '$project_id')";
    if ($conn->query($sql) === TRUE) {
        $response = ["message" => "Record added successfully", "id" => $conn->insert_id];
    } else {
        $response = ["message" => "Error: " . $sql . " - " . $conn->error];
    }
}

$conn->close();

echo json_encode($response);
?>

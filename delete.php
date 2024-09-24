<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

include 'db.php'; // Include your database connection file

$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'] ?? '';

$response = [];

if ($name) {
    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM projects WHERE Name_of_Project = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        $response = ["success" => true];
    } else {
        $error_message = "Error deleting project: " . $stmt->error;
        error_log($error_message, 3, '/path/to/error.log'); // Log error to a file
        $response = ["success" => false, "message" => $error_message];
    }

    $stmt->close();
} else {
    $response = ["success" => false, "message" => "Invalid Name"];
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>

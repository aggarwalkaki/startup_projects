<?php
// Include your database connection file here
include 'db.php';

// Check if form data is received through POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize inputs
    $projectId = $_POST['ProjectID'];
    $name = $_POST['Name_of_Project'];
    $address = $_POST['address'];
    $implementingAgency = $_POST['Implementing_Agency'];
    $projectObjectives = $_POST['Project_Objectives'];
    $areasOfTechnology = $_POST['Areas_of_Technology_Develop'];
    $budget = $_POST['budget'];
    $fundsToBeReleased = $_POST['FundsToBeReleased'];
    $fundsReleased = $_POST['Funds_Released'];
    $numStartupIncubated = $_POST['No_of_Startup_Incubated'];
    $prsgDates = $_POST['PRSGDates'];
    $projectApprovalDate = $_POST['Project_Approval_Date'];
    $projectDeadline = $_POST['Project_Deadline'];
    $projectDuration = $_POST['Project_Duration'];
    $totalInvestment = $_POST['Total_Investment_Generated'];
    $totalOutlay = $_POST['Total_Outlay'];
    $actionTaken = $_POST['ActionTaken'];
    $outcomeSoFar = $_POST['outcome_so_far'];

    // Prepare update query
    $sql = "UPDATE projects SET 
            Name_of_Project='$name', 
            Address='$address', 
            Implementing_Agency='$implementingAgency', 
            Project_Objectives='$projectObjectives', 
            Areas_of_Technology_Develop='$areasOfTechnology', 
            Budget='$budget', 
            FundsToBeReleased='$fundsToBeReleased', 
            Funds_Released='$fundsReleased', 
            No_of_Startup_Incubated='$numStartupIncubated', 
            PRSGDates='$prsgDates', 
            Project_Approval_Date='$projectApprovalDate', 
            Project_Deadline='$projectDeadline', 
            Project_Duration='$projectDuration', 
            Total_Investment_Generated='$totalInvestment', 
            Total_Outlay='$totalOutlay', 
            ActionTaken='$actionTaken', 
            outcome_so_far='$outcomeSoFar' 
            WHERE  Name_of_Project='$name'";

    // Execute update query
    if ($conn->query($sql) === TRUE) {
        // Success response
        $response = array("success" => true);
    } else {
        // Error response
        $response = array("success" => false, "error" => $conn->error);
    }

    // Return JSON response
    echo json_encode($response);
}

// Close database connection
$conn->close();
?>


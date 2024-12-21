<?php
// Retrieve data from POST
require("../model/db.php");
$data = json_decode(file_get_contents("php://input"), true);
$vehicleID = isset($data['VehicleID']) ? intval($data['VehicleID']) : 0;

if ($vehicleID === 0) {
    die(json_encode(['error' => 'Vehicle ID is required']));
}

// Get the current status
$sql = "SELECT Status FROM vehicles WHERE VehicleID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vehicleID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $newStatus = $row['Status'] === 'Available' ? 'Not Available' : 'Available';

    // Update the status
    $updateSql = "UPDATE vehicles SET Status = ? WHERE VehicleID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $newStatus, $vehicleID);
    $updateStmt->execute();

    echo json_encode(['success' => true, 'newStatus' => $newStatus]);
} else {
    echo json_encode(['error' => 'Vehicle not found']);
}

$conn->close();

?>
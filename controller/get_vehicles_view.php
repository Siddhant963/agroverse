<?php
// Fetch owner ID from GET or session
require("../model/db.php");
$ownerID = isset($_GET['ownerID']) ? intval($_GET['ownerID']) : 0;

if ($ownerID === 0) {
    die(json_encode(['error' => 'Owner ID is required']));
}

// Query to fetch vehicles for the owner
$sql = "SELECT VehicleID, Brand, Model, HourlyRate, Status, Location FROM vehicles WHERE OwnerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ownerID);
$stmt->execute();
$result = $stmt->get_result();

$vehicles = [];
while ($row = $result->fetch_assoc()) {
    $vehicles[] = $row;
}

echo json_encode($vehicles);

$conn->close();

?>
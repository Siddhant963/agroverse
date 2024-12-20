<?php 
require("../model/db.php");
$vehicleType = isset($_GET['vehicleType']) ? $_GET['vehicleType'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';

// $vehicleType = 'Tractor-Trolley';
// $location = 'jabalpur';
// Fetch vehicles based on the selected type
if ($vehicleType) {
    // Query to get vehicles of the specified type
    $sql = "SELECT VehicleID, Brand, Model, HourlyRate, Status FROM Vehicles WHERE VehicleType = ? AND Status = 'Available' AND location = ? ";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $vehicleType , $location); // Bind the vehicle type parameter
        $stmt->execute();
        $result = $stmt->get_result();

        $vehicles = [];
        while ($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }

        // Return the vehicles as a JSON response
        echo json_encode($vehicles);
    } else {
        echo json_encode(['error' => 'Failed to prepare query']);
    }
} else {
    echo json_encode(['error' => 'No vehicle type specified']);
}


?>
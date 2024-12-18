<?php
require("../model/db.php");

$vehicleID = isset($_POST['vehicleID']) ? $_POST['vehicleID'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$hours = isset($_POST['hours']) ? $_POST['hours'] : '';

// Get the hourly rate for the vehicle
$sql = "SELECT HourlyRate FROM Vehicles WHERE VehicleID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vehicleID);
$stmt->execute();
$stmt->bind_result($hourlyRate);
$stmt->fetch();
$stmt->close();

// Calculate total payment
$totalPayment = $hourlyRate * $hours;
$Booker_id =  $_SESSION['user_id'];
// Validate inputs
if ($vehicleID && $date && $hours) {
    // Insert booking into the bookings table (create this table as necessary)
    $sql = "INSERT INTO Bookings (BookerID,VehicleID, BookingDate, Hours, TotalPayment,Status) VALUES (?,?, ?, ?, ?,'Pending')";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iisid", $Booker_id, $vehicleID, $date, $hours, $totalPayment); // Bind parameters
        if ($stmt->execute()) {
            // Successfully booked
            echo json_encode(['success' => true]);
        } else {
            // Failed to book
            echo json_encode(['success' => false, 'error' => 'Failed to execute query']);
        }
    } else {
        // Failed to prepare the query
        echo json_encode(['success' => false, 'error' => 'Failed to prepare query']);
    }
} else {
    // Missing required parameters
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
}

?>
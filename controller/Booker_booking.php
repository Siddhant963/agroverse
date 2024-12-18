<?php
// Include your database connection file
require("../model/db.php");

header('Content-Type: application/json');
$user_id =  $_SESSION['user_id'];

// Query to fetch all bookings with vehicle details for the owner with ID = 1
$query = "SELECT b.BookingID, b.VehicleID, b.BookingDate, b.Hours, b.TotalPayment, b.Status, v.Brand, v.Model, v.VehicleType
          FROM Bookings b
          JOIN Vehicles v ON b.VehicleID = v.VehicleID
          WHERE b.BookerID = $user_id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $bookings = [];
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    echo json_encode($bookings);
} else {
    echo json_encode([]);
}

$conn->close();
?>

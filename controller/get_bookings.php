<?php
require('../model/db.php');
$sql = "SELECT b.BookingID, u.name, v.VehicleType, v.model, v.location, b.BookingDate, b.Hours, b.TotalPayment
FROM bookings b
INNER JOIN Vehicles v ON b.VehicleID = v.VehicleID
INNER JOIN users u ON b.BookerID = u.UserID;";
$result = $conn->query($sql);

// Initialize an empty array to store booking data
$bookings = [];

if ($result->num_rows > 0) {
    // Fetch each row and add it to the bookings array
    while ($row = $result->fetch_assoc()) {
        $bookings[] = [
            'BookingID' => $row['BookingID'],
            'CustomerName' => $row['name'],
            'VehicleType' => $row['VehicleType'],
            'Location' => $row['location'],
            'Date' => $row['BookingDate'],
            'Hours' => $row['Hours'],
            'TotalPayment' => $row['TotalPayment']
        ];
    }
    // Return the booking data as a JSON response
    echo json_encode($bookings);
} else {
    // Return an empty array if no bookings found
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
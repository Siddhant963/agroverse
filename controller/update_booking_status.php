<?php
// Include database connection file
require("../model/db.php");

// Get the input data (booking ID and status) from the frontend
$data = json_decode(file_get_contents('php://input'), true);

$bookingID = $data['bookingID'];
$status = $data['status'];

// Query to update the status of the booking
$query = "UPDATE Bookings SET Status = ? WHERE BookingID = ?";

// Prepare the statement
$stmt = $conn->prepare($query);
$stmt->bind_param('si', $status, $bookingID);

// Execute the query
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

// Close the connection
$stmt->close();
$conn->close();
?>

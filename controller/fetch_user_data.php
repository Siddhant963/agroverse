<?php
require '../model/db.php'; // Include your database connection file

$user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

// echo $_SESSION['user_id'];

// Ensure proper escaping to prevent SQL injection
$user_id = mysqli_real_escape_string($conn, $user_id);

$sql = "SELECT name, email, UserType FROM users WHERE UserID = '$user_id'";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(["error" => "User not found"]);
    }
} else {
    echo json_encode(["error" => "Query execution failed: " . $conn->error]);
}

$conn->close();
?>
<?php 
require ("../model/db.php");

if (isset($_POST['registerVehicle'])) {
     // Get form data
     $vehicleType = $_POST['vehicleType'];
     $brand = $_POST['brand'];
     $model = $_POST['model'];
     $hourlyRate = $_POST['hourlyRate'];
     $ownerID =  $_SESSION['user_id']; // Assuming the owner is logged in with a session, set the owner ID here (replace with dynamic session value if necessary)
 
     // Prepare SQL statement to insert vehicle data
     $sql = "INSERT INTO Vehicles (OwnerID, VehicleType, Brand, Model, HourlyRate, Status) 
             VALUES (?, ?, ?, ?, ?, 'Available')";
 
     // Prepare statement
     if ($stmt = $conn->prepare($sql)) {
         // Bind parameters
         $stmt->bind_param("isssd", $ownerID, $vehicleType, $brand, $model, $hourlyRate);
 
         // Execute the statement
         if ($stmt->execute()) {
             echo "Vehicle registered successfully!";
             `<script>
             alert("Vehicle registered successfully!");
             </script>`;
             header("Location:../views/Owner/owner_dashboard.php");
         } else {
             echo "Error: " . $stmt->error;
         }
 
         // Close statement
         $stmt->close();
     } else {
         echo "Error: " . $conn->error;
     }
 }

?>
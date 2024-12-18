<?php
require("../model/db.php");
// session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $email = $conn->real_escape_string($_POST['email']);
     $password = $_POST['password'];
 
     // Check user in database
     $sql = "SELECT * FROM Users WHERE Email = '$email'";
     $result = $conn->query($sql);
 
     if ($result->num_rows > 0) {
         $user = $result->fetch_assoc();
 
         // Verify password
         if (password_verify($password, $user['Password'])) {
             $_SESSION['user_id'] = $user['UserID'];
             $_SESSION['user_type'] = $user['UserType'];
             
          //    Redirect based on user type
             if ($user['UserType'] == 'Owner') {
                 header("Location:../views/Owner/owner_dashboard.php");
               
             } elseif ($user['UserType'] == 'Booker') {
                 header("Location:../views/Booker/booker_dashboard.php");
              
             }
             exit();
         } else {
             echo "Invalid password.";
         }
     } else {
         echo "No user found with this email.";
     }
 }

?>
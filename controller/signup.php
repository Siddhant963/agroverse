<?php
require("../model/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = $conn->real_escape_string($_POST['name']);
     $email = $conn->real_escape_string($_POST['email']);
     $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
     $phone = $conn->real_escape_string($_POST['phone']);
     $userType = $conn->real_escape_string($_POST['userType']);
 
     $sql = "INSERT INTO Users (Name, Email, Password, PhoneNumber, UserType) 
             VALUES ('$name', '$email', '$password', '$phone', '$userType')";
 
     if ($conn->query($sql) === TRUE) {
         echo "Sign up successful!";
         header("Location:../views/login.php");
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }
 
  
 }
?>
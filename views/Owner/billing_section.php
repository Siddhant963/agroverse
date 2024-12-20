<?php
// billing_section.php
require_once('../../model/db.php');

$bookingID = $_GET['bookingID'] ?? null;

if (!$bookingID) {
    echo "<p>Invalid Booking ID.</p>";
    exit;
}

// Fetch booking details from the database
$query = "SELECT * FROM Bookings b
JOIN Vehicles v ON b.VehicleID = v.VehicleID
 WHERE BookingID  = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $bookingID);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    echo "<p>No booking found for this ID.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Section</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
        }
        .billing-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        .billing-container h2 {
            margin-bottom: 20px;
        }
        .billing-container p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
        }

        .navbar .brand {
            display: flex;
            align-items: center;
        }

        .navbar .brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar .brand span {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar .nav-links {
            display: flex;
            align-items: center;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            font-size: 16px;
            transition: color 0.3s;
        }

        .navbar .nav-links a:hover {
            color: #d1eaff;
        }
        @media (max-width: 768px) {
            .navbar .nav-links {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar .nav-links a {
                margin: 5px 0;
            }

            .hero h1 {
                font-size: 28px;
            }

            .hero p {
                font-size: 16px;
            }
        }
        .profile {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #007bff;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 20px;
            text-transform: uppercase;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 200px;
            z-index: 1000;
        }

        .profile-dropdown.active {
            display: block;
        }

        .profile-dropdown .dropdown-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            color: #333;
        }

        .profile-dropdown .dropdown-item:last-child {
            border-bottom: none;
        }

        .profile-dropdown .dropdown-item:hover {
            background: #f5f5f5;
        }
        .footer {
            background: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin-top: auto;
        }

        .footer p {
            margin: 5px 0;
            font-size: 14px;
        }

        .footer a {
            color: #ffc107;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="navbar">
        <div class="brand">
            <img src="../../assets/logo.jpg" alt="Logo">
            <span>Agroverse</span>
        </div>
        <div class="nav-links">
            <a href="./owner_dashboard.php">Home</a>
            <a href="./Bookings.php">Bookings</a>
            <div class="profile" onclick="toggleDropdown()">
                <div class="profile-icon">B</div>
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="dropdown-item"><strong>Name:</strong> <span id="userName"></span></div>
                    <div class="dropdown-item"><strong>Email:</strong> <span id="userEmail"></span></div>
                    <div class="dropdown-item"><strong>Role:</strong> <span id="userRole"></span></div>
                    <a href="../../controller/logout.php"><div class="dropdown-item"><strong>Logout</strong></div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="billing-container">
        <h2>Payment Slip</h2>
        <p><strong>Booking ID:</strong> <?= htmlspecialchars($booking['BookingID']); ?></p>
        <p><strong>Brand:</strong> <?= htmlspecialchars($booking['Brand']); ?></p>
        <p><strong>Model:</strong> <?= htmlspecialchars($booking['Model']); ?></p>
        <p><strong>Vehicle Type:</strong> <?= htmlspecialchars($booking['VehicleType']); ?></p>
        <p><strong>Booking Date:</strong> <?= htmlspecialchars($booking['BookingDate']); ?></p>
        <p><strong>Hours:</strong> <?= htmlspecialchars($booking['Hours']); ?></p>
        <p><strong>Total Payment:</strong> $<?= htmlspecialchars($booking['TotalPayment']); ?></p>
        <a href="./owner_dashboard.php" class="btn">Back to Dashboard</a>
        
    </div>
    <div class="footer">
        <p>&copy; 2024 Agroverse. All rights reserved.</p>
        <p>Need help? Contact us at <a href="mailto:help@brandname.com">help@brandname.com</a></p>
    </div>

</body>
</html>

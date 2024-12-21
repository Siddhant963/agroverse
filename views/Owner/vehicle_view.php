<?php 
require('../../model/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .toggle-btn {
            padding: 5px 10px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .toggle-btn.not-available {
            background-color: #dc3545;
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
            <a href="./vehicle_view.php">see your Vehicles</a>
            <a href="./Bookings.php">Bookings</a>
            <div class="profile" onclick="toggleDropdown()">
                <div class="profile-icon">A</div>
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

    <h1>Vehicle Management</h1>
    <table>
        <thead>
            <tr>
                <th>Vehicle ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Hourly Rate</th>
                <th>Status</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="vehicleTableBody"></tbody>
    </table>

    <div class="footer">
        <p>&copy; 2024 Agroverse. All rights reserved.</p>
        <p>Need help? Contact us at <a href="mailto:help@brandname.com">help@brandname.com</a></p>
    </div>

    <script>
        const ownerID = <?php echo $_SESSION['user_id'] ?>; // Replace with the actual owner ID
        const vehicleTableBody = document.getElementById('vehicleTableBody');

        // Fetch all vehicles for the owner
        function fetchVehicles() {
            fetch(`../../controller/get_vehicles_view.php?ownerID=${ownerID}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error(data.error);
                        return;
                    }

                    vehicleTableBody.innerHTML = data.map(vehicle => `
                        <tr>
                            <td>${vehicle.VehicleID}</td>
                            <td>${vehicle.Brand}</td>
                            <td>${vehicle.Model}</td>
                            <td>$${vehicle.HourlyRate}</td>
                            <td id="status-${vehicle.VehicleID}">${vehicle.Status}</td>
                            <td>${vehicle.Location}</td>
                            <td>
                                <button 
                                    class="toggle-btn ${vehicle.Status === 'Not Available' ? 'not-available' : ''}" 
                                    onclick="toggleStatus(${vehicle.VehicleID})">
                                    Toggle
                                </button>
                            </td>
                        </tr>
                    `).join('');
                })
                .catch(err => console.error('Error fetching vehicles:', err));
        }

        // Toggle vehicle status
        function toggleStatus(vehicleID) {
            fetch('../../controller/update_vehicle_status.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ VehicleID: vehicleID })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const statusCell = document.getElementById(`status-${vehicleID}`);
                        const button = document.querySelector(`button[onclick="toggleStatus(${vehicleID})"]`);
                        statusCell.textContent = data.newStatus;
                        button.classList.toggle('not-available', data.newStatus === 'Not Available');
                    } else {
                        console.error(data.error);
                    }
                })
                .catch(err => console.error('Error updating status:', err));
        }

        // Initial fetch
        fetchVehicles();
    </script>
     <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('active');
        }

        // Fetch user data dynamically
        fetch('../../controller/fetch_user_data.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('userName').textContent = data.name;
                document.getElementById('userEmail').textContent = data.email;
                document.getElementById('userRole').textContent = data.UserType;
            })
            .catch(err => console.error('Error fetching user data:', err));

        // Booking functionality
        document.getElementById('bookVehicle').addEventListener('click', () => {
            const vehicle = document.getElementById('vehicleSelect').value;
            const pickupDate = document.getElementById('pickupDate').value;
            const returnDate = document.getElementById('returnDate').value;
            const additionalNotes = document.getElementById('additionalNotes').value;

            if (vehicle && pickupDate && returnDate) {
                alert(`Booking confirmed:\nVehicle: ${vehicle}\nPick-up: ${pickupDate}\nReturn: ${returnDate}\nNotes: ${additionalNotes}`);
            } else {
                alert('Please fill in all required fields.');
            }
        });
    </script>
</body>
</html>

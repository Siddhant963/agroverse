<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
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

        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .booking-card {
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .booking-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .booking-card p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .booking-card .buttons {
            margin-top: 10px;
        }
        .booking-card .btn {
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        .booking-card .btn.accept {
            background-color: #28a745;
            color: white;
        }
        .booking-card .btn.cancel {
            background-color: #dc3545;
            color: white;
        }
        .booking-card .btn:hover {
            opacity: 0.8;
        }
        .booking-card .hidden {
            display: none;
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

<div class="container" id="bookingListContainer">
    <!-- Booking details will be displayed here -->
</div>

<div class="footer">
        <p>&copy; 2024 Agroverse. All rights reserved.</p>
        <p>Need help? Contact us at <a href="mailto:help@brandname.com">help@brandname.com</a></p>
    </div>

<script>
    // Fetch booking details from the server
    fetch('../../controller/fetch_bookings.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('bookingListContainer');
            
            if (data.length === 0) {
                container.innerHTML = '<p>No bookings available.</p>';
            } else {
                data.forEach(booking => {
                    // Create booking card HTML
                    const bookingCard = `
                        <div class="booking-card" id="booking-${booking.BookingID}">
                            <h3>${booking.Brand} ${booking.Model} (${booking.VehicleType})</h3>
                            <p><strong>Booking Date:</strong> ${booking.BookingDate}</p>
                            <p><strong>Hours:</strong> ${booking.Hours}</p>
                            <p><strong>Total Payment:</strong> $${booking.TotalPayment}</p>
                            <p><strong>Status:</strong> <span id="status-${booking.BookingID}">${booking.Status}</span></p>
                            <div class="buttons">
                                <button class="btn accept" id="accept-btn-${booking.BookingID}" onclick="updateStatus(${booking.BookingID}, 'Confirmed')">Accept</button>
                                <button class="btn cancel" id="cancel-btn-${booking.BookingID}" onclick="updateStatus(${booking.BookingID}, 'Cancelled')">Cancel</button>
                            </div>
                        </div>
                    `;
                    container.innerHTML += bookingCard;
                });
            }
        })
        .catch(err => console.error('Error fetching bookings:', err));

    // Function to update the booking status
    function updateStatus(bookingID, status) {
        // Send the updated status to the server
        fetch('../../controller/update_booking_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ bookingID: bookingID, status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the status on the page
                document.getElementById(`status-${bookingID}`).innerText = status;

                // Hide both Accept and Cancel buttons after a selection
                document.getElementById(`accept-btn-${bookingID}`).classList.add('hidden');
                document.getElementById(`cancel-btn-${bookingID}`).classList.add('hidden');
            } else {
                alert('Error updating status');
            }
        })
        .catch(err => console.error('Error updating status:', err));
    }
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
    </script>

</body>
</html>

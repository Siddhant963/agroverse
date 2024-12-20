<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agroverse</title>
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
        .vehicle-type-links a {
            margin-right: 20px;
            font-size: 18px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .vehicle-type-links a:hover {
            text-decoration: underline;
        }
        .vehicle-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }
        .vehicle-card {
            width: 30%;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .vehicle-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .vehicle-card p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .vehicle-card .book-now-btn {
            background: #28a745;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .vehicle-card .book-now-btn:hover {
            background: #218838;
        }
        .vehicle-card .booking-details {
            margin-top: 15px;
        }
        .vehicle-card input {
            padding: 8px;
            margin-top: 5px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }
        .vehicle-card label {
            font-weight: bold;
        }
        .total-payment {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
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
            <a href="./booker_dashboard.php">Home</a>
            <a href="./vehicles.php">Vehicles</a>
            <a href="./Booking.php">Bookings</a>
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

<div class="container">
    <!-- Links for Vehicle Types -->
    <form id="vehicleForm">
    <label for="vehicleType">Type of Vehicle:</label>
    <select id="vehicleType" required>
      <option value="">Select a vehicle type</option>
      <option value="Tractor-Trolley">Tractor-Trolley</option>
      <option value="Tractor-Rotary">Tractor Rotary</option>
      <option value="Tractor-Cultivator">Tractor-Cultivator</option>
      <option value="Harvester">Harvester</option>
    </select>

    <label for="location">Location:</label>
    <input type="text" id="location" placeholder="Enter location" required>

    <button type="button" onclick="searchVehicles()">Search</button>
  </form>

    <!-- Vehicle List will be populated here -->
    <div class="vehicle-list" id="vehicleList"></div>
</div>
<div class="footer">
        <p>&copy; 2024 Agroverse. All rights reserved.</p>
        <p>Need help? Contact us at <a href="mailto:help@brandname.com">help@brandname.com</a></p>
    </div>

<script>
    function searchVehicles() {
    // Get the selected vehicle type and location from the form
    const vehicleType = document.getElementById("vehicleType").value.trim();
    const location = document.getElementById("location").value.trim();

    // Validate input
    if (!vehicleType || !location) {
        alert("Please select a vehicle type and provide a location.");
        return;
    }

    console.log("Vehicle Type:", vehicleType);
    console.log("Location:", location);

    // Send a request to the server to fetch the vehicle data
    fetch(`../../controller/get_vehicles.php?vehicleType=${vehicleType}&location=${location}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            const vehicleList = document.getElementById('vehicleList');

            // Handle empty data response
            if (data.length === 0) {
                vehicleList.innerHTML = '<p>No vehicles found for the selected type and location.</p>';
                return;
            }

            // Render vehicle cards dynamically
            vehicleList.innerHTML = data.map(vehicle => {
                const vehicleId = vehicle.VehicleID || "Unknown";
                const brand = vehicle.Brand || "Unknown Brand";
                const model = vehicle.Model || "Unknown Model";
                const hourlyRate = vehicle.HourlyRate || 0;
                const status = vehicle.Status || "Unavailable";

                return `
                    <div class="vehicle-card" id="vehicle-${vehicleId}">
                        <h3>${brand} ${model}</h3>
                        <p>Hourly Rate: $${hourlyRate}</p>
                        <p>Status: ${status}</p>
                        <div class="booking-details">
                            <label for="date-${vehicleId}">Select Date:</label>
                            <input type="date" id="date-${vehicleId}" required />
                            <label for="hours-${vehicleId}">Select Hours:</label>
                            <input type="number" id="hours-${vehicleId}" min="1" required onchange="calculateTotal(${vehicleId}, ${hourlyRate})" />
                            <div class="total-payment" id="total-payment-${vehicleId}">
                                Total Payment: 0
                            </div>
                            <button class="book-now-btn" onclick="bookNow(${vehicleId})">Book Now</button>
                        </div>
                    </div>
                `;
            }).join('');
        })
        .catch(err => {
            console.error('Error fetching vehicles:', err);
            alert("An error occurred while fetching vehicle data. Please try again.");
        });
}


    // Function to calculate total payment dynamically
    function calculateTotal(vehicleID, hourlyRate) {
        const hours = document.getElementById(`hours-${vehicleID}`).value;
        const totalPaymentElement = document.getElementById(`total-payment-${vehicleID}`);
        
        if (hours && hours > 0) {
            const totalPayment = hourlyRate * hours;
            totalPaymentElement.innerText = `Total Payment: $${totalPayment.toFixed(2)}`;
        } else {
            totalPaymentElement.innerText = 'Total Payment: $0';
        }
    }


    // Function to handle the booking action
    function bookNow(vehicleID) {
        const date = document.getElementById(`date-${vehicleID}`).value;
        const hours = document.getElementById(`hours-${vehicleID}`).value;

        if (!date || !hours) {
            alert('Please select both date and hours.');
            return;
        }

        // Send booking data to the server (you can modify this part to handle actual booking in the backend)
        const formData = new FormData();
        formData.append('vehicleID', vehicleID);
        formData.append('date', date);
        formData.append('hours', hours);

        fetch('../../controller/book_vehicle.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Booking successful!');
            } else {
                alert('Booking failed. Please try again.');
            }
        })
        .catch(err => {
            console.error('Error during booking:', err);
            alert('Booking failed.');
        });
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        .hero {
            background: url('../../assets/header.jpg') no-repeat center center/cover;
            color: #fff;
            text-align: center;
            padding: 50px 20px;
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .hero .btn {
            background: #ff5733;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .hero .btn:hover {
            background: #e64a19;
        }

        .services {
            padding: 20px;
            text-align: center;
        }

        .services h2 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .services p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .services .btn {
            background: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .services .btn:hover {
            background: #218838;
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

    <div class="hero">
        <h1>Get Started With Us</h1>
        <p>Your trusted partner in vehicle rentals and management.</p>
        <button class="btn">Learn More</button>
    </div>

    <div class="services">
        <h2>Our Services</h2>
        <p>We offer a wide range of vehicle rental solutions tailored to your needs.</p>
        <a href="./vehicle_register.php" class="btn">Register Your Vehicle</a>
    </div>

    <div class="footer">
        <p>&copy; 2024 Agroverse. All rights reserved.</p>
        <p>Need help? Contact us at <a href="mailto:help@brandname.com">help@brandname.com</a></p>
    </div>
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

# Agroverse farming Vehicle Booking System

Agroverse is a vehicle rental management system designed for managing bookings, vehicle details, and user accounts. The platform allows users (bookers) to view available vehicles based on type, book a vehicle for a specific duration, and make payments. The owners can manage their vehicle listings and approve or reject booking requests.

## Features

- **Owner Dashboard**: Allows vehicle owners to add and manage their vehicles, including vehicle type, brand, model, and pricing.
- **Booking System**: Bookers can select vehicles based on type, choose a booking date, select the number of hours, and pay for the booking.
- **Booking Management**: Owners can view and manage all their bookings, approve or reject them based on status.
- **User Authentication**: Basic login system for both owners and bookers with session management.
  
## Requirements

- PHP (7.x or higher)
- MySQL Database
- Apache or Nginx Server

## Setup Instructions

### 1. Clone the Repository

Clone the repository to your local machine or server:

```bash
git clone https://github.com/Siddhant963/agroverse.git


use following cmd to setup db

CREATE DATABASE agroverse;

CREATE TABLE agroverse.Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    PhoneNumber VARCHAR(15),
    UserType ENUM('Owner', 'Booker') NOT NULL
);

CREATE TABLE Vehicles (
    VehicleID INT AUTO_INCREMENT PRIMARY KEY,
    OwnerID INT NOT NULL,
    VehicleType VARCHAR(50) NOT NULL,
    Brand VARCHAR(100),
    Model VARCHAR(100),
    HourlyRate DECIMAL(10, 2) NOT NULL,
    Status ENUM('Available', 'Unavailable') DEFAULT 'Available',
    FOREIGN KEY (OwnerID) REFERENCES Users(UserID) ON DELETE CASCADE
);

CREATE TABLE Bookings (
    BookingID INT AUTO_INCREMENT PRIMARY KEY,
     BookerID INT NOT NULL,
    VehicleID INT NOT NULL,
    BookingDate DATE NOT NULL,
    Hours INT NOT NULL,
    TotalPayment DECIMAL(10, 2) NOT NULL,
    Status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
     FOREIGN KEY (BookerID) REFERENCES Users(UserID) ON DELETE CASCADE,
    FOREIGN KEY (VehicleID) REFERENCES Vehicles(VehicleID) ON DELETE CASCADE
    
);

ater this change in model folder db.php file 
in password  and db name 

and your setup is done 
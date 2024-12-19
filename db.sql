-- Create the database
CREATE DATABASE registration_db;

-- Use the database
USE registration_db;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,    -- Unique user ID
    name VARCHAR(255) NOT NULL,           -- Full name of the user
    email VARCHAR(255) NOT NULL,          -- Email address
    phone VARCHAR(15) NOT NULL,           -- Phone number
    gender ENUM('Male', 'Female', 'Other') NOT NULL, -- Gender
    password VARCHAR(255) NOT NULL,       -- Password
    dob DATE NOT NULL,                    -- Date of birth
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Creation timestamp
);

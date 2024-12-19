<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $gender = $conn->real_escape_string(trim($_POST['gender']));
    $password = $conn->real_escape_string(trim($_POST['password']));
    $dob = $conn->real_escape_string(trim($_POST['dob']));

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($gender) || empty($password) || empty($dob)) {
        $error_message = "All fields are required.";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert data into the database
        $sql = "INSERT INTO users (name, email, phone, gender, password, dob) 
                VALUES ('$name', '$email', '$phone', '$gender', '$hashedPassword', '$dob')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            $success = true;
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Result</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }
        .message {
            text-align: center;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .user-details {
            background-color: #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .user-details h2 {
            color: #34495e;
            margin-bottom: 15px;
        }
        .user-details p {
            margin: 10px 0;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Result</h1>
        <?php if (isset($success) && $success): ?>
            <div class="message success">
                Registration successful! 🎉
            </div>
            <div class="user-details">
                <h2>Your Registration Details:</h2>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($dob); ?></p>
            </div>
        <?php elseif (isset($error_message)): ?>
            <div class="message error">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <a href="index.html" class="back-link">Back to Registration Form</a>
    </div>
</body>
</html>


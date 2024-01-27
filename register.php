<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body {
            font-family: Poppins, sans-serif;
            background-image: url("images/bgcool.jpg");
            background-size: cover;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #F2F7A1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #435585;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #435585;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .success {
            color: green;
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .back-button {
            background-color: #435585;
            color: #fff;
            padding: 12px;
            margin-left: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #444;
        }
    </style>
    <title>User Registration Form</title>
</head>
<body>

<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <div class="button-container">
        <input type="submit" value="Register">
        <input type="button" class="back-button" value="Back" onclick="location.href='login.php';">
    </div>
</form>

<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BlogSite";
 
$conn = new mysqli($servername, $username, $password, $dbname);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $email = $_POST["email"];
 
    // Insert user data into tblAccounts
    $sql = "INSERT INTO tblAccounts (username, password, email) VALUES ('$username', '$password', '$email')";
 
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
 
$conn->close();
?>

</body>
</html>

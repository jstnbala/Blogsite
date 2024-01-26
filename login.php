<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #E5D2B8;
            text-align: center;
            margin: 50px;
            padding: 50px;
        }

        h2 {
            color:black;
        }

        form {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #E5E0D8;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #D2AB80;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
 
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and process login
        $username = $_POST["username"];
        $password = $_POST["password"];
 
        // Database connection
        $servername = "localhost";
        $dbUsername = "root"; // Replace with your actual database username
        $dbPassword = "";
        $dbname = "BlogSite";

 
        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
 
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
 
        // Check login credentials
        $sql = "SELECT id, username, password FROM tblAccounts WHERE username='$username'";
        $result = $conn->query($sql);
 
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
 
            // Verify password
            if (password_verify($password, $row["password"])) {
                // Start a session and store user ID
                session_start();
                $_SESSION["user_id"] = $row["id"];
 
                // Redirect to admin dashboard
                header("Location: admin.php");
                exit();
            } else {
                echo "Invalid password";
            }
        } else {
            echo "Invalid username";
        }
 
        $conn->close();
    }
    ?>
 
    <!-- Login Form -->
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
 
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
 
        <input type="submit" value="Login">
        <a href="index.php">Create an account</a>
    </form>
</body>
</html>

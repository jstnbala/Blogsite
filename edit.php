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
            font-family: 'Poppins';
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
    <title>User Edit Form</title>
</head>
<body>

<?php
// Check if an ID is provided
if (isset($_GET["id"])) {
    $id = $_GET["id"];
 
    // Fetch user data based on ID from tblAccounts
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BlogSite";
 
    $conn = new mysqli($servername, $username, $password, $dbname);
 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
    $sql = "SELECT id, username, email FROM tblAccounts WHERE id = $id";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row["username"];
        $email = $row["email"];
 
        // Display a form to edit user data
        echo "<form action='update.php' method='post'>
                <input type='hidden' name='id' value='$id'>
                <label for='username'>Username:</label>
                <input type='text' name='username' value='$username' required><br>
 
                <label for='email'>Email:</label>
                <input type='email' name='email' value='$email' required><br>
 
                <input type='submit' value='Update'>
            </form>";
    } else {
        echo "User not found.";
    }
 
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
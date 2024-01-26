<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body {
            font-family: Poppins, sans-serif;
            background-color: #395144;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #F0EBCE;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
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
            background-color: #4caf50;
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
            background-color: #555;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #444;
        }
    </style>
    <title>User Update Form</title>
</head>
<body>

<?php
// Initialize variables
$id = $username = $email = "";

// Process form submission for updating user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $username = $_POST["username"];
    $email = $_POST["email"];
 
    // Update user data in tblAccounts
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "BlogSite";
 
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
    $sql = "UPDATE tblAccounts SET username='$username', email='$email' WHERE id=$id";
 
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Update successful!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }    
 
    $conn->close();
}
?>

<form action="" method="post">
    <?php if(isset($id)) { ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    <?php } ?>

    <label for="username">Username:</label>
    <input type="text" name="username" value="<?php echo $username; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $email; ?>" required>

    <div class="button-container">
        <input type="submit" value="Update">
        <input type="button" class="back-button" value="Back" onclick="location.href='admin.php';">
    </div>
</form>

</body>
</html>

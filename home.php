<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Function to sanitize input data
function sanitizeInput($data) {
    // Remove leading and trailing whitespaces
    $data = trim($data);
    // Convert special characters to HTML entities to prevent XSS attacks
    $data = htmlspecialchars($data, ENT_QUOTES);
    return $data;
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and insert the comment into the database
    $commentText = sanitizeInput($_POST["comment_text"]);

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BlogSite";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_SESSION["user_id"];

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO tblComments (account_id, comment_text) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $commentText);

    // Check if the comment was inserted successfully
    if ($stmt->execute()) {
        // Set the success message in a session variable
        $_SESSION["success_message"] = "Comment posted successfully!";
        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url("images/bgcool.jpg");
            background-size: cover;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2, p {
            margin-top: 30px;
            color: #F0EBCE;
            font-weight: bold;
        }

        form {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #F2F7A1;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border-radius: 4px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color:  #435585;
            color: #fff;
            cursor: pointer;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .button {
            display: inline-block;
            background-color: #FAE7F3;
            color: black;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #45a049;
            color: white;
        }

        .logout-button {
            display: inline-block;
            background-color: #FAE7F3;
            color: black;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 120px;
        }

        .logout-button:hover {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Welcome to the Home Page!</h2>

    <p>Express your thoughts and ideas in the space provided!</p>

    <!-- Comment Form -->
    <form action="" method="post">
        <label for="comment_text">Comment:</label>
        <textarea name="comment_text" rows="4" required></textarea>

        <input type="submit" value="Post">
    </form>
    
    <a class="logout-button" href="logout.php">Logout</a>
    <a class="button" href="admin.php">Admin</a>
    

    <script>
        // Check if the success message is set
        var successMessage = "<?php echo isset($_SESSION['success_message']) ? $_SESSION['success_message'] : ''; ?>";

        if (successMessage) {
            alert(successMessage);
            // Clear the success message
            <?php unset($_SESSION["success_message"]); ?>
        }
    </script>
</body>
</html>

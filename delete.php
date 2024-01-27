<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url("images/bgcool.jpg");
            background-size: cover;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #E5E0D8;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
        }

        .success {
            color: green;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .error {
            color: black;
            margin-top: 10px;
        }

        #backButton {
            background-color: #435585;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

    </style>
    <title>Delete User</title>
</head>
<body>

<div class="container">
    <?php
    // Check if an ID is provided for deletion
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
     
        // Delete user from tblAccounts
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "BlogSite";
     
        $conn = new mysqli($servername, $username, $password, $dbname);
     
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
     
        $sql = "DELETE FROM tblAccounts WHERE id=$id";
     
        if ($conn->query($sql) === TRUE) {
            echo "<div class='success'>Record Deleted Successfully</div>";
        } else {
            echo "<div class='error'>Error deleting record: " . $conn->error . "</div>";
        }
     
        $conn->close();
    } else {
        echo "<div class='error'>Invalid request.</div>";
    }
    ?>

    <button id="backButton" onclick="goBack()">Back</button>

    <script>
        // Function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>

</div>

</body>
</html>

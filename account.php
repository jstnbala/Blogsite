<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            margin-top:30px;
            color: white;
            font-weight: bold;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #FAE7F3;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #E6B9DE;
            color: #363062;
        }

        tr:hover {
            background-color: #F5E8C7;
        }

        .btn-admin {
            background-color: #E6B9DE; /* Green */
            color: black; /* White */
            border: 1px solid #4caf50; /* Green */
        }

        .btn-admin:hover {
            background-color: #45a049; /* Darker Green */
            color: #fff; 
        }

        .btn-logout {
            background-color: #E6B9DE; /* Dark Gray */
            color: black; /* White */
            border: 1px solid #444; /* Dark Gray */
        }

        .btn-logout:hover {
            background-color: #333;
            color: #fff; 
        }
    </style>
</head>
<body>
    <h2>Account Management</h2>

    <?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION["user_id"])) {
        // Redirect to the login page if not logged in
        header("Location: login.php");
        exit();
    }

    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BlogSite";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user accounts from tblAccounts
    $sql = "SELECT id, username, email FROM tblAccounts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>
                        <a href='edit.php?id=" . $row["id"] . "'>Edit</a> |
                        <a href='delete.php?id=" . $row["id"] . "'>Delete</a>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();
    ?>

    <div class="container mt-3">
        <div class="row">
            <div class="col">
                  <form action="logout.php" method="post">
                  <input class="btn btn-logout" type="submit" value="Logout"> 
                </form>
            </div>
            <div class="col">
                    <form action="admin.php" method="get">
                    <input class="btn btn-admin" type="submit" value="Admin">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

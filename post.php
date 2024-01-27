<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            color: #F0EBCE;
            font-weight: bold;
        }

        a {
            text-decoration: none;  
            color: #333;
        }

        a:hover {
            color: #4caf50;
        }

        .table-container {
            margin: 20px auto;
            width: 70%;
            background-color: #F2F7A1;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow: auto;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-container th, .table-container td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }

        .table-container th {
            background-color:  #FAE7F3;
            color: black;
        }

        /* Button styles similar to login.php */
        .btn {
            width: 50%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #4caf50; /* Green */
            color: #fff; /* White */
            border: 1px solid #4caf50; /* Green */
        }

        .btn-primary:hover {
            background-color: #45a049; /* Darker Green */
        }

        .btn-secondary {
            background-color: #444; /* Dark Gray */
            color: #fff; /* White */
            border: 1px solid #444; /* Dark Gray */
        }

        .btn-secondary:hover {
            background-color: #333; /* Darker Gray */
        }

        .btn-admin {
            background-color: #FAE7F3; /* Blue */
            color: black; /* White */
            border: 1px solid #2196F3; /* Blue */
        }

        .btn-admin:hover {
            background-color: #0b7dda; /* Darker Blue */
        }

        /* Style for delete link */
        .delete-link {
            color: #333;
        }

        .delete-link:hover {
            color: #FF3D00; /* Darker Red */
        }
    </style>
</head>
<body>
<h2>Post Management</h2>

<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BlogSite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch comments from tblComments
$commentSql = "SELECT id, account_id, comment_text FROM tblComments";
$commentResult = $conn->query($commentSql);

if ($commentResult->num_rows > 0) {
    echo "<div class='table-container'>";
    echo "<table>";
    echo "<tr><th>ID</th><th>User ID</th><th>Comment</th><th>Action</th></tr>";
    while ($row = $commentResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td><td>{$row['account_id']}</td><td>{$row['comment_text']}</td>";
        echo "<td><a class='delete-link' href='delete_post.php?id={$row['id']}'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "0 results";
}

$conn->close();
?>

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <form action="home.php" method="get">
                <input class="btn btn-secondary" type="submit" value="Home">
            </form>
        </div>
        <div class="col">
            <form action="account.php" method="get">
                <input class="btn btn-primary" type="submit" value="Account Management">
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
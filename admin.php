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

        a {
            text-decoration: none;
            color: #333;
            
        }

        a:hover {
            color: #4caf50;
        }

        /* Set a max-width for the chart container */
        #chart-container {
            max-width: 500px;
            margin: 20px auto;         
            background-color: #FAE7F3;   
            padding-bottom: 12px;
            border-radius: 25px;
        }

        .btn-primary {
        background-color: #F5E8C7;
        border-color: #725C3A;
        color: #363062;
        font-weight: bold;
    }

    </style>
</head>
<body>
    <h2>Admin Dashboard</h2>

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
    $userSql = "SELECT id, username, email FROM tblAccounts";
    $userResult = $conn->query($userSql);

    // Get user count
    $userCount = $userResult->num_rows;

    // Fetch comments from tblComments
    $commentSql = "SELECT id, account_id, comment_text FROM tblComments";
    $commentResult = $conn->query($commentSql);

    if ($userCount > 0) {
        // Close the database connection
        $conn->close(); 

        // Script for Chart.js pie chart
        echo "<div id='chart-container'><canvas id='userChart' width='500' height='200'></canvas></div>";
        echo "<p>User Count: $userCount</p>";
        echo "<script>
            var ctx = document.getElementById('userChart').getContext('2d');
            var userChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Users'],
                    datasets: [{
                        label: 'Number of Users',
                        data: [$userCount],
                        backgroundColor: [
                            '#F0EBCE',
                        ],
                        borderColor: [
                            '#AA8B56',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Set to false to control the size
                }
            });
        </script>";

        // Display comments in a table
        echo "<div class='table-container'>";
        echo "<table>";
        echo "<tr><th>ID</th><th>User ID</th><th>Comment</th></tr>";
        while ($row = $commentResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td><td>{$row['account_id']}</td><td>{$row['comment_text']}</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "0 results";
        // Close the database connection
        $conn->close();
    }
    ?>

    <!-- Add Account Management and Back to Account Management buttons with updated styles -->
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <form action="home.php" method="get">
                    <input class="btn btn-secondary" type="submit" value="Back">
                </form>
            </div>
            <div class="col">
                <form action="account.php" method="get">
                    <input class="btn btn-primary" type="submit" value="Account Management">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

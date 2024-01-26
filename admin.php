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
            background-color: #B3B792;
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
            background-color: #E5E0D8;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #809671;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
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
        }

        .btn-primary {
        background-color: #725C3A;
        border-color: #725C3A;
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
    $sql = "SELECT id, username, email FROM tblAccounts";
    $result = $conn->query($sql);

    // Get user count
    $userCount = $result->num_rows;

    if ($userCount > 0) {
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

        // Display user count
        echo "<p>User Count: $userCount</p>";

        // Close the database connection
        $conn->close(); 

        // Script for Chart.js pie chart
        echo "<div id='chart-container'><canvas id='userChart' width='300' height='300'></canvas></div>";
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
                            '#E5D2B8',
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
    } else {
        echo "0 results";
        // Close the database connection
        $conn->close();
    }
    ?>

    <!-- Add Logout button -->
    <form action="logout.php" method="post">
        <input class="btn btn-primary" type="submit" value="Logout">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

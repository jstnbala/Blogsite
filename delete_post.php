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

if (isset($_GET["id"])) {
    $postId = mysqli_real_escape_string($conn, $_GET["id"]);

    // Check if the post exists
    $checkSql = "SELECT * FROM tblComments WHERE id = '$postId'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Delete the post
        $deleteSql = "DELETE FROM tblComments WHERE id = '$postId'";
        if ($conn->query($deleteSql) === TRUE) {
            // Display a confirmation alert and redirect to post.php
            echo "<script>
                    alert('Post deleted successfully.');
                    window.location.href = 'post.php';
                  </script>";
        } else {
            echo "Error deleting post: " . $conn->error;
        }
    } else {
        echo "Post not found.";
    }
} else {
    echo "Post ID not provided.";
}

$conn->close();
?>

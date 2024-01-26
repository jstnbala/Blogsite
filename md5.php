<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD5 Converter</title>
</head>
<body>

    <h2>MD5 Converter</h2>

    <form method="post">
        <label for="inputText">Enter Text:</label>
        <input type="text" name="inputText" id="inputText" required>
        <button type="submit">Convert to MD5</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve input text
        $inputText = $_POST["inputText"];

        // Convert to MD5
        $md5Result = md5($inputText);

        // Display the result
        echo "<p>Original Text: $inputText</p>";
        echo "<p>MD5: $md5Result</p>";
    }
    ?>

</body>
</html>

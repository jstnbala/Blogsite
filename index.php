<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body {
            font-family: Poppins, sans-serif;
            background-color: #E5D2B8;
            margin: 50px;
            padding: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: black;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #E5E0D8;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 15px;
        }

        input[type="button"],
        input[type="submit"]  {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: #D2AB80;
            color: #fff;
            margin-right: 5px;
        }

        input[type="submit"]:hover {
            background-color: #444;
        }

        input[type="button"] {
            background-color: #D2AB80;
            color: #fff;
        }

        input[type="button"]:hover {
            background-color: #444;
        }

    </style>
    <title>Registration Page</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
 
        <label for="password">Password:</label>
        <input type="password" name="password" required>
 
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <div class="button-container">
        <input type="submit" value="Register">
            <input type="button" value="Back" onclick="location.href='login.php';">
        </div>
    </form>
</body>
</html>

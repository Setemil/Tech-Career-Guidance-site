<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send OTP</title>
    <style>
@import url("https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap");

        body {  
            font-family: "Outfit", serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to left, #b1adff, #d7d5fc);
        }

        .container {
            background: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            flex-direction: row;
            height: 240px;
            width: 600px;
            padding: 25px;
            text-align: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            height: 100%;
            width: 100%;
        }
        form input {
            width: 90%;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 15px;
        }

        form input[type="submit"] {
            background-color: #6a679e;
            color: white;
            cursor: pointer;
            border: none;
            font-weight: bold;
            width: 100px;
            border-bottom: 20px;
        }

        form input[type="submit"]:hover {
            background-color:rgb(142, 139, 215);
            transition: 0.7s ease-in-out;
        }

        .container div {
            text-align: center;
            align-items: center;
        }

        .error-message {
            color: white;
            background-color: red;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Send OTP</h1>
        <div>
        <?php
        if (isset($_GET['error'])) {
            echo "<p class='error-message'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>
        </div>
        <div><form method="post" action="OTPSend.php">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="submit" class="btn" value="Send" name="sendOTP">
        </form></div>
    </div>
</body>
</html>

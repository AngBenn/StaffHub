<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to StaffHub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightgrey;
            margin: 0;
            padding: 0;
        }

        .header {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            background-color: rgba(6, 109, 212, 0.459);
            color: white;
            padding: 5px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            z-index: 2;
        }

        .image {
            flex: 0.8;
            margin-top: 20px;
            margin-bottom: 0px;
            width: 320px;
            height: auto;
        }

        .logo {
            width: 50px;
            height: auto;
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

        .header-title {
            display: inline-block;
            text-align: left;
            font-size: 24px;
        }

        .welcome-message {
            text-align: center;
            margin-top: 50px;
        }

        .welcome-message h2 {
            font-size: 34px;
            margin-bottom: 20px;
        }

        .welcome-message p {
            font-size: 18px;
            color: #666;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons a {
            display: inline-block;
            background-color: rgba(6, 109, 212, 0.459);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .buttons a:hover {
            background-color: rgba(6, 109, 212, 0.7);
        }
    </style>
</head>

<body>
    <header class="header">
        <div>
            <img src="../images/logo.png" alt="Logo" class="logo">
            <h1 class="header-title">StaffHub</h1>
        </div>
    </header>

    <div class="welcome-message">
        <h2>Welcome to StaffHub</h2>
        <p>Join us in creating a supportive and collaborative environment!</p>
    </div>

    <div class="buttons">
        <a href="../login/login.php">Login</a>
        <a href="../login/register.php">Register</a>
    </div>

</body>

</html>

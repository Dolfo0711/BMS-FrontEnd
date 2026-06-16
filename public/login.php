<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .container {
            width: 350px;
            margin: 80px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
        }

        h2 {
            text-align: center;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <form action="#" method="post">

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter Email">

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter Password">

        <button type="submit">Login</button>

    </form>

    <p style="text-align:center;">
        Don't have an account?
        <a href="register.php">Register</a>
    </p>
</div>

</body>
</html>
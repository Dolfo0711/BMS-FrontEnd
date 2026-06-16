<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
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
    <h2>Register</h2>

    <form action="#" method="post">

      
        <label>First Name</label>
        <input type="text" name="firstname" placeholder="Enter First Name">

        <label>Last Name</label>
        <input type="text" name="lastname" placeholder="Enter Last Name">

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter Email">

        <label>Birthday</label>
        <input type="date" name="birthday">

       

        <button type="submit">Register</button>

    </form>

    <p style="text-align:center;">
        Already have an account?
        <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>
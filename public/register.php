<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $birthdate  = $_POST['birthdate'];
    $password   = $_POST['password'];

    $data = [
        "firstName" => $first_name,
        "lastName"  => $last_name,
        "email"     => $email,
        "birthdate" => $birthdate,
        "password"  => $password
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://localhost:8081/api/auth/register");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "Error: " . curl_error($ch);
    } else {
        echo $response;
    }

    curl_close($ch);

} // <-- close the POST block

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    height:100vh;
    display:flex;
    background: linear-gradient(135deg,#0f172a,#1e293b);
}

/* LEFT */
.left {
    flex:1;
    background: linear-gradient(135deg,#22c55e,#4f46e5);
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    padding:40px;
}

.left h1 {
    font-size:40px;
}

/* RIGHT */
.right {
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* GLASS CARD */
.card {
    width:380px;
    padding:30px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,0.4);
    color:white;
}

h2 {
    text-align:center;
    margin-bottom:20px;
}

input {
    width:100%;
    padding:12px;
    margin:10px 0;
    border:none;
    border-radius:8px;
    outline:none;
    background: rgba(255,255,255,0.15);
    color:white;
}

input::placeholder {
    color:#ddd;
}

button {
    width:100%;
    padding:12px;
    background:#4f46e5;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
    color:white;
    transition:0.3s;
}

button:hover {
    transform:scale(1.03);
    background:#3730a3;
}

.msg {
    text-align:center;
    padding:10px;
    margin-bottom:10px;
    background: rgba(16, 219, 77, 0.98);
    border-radius:8px;
}

a {
    color:#93c5fd;
    text-decoration:none;
}

.small {
    text-align:center;
    margin-top:15px;
}

.back-btn {
    display:block;
    text-align:center;
    margin-top:10px;
    padding:12px;
    background:#64748b;
    border-radius:8px;
    color:white;
    font-weight:bold;
    text-decoration:none;
    transition:0.3s;
}

.back-btn:hover {
    background:#475569;
    transform:scale(1.03);
}


</style>
</head>

<body>

<div class="left">
    <div>
        <h1>Join Us</h1>
        <p>Create your account to start booking appointments.</p>
    </div>
</div>

<div class="right">

    <div class="card">

        <h2>Register</h2>


       <form method="POST" action="">

    <input type="text" name="first_name" placeholder="First Name" required>

    <input type="text" name="last_name" placeholder="Last Name" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="date" name="birthdate" required>

    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Create Account</button>

</form>

        <div class="small">
            Already have account? <a href="login.php">Login</a>
        </div>

    </div>

</div>

</body>
</html>
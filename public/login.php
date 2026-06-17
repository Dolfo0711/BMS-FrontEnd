

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body {
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    height:100vh;
    display:flex;
    background: linear-gradient(135deg,#0f172a,#1e293b);
}

/* LEFT SIDE */
.left {
    flex: 1;
    background-image: url('../img/BMS.jpg');
    background-repeat: no-repeat;
    background-position: center center;
    background-size: contain; /* shows the entire image */
    background-color: #003D52   ; /* fills empty space */
    
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    padding: 40px;
    position: relative;
}

.left h1 {
    font-size:40px;
    color:black;
    margin-bottom:10px;
}

/* RIGHT SIDE */
.right {
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* GLASS CARD */
.card {
    width:350px;
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
    background:#22c55e;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
    color:white;
    transition:0.3s;
}

button:hover {
    transform:scale(1.03);
    background:#16a34a;
}

.error {
    background:rgba(239,68,68,0.2);
    padding:10px;
    border-radius:8px;
    text-align:center;
    margin-bottom:10px;
}

a {
    color:#93c5fd;
    text-decoration:none;
}

a:hover {
    text-decoration:underline;
}

.small {
    text-align:center;
    margin-top:15px;
    font-size:13px;
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
        <h1>Building Management System</h1>
        <p>Welcome back! Please login to continue.</p>
    </div>
</div>

<div class="right">

    <div class="card">

        <h2>Login</h2>

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Sign In</button>
                        <a href="index.php" class="back-btn">Back to Home</a>

        </form>

        <div class="small">
            No account? <a href="register.php">Create one</a>
        </div>

    </div>

</div>

</body>
</html>
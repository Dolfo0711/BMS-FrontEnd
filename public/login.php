<?php
session_start();
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if (!isset($_SESSION['last_attempt'])) {
    $_SESSION['last_attempt'] = time();
}


$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $data = [
        "email" => $email,
        "password" => $password
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://projectx-n2d1.onrender.com/api/auth/login");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        $error = "Curl Error: " . curl_error($ch);
        curl_close($ch);
    } else {
        curl_close($ch);

        if ($httpCode == 200) {

    $user = json_decode($response, true);

    // Check if role exists
    $userRole = strtoupper($user['role'] ?? '');

    if ($userRole !== 'ADMIN') {
        $error = "Access denied. Administrator account required.";
        session_destroy();
    } else {

        // Regenerate session ID (prevents session fixation)
        session_regenerate_id(true);

        $_SESSION['user'] = $user;
        $_SESSION['logged_in'] = true;
        $_SESSION['role'] = $userRole;

        header("Location: ../Dashboard/dashboard.php");
        exit();
    }
}else {
            $error = "Login failed: " . $response;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --primary:#076D48;
    --primary2:#11b978;
    --bg:#0b1220;
    --card:#ffffff;
    --muted:#64748b;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Inter',sans-serif;
}

body{
    min-height:100vh;
    background: linear-gradient(135deg,#eef2f7,#e6edf5);
}

/* LAYOUT */
.container{
    display:flex;
    min-height:100vh;
}

/* LEFT */
.login-section{
    width:42%;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:48px;
    background:rgba(255,255,255,.6);
    backdrop-filter: blur(10px);
}

.login-card{
    width:100%;
    max-width:440px;
    padding:40px;
    border-radius:20px;
    background:white;
    box-shadow:0 20px 60px rgba(15,23,42,.12);
}

/* LOGO */
.logo{
    font-size:22px;
    font-weight:700;
    color:var(--primary);
    margin-bottom:16px;
}

/* TEXT */
h1{
    font-size:32px;
    color:#0f172a;
    margin-bottom:8px;
}

.subtitle{
    color:var(--muted);
    font-size:14px;
    margin-bottom:28px;
    line-height:1.6;
}

/* INPUTS (FLOATING STYLE) */
.field{
    position:relative;
    margin-bottom:18px;
}

.field input{
    width:100%;
    padding:16px 14px;
    border-radius:14px;
    border:1px solid #e2e8f0;
    outline:none;
    font-size:14px;
    transition:.25s;
    background:#f8fafc;
}

.field label{
    position:absolute;
    left:12px;
    top:14px;
    color:#94a3b8;
    font-size:13px;
    pointer-events:none;
    transition:.2s;
    background:white;
    padding:0 6px;
}

.field input:focus{
    border-color:var(--primary);
    background:white;
    box-shadow:0 0 0 4px rgba(7,109,72,.08);
}

.field input:focus + label,
.field input:not(:placeholder-shown) + label{
    top:-8px;
    font-size:11px;
    color:var(--primary);
}

/* BUTTON */
.login-btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:14px;
    background:linear-gradient(135deg,var(--primary),var(--primary2));
    color:white;
    font-weight:600;
    cursor:pointer;
    transition:.25s;
    margin-top:8px;
}

.login-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 14px 30px rgba(7,109,72,.25);
}

/* LINKS */
.links{
    margin-top:18px;
    display:flex;
    justify-content:space-between;
    font-size:13px;
}

.links a{
    color:var(--primary);
    text-decoration:none;
    font-weight:600;
}

/* ERROR */
.error{
    background:#fee2e2;
    color:#b91c1c;
    padding:12px;
    border-radius:12px;
    margin-bottom:16px;
    font-size:13px;
}

/* RIGHT SIDE */
.hero-section{
    width:58%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#003D52,#076D48);
    color:white;
    padding:60px;
    position:relative;
    overflow:hidden;
}

/* DECOR */
.hero-section::before,
.hero-section::after{
    content:'';
    position:absolute;
    border-radius:50%;
    background:rgba(255,255,255,.06);
}

.hero-section::before{
    width:500px;
    height:500px;
    top:-200px;
    right:-150px;
}

.hero-section::after{
    width:300px;
    height:300px;
    bottom:-100px;
    left:-100px;
}

.hero-content{
    text-align:center;
    max-width:600px;
    z-index:2;
}

.hero-content h2{
    font-size:42px;
    margin-bottom:14px;
}

.hero-content p{
    opacity:.9;
    font-size:16px;
    line-height:1.7;
    margin-bottom:30px;
}

.hero-content img{
    width:100%;
    max-width:520px;
    animation:float 5s ease-in-out infinite;
}

@keyframes float{
    0%,100%{transform:translateY(0);}
    50%{transform:translateY(-12px);}
}

/* MOBILE */
@media(max-width:900px){
    .container{flex-direction:column;}
    .hero-section{display:none;}
    .login-section{width:100%;}
    .login-card{box-shadow:none;}
}
</style>
</head>

<body>

<div class="container">

    <!-- LEFT -->
    <div class="login-section">

        <div class="login-card">

            <div class="logo">🏢 DJT System</div>

            <h1>Welcome Back</h1>
            <p class="subtitle">
                Sign in to manage your building operations, tenants, payments, and reports.
            </p>

            <?php if (!empty($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">

                <div class="field">
                    <input type="email" name="email" placeholder=" " required>
                    <label>Email Address</label>
                </div>

                <div class="field">
                    <input type="password" name="password" placeholder=" " required>
                    <label>Password</label>
                </div>

                <button class="login-btn" type="submit">
                    Sign In
                </button>

            </form>

            <div class="links">
                <a href="index.php">← Back</a>
                <a href="register.php">Create Account</a>
            </div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="hero-section">

        <div class="hero-content">

            <h2>Building Management System</h2>

            <p>
                A centralized dashboard for monitoring tenants, assets,
                maintenance requests, and operational reports in real time.
            </p>

            <img src="assets/building-dashboard.png" alt="Dashboard">

        </div>

    </div>

</div>

</body>
</html>
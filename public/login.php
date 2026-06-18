
<?php

session_start();

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

    // ❗ IMPORTANT: capture curl error
    if (curl_errno($ch)) {
        $error = "Curl Error: " . curl_error($ch);
        curl_close($ch);
    } else {
        curl_close($ch);

        // DEBUG OUTPUT (REMOVE LATER)
        // echo $response; exit();

        if ($httpCode == 200) {

            $user = json_decode($response, true);

            $_SESSION['user'] = $user;

            header("Location: ../Dashboard/dashboard.php");
            exit();

        } else {

            // SHOW REAL ERROR FROM BACKEND
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
<style>
{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI',sans-serif;
    min-height:100vh;
    background:#eef2f7;
}

.container{
    display:flex;
    min-height:100vh;
}

/* LEFT LOGIN */

.login-section{
    width:40%;
    display:flex;
    justify-content:center;
    align-items:center;
    background:white;
    padding:40px;
}

.login-card{
    width:100%;
    max-width:420px;
}

.logo{
    font-size:30px;
    font-weight:700;
    color:#076D48;
    margin-bottom:15px;
}

.login-card h1{
    font-size:36px;
    color:#1e293b;
    margin-bottom:10px;
}

.subtitle{
    color:#64748b;
    margin-bottom:35px;
    line-height:1.6;
}

/* INPUTS */

.input-group{
    display:flex;
    align-items:center;
    gap:12px;
    background:#f8fafc;
    border:2px solid transparent;
    border-radius:14px;
    padding:14px 16px;
    margin-bottom:18px;
    transition:.3s;
}

.input-group:focus-within{
    border-color:#076D48;
    background:white;
}

.input-group span{
    font-size:18px;
}

.input-group input{
    border:none;
    outline:none;
    width:100%;
    background:transparent;
    font-size:15px;
}

/* BUTTON */

.login-btn{
    width:100%;
    border:none;
    padding:15px;
    border-radius:14px;
    background:linear-gradient(
        135deg,
        #076D48,
        #11b978
    );
    color:white;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.login-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 25px rgba(7,109,72,.25);
}

/* LINKS */

.links{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
}

.links a{
    text-decoration:none;
    color:#076D48;
    font-weight:600;
}

/* ERROR */

.error{
    background:#fee2e2;
    color:#dc2626;
    padding:12px;
    border-radius:10px;
    margin-bottom:20px;
}

/* RIGHT HERO */

.hero-section{
    width:60%;
    background:linear-gradient(
        135deg,
        #003D52,
        #076D48
    );
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    padding:50px;
    position:relative;
    overflow:hidden;
}

.hero-section::before{
    content:'';
    position:absolute;
    width:700px;
    height:700px;
    background:rgba(255,255,255,.05);
    border-radius:50%;
    top:-300px;
    right:-200px;
}

.hero-content{
    max-width:650px;
    text-align:center;
    z-index:2;
}

.hero-content h2{
    font-size:48px;
    margin-bottom:20px;
}

.hero-content p{
    font-size:18px;
    opacity:.9;
    line-height:1.7;
    margin-bottom:40px;
}

.hero-content img{
    width:100%;
    max-width:550px;
    animation:float 4s ease-in-out infinite;
}

@keyframes float{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(-15px);
    }
}

/* MOBILE */

@media(max-width:900px){

    .container{
        flex-direction:column;
    }

    .hero-section{
        display:none;
    }

    .login-section{
        width:100%;
    }
}

</style>
<body>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="login-section">

        <div class="login-card">

            <div class="logo">
                🏢 DJT
            </div>

            <h1>Welcome Back</h1>
            <p class="subtitle">
                Sign in to access your Building Management Dashboard.
            </p>

            <?php if (!empty($error)): ?>
                <div class="error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="input-group">
                    <span>📧</span>
                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        required
                    >
                </div>

                <div class="input-group">
                    <span>🔒</span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                        required
                    >
                </div>

                <button type="submit" class="login-btn">
                    Sign In
                </button>

            </form>

            <div class="links">
                <a href="index.php">← Back to Home</a>
                <a href="register.php">Create Account</a>
            </div>

        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="hero-section">

        <div class="hero-content">

            <h2>Building Management System</h2>

            <p>
                Manage tenants, rooms, payments,
                maintenance requests and reports
                all in one place.
            </p>

            <img
                src="assets/building-dashboard.png"
                alt="Dashboard Illustration"
            >

        </div>

    </div>

</div>

</body>
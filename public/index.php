

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QARI - Smart System</title>

<style>
* {
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: #0f172a;
    color:white;
}

/* HEADER */
header {
    position:fixed;
    top:0;
    width:100%;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 40px;
    background: rgba(15,23,42,0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255,255,255,0.1);
    z-index:1000;
}

.logo-img {
    width:60px;
    height:60px;
    border-radius:50%;
}

nav ul {
    display:flex;
    list-style:none;
    gap:25px;
}

nav a {
    text-decoration:none;
    color:white;
    font-weight:500;
    transition:0.3s;
}

nav a:hover {
    color:#22c55e;
}

/* HERO */
.hero {
    height:100vh;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    padding:20px;
    background: radial-gradient(circle at top, #2522c5, transparent 60%),
                radial-gradient(circle at bottom, #4f46e5, transparent 60%);
}

.hero img {
    width:120px;
    margin-bottom:20px;
    animation: float 3s ease-in-out infinite;
}

.hero h1 {
    font-size:50px;
    margin-bottom:10px;
}

.hero p {
    max-width:600px;
    font-size:18px;
    color:#cbd5e1;
}

.hero button {
    margin-top:20px;
    padding:12px 25px;
    border:none;
    border-radius:10px;
    background:#22c55e;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

.hero button:hover {
    transform:scale(1.05);
    background:#16a34a;
}

/* INFO SECTION */
.info-container {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:25px;
    padding:80px 40px;
    max-width:1200px;
    margin:auto;
}

.info-section {
    background: rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1);
    padding:25px;
    border-radius:16px;
    backdrop-filter: blur(10px);
    transition:0.3s;
}

.info-section:hover {
    transform: translateY(-8px);
    background: rgba(255,255,255,0.08);
}

.info-section img {
    width:100%;
    border-radius:12px;
    margin-bottom:15px;
}

.info-section h2 {
    margin-bottom:10px;
    color:#22c55e;
}

/* FOOTER */
footer {
    text-align:center;
    padding:20px;
    background:#020617;
    color:#94a3b8;
}

/* ANIMATION */
@keyframes float {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* RESPONSIVE */
@media(max-width:768px){
    header {
        padding:15px 20px;
    }

    .hero h1 {
        font-size:32px;
    }

    nav ul {
        gap:15px;
    }
}
</style>

</head>

<body>

<header>
<img src="../img/school_logo.jpg" class="logo-img">
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="https://web.facebook.com/jayr.dolfo">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- HERO -->
<section class="hero">

<img src="../img/school_logo.jpg" class="logo-img">
    <h1>Welcome to Pinnacle Technology Incorporation</h1>

    <p>
        An intelligent system for real-time monitoring,
        user management, and smart appointment handling.
    </p>

    <button onclick="document.getElementById('info').scrollIntoView({behavior:'smooth'})">
        Explore More
    </button>

</section>

<!-- INFO -->
<div class="info-container" id="info">

    <div class="info-section">
        <img src="img/logo1.png">
        <h2>About System</h2>
        <p>
            QARI is a smart greenhouse and monitoring system
            designed for sustainable urban farming and automation.
        </p>
    </div>

    <div class="info-section">
        <img src="img/qcu1.jpg">
        <h2>About School</h2>
        <p>
            Quezon City University (QCU) is a public university
            providing quality education in technology and innovation.
        </p>
    </div>

    <div class="info-section">
        <img src="img/c2.jpg">
        <h2>Urban Farming</h2>
        <p>
            Urban farming improves sustainability, food security,
            and promotes smart agricultural practices in cities.
        </p>
    </div>

</div>

<footer>
    &copy; 2026 QARI System. All rights reserved.
</footer>

</body>
</html>
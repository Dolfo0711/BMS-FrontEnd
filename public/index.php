<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BMS Sample Website</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
}

body {
    color: #f8fafc;
    background-color: #0f172a; /* Solid deep background color for the overall page */
    line-height: 1.6;
}

/* HEADER */
header {
    position: fixed;
    top: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 5%;
    background: rgba(15, 23, 42, 0.75);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    z-index: 1000;
}

.logo-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    background: #1e293b;
}

nav ul {
    display: flex;
    list-style: none;
    gap: 30px;
}

nav a {
    text-decoration: none;
    color: #cbd5e1;
    font-weight: 500;
    font-size: 0.95rem;
    transition: color 0.25s ease;
}

nav a:hover {
color: #3b82f6;
}

/* HERO SECTION (First Section with Custom Background Image) */
.hero {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 24px;
    position: relative;
    overflow: hidden;
    
    /* Image lives strictly inside this section now */
    background-image: linear-gradient(rgba(15, 23, 42, 0.65), rgba(15, 23, 42, 0.65)), 
                      url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4xK6IHA9nqcj1bZZ_BOCBhgONnMv9wlREFRY_FlIybWMkUEfIROEYDFIf&s=10");
    
    background-position: center center;
    background-repeat: no-repeat;
    background-size: 100% auto; 
}

.hero .logo-img {
    width: 110px;
    height: 110px;
    margin-bottom: 24px;
    box-shadow: 0 0 25px rgba(34, 197, 94, 0.3);
    animation: float 4s ease-in-out infinite;
}

.hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    letter-spacing: -0.025em;
    line-height: 1.2;
    max-width: 850px;
    margin-bottom: 16px;
    background: linear-gradient(to right, #ffffff, #cbd5e1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero p {
    max-width: 600px;
    font-size: 1.15rem;
    color: #94a3b8;
    margin-bottom: 32px;
}

.hero button {
    padding: 14px 32px;
    border: none;
    border-radius: 12px;
    background: #22c55e;
    color: white;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(34, 197, 94, 0.4);
    transition: all 0.25s ease;
}

.hero button:hover {
    transform: translateY(-2px);
    background: #16a34a;
    box-shadow: 0 6px 20px rgba(34, 197, 94, 0.6);
}

/* INFO SECTION */
.info-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    padding: 100px 5% 140px 5%;
    max-width: 1280px;
    margin: auto;
}

.info-section {
    background: rgba(30, 41, 59, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 32px;
    border-radius: 20px;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
}

.info-section:hover {
    transform: translateY(-6px);
    background: rgba(30, 41, 59, 0.6);
    border-color: rgba(34, 197, 94, 0.3);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

.info-section img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 20px;
    background: #1e293b;
}

.info-section h2 {
    margin-bottom: 12px;
    color: #22c55e;
    font-size: 1.4rem;
    font-weight: 600;
}

.info-section p {
    color: #94a3b8;
    font-size: 0.95rem;
}

/* FOOTER */
footer {
    text-align: center;
    padding: 30px;
    background: #090d16;
    color: #64748b;
    font-size: 0.9rem;
    border-top: 1px solid rgba(255, 255, 255, 0.03);
}

/* ANIMATION */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-12px); }
}

/* RESPONSIVE */
@media(max-width: 768px){
    header {
        padding: 15px 5%;
    }

    nav ul {
        gap: 18px;
    }

    .hero h1 {
        font-size: 2.25rem;
    }
    
    .hero p {
        font-size: 1rem;
    }
    
    .hero {
        background-size: 100% auto; /* Looks cleaner filling screen width on small mobile views */
    }

    .info-container {
        padding: 60px 24px;
        gap: 20px;
    }
}
</style>

</head>
<body>

<header>
    <img src="https://lh5.googleusercontent.com/proxy/9G0O0VHzwTmXePbIc0MI0pVcw9MklZKB_kfDA8NFZTh8rpwaXNCcAI0DyoBrakfB9pw476DpxcgHhOY1" class="logo-img" alt="Logo">
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="https://web.facebook.com/jayr.dolfo" target="_blank" rel="noopener noreferrer">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- FIRST SECTION (Hero Section with Background Image) -->
<section class="hero">
    <img src="https://lh5.googleusercontent.com/proxy/9G0O0VHzwTmXePbIc0MI0pVcw9MklZKB_kfDA8NFZTh8rpwaXNCcAI0DyoBrakfB9pw476DpxcgHhOY1" class="logo-img" alt="Pinnacle Logo">
    <h1>Welcome to Pinnacle Technology Incorporation</h1>
    <p>
        An intelligent system for real-time monitoring,
        user management, and smart appointment handling.
    </p>
    <button onclick="document.getElementById('info').scrollIntoView({behavior:'smooth'})">
        Explore More
    </button>
</section>

<!-- SECOND SECTION (Clean info cards grid on dark slate fallback body background) -->
<main class="info-container" id="info">

    <div class="info-section">
        <img src="img/logo1.png" alt="QARI System Preview">
        <h2>About System</h2>
        <p>
            QARI is a smart greenhouse and monitoring system
            designed for sustainable urban farming and automation.
        </p>
    </div>

    <div class="info-section">
        <img src="img/qcu1.jpg" alt="QCU Campus">
        <h2>About School</h2>
        <p>
            Quezon City University (QCU) is a public university
            providing quality education in technology and innovation.
        </p>
    </div>

    <div class="info-section">
        <img src="img/c2.jpg" alt="Urban Farming Environment">
        <h2>Urban Farming</h2>
        <p>
            Urban farming improves sustainability, food security,
            and promotes smart agricultural practices in cities.
        </p>
    </div>

</main>

<footer>
    &copy; 2026 QARI System. All rights reserved.
</footer>

</body>
</html>
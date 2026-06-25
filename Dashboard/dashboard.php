<?php

//authentication and checking if users are allowed to login
include '../auth.php';

?>


<!DOCTYPE html>
<html>
<head>
<title>BMS Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>


:root{
    --space-1:8px;
    --space-2:16px;
    --space-3:24px;
    --space-4:32px;
    --space-5:40px;

    --radius:12px;
}

:root{
    --bg:#f1f5f9;
    --card:#ffffff;
    --text:#111827;
    --muted:#6b7280;
    --sidebar:#111827;
    --sidebarText:#d1d5db;
    --accent:#10b981;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
        background:#e2e8f0;

}

.kpi-card,
.panel{
    position:relative;
    overflow:hidden;
}

.kpi-card::before,
.panel::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:4px;
    background:#10b981;
}

/* HEADER */
.header{
    height:70px;
    background:#0f172a;
    color:white;

    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:0 20px;

    position:fixed;
    top:0;
    left:0;
    right:0;

    z-index:1000;
}

/* LEFT HEADER */
.leftHeader{
    display:flex;
    align-items:center;
    gap:15px;
}

/* ICON BUTTON */
.icon-btn{
    background:#1f2937;
    border:none;
    color:white;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
}

.icon-btn:hover{
    background:#374151;
}

/* PROFILE */
.profile{
    position:relative;
    cursor:pointer;
    display:flex;
    align-items:center;
    gap:10px;
    z-index:2000;
}

.avatar{
    width:38px;
    height:38px;
    border-radius:50%;
    background:var(--accent);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
}

/* DROPDOWN */
.dropdown{
    position:absolute;
    right:0;
    top:50px;
    background:white;
    width:160px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
    display:none;
    overflow:hidden;
    z-index:3000;
}

.dropdown a{
    display:block;
    padding:10px;
    color:var(--text);
    text-decoration:none;
    font-size:14px;
}

.dropdown a:hover{
    background:#f3f4f6;
}

.dropdown.show{
    display:block;
}



/* CONTENT */
.content{
    margin-left:260px;
    margin-top:70px;
    padding:20px;
    background:#f8fafc;
    min-height:100vh;
    transition:0.3s ease;
}


/* RESPONSIVE */
@media(max-width:768px){
    .sidebar{
        position:relative;
        width:100%;
        height:auto;
    }

    .content{
        margin-left:0;
    }
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
}

.page-header h1{
    font-size:28px;
    margin-bottom:5px;
}

.page-header p{
    color:#64748b;
}

.live-clock{
    text-align:right;
    background:none;
    padding:0;
}

.live-clock span{
    font-size:18px;
    font-weight:600;
}

.kpi-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:24px;
}

.kpi-card{
    background:#fff;
    border:2px solid #cbd5e1;
    border-radius:12px;
    padding:16px 20px;

    display:flex;
    align-items:center;
    gap:12px;

     box-shadow:0 4px 12px rgba(0,0,0,.08);
    transition:.3s ease;
}

.kpi-card:hover{
    transform:translateY(-3px);
    border-color:#10b981;
    box-shadow:0 8px 20px rgba(16,185,129,.15);
}

.kpi-icon{
    width:55px;
    height:55px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;
    border-radius:12px;

    background:#ecfdf5;
    border:2px solid #a7f3d0;

    width:auto;
    height:auto;
    background:none;
}

.kpi-card h4{
    color:#64748b;
    font-size:13px;
}

.kpi-card h2{
    margin-top:5px;
}

.dashboard-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:24px;
    margin-bottom:24px;
}

.panel{
    background:#fff;
    border:2px solid #cbd5e1;
    border-radius:12px;
    padding:18px;

    box-shadow:0 4px 12px rgba(0,0,0,.08);
    transition:.3s ease;
}

.panel:hover{
    border-color:#10b981;
    box-shadow:0 8px 20px rgba(16,185,129,.15);
}

.panel h3{
    margin-bottom:20px;
}

.chart-placeholder{
    height:220px;
    background:#f8fafc;
    border-radius:8px;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#94a3b8;
}

.asset-stats{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.status-item{
    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:12px;
    border:1px solid #e5e7eb;
    border-radius:8px;
}

.control-list{
    display:flex;
    flex-direction:column;
    gap:15px;
}

.control-item{
    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:12px;
    border:2px solid #e2e8f0;
    background: #f8fafc; 
    border-radius:8px;
}

.on-btn{
    background:#10b981;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:8px;
}

.off-btn{
    background:#ef4444;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:8px;
}

.alert{
    background:#f8fafc;;
    padding:12px;
    margin-bottom:10px;

    border-radius:8px;
    border-left:4px solid #e5e7eb;
}

.danger{
    border-left-color:#ef4444;
}

.warning{
    border-left-color:#f59e0b;
}

.info{
    border-left-color:#3b82f6;
}

.activity{
    padding:14px;
    border-bottom:1px solid #cbd5e1;
}

@media(max-width:1100px){

    .kpi-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .dashboard-grid{
        grid-template-columns:1fr;
    }

}

</style>
</head>

<body>

<!-- HEADER -->
<div class="header">

    <div class="leftHeader">
        <h3>BMS Dashboard</h3>
    </div>

    <!-- PROFILE -->
    <div class="profile" onclick="toggleDropdown(event)">
        <div class="avatar">A</div>
        <span>Admin ▾</span>

        <div class="dropdown">
            <a href="#">Profile</a>
            <a href="#">Settings</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

</div>

<?php
$activePage = "dashboard";
include '../sidebar.php';
?>




<!-- CONTENT -->
<div class="content">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div>
            <h1>Building Management Dashboard</h1>
            <p>Monitor attendance, assets and building systems.</p>
        </div>
<div class="live-clock">
    <div id="currentDate"></div>
    <span id="currentTime"></span>
</div>
    </div>

    <!-- KPI CARDS -->
    <div class="kpi-grid">

        <div class="kpi-card">
            <div class="kpi-icon">👨‍💼</div>
            <div>
                <h4>Employees Present</h4>
                <h2>152</h2>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon">📦</div>
            <div>
                <h4>Total Assets</h4>
                <h2>438</h2>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon">❄️</div>
            <div>
                <h4>Aircons Running</h4>
                <h2>8</h2>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon">💡</div>
            <div>
                <h4>Lights Active</h4>
                <h2>24</h2>
            </div>
        </div>

    </div>

    <!-- ANALYTICS -->
    <div class="dashboard-grid">

        <div class="panel">
            <h3>Attendance Overview</h3>

            <div class="chart-placeholder">
                Attendance Chart
            </div>
        </div>

        <div class="panel">
            <h3>Asset Status</h3>

            <div class="asset-stats">

                <div class="status-item">
                    <span>Working</span>
                    <strong>320</strong>
                </div>

                <div class="status-item">
                    <span>Maintenance</span>
                    <strong>12</strong>
                </div>

                <div class="status-item">
                    <span>Damaged</span>
                    <strong>5</strong>
                </div>

                <div class="status-item">
                    <span>Missing</span>
                    <strong>2</strong>
                </div>

            </div>
        </div>

    </div>

    <!-- BUILDING CONTROLS -->
    <div class="dashboard-grid">

        <div class="panel">
            <h3>Building Controls</h3>

            <div class="control-list">

                <div class="control-item">
                    <span>Air Conditioning</span>
                    <button class="on-btn">ON</button>
                </div>

                <div class="control-item">
                    <span>Lobby Lights</span>
                    <button class="on-btn">ON</button>
                </div>

                <div class="control-item">
                    <span>Meeting Room Lights</span>
                    <button class="off-btn">OFF</button>
                </div>

            </div>
        </div>

        <div class="panel">
            <h3>System Alerts</h3>

            <div class="alert danger">
                Aircon Unit #2 requires maintenance
            </div>

            <div class="alert warning">
                Low inventory stock detected
            </div>

            <div class="alert info">
                5 employees arrived late
            </div>
        </div>

    </div>

    <!-- RECENT ACTIVITIES -->
    <div class="panel">
        <h3>Recent Activities</h3>

        <div class="activity">
            08:15 AM - Employee Time In
        </div>

        <div class="activity">
            08:22 AM - Asset Assigned
        </div>

        <div class="activity">
            08:35 AM - Aircon Activated
        </div>

        <div class="activity">
            08:40 AM - User Created
        </div>

    </div>

</div>

<!-- JS -->
<script>

function toggleDropdown(e){
    e.stopPropagation();
    document.querySelector(".dropdown").classList.toggle("show");
}

// close dropdown when clicking outside
document.addEventListener("click", function(){
    document.querySelector(".dropdown").classList.remove("show");
});

function updateClock() {
    const now = new Date();

    document.getElementById("currentDate").textContent =
        now.toLocaleDateString("en-US", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric"
        });

    document.getElementById("currentTime").textContent =
        now.toLocaleTimeString("en-US", {
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            hour12: true
        });
}

// Run immediately
updateClock();

// Update every second
setInterval(updateClock, 1000);

</script>

</body>
</html>
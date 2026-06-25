

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
:root{
    --sidebar-bg:#111827;   /* same dark as dashboard header */
    --sidebar-hover:#1f2937;
    --sidebar-text:#d1d5db;
    --accent:#10b981;
}

/* SIDEBAR */
.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:260px;
    height:100vh;

    background:var(--sidebar-bg);
    border-right:1px solid #1f2937;

    padding:18px 14px;
    display:flex;
    flex-direction:column;
    gap:10px;

    overflow-y:auto;
    z-index:1000;
}

/* LOGO */
.sidebar .logo{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;

    padding:16px;
    border-radius:14px;

    background:#0f172a;
    border:1px solid #1f2937;
    color:var(--sidebar-text);
}

.sidebar .logo i{
    font-size:28px;
    color:var(--accent);
    margin-bottom:6px;
}

.sidebar .logo span{
    font-weight:700;
    color:var(--sidebar-text);
}

/* LINKS */
.sidebar a{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;

    padding:12px;
    border-radius:14px;

    background:transparent;
    border:1px solid transparent;

    color:var(--sidebar-text);
    text-decoration:none;

    transition:.25s ease;
}

/* ICON */
.sidebar a i{
    font-size:18px;
    color:#94a3b8;
    margin-bottom:5px;
    transition:.25s ease;
}

/* HOVER */
.sidebar a:hover{
    background:var(--sidebar-hover);
    border-color:#374151;
    transform:translateY(-2px);
}

.sidebar a:hover i{
    color:var(--accent);
}

/* ACTIVE STATE */
.sidebar a.active{
    background:#0b2a22;
    border:1px solid var(--accent);
    color:#ffffff;
}

.sidebar a.active i{
    color:var(--accent);
}

/* FOOTER */
.sidebar-footer{
    margin-top:auto;
    padding:12px;

    text-align:center;

    border-radius:12px;
    border:1px solid #1f2937;
    background:#0f172a;

    font-size:12px;
    color:var(--sidebar-text);
}

</style>




<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<div class="sidebar">

    <div class="logo">
        <i class="fas fa-building"></i>
        <span>BMS</span>
    </div>

    <a href="dashboard.php"
       class="<?= ($activePage ?? '') == 'dashboard' ? 'active' : '' ?>">
        <i class="fas fa-chart-line"></i>
        Dashboard
    </a>

    <a href="attendance_monitoring.php"
       class="<?= ($activePage ?? '') == 'attendance' ? 'active' : '' ?>">
        <i class="fas fa-user-check"></i>
        Attendance Monitoring
    </a>

    <a href="inventory.php"
       class="<?= ($activePage ?? '') == 'assets' ? 'active' : '' ?>">
        <i class="fas fa-boxes-stacked"></i>
        Asset Management
    </a>

    <a href="user_management.php"
       class="<?= ($activePage ?? '') == 'users' ? 'active' : '' ?>">
        <i class="fas fa-users"></i>
        User Management
    </a>

    <a href="documentation.php"
       class="<?= ($activePage ?? '') == 'docs' ? 'active' : '' ?>">
        <i class="fas fa-file-lines"></i>
        Floor plan mapping
    </a>

    <a href="bms_components.php"
       class="<?= ($activePage ?? '') == 'components' ? 'active' : '' ?>">
        <i class="fas fa-microchip"></i>
        BMS Components
    </a>

    <div class="sidebar-footer">
        Building Management System
    </div>

</div>

<script>
function toggleSidebar(){

    document
        .querySelector(".sidebar")
        .classList
        .toggle("active");

    document
        .querySelector(".sidebar-overlay")
        .classList
        .toggle("active");
}
</script>
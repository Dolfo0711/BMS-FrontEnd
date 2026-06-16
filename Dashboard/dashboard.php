<!DOCTYPE html>
<html>
<head>
<title>BMS Dashboard</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}

body{
    background:#f4f6f9;
}

.header{
    background:#007bff;
    color:white;
    padding:20px;
    text-align:center;
}

.container{
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */
.sidebar{
    width:250px;
    background:#343a40;
    color:white;
    padding-top:20px;
}

.sidebar ul{
    list-style:none;
}

.sidebar ul li{
    border-bottom:1px solid #555;
}

.sidebar ul li a{
    display:block;
    padding:15px 20px;
    color:white;
    text-decoration:none;
    cursor:pointer;
}

.sidebar ul li a:hover{
    background:#495057;
}

/* CONTENT */
.content{
    flex:1;
    padding:30px;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.card{
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 2px 5px rgba(0,0,0,0.2);
    text-align:center;
}

.card h3{
    margin-bottom:10px;
    color:#007bff;
}

.logout{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    background:red;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.logout:hover{
    background:darkred;
}
</style>
</head>

<body>

<div class="header">
    <h1>Building Management System Dashboard</h1>
</div>

<div class="container">

    <div class="sidebar">
        <ul>
            <li><a href="attendance_monitoring.php">Attendance Monitoring</a></li>
            <li><a href="asset_management.php">Asset Management</a></li>
            <li><a href="user_management.php">User Management</a></li>
            <li><a href="documentation.php">Documentation</a></li>
            <li><a href="bms_components.php">BMS Components</a></li>
        </ul>
    </div>

    <div class="content">
        <h2>Welcome to the BMS Dashboard</h2>
        <br>

        <div class="cards">
            <div class="card">
                <h3>Attendance Monitoring</h3>
                <p>Track employee attendance and logs.</p>
            </div>

            <div class="card">
                <h3>Asset Management</h3>
                <p>Manage equipment and facility assets.</p>
            </div>

            <div class="card">
                <h3>User Management</h3>
                <p>Create and manage user accounts.</p>
            </div>

            <div class="card">
                <h3>Documentation</h3>
                <p>Store manuals, reports, and records.</p>
            </div>

            <div class="card">
                <h3>BMS Components</h3>
                <p>Monitor and manage BMS devices.</p>
            </div>
        </div>

        <a href="login.php" class="logout">Logout</a>
    </div>

</div>

</body>
</html>
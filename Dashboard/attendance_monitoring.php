
<!DOCTYPE html>
<html>
<head>
    <title>Attendance Monitoring</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f4f6f9;
        }

        /* Sidebar */
        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            background:#1f2937;
            color:white;
            padding-top:20px;
        }

        .logo{
            text-align:center;
            font-size:24px;
            font-weight:600;
            padding-bottom:20px;
            border-bottom:1px solid rgba(255,255,255,.1);
        }

        .sidebar a{
            display:block;
            color:#d1d5db;
            text-decoration:none;
            padding:14px 25px;
            transition:.3s;
        }

        .sidebar a:hover,
        .sidebar a.active{
            background:#374151;
            color:white;
            border-left:4px solid #3b82f6;
        }

        /* Main Content */
        .main{
            margin-left:250px;
            padding:25px;
        }

        /* Header */
        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .header h2{
            color:#111827;
            font-weight:600;
        }

        .btn{
            background:#10b981;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:8px;
            cursor:pointer;
        }

        .btn:hover{
            background:#059669;
        }

        /* Summary Cards */
        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
            margin-bottom:25px;
        }

        .card{
            background:white;
            border-radius:14px;
            padding:20px;
            box-shadow:0 2px 10px rgba(0,0,0,.05);
        }

        .card h4{
            color:#6b7280;
            margin-bottom:10px;
            font-size:14px;
        }

        .card .number{
            font-size:30px;
            font-weight:600;
            color:#111827;
        }

        .success{
            color:#10b981;
        }

        .danger{
            color:#ef4444;
        }

        /* Toolbar */
        .toolbar{
            background:white;
            padding:15px;
            border-radius:14px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
            box-shadow:0 2px 10px rgba(0,0,0,.05);
        }

        .search-box{
            width:320px;
            padding:10px 15px;
            border:1px solid #d1d5db;
            border-radius:8px;
            outline:none;
        }

        .search-box:focus{
            border-color:#3b82f6;
        }

        /* Table Container */
        .table-card{
            background:white;
            border-radius:14px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,.05);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        thead{
            background:#f9fafb;
        }

        th{
            text-align:left;
            padding:16px;
            font-size:14px;
            color:#374151;
        }

        td{
            padding:16px;
            border-top:1px solid #f1f1f1;
            font-size:14px;
        }

        tr:hover{
            background:#f9fafb;
        }

        .badge{
            padding:6px 12px;
            border-radius:20px;
            font-size:12px;
            font-weight:500;
        }

        .badge-success{
            background:#dcfce7;
            color:#15803d;
        }

        .badge-danger{
            background:#fee2e2;
            color:#dc2626;
        }

        .location{
            color:#2563eb;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">BMS</div>

    <a href="dashboard.php">Dashboard</a>
    <a href="attendance_monitoring.php" class="active">
        Attendance Monitoring
    </a>
    <a href="asset_management.php">Asset Management</a>
    <a href="user_management.php">User Management</a>
    <a href="documentation.php">Documentation</a>
    <a href="bms_components.php">BMS Components</a>
</div>

<!-- Main Content -->
<div class="main">

    <div class="header">
        <h2>Attendance Monitoring</h2>
        <button class="btn">+ Add Attendance</button>
    </div>

    <!-- Summary Cards -->
    <div class="cards">

        <div class="card">
            <h4>Present Today</h4>
            <div class="number success">265</div>
        </div>

        <div class="card">
            <h4>Late Employees</h4>
            <div class="number danger">62</div>
        </div>

        <div class="card">
            <h4>Early Check-In</h4>
            <div class="number">224</div>
        </div>

        <div class="card">
            <h4>Absent</h4>
            <div class="number danger">42</div>
        </div>

    </div>

    <!-- Search -->
    <div class="toolbar">
        <input type="text"
               class="search-box"
               placeholder="Search employee attendance...">

        <button class="btn">
            Attendance Report
        </button>
    </div>

    <!-- Table -->
    <div class="table-card">

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Time In</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Picture</th>
                    <th>Location</th>
                    <th>User ID</th>
                </tr>
            </thead>

           

        </table>

    </div>

</div>

</body>
</html>
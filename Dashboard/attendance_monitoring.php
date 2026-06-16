<?php ?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance Monitoring</title>
</head>
<body style="margin:0;font-family:Arial;background:#f4f6f9;">

<!-- Sidebar -->
<div style="width:220px;height:100vh;background:#2f3640;color:white;position:fixed;">
    <h3 style="text-align:center;padding:15px 0;border-bottom:1px solid #444;">BMS</h3>
    <a href="attendance_monitoring.php" style="display:block;padding:12px;color:white;text-decoration:none;">Attendance Monitoring</a>
    <a href="asset_management.php" style="display:block;padding:12px;color:white;text-decoration:none;">Asset Management</a>
    <a href="user_management.php" style="display:block;padding:12px;color:white;text-decoration:none;">User Management</a>
    <a href="documentation.php" style="display:block;padding:12px;color:white;text-decoration:none;">Documentation</a>
    <a href="bms_components.php" style="display:block;padding:12px;color:white;text-decoration:none;">BMS Components</a>
</div>

<!-- Content -->
<div style="margin-left:220px;padding:20px;">
    <h2>Attendance Monitoring</h2>

    <!-- Search -->
    <input type="text" placeholder="Search attendance..." 
        style="padding:10px;width:300px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px;">

    <!-- Table -->
    <table style="width:100%;border-collapse:collapse;background:white;">
        <tr style="background:#0984e3;color:white;">
            <th style="padding:10px;">ID</th>
            <th>Time In</th>
            <th>Date</th>
            <th>Type</th>
            <th>Picture</th>
            <th>Location</th>
            <th>User ID</th>
        </tr>

        <tr>
            <td style="padding:10px;">1</td>
            <td>08:00 AM</td>
            <td>2026-06-16</td>
            <td>Time In</td>
            <td>image.jpg</td>
            <td>Building A</td>
            <td>U001</td>
        </tr>
    </table>
</div>

</body>
</html>
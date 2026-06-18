<?php ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
</head>
<body style="margin:0;font-family:Arial;background:#f4f6f9;">

<div style="width:220px;height:100vh;background:#2f3640;color:white;position:fixed;">
    <a href="dashboard.php"
   style="
      display:block;
      text-align:center;
      padding:15px 0;
      border-bottom:1px solid #444;
      color:white;
      text-decoration:none;
      font-size:20px;
      font-weight:bold;
   ">
   BMS
</a>
    <a href="attendance_monitoring.php" style="display:block;padding:12px;color:white;text-decoration:none;">Attendance Monitoring</a>
    <a href="asset_management.php" style="display:block;padding:12px;color:white;text-decoration:none;">Asset Management</a>
    <a href="user_management.php" style="display:block;padding:12px;color:white;text-decoration:none;">User Management</a>
    <a href="documentation.php" style="display:block;padding:12px;color:white;text-decoration:none;">Documentation</a>
    <a href="bms_components.php" style="display:block;padding:12px;color:white;text-decoration:none;">BMS Components</a>
</div>

<div style="margin-left:220px;padding:20px;">
    <h2>User Management</h2>

    <input type="text" placeholder="Search users..."
        style="padding:10px;width:300px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px;">

    <table style="width:100%;border-collapse:collapse;background:white;">
        <tr style="background:#6c5ce7;color:white;">
            <th style="padding:10px;">ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Birthday</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>

        <tr>
            <td style="padding:10px;">U001</td>
            <td>John</td>
            <td>Doe</td>
            <td>john@email.com</td>
            <td>2000-01-01</td>
            <td>Admin</td>
            <td>
                <button style="padding:5px 10px;">Update</button>
                <button style="padding:5px 10px;background:red;color:white;">Delete</button>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
<?php ?>
<!DOCTYPE html>
<html>
<head>
    <title>Asset Management</title>
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
    <h2>Asset Management</h2>

    <input type="text" placeholder="Search assets..."
        style="padding:10px;width:300px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px;">

    <table style="width:100%;border-collapse:collapse;background:white;">
        <tr style="background:#00b894;color:white;">
            <th style="padding:10px;">Asset ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Status</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>

        <tr>
            <td style="padding:10px;">A001</td>
            <td>Aircon Unit</td>
            <td>HVAC</td>
            <td>Active</td>
            <td>Room 101</td>
            <td>
                <button style="padding:5px 10px;">Update</button>
                <button style="padding:5px 10px;background:red;color:white;">Delete</button>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
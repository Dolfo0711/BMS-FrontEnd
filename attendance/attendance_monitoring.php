<?php

$api_url = "https://projectx-n2d1.onrender.com/attendances";

$response = file_get_contents($api_url);

$data = json_decode($response, true);






?>



<!DOCTYPE html>
<html>
<head>

<style>

table{
width:100%;
border-collapse:collapse;
}

th{
background:#007bff;
color:white;
padding:12px;
}

td{
padding:10px;
border:1px solid #ddd;
}

img{
width:60px;
height:60px;
object-fit:cover;
}

</style>

</head>

<body>

<h2>Attendance Monitoring</h2>

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

<tbody>

<?php if(!empty($data)): ?>
    <?php foreach($data as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['time_in']) ?></td>
            <td><?= htmlspecialchars($row['date']) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td>
                <img src="<?= htmlspecialchars($row['picture']) ?>">
            </td>
            <td><?= htmlspecialchars($row['location']) ?></td>
            <td><?= htmlspecialchars($row['user_id']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="7">No attendance records found.</td>
    </tr>
<?php endif; ?>

</tbody>

</table>

</body>
</html>
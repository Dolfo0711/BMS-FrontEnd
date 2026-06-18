<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "bms"
);

$user_id = $_POST['user_id'];
$type = $_POST['type'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$date = date("Y-m-d");
$time = date("H:i:s");

$filename = time() . "_" .
            $_FILES['picture']['name'];

move_uploaded_file(
    $_FILES['picture']['tmp_name'],
    "uploads/attendance_photos/" . $filename
);

$sql = "INSERT INTO attendance
(
user_id,
attendance_type,
attendance_date,
attendance_time,
picture,
latitude,
longitude
)

VALUES
(
'$user_id',
'$type',
'$date',
'$time',
'$filename',
'$latitude',
'$longitude'
)";

$conn->query($sql);

header("Location: attendance.php");
exit();
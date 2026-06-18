<?php
session_start();

/*
Assume user is logged in.

$_SESSION['user_id']
$_SESSION['first_name']
$_SESSION['last_name']
*/

$user_id = $_SESSION['user_id'] ?? 'U001';
$name = ($_SESSION['first_name'] ?? 'John') . ' ' .
        ($_SESSION['last_name'] ?? 'Doe');
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance</title>

<style>

body{
    font-family:Arial;
    background:#f4f6f9;
}

.container{
    width:600px;
    margin:40px auto;
    background:white;
    padding:20px;
    border-radius:10px;
}

input,select{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
}

button{
    background:#007bff;
    color:white;
    border:none;
    padding:12px;
    width:100%;
    cursor:pointer;
}

</style>

</head>
<body>

<div class="container">

<h2>Attendance Form</h2>

<form action="save_attendance.php"
      method="POST"
      enctype="multipart/form-data">

<label>User ID</label>
<input type="text"
       name="user_id"
       value="<?= $user_id ?>"
       readonly>

<label>Name</label>
<input type="text"
       value="<?= $name ?>"
       readonly>

<label>Attendance Type</label>
<select name="type" required>
    <option value="TIME_IN">Time In</option>
    <option value="TIME_OUT">Time Out</option>
</select>

<label>Take Picture</label>
<input type="file"
       name="picture"
       accept="image/*"
       capture="user"
       required>

<label>Latitude</label>
<input type="text"
       id="latitude"
       name="latitude"
       readonly>

<label>Longitude</label>
<input type="text"
       id="longitude"
       name="longitude"
       readonly>

<button type="submit">
Submit Attendance
</button>

</form>

</div>

<script>

navigator.geolocation.getCurrentPosition(
function(position){

document.getElementById("latitude").value =
position.coords.latitude;

document.getElementById("longitude").value =
position.coords.longitude;

},
function(error){
alert("Location access required.");
}
);

</script>

</body>
</html>
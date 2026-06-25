<?php
include '../auth.php';

$activePage = "users";

/* =========================
   CONFIG
========================= */
$apiUrl = "https://projectx-n2d1.onrender.com/api/users";

$token = "eyJhbGciOiJIUzUxMiJ9.eyJ1c2VySWQiOjcsImVtYWlsIjoic3VwZXJhZG1pbkBnbWFpbC5jb20iLCJpYXQiOjE3ODE5NDQ2MzEsImV4cCI6MTc4MjU0OTQzMX0.IEnxaN0WJbooZ3XXb_zBHYnJqu7qGJ7ZOWhyMbhy_25hJ38dtj4AWLF9n2YvrHiLEI0s1FlpD-F4d_t6ZgSuEA";

/* =========================
   FETCH USERS
========================= */
function fetchUsers($url, $token) {
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $token",
            "Content-Type: application/json"
        ]
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true) ?? [];
}

$users = fetchUsers($apiUrl, $token);

function fetchUsersRoles($url, $token) {
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $token",
            "Content-Type: application/json"
        ]
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true) ?? [];
}

$usersRoles = fetchUsersRoles("https://projectx-n2d1.onrender.com/api/auth/user-roles", $token);



?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>User Management</title>
    
</head>

<style>

    body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#f8fafc;
}



.main-content{
    margin-left:270px;
    padding:32px;
    min-height:100vh;
    box-sizing:border-box;
    transition:all .3s ease;
}

/* TABLET & MOBILE */
@media (max-width:768px){

    .main-content{
        margin-left:0;
        padding:80px 15px 20px;
        width:100%;
    }

    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    .toolbar{
        flex-direction:column;
        align-items:stretch;
        gap:10px;
    }

    .search-box{
        width:100%;
    }

    .table-card{
        overflow-x:auto;
    }

    .user-table{
        min-width:900px;
    }
}


.table-card{
    overflow-x:auto;
}

.user-table{
    width:100%;
}

@media(max-width:768px){

    .user-table{
        min-width:1000px;
    }
}



.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
}

.page-title{
    font-size:28px;
    font-weight:700;
    color:#0f172a;
}

.page-subtitle{
    color:#64748b;
    font-size:14px;
}
    
.kpi-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(170px,1fr));
    gap:12px;
    margin-bottom:20px;
}

.kpi-card{
    background:#fff;
    border-radius:14px;
    padding:16px;
    min-height:80px;

    box-shadow:
        0 2px 8px rgba(15,23,42,.04),
        0 1px 2px rgba(15,23,42,.06);

    transition:.2s ease;
}

.kpi-card:hover{
    transform:translateY(-2px);
}

.kpi-title{
    font-size:12px;
    font-weight:500;
    color:#64748b;
    margin-bottom:6px;
}

.kpi-value{
    font-size:22px;
    font-weight:700;
    color:#0f172a;
    line-height:1;
}



button:hover{
    transform: scale(1.05);
    transition: 0.15s ease;
    opacity: 0.9;
}


.table-card{
    background:white;
    border-radius:18px;

    overflow-x:auto;
    overflow-y:hidden;

    box-shadow:
        0 4px 12px rgba(15,23,42,.04),
        0 1px 2px rgba(15,23,42,.06);
}

.user-table{
    width:100%;
    border-collapse:collapse;
}

.user-table thead{
    background:#0f172a;
    color:white;
}

.user-table th{
    padding:18px;
    text-align:left;
    font-size:14px;
}

.user-table td{
    padding:18px;
    border-bottom:1px solid #f1f5f9;
}

.user-table tr:hover{
    background:#f8fafc;
}

.kpi-card.total { border-left:5px solid #2d3436; }
.kpi-card.admin { border-left:5px solid #d63031; }
.kpi-card.tech { border-left:5px solid #0984e3; }
.kpi-card.pti { border-left:5px solid #00b894; }

@media(max-width:900px){
    .kpi-grid{ grid-template-columns: repeat(2, 1fr); }
}

@media(max-width:500px){
    .kpi-grid{ grid-template-columns: 1fr; }
}

.kpi-card.manager{
    border-left:5px solid #8e44ad;
}

.kpi-card.leader{
    border-left:5px solid #e67e22;
}

.kpi-card.coordinator{
    border-left:5px solid #16a085;
}

.kpi-card.operator{
    border-left:5px solid #3498db;
}

.kpi-card.prov{
    border-left:5px solid #f1c40f;
}

.toolbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin:24px 0;
}

.search-box{
    width:380px;
    background:white;
    border-radius:12px;
    border:1px solid #e2e8f0;

    display:flex;
    align-items:center;

    padding:0 14px;
}

.search-box i{
    color:#94a3b8;
}

.search-box input{
    border:none;
    outline:none;
    padding:14px;
    width:100%;
    background:none;
}

.pagination{
    display:flex;
    justify-content:flex-end;
    align-items:center;
    gap:8px;
    padding:16px 20px;
    background:white;
    border-top:1px solid #e2e8f0;
}

.pagination button{
    border:none;
    background:#f1f5f9;
    color:#334155;
    width:36px;
    height:36px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.pagination button:hover{
    background:#3b82f6;
    color:white;
}

.pagination button.active{
    background:#3b82f6;
    color:white;
}

.pagination-info{
    margin-right:auto;
    color:#64748b;
    font-size:14px;
}

.edit-btn{
    background:#3b82f6;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
    margin-right:6px;
    font-size:13px;
}

.edit-btn:hover{
    background:#2563eb;
}

.delete-btn{
    background:#ef4444;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
}

.delete-btn:hover{
    background:#dc2626;
}

.status-badge{
    display:inline-block;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.status-badge.approved{
    background:#dcfce7;
    color:#166534;
}

.status-badge.pending{
    background:#fef3c7;
    color:#92400e;
}


</style>

<body>

<?php
$activePage = "users";
include '../sidebar.php';
?>

<div class="main-content">

    <div class="page-header">

    <div>
        <div class="page-title">
            User Management
        </div>

        <div class="page-subtitle">
            Manage BMS users and permissions
        </div>
    </div>

</div>

    <div class="kpi-grid">

    <div class="kpi-card total">
        <div class="kpi-title">Total Users</div>
        <div class="kpi-value" id="kpiTotal">0</div>
    </div>

    <div class="kpi-card admin">
        <div class="kpi-title">Admins</div>
        <div class="kpi-value" id="kpiAdmin">0</div>
    </div>

    <div class="kpi-card manager">
        <div class="kpi-title">Assistant Managers</div>
        <div class="kpi-value" id="kpiManager">0</div>
    </div>

    <div class="kpi-card leader">
        <div class="kpi-title">Tech Leaders</div>
        <div class="kpi-value" id="kpiLeader">0</div>
    </div>

    <div class="kpi-card coordinator">
        <div class="kpi-title">Site Coordinators</div>
        <div class="kpi-value" id="kpiCoordinator">0</div>
    </div>

    

    <div class="kpi-card operator">
        <div class="kpi-title">BMS Operators</div>
        <div class="kpi-value" id="kpiOperator">0</div>
    </div>

    <div class="kpi-card prov">
        <div class="kpi-title">Provisionary</div>
        <div class="kpi-value" id="kpiProv">0</div>
    </div>

</div>



    <!-- SEARCH -->
    <div class="toolbar">

    <div class="search-box">

        <i class="fa-solid fa-search"></i>

        <input
            type="text"
            id="searchInput"
            placeholder="Search users..."
            onkeyup="filterUsers()">

    </div>

</div>
        


    <!-- TABLE -->
    <div class="table-card">

<table class="user-table">

<thead>
        <tr style="background:#6c5ce7;color:white;">
            <th style="padding:10px;">ID</th>
            <th>First</th>
            <th>Last</th>
            <th>Email</th>
            <th>Birthday</th>
            <th>Role</th>
              <th>Status</th>
            <th>Actions</th>

        </tr>
        </thead>

        <tbody id="userTable">

        <?php foreach ($users as $user): ?>
        <tr class="user-row">
            <td style="padding:10px;"><?= htmlspecialchars($user['id'] ?? '') ?></td>
            <td class="fname"><?= htmlspecialchars($user['firstName'] ?? '') ?></td>
            <td class="lname"><?= htmlspecialchars($user['lastName'] ?? '') ?></td>
            <td class="email"><?= htmlspecialchars($user['email'] ?? '') ?></td>
            <td><?= htmlspecialchars($user['birthday'] ?? '') ?></td>
            <td><?= htmlspecialchars($user['role'] ?? '') ?></td>

<td>
    <?php
        $status = ($user['role'] ?? '') === 'NEW_USER'
            ? 'Pending'
            : 'Approved';
    ?>

    <span class="status-badge <?= strtolower($status) ?>">
        <?= $status ?>
    </span>
</td>

<td style="white-space:nowrap;">

    <button
        class="edit-btn"
        onclick="openEditModal(
            '<?= $user['id'] ?>',
            '<?= htmlspecialchars($user['role'] ?? '') ?>'

          
        )">

        <i class="fa-solid fa-pen"></i>
        
    </button>
 
    <button
        class="delete-btn"
        onclick="deleteUser('<?= $user['id'] ?>')">

        <i class="fa-solid fa-trash"></i>
        
    </button>

</td>


    
        


</div>

            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    
</div>

</div>


<div id="editModal"
     style="display:none;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,.4);
            z-index:9999;">

   <div style="
width:min(400px,90%);
background:white;
margin:80px auto;
padding:25px;
border-radius:12px;">

        <h3>Update User Role</h3>

        <input type="hidden" id="editUserId">

        <label>Role</label>

        <select id="editRole"
        style="width:100%;
               padding:10px;
               margin-top:10px;
               margin-bottom:20px;">

    <?php foreach($usersRoles as $role): ?>
        <option value="<?= $role ?>">
            <?= $role ?>
        </option>
    <?php endforeach; ?>

</select>

        <button onclick="saveRole()"
                style="
                    background:#22c55e;
                    color:white;
                    border:none;
                    padding:10px 16px;
                    border-radius:8px;">
            Save
        </button>

        <button onclick="closeEditModal()"
                style="
                    background:#64748b;
                    color:white;
                    border:none;
                    padding:10px 16px;
                    border-radius:8px;">
            Cancel
        </button>

    </div>
</div>




<!-- =========================
     JAVASCRIPT
========================= -->
<script>

const API_URL = "https://projectx-n2d1.onrender.com/api/users";
const TOKEN = "<?= $token ?>";

let deleteTargetId = null;
let deletedUserBackup = null;




/* TOAST */
function showUndoToast() {
    const toast = document.getElementById("undoToast");
    toast.style.display = "block";

    setTimeout(() => {
        toast.style.display = "none";
    }, 5000);
}

/* SEARCH */
function filterUsers() {

    let filter = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll(".user-row");

    rows.forEach(row => {

        let fname = row.querySelector(".fname").innerText.toLowerCase();
        let lname = row.querySelector(".lname").innerText.toLowerCase();
        let email = row.querySelector(".email").innerText.toLowerCase();

        row.style.display =
            (fname.includes(filter) ||
             lname.includes(filter) ||
             email.includes(filter))
            ? ""
            : "none";
    });
}

/* KPI CALCULATION */
function calculateKPIs() {

    let total = USERS.length;

    let admin = 0;
    let manager = 0;
    let leader = 0;
    let coordinator = 0;
    
    let operator = 0;
    let prov = 0;

    USERS.forEach(user => {

        let role = (user.role || "").toLowerCase().trim();

        if(role === "admin")
            admin++;

        else if(role === "assistant manager")
            manager++;

        else if(role === "tech leader")
            leader++;

        else if(role === "site coordinator")
            coordinator++;

       

        else if(role === "bms operator")
            operator++;

        else if(role === "provisionary")
            prov++;
    });

    document.getElementById("kpiTotal").innerText = total;
    document.getElementById("kpiAdmin").innerText = admin;
    document.getElementById("kpiManager").innerText = manager;
    document.getElementById("kpiLeader").innerText = leader;
    document.getElementById("kpiCoordinator").innerText = coordinator;
    
    document.getElementById("kpiOperator").innerText = operator;
    document.getElementById("kpiProv").innerText = prov;
}

function openEditModal(userId, role){

    document.getElementById("editUserId").value = userId;
    document.getElementById("editRole").value = role;

    document.getElementById("editModal").style.display = "block";
}


function closeEditModal(){

    document.getElementById("editModal").style.display = "none";
}

async function saveRole(){

    const userId =
        document.getElementById("editUserId").value;

    const role =
        document.getElementById("editRole").value;

    try{

        const response = await fetch(
            `${API_URL}/${userId}`,
            {
                method:"PUT",
                headers:{
                    "Content-Type":"application/json",
                    "Authorization":"Bearer " + TOKEN
                },
                body:JSON.stringify({
                    role:role
                })
            }
        );

        if(response.ok){

            alert("Role updated successfully");

            location.reload();

        }else{

            alert("Failed to update role");
        }

    }catch(error){

        console.error(error);

        alert("Error updating role");
    }
}

async function deleteUser(userId){

    if(!confirm("Delete this user?")){
        return;
    }

    try{

        const response = await fetch(
            `${API_URL}/${userId}`,
            {
                method:"DELETE",
                headers:{
                    "Authorization":"Bearer " + TOKEN
                }
            }
        );

        if(response.ok){

            alert("User deleted");

            location.reload();

        }else{

            alert("Failed to delete user");
        }

    }catch(error){

        console.error(error);

        alert("Error deleting user");
    }
}

</script>
<script>
const USERS = <?= json_encode($users) ?>;

calculateKPIs();
</script>
</body>
</html>
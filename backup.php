
<?php
include '../auth.php';

$token = "eyJhbGciOiJIUzUxMiJ9.eyJ1c2VySWQiOjcsImVtYWlsIjoic3VwZXJhZG1pbkBnbWFpbC5jb20iLCJpYXQiOjE3ODE5NDQ2MzEsImV4cCI6MTc4MjU0OTQzMX0.IEnxaN0WJbooZ3XXb_zBHYnJqu7qGJ7ZOWhyMbhy_25hJ38dtj4AWLF9n2YvrHiLEI0s1FlpD-F4d_t6ZgSuEA";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://projectx-n2d1.onrender.com/api/attendances");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $token
]);

$response = curl_exec($ch);



if(curl_errno($ch)){
    die("API Error: " . curl_error($ch));
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if($httpCode != 200){
    die("API returned HTTP Code: " . $httpCode);
}

$data = [];

if ($response) {
    $result = json_decode($response, true);

if (json_last_error() === JSON_ERROR_NONE) {

    if (isset($result['data']) && is_array($result['data'])) {
        $data = $result['data'];
    }
    elseif (is_array($result)) {
        $data = $result;
    }

} else {
    $data = [];
}
}

$uploadSuccess = false;

if (isset($_POST['import_csv'])) {
    $uploadSuccess = true; // set true after successful import logic
}



?>


<?php
$activePage = "attendance";

/*
|--------------------------------------------------------------------------
| EXPORT CSV
|--------------------------------------------------------------------------
*/
if (isset($_GET['export']) && $_GET['export'] == 'csv') {

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="attendance_report_' . date('Y-m-d') . '.csv"');

    $output = fopen('php://output', 'w');

    fputcsv($output, [
        'User ID','Time','Date','Type','Status','Latitude','Longitude'
    ]);

    foreach ($data as $row) {

        $dateTime = $row['dateTime'] ?? '';
        $status = '';

        if ($dateTime) {
            $hour = (int) date("H", strtotime($dateTime));

            if ($hour < 9) $status = "Early";
            elseif ($hour == 9) $status = "On Time";
            else $status = "Late";
        }

        fputcsv($output, [
            $row['user']['id'] ?? '',
            $dateTime ? date("h:i A", strtotime($dateTime)) : '',
            $dateTime ? date("Y-m-d", strtotime($dateTime)) : '',
            $row['type'] ?? '',
            $status,
            $row['latitude'] ?? '',
            $row['longitude'] ?? ''
        ]);
    }

    fclose($output);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance Monitoring</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<style>

    
:root{
    --bg:#0f172a;
    --card:#111827;
    --card2:#1f2937;
    --text:#e5e7eb;
    --muted:#9ca3af;
    --accent:#10b981;
    --danger:#ef4444;
    --warning:#f59e0b;
}

/* BODY */
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:var(--bg);
    color:var(--text);
}

/* MAIN CONTENT */
.main{
    margin-left:260px;
    padding:25px;
}

/* DASH CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
    margin-bottom:20px;
}

.card{
    background:var(--card);
    border:1px solid #1f2937;
    border-radius:14px;
    padding:18px;
    transition:.2s;
}

.card:hover{
    transform:translateY(-3px);
    border-color:var(--accent);
}

.card h4{
    margin:0;
    font-size:14px;
    color:var(--muted);
}

.card .number{
    font-size:26px;
    font-weight:700;
    margin-top:8px;
}

/* CARD COLORS */
.card.present .number{color:var(--accent);}
.card.late .number{color:var(--warning);}
.card.early .number{color:#3b82f6;}
.card.absent .number{color:var(--danger);}

/* TOOLBAR */
.toolbar{
    display:flex;
    justify-content:space-between;
    gap:15px;
    margin-bottom:20px;
}

.drop-zone{
    flex:1;
    padding:18px;
    border:2px dashed #334155;
    border-radius:14px;
    text-align:center;
    color:var(--muted);
    cursor:pointer;
    transition:.2s;
    background:var(--card);
}

.drop-zone:hover{
    border-color:var(--accent);
    color:var(--text);
}

.drop-zone.dragover{
    border-color:var(--accent);
    background:#0b2a22;
}

/* UPLOAD BUTTON */
.upload-form .btn{
    background:var(--accent);
    border:none;
    padding:14px 18px;
    border-radius:10px;
    color:#fff;
    font-weight:600;
    cursor:pointer;
}

.upload-form .btn:hover{
    opacity:0.9;
}

/* TABLE CARD */
.table-card{
    background:var(--card);
    border:1px solid #1f2937;
    border-radius:14px;
    padding:15px;
    overflow:hidden;
}

/* DATATABLE STYLE */
table.dataTable{
    color:var(--text);
}

table.dataTable thead{
    background:var(--card2);
    color:#fff;
}

table.dataTable tbody tr{
    background:var(--card);
}

table.dataTable tbody tr:hover{
    background:#0b2a22;
}

/* IMAGE */
table img{
    width:40px;
    height:40px;
    border-radius:8px;
    object-fit:cover;
}

/* LINKS */
table a{
    color:var(--accent);
    text-decoration:none;
    font-weight:500;
}

/* MODAL */
#editModal{
    display:none;
    position:fixed;
    top:0;left:0;
    width:100%;height:100%;
    background:rgba(0,0,0,0.6);
    justify-content:center;
    align-items:center;
}

#editModal > div{
    background:var(--card);
    padding:20px;
    border-radius:14px;
    width:300px;
}

input{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:10px;
    border-radius:8px;
    border:1px solid #334155;
    background:#0f172a;
    color:#fff;
}

.btn-delete{
    background:var(--danger);
    border:none;
    padding:10px;
    color:#fff;
    border-radius:8px;
    cursor:pointer;
}
.status-filter{
    display:flex;
    align-items:center;
    gap:10px;
    background:#111827;
    padding:10px 14px;
    border-radius:12px;
    border:1px solid #1f2937;
    color:#e5e7eb;
}

.status-filter select{
    background:#0f172a;
    color:#fff;
    border:1px solid #334155;
    padding:8px 10px;
    border-radius:8px;
    outline:none;
    cursor:pointer;
}
/* RESPONSIVE */
@media(max-width:900px){
    .cards{
        grid-template-columns:repeat(2,1fr);
    }

    .main{
        margin-left:0;
    }
}

</style>
</head>

<body>

<!-- EDIT MODAL -->
<div id="editModal">
    <div>
        <h3>Edit Attendance</h3>

        <label>Date</label>
        <input type="date" id="editDate">

        <label>Time</label>
        <input type="time" id="editTime">

        <label>Type</label>
        <input type="text" id="editType">

        <br><br>

        <button id="saveEdit" class="btn">Save</button>
        <button id="cancelEdit" class="btn-delete">Cancel</button>
    </div>
</div>


<?php
$activePage = "attendance";
include '../sidebar.php';
?>

<div class="main">

    <!-- HEADER -->
  <div class="cards">

    <div class="card present">
        <h4>Present Today</h4>
        <div class="number">265</div>
    </div>

    <div class="card late">
        <h4>Late Employees</h4>
        <div class="number">62</div>
    </div>

    <div class="card early">
        <h4>Early Check-In</h4>
        <div class="number">224</div>
    </div>

    <div class="card absent">
        <h4>Absent</h4>
        <div class="number">42</div>
    </div>

</div>

<div class="toolbar">

    <div id="dropZone" class="drop-zone">
        📂 Drag & Drop CSV here or click to select
        <input type="file" name="csv_file" id="csvInput" accept=".csv" hidden>
    </div>

    <div class="status-filter">
    <label>Status:</label>
    <select id="statusFilter">
        <option value="">All</option>
        <option value="Early">Early</option>
        <option value="On Time">On Time</option>
        <option value="Late">Late</option>
    </select>
</div>

    <form method="POST" enctype="multipart/form-data" id="uploadForm" class="upload-form">
        <input type="file" name="csv_file" id="hiddenFile" accept=".csv" hidden>
        <button class="btn" name="import_csv">📤 Upload CSV</button>
    </form>

</div>

    <!-- TABLE -->
    <div class="table-card">

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Picture</th>
                    <th>Location</th>
                    <th>User ID</th>

                </tr>
            </thead>

            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <?php $dateTime = $row['dateTime'] ?? null; ?>

                        <tr>
                            <td><?= $row['user']['id'] ?? '' ?></td>
                            <td><?= $dateTime ? date("h:i A", strtotime($dateTime)) : '' ?></td>
                            <td><?= $dateTime ? date("Y-m-d", strtotime($dateTime)) : '' ?></td>
                            <td><?= $row['type'] ?? '' ?></td>

                            <td>
                                <?php
                                $status = "Late";
                                if ($dateTime) {
                                    $hour = date("H", strtotime($dateTime));
                                    $status = ($hour < 9) ? "Early" : (($hour == 9) ? "On Time" : "Late");
                                }
                                echo $status;
                                ?>
                            </td>

                            <td>
                                <?php if (!empty($row['picture'])): ?>
                                    <img src="<?= $row['picture'] ?>">
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if (!empty($row['latitude'])): ?>
                                    <a target="_blank"
                                       href="https://maps.google.com/?q=<?= $row['latitude'] ?>,<?= $row['longitude'] ?>">
                                        View
                                    </a>
                                <?php endif; ?>
                            </td>

                            <td><?= $row['user']['id'] ?? '' ?></td>
                            
                        </tr>

                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>

    </div>

</div>

<script>
$(document).ready(function () {
    $('#myTable').DataTable({
        pageLength: 7,
        lengthMenu: [5, 10, 25, 50],
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: '⬇ Action',
                autoClose: true,
                buttons: [
                    {
                        extend: 'csv',
                        text: 'Export CSV'
                    },
                    {
                        extend: 'excel',
                        text: 'Export Excel'
                    },
                    {
                        extend: 'pdf',
                        text: 'Export PDF'
                    },
                    {
                        extend: 'print',
                        text: 'Print Table'
                    }
                ]
            }
        ]
    });
});


$(document).ready(function () {

    var table = $('#myTable').DataTable({
        pageLength: 7,
        lengthMenu: [5, 10, 25, 50],
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: '⬇ Export',
                autoClose: true,
                buttons: [
                    { extend: 'csv', text: 'CSV' },
                    { extend: 'excel', text: 'Excel' },
                    { extend: 'pdf', text: 'PDF' },
                    { extend: 'print', text: 'Print' }
                ]
            }
        ]
    });

    // STATUS FILTER
    $('#statusFilter').on('change', function () {
        var value = this.value;
        table.column(4).search(value).draw(); // column 4 = Status
    });

});
</script>

<script>

// DROP ZONE
const dropZone = document.getElementById("dropZone");
const fileInput = document.getElementById("hiddenFile");
const toast = document.getElementById("toast");

// click to open file
dropZone.addEventListener("click", () => fileInput.click());

// drag over
dropZone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZone.classList.add("dragover");
});

// drag leave
dropZone.addEventListener("dragleave", () => {
    dropZone.classList.remove("dragover");
});

// drop file
dropZone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropZone.classList.remove("dragover");

    const file = e.dataTransfer.files[0];
    if (file) {
        fileInput.files = e.dataTransfer.files;
        dropZone.innerHTML = "📄 " + file.name;
    }
});





 
    

</script>




</body>
</html>
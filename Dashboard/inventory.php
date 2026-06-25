<?php
include '../auth.php';

$activePage = "assets";

$token = "eyJhbGciOiJIUzUxMiJ9.eyJ1c2VySWQiOjcsImVtYWlsIjoic3VwZXJhZG1pbkBnbWFpbC5jb20iLCJpYXQiOjE3ODE5NDQ2MzEsImV4cCI6MTc4MjU0OTQzMX0.IEnxaN0WJbooZ3XXb_zBHYnJqu7qGJ7ZOWhyMbhy_25hJ38dtj4AWLF9n2YvrHiLEI0s1FlpD-F4d_t6ZgSuEA";
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory Management</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="../inventory/css/style.css">

<style>

body{
    background:#f3f4f6;
    font-family:system-ui, sans-serif;
}

/* MAIN CONTENT */
.main{
    margin-left: 270px; /* same as sidebar width */
    padding: 25px;
    min-height: 100vh;
    width: calc(100% - 270px);
    box-sizing: border-box;
}

/* PAGE TITLE */
.page-title{
    margin-top: 0;
    margin-bottom: 20px;
    color: #111827;
    font-size: 28px;
    font-weight: 700;
}

/* HEADER */
.table-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin:15px 0;
}

/* BUTTON */
.add-btn{
    background:#1f2937;
    color:white;
    border:none;
    padding:10px 14px;
    border-radius:8px;
    cursor:pointer;
}
.add-btn:hover{ background:#1d4ed8; }

/* MODAL */
.modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.5);
    justify-content:center;
    align-items:center;
}

.modal-content{
    background:white;
    padding:20px;
    width:380px;
    border-radius:10px;
    max-height:90vh;
    overflow:auto;
}

.modal-content label{
    font-size:13px;
    font-weight:600;
    margin-top:8px;
    display:block;
    color:#374151;
}

.modal-content input,
.modal-content select{
    width:100%;
    padding:10px;
    margin-top:4px;
    margin-bottom:10px;
    border:1px solid #e5e7eb;
    border-radius:8px;
    outline:none;
}
#equipmentTable_wrapper{
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,.05);
}

table.dataTable{
    width: 100% !important;
}

.analytics-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:12px;
    margin-bottom:20px;
}

.table-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:10px;
}

@media (max-width: 768px){

    .main{
        margin-left:0;
        width:100%;
        padding:15px;
    }

    .analytics-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .table-header{
        flex-direction:column;
        align-items:stretch;
    }

    .toolbar{
        width:100%;
        justify-content:flex-start;
        flex-wrap:wrap;
    }
}

.modal-content input:focus,
.modal-content select:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 2px rgba(37,99,235,.2);
}

.save-btn{
    width:100%;
    padding:12px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

/* ACTION BUTTONS */
.edit-btn{
    background:#f59e0b;
    color:white;
    border:none;
    padding:6px 10px;
    border-radius:6px;
    cursor:pointer;
}

.delete-btn{
    background:#dc2626;
    color:white;
    border:none;
    padding:6px 10px;
    border-radius:6px;
    cursor:pointer;
}

/* ANALYTICS */
.analytics-grid{
    display:grid;
    grid-template-columns:repeat(6,1fr);
    gap:12px;
    margin-bottom:15px;
}

.analytics-card{
    padding:14px;
    border-radius:12px;
    color:white;
    min-height:75px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.analytics-card h3{
    font-size:24px;
    margin:0;
}

.analytics-card p{
    margin-top:4px;
    font-size:13px;
    opacity:.9;
}


.toolbar{
    display:flex;
    gap:10px;
    align-items:center;
}

/* DROPDOWN */
.dropdown{
    position:relative;
    display:inline-block;
}

.dropdown-content{
    display:none;
    position:absolute;
    right:0;
    background:white;
    min-width:200px;
    box-shadow:0 6px 20px rgba(0,0,0,0.15);
    border-radius:10px;
    overflow:hidden;
    z-index:1000;
}

.dropdown-content button,
.dropdown-content label{
    width:100%;
    padding:10px;
    border:none;
    background:white;
    text-align:left;
    cursor:pointer;
    font-size:13px;
    display:block;
}

.dropdown-content button:hover,
.dropdown-content label:hover{
    background:#f3f4f6;
}

/* show dropdown on hover */
.dropdown:hover .dropdown-content{
    display:block;
}

.total{ background:linear-gradient(135deg,#2563eb,#1d4ed8); }
.fdas{ background:linear-gradient(135deg,#ef4444,#dc2626); }
.bms{ background:linear-gradient(135deg,#3b82f6,#2563eb); }
.bgmpa{ background:linear-gradient(135deg,#f59e0b,#d97706); }
.cctv{ background:linear-gradient(135deg,#8b5cf6,#7c3aed); }
.laptop{ background:linear-gradient(135deg,#10b981,#059669); }


.delete-all-btn{
    background:#dc2626;
    color:white;
}

.delete-all-btn:hover{
    background:#b91c1c;
}

/* ACTION DROPDOWN BUTTON HOVER EFFECT */
.dropdown-content button,
.dropdown-content label{
    transition: all 0.2s ease-in-out;
    border-left: 3px solid transparent;
}

/* hover effect */
.dropdown-content button:hover,
.dropdown-content label:hover{
    background: #e5e7eb;
    border-left: 3px solid #2563eb;
    padding-left: 12px; /* slight shift effect */
}

/* active click effect */
.dropdown-content button:active,
.dropdown-content label:active{
    background: #d1d5db;
    transform: scale(0.98);
}

/* optional icon-like emphasis on destructive actions */
.dropdown-content button.danger:hover{
    background: #fee2e2;
    border-left: 3px solid #dc2626;
    color: #b91c1c;
}


/* FAB WRAPPER */
.fab-menu{
    position: relative;
    display: inline-block;
}

/* MAIN BUTTON */
.fab-main{
    background:#1f2937;
    color:white;
    border:none;
    padding:10px 14px;
    border-radius:10px;
    cursor:pointer;
    display:flex;
    align-items:center;
    gap:6px;
    transition:0.2s;
}

.fab-main:hover{
    background:#111827;
    transform: translateY(-1px);
}

/* ITEMS PANEL */
.fab-items{
    position:absolute;
    right:0;
    top:110%;
    background:white;
    border-radius:14px;
    box-shadow:0 12px 30px rgba(0,0,0,0.15);
    overflow:hidden;
    min-width:220px;

    opacity:0;
    transform: translateY(-10px);
    pointer-events:none;
    transition:0.25s ease;
    z-index:999;
}

/* OPEN STATE */
.fab-menu.active .fab-items{
    opacity:1;
    transform: translateY(0);
    pointer-events:auto;
}

/* BUTTON ITEMS */
.fab-items button,
.fab-items label{
    width:100%;
    padding:12px 14px;
    border:none;
    background:white;
    text-align:left;
    cursor:pointer;
    font-size:13px;
    display:flex;
    align-items:center;
    gap:8px;
    transition:0.2s;
}

/* HOVER */
.fab-items button:hover,
.fab-items label:hover{
    background:#f3f4f6;
    padding-left:18px;
}

/* DANGER */
.fab-items .danger:hover{
    background:#fee2e2;
    color:#b91c1c;
}

/* ACTIVE CLICK */
.fab-items button:active{
    transform: scale(0.98);
}

</style>
</head>

<body>


<?php
$activePage = "assets";
include '../sidebar.php';
?>


<div class="main">

<h1 class="page-title">Inventory Management</h1>

<!-- ANALYTICS -->
<div class="analytics-grid">

    <div class="analytics-card total"><h3 id="totalEquipment">0</h3><p>Total Equipment</p></div>
    <div class="analytics-card fdas"><h3 id="fdasCount">0</h3><p>FDAS</p></div>
    <div class="analytics-card bms"><h3 id="bmsCount">0</h3><p>BMS</p></div>
    <div class="analytics-card bgmpa"><h3 id="bgmpaCount">0</h3><p>BGMPA</p></div>
    <div class="analytics-card cctv"><h3 id="cctvCount">0</h3><p>CCTV</p></div>
    <div class="analytics-card laptop"><h3 id="laptopCount">0</h3><p>Laptop</p></div>

</div>

<!-- TABLE HEADER -->
<div class="table-header">
    <h3>Equipment Inventory</h3>

    <div class="toolbar">

        <button class="add-btn" onclick="openModal()">+ Add Device</button>

        <div class="fab-menu">

    <!-- Main Button -->
    <button class="fab-main" onclick="toggleFabMenu()">
        ⚙️ Actions
    </button>

    <!-- Floating Items -->
    <div class="fab-items" id="fabItems">

        <button onclick="exportPDF()">
            📄 Export PDF
        </button>

        <button onclick="exportCSV()">
            📊 Export CSV
        </button>

        <label>
            ⬆️ Import CSV
            <input type="file" accept=".csv" onchange="importCSV(event)" hidden>
        </label>

        <button onclick="printTable()">
            🖨️ Print Selected
        </button>

        <button onclick="exportSelectedPDF()">
            📑 Export Selected
        </button>

        <button onclick="deleteSelectedItems()" class="danger">
            🗑️ Delete Selected
        </button>

        <button onclick="deleteVisibleItems()" class="danger">
            ❌ Delete all in Table
        </button>

    </div>
</div>

    </div>
</div>

<!-- TABLE -->
<table id="equipmentTable" class="display">
    <thead>
        <tr>
            <th>
    <input type="checkbox" id="selectAll">
</th>
            <th>Name</th>
            <th>Type</th>
            <th>Model</th>
            <th>Serial Number</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

</div>

<!-- MODAL -->
<div id="equipmentModal" class="modal">
<div class="modal-content">

<h2>Add Equipment</h2>

<form id="equipmentForm">

<input type="hidden" id="editId">

<label>Type</label>
<select id="type" required onchange="loadEquipmentNames()">
    <option value="">Select Type</option>
    <option value="FDAS">FDAS</option>
    <option value="BMS">BMS</option>
    <option value="BGMPA">BGMPA</option>
    <option value="CCTV">CCTV</option>
    <option value="Laptop">Laptop</option>
</select>

<label>Name</label>
<select id="name" required>
    <option value="">Select Equipment</option>
</select>

<label>Model</label>
<input id="model" type="text" required>

<label>Serial Number</label>
<input id="serialNumber" type="text">

<button class="save-btn" type="submit">Save Equipment</button>

</form>

</div>
</div>

<script>

const API_URL = "https://projectx-n2d1.onrender.com/api/equipments";
const TOKEN = "<?php echo $token; ?>";

let table;

const modal = document.getElementById("equipmentModal");
const form = document.getElementById("equipmentForm");

const editId = document.getElementById("editId");
const typeEl = document.getElementById("type");
const nameEl = document.getElementById("name");
const modelEl = document.getElementById("model");
const serialEl = document.getElementById("serialNumber");

/* MODAL */
function openModal(){ modal.style.display = "flex"; }
function closeModal(){ modal.style.display = "none"; form.reset(); editId.value=""; }

window.onclick = (e) => { if(e.target === modal) closeModal(); };

/* TABLE */
$(document).ready(function(){

table = $('#equipmentTable').DataTable({

    processing: true,
    serverSide: false,

    ajax: function(data, callback){

        fetch(API_URL, {
            headers: { "Authorization": "Bearer " + TOKEN }
        })
        .then(r => r.json())
        .then(res => {

            const items = res.data ?? res.content ?? res ?? [];

            updateAnalytics(items);

            callback({
    data: items.map(item => ([
        `<input type="checkbox" class="row-check" data-id="${item.id}">`,
        item.name,
        item.type,
        item.model,
        item.serialNumber,
        `
        <button class="edit-btn" onclick='editItem(${JSON.stringify(item)})'>Edit</button>
        <button class="delete-btn" onclick='deleteItem(${item.id})'>Delete</button>
        `
    ]))
});

        });

    }

});

});

/* SAVE */
form.addEventListener("submit", async (e) => {

e.preventDefault();

const id = editId.value;

const payload = {
    name: nameEl.value,
    type: typeEl.value,
    model: modelEl.value,
    serialNumber: serialEl.value
};

const url = id ? `${API_URL}/${id}` : API_URL;
const method = id ? "PUT" : "POST";

await fetch(url, {
    method,
    headers: {
        "Content-Type": "application/json",
        "Authorization": "Bearer " + TOKEN
    },
    body: JSON.stringify(payload)
});

closeModal();
table.ajax.reload(null,false);

});

/* EDIT */
function editItem(item){

editId.value = item.id;
typeEl.value = item.type;

loadEquipmentNames();

setTimeout(()=>{
    nameEl.value = item.name;
},100);

modelEl.value = item.model;
serialEl.value = item.serialNumber;

openModal();

}

/* DELETE */
async function deleteItem(id){

if(!confirm("Delete?")) return;

await fetch(`${API_URL}/${id}`,{
    method:"DELETE",
    headers:{ "Authorization":"Bearer "+TOKEN }
});

table.ajax.reload(null,false);

}

/* TYPE LIST */
function loadEquipmentNames(){

const data = {
FDAS:["Smoke Detector","Heat Detector","Manual Pull Station"],
BMS:["DDC Controller","Temperature Sensor"],
BGMPA:["Amplifier","Speaker"],
CCTV:["Dome Camera","NVR","DVR"],
Laptop:["Dell Latitude","HP ProBook"]
};

nameEl.innerHTML = '<option value="">Select Equipment</option>';

if(data[typeEl.value]){
data[typeEl.value].forEach(i=>{
nameEl.innerHTML += `<option value="${i}">${i}</option>`;
});
}

}

/* ANALYTICS */
function updateAnalytics(items){

document.getElementById("totalEquipment").innerText = items.length;

document.getElementById("fdasCount").innerText = items.filter(i=>i.type==="FDAS").length;
document.getElementById("bmsCount").innerText = items.filter(i=>i.type==="BMS").length;
document.getElementById("bgmpaCount").innerText = items.filter(i=>i.type==="BGMPA").length;
document.getElementById("cctvCount").innerText = items.filter(i=>i.type==="CCTV").length;
document.getElementById("laptopCount").innerText = items.filter(i=>i.type==="Laptop").length;

}

function exportCSV() {
    fetch(API_URL, {
        headers: { "Authorization": "Bearer " + TOKEN }
    })
    .then(r => r.json())
    .then(res => {

        const items = res.data ?? res.content ?? res ?? [];

        let csv = "Name,Type,Model,Serial Number\n";

        items.forEach(item => {
            csv += `"${item.name}","${item.type}","${item.model}","${item.serialNumber}"\n`;
        });

        const blob = new Blob([csv], { type: "text/csv" });
        const url = URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = url;
        a.download = "equipment_inventory.csv";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    });
}


function importCSV(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = async function(e) {
        const text = e.target.result;

        const rows = text.split("\n").slice(1); // skip header

        for (let row of rows) {
            if (!row.trim()) continue;

            const cols = row.split(",");

            const payload = {
                name: cols[0]?.replace(/"/g,'').trim(),
                type: cols[1]?.replace(/"/g,'').trim(),
                model: cols[2]?.replace(/"/g,'').trim(),
                serialNumber: cols[3]?.replace(/"/g,'').trim()
            };

            await fetch(API_URL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer " + TOKEN
                },
                body: JSON.stringify(payload)
            });
        }

        table.ajax.reload(null,false);
        alert("CSV Imported Successfully!");
    };

    reader.readAsText(file);
}


function printTable() {

    const selectedRows = [];

    document.querySelectorAll(".row-check:checked").forEach(cb => {

        const row = cb.closest("tr");

        const cells = row.querySelectorAll("td");

        selectedRows.push({
            name: cells[1]?.innerText,
            type: cells[2]?.innerText,
            model: cells[3]?.innerText,
            serialNumber: cells[4]?.innerText
        });
    });

    if (selectedRows.length === 0) {
        alert("Please select at least one row to print.");
        return;
    }

    const printWindow = window.open('', '', 'width=900,height=600');

    let tableHTML = `
        <html>
        <head>
            <title>Print Selected Inventory</title>
            <style>
                body { font-family: system-ui, sans-serif; padding: 20px; }
                h2 { text-align:center; margin-bottom:20px; }

                .meta {
                    text-align:center;
                    font-size: 13px;
                    margin-bottom: 15px;
                    color: #555;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                    font-size: 13px;
                }

                th {
                    background: #2563eb;
                    color: white;
                }
            </style>
        </head>
        <body>

            <h2>Selected Equipment Inventory</h2>

            <div class="meta">
                Printed Date: ${new Date().toLocaleString()} <br>
                Selected Rows Only (${selectedRows.length})
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Model</th>
                        <th>Serial Number</th>
                    </tr>
                </thead>
                <tbody>
    `;

    selectedRows.forEach(item => {
        tableHTML += `
            <tr>
                <td>${item.name}</td>
                <td>${item.type}</td>
                <td>${item.model}</td>
                <td>${item.serialNumber}</td>
            </tr>
        `;
    });

    tableHTML += `
                </tbody>
            </table>

            <script>
                window.onload = function() {
                    window.print();
                    window.onafterprint = function() {
                        window.close();
                    }
                }
            <\/script>

        </body>
        </html>
    `;

    printWindow.document.write(tableHTML);
    printWindow.document.close();
}


async function exportPDF() {

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const res = await fetch(API_URL, {
        headers: { "Authorization": "Bearer " + TOKEN }
    });

    const json = await res.json();
    const items = json.data ?? json.content ?? json ?? [];

    const rows = items.map(item => ([
        item.name,
        item.type,
        item.model,
        item.serialNumber
    ]));

    doc.setFontSize(14);
    doc.text("Equipment Inventory Report", 14, 15);

    doc.autoTable({
        startY: 25,
        head: [["Name", "Type", "Model", "Serial Number"]],
        body: rows,
    });

    doc.save("inventory.pdf");
}


function exportSelectedPDF() {

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const selectedRows = [];

    document.querySelectorAll(".row-check:checked").forEach(cb => {

        const row = cb.closest("tr");
        const cells = row.querySelectorAll("td");

        selectedRows.push([
            cells[1]?.innerText,
            cells[2]?.innerText,
            cells[3]?.innerText,
            cells[4]?.innerText
        ]);
    });

    if (selectedRows.length === 0) {
        alert("Please select rows first.");
        return;
    }

    doc.setFontSize(14);
    doc.text("Selected Inventory Report", 14, 15);

    doc.autoTable({
        startY: 25,
        head: [["Name", "Type", "Model", "Serial Number"]],
        body: selectedRows,
    });

    doc.save("selected-inventory.pdf");
}

document.addEventListener("change", function(e) {

    /* SELECT ALL */
    if (e.target && e.target.id === "selectAll") {

        const checked = e.target.checked;

        document.querySelectorAll(".row-check").forEach(cb => {
            cb.checked = checked;
        });
    }

    /* AUTO-UNCHECK SELECT ALL if one row is unchecked */
    if (e.target && e.target.classList.contains("row-check")) {

        const all = document.querySelectorAll(".row-check").length;
        const checked = document.querySelectorAll(".row-check:checked").length;

        document.getElementById("selectAll").checked = (all === checked);
    }
});


async function deleteSelectedItems(){

    const selected = [];

    document.querySelectorAll(".row-check:checked").forEach(cb=>{
        selected.push(cb.dataset.id);
    });

    if(selected.length === 0){
        alert("Please select at least one item.");
        return;
    }

    if(!confirm(`Delete ${selected.length} selected item(s)?`)){
        return;
    }

    try{

        await Promise.all(
            selected.map(id =>
                fetch(`${API_URL}/${id}`,{
                    method:"DELETE",
                    headers:{
                        "Authorization":"Bearer "+TOKEN
                    }
                })
            )
        );

        alert(`${selected.length} item(s) deleted.`);
        table.ajax.reload(null,false);

    }catch(err){
        console.error(err);
        alert("Delete failed.");
    }
}


async function deleteVisibleItems(){

    const visibleIds = [];

    document.querySelectorAll(".row-check").forEach(cb=>{
        visibleIds.push(cb.dataset.id);
    });

    if(visibleIds.length === 0){
        alert("No visible records found.");
        return;
    }

    if(!confirm(
        `Delete ALL ${visibleIds.length} visible records?\n\nThis cannot be undone.`
    )){
        return;
    }

    try{

        await Promise.all(
            visibleIds.map(id =>
                fetch(`${API_URL}/${id}`,{
                    method:"DELETE",
                    headers:{
                        "Authorization":"Bearer "+TOKEN
                    }
                })
            )
        );

        alert(`${visibleIds.length} visible records deleted.`);
        table.ajax.reload(null,false);

    }catch(err){
        console.error(err);
        alert("Delete failed.");
    }
}

async function deleteVisibleItems(){

    const visibleRows = table.rows({search:'applied'}).nodes();

    const ids = [];

    $(visibleRows).find(".row-check").each(function(){
        ids.push($(this).data("id"));
    });

    if(ids.length === 0){
        alert("No visible records.");
        return;
    }

    if(!confirm(`Delete ${ids.length} visible records?`)){
        return;
    }

    await Promise.all(
        ids.map(id =>
            fetch(`${API_URL}/${id}`,{
                method:"DELETE",
                headers:{
                    "Authorization":"Bearer "+TOKEN
                }
            })
        )
    );

    table.ajax.reload(null,false);
}


function toggleFabMenu(){
    document.querySelector(".fab-menu").classList.toggle("active");
}

// close when clicking outside
document.addEventListener("click", function(e){
    const menu = document.querySelector(".fab-menu");
    if(!menu.contains(e.target)){
        menu.classList.remove("active");
    }
});

</script>

</body>
</html>
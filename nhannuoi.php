<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit();
}
include 'nav.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Nhận nuôi</title>
</head> 
<body>
    <h1>UPLOAD THÔNG TIN CỦA BẠN</h1>
    <div class="container_nhannuoi" >
        <form id="uploadForm">
            <input type="file" name="xmlfile" required><br>
            <button type="submit">Upload</button> </br>
        </form>
    </div>

    <table id="resultTable">
        <thead>
            <tr><th>Họ Tên </th><th>Email</th><th>Địa chỉ</th><th>Mã công dân</th></tr>
        </thead>
        <tbody id="tableBody"></tbody>
    </table>

    <script>
    document.getElementById('uploadForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('tableBody').insertAdjacentHTML('beforeend', html);
        })
        .catch(err => {
            alert("Error uploading file.");
            console.error(err);
        });
    });
    </script>
</body>
</html>
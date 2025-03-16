<?php
include '../db.php';
$id = $_GET['id'];

$sql = "DELETE FROM places WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "ลบข้อมูลสำเร็จ!";
} else {
    echo "Error: " . $conn->error;
}

header("Location: admin.php");
?>

<?php
$password = "123456"; // ใส่รหัสผ่านที่ต้องการ
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "รหัสผ่านที่เข้ารหัสแล้ว: " . $hashed_password;
?>

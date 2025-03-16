<?php
include '../db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน

    // ตรวจสอบว่าชื่อผู้ใช้ซ้ำหรือไม่
    $checkAdmin = $conn->query("SELECT * FROM admin WHERE username='$username'");
    if ($checkAdmin->num_rows > 0) {
        $error = "❌ ชื่อนี้มีคนใช้แล้ว กรุณาเลือกชื่อใหม่";
    } else {
        $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            $success = "✅ สมัครแอดมินสำเร็จ! <a href='admin_login.php' class='text-blue-500 underline'>เข้าสู่ระบบ</a>";
        } else {
            $error = "❌ เกิดข้อผิดพลาด: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครแอดมิน | THAI COMMUNITY TRIP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center text-blue-600">สมัครแอดมิน</h2>
        
        <?php if (isset($error)): ?>
            <p class="text-red-500 text-sm mt-4"><?= $error ?></p>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <p class="text-green-500 text-sm mt-4"><?= $success ?></p>
        <?php endif; ?>

        <form method="POST" class="mt-6">
            <label class="block text-gray-700 font-semibold">ชื่อผู้ใช้</label>
            <input type="text" name="username" required 
                   class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            
            <label class="block text-gray-700 font-semibold mt-4">รหัสผ่าน</label>
            <input type="password" name="password" required 
                   class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            
            <button type="submit" class="w-full mt-6 bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                สมัครแอดมิน
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="admin_login.php" class="text-blue-500 underline">เข้าสู่ระบบแอดมิน</a>
        </div>
    </div>

</body>
</html>

<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $username;
            header("Location: admin.php"); // ให้ไปที่หน้าผู้ดูแลระบบ
            exit();
        } else {
            $error = "❌ รหัสผ่านไม่ถูกต้อง!";
        }
    } else {
        $error = "❌ ไม่พบแอดมินนี้!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบแอดมิน | THAI COMMUNITY TRIP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center text-blue-600">เข้าสู่ระบบแอดมิน</h2>
        
        <?php if (isset($error)): ?>
            <p class="text-red-500 text-sm mt-4"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" class="mt-6">
            <label class="block text-gray-700 font-semibold">ชื่อผู้ใช้</label>
            <input type="text" name="username" required 
                   class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            
            <label class="block text-gray-700 font-semibold mt-4">รหัสผ่าน</label>
            <input type="password" name="password" required 
                   class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            
            <button type="submit" class="w-full mt-6 bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                เข้าสู่ระบบ
            </button>
        </form>
    </div>

</body>
</html>

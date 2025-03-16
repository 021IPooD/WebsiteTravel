<?php
session_start();
include 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['user'])) {
    header("Location: login_user.php"); // ถ้ายังไม่ได้ล็อกอินให้ไปที่หน้าเข้าสู่ระบบ
    exit();
}

$username = $_SESSION['user']; // ดึงชื่อผู้ใช้ที่ล็อกอิน

// ดึงข้อมูลสถานที่ทั้งหมด
$stmt = $conn->prepare("SELECT * FROM places");
$stmt->execute();
$result = $stmt->get_result();
$places = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌴 จองสถานที่ | THAI COMMUNITY TRIP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- ✅ แถบเมนูด้านบน -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-2xl font-bold text-blue-600">🏡 THAI COMMUNITY TRIP</h1>
            <div class="flex items-center space-x-6">
                <span class="text-gray-700 font-semibold">👤 ผู้ใช้: <b><?php echo htmlspecialchars($username); ?></b></span>
                <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    ⬅️ ออกจากระบบ
                </a>
            </div>
        </div>
    </nav>

    <!-- ✅ ส่วนหัวของหน้า -->
    <header class="bg-blue-500 text-white text-center py-12">
        <h2 class="text-4xl font-bold">🌟 เลือกสถานที่ท่องเที่ยวที่คุณต้องการ</h2>
        <p class="mt-2 text-lg">พักผ่อนแบบหรูหรากับในธรรมชาติที่ดีที่สุด</p>
    </header>

    <!-- ✅ รายการสถานที่ท่องเที่ยว -->
    <div class="container mx-auto py-12 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($places as $place): ?>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    <img src="<?= htmlspecialchars($place['image']) ?>" class="w-full h-48 object-cover rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mt-4"><?= htmlspecialchars($place['name']) ?></h3>
                    <p class="text-gray-600"><strong>📍 ที่ตั้ง:</strong> <?= htmlspecialchars($place['location']) ?></p>
                    <p class="text-gray-600"><strong>💲 ราคา/คน:</strong> ฿<?= number_format($place['price']) ?></p>
                    <a href="success.php?place_id=<?= $place['id'] ?>" 
                       class="block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg text-center shadow-md transition">
                       จองเลย
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

     <!-- Footer -->
     <footer class="bg-blue-600 text-white mt-12 p-8 text-center">
        <p>© 2025 THAI COMMUNITY TRIP. All rights reserved.</p>
    </footer>

</body>
</html>

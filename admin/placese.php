<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

include '../db.php';
$result = $conn->query("SELECT * FROM places");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการสถานที่ท่องเที่ยว</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-xl font-bold text-gray-800">🏡 จัดการสถานที่ท่องเที่ยว</h1>
            <a href="admin.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                ⬅ กลับไปแดชบอร์ด
            </a>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto py-10 px-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">📋 รายการสถานที่ท่องเที่ยว</h2>

            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-blue-500 text-white text-left">
                        <th class="py-3 px-4">🏡 ชื่อสถานที่</th>
                        <th class="py-3 px-4">💰 ราคา</th>
                        <th class="py-3 px-4">📍 ที่ตั้ง</th>
                        <th class="py-3 px-4">⚙ จัดการ</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                

                    <?php while ($place= $result->fetch_assoc()): ?>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="py-3 px-4"><?= htmlspecialchars($place['name']) ?></td>
                            <td class="py-3 px-4 text-green-600 font-bold">$<?= number_format($place['price']) ?>/คน</td>
                            <td class="py-3 px-4"><?= htmlspecialchars($place['location']) ?></td>
                            <td class="py-3 px-4 space-x-2">
                                <a href="edit.php?id=<?= $place['id'] ?>" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded transition">
                                    ✏ แก้ไข
                                </a>
                                <a href="delete.php?id=<?= $place['id'] ?>" 
                                   class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition"
                                   onclick="return confirm('❗ คุณแน่ใจหรือไม่?')">
                                    🗑 ลบ
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white mt-12 p-8 text-center">
        <p>© 2025 THAI COMMUNITY TRIP. All rights reserved.</p>
    </footer>
</body>
</html>

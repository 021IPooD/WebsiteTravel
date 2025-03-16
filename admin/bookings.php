<?php
session_start();
include '../db.php'; // ✅ เชื่อมต่อฐานข้อมูล


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
    <title>📋 รายการจองทริปท่องเที่ยว</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- ✅ Navbar -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-xl font-bold text-gray-800">📋 รายการจองทริปท่องเที่ยว</h1>
            <a href="admin.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                ⬅️ กลับไปแดชบอร์ด
            </a>
        </div>
    </nav>

    <div class="container mx-auto py-10 px-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">📋 รายการจองทริป</h2>

            <?php if ($result->num_rows > 0 ): ?>
            <table class="w-full border-collapse rounded-lg overflow-hidden shadow-lg">
                <thead>
                    <tr class="bg-blue-500 text-white text-left">
                        <th class="py-3 px-4">👤 ผู้จอง</th>
                        <th class="py-3 px-4">🏝️ สถานที่</th>
                        <th class="py-3 px-4">📅 วันที่เดินทาง</th>
                        <th class="py-3 px-4">👥 จำนวนคน</th>
                        <th class="py-3 px-4">💰 ราคารวม</th>
                        <th class="py-3 px-4">📌 สถานะ</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php while ($booking = $result->fetch_assoc()): ?>
                        <tr class="border-b hover:bg-gray-100 transition">
                            <td class="py-3 px-4"><?= htmlspecialchars($booking['username']) ?></td>
                            <td class="py-3 px-4"><?= htmlspecialchars($booking['name']) ?></td>
                            <td class="py-3 px-4"><?= date("d M Y", strtotime($booking['travel_date'])) ?></td>
                            <td class="py-3 px-4"><?= htmlspecialchars($booking['people']) ?> คน</td>
                            <td class="py-3 px-4 text-green-600 font-bold">฿<?= number_format($booking['total_price'], 2) ?></td>
                            <td class="py-3 px-4">
                                <?php if ($booking['status'] == 'confirmed'): ?>
                                    <span class="bg-green-500 text-white px-3 py-1 rounded">ยืนยันแล้ว</span>
                                <?php elseif ($booking['status'] == 'pending'): ?>
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded">รอดำเนินการ</span>
                                <?php else: ?>
                                    <span class="bg-red-500 text-white px-3 py-1 rounded">ยกเลิก</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p class="text-center text-gray-500 mt-4">❌ ไม่พบรายการจอง</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>

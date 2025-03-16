<?php 
include '../db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">🔧 Admin Dashboard</h1>
            <a href="admin_logout.php" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">🚪 ออกจากระบบ</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto py-10">
        <h2 class="text-3xl font-bold text-center mb-6">👋 ยินดีต้อนรับ, Admin!</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- เพิ่มที่พัก -->
            <a href="add_place.php" class="bg-red-500 text-white p-6 rounded-lg shadow-lg text-center hover:bg-red-600">
                <h3 class="text-2xl font-bold">➕ เพิ่มสถานที่ท่องเที่ยว</h3>
                <p class="mt-2">เพิ่มข้อมูลสถานที่ท่องเที่ยว</p>
            </a>

            <!-- จัดการที่พัก -->
            <a href="edit.php" class="bg-pink-500 text-white p-6 rounded-lg shadow-lg text-center hover:bg-pink-600">
                <h3 class="text-2xl font-bold">🏡 จัดการสถานที่ท่องเที่ยว</h3>
                <p class="mt-2">ดูและแก้ไขข้อมูลสถานที่ท่องเที่ยว</p>
            </a>

            <!-- ดูการจอง -->
            <a href="bookings.php" class="bg-orange-500 text-white p-6 rounded-lg shadow-lg text-center hover:bg-orange-600">
                <h3 class="text-2xl font-bold">📅 การจอง</h3>
                <p class="mt-2">ดูรายการจองทั้งหมด</p>
            </a>
        </div>
    </div>

     <!-- Footer -->
     <footer class="bg-blue-600 text-white mt-12 p-8 text-center">
        <p>© 2025 THAI COMMUNITY TRIP. All rights reserved.</p>
    </footer>
</body>
</html>

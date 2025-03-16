<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("INSERT INTO places (name, description, location, price, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $name, $description, $location, $price, $image);
    
    if ($stmt->execute()) {
        $success = "✅ เพิ่มสถานที่เรียบร้อย!";
    } else {
        $error = "❌ เกิดข้อผิดพลาดในการเพิ่มข้อมูล!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสถานที่ท่องเที่ยว | THAI COMMUNITY TRIP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-xl font-bold text-gray-800">➕ เพิ่มสถานที่ท่องเที่ยว</h1>
            <a href="admin.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                ⬅ กลับไปแดชบอร์ด
            </a>
        </div>
    </nav>

    <!-- Main Form -->
    <div class="flex-grow flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold text-center text-blue-600">➕ เพิ่มสถานที่ท่องเที่ยว</h2>

            <!-- แสดงข้อความแจ้งเตือน -->
            <?php if (isset($success)): ?>
                <p class="text-green-500 text-sm mt-4"><?= $success ?></p>
            <?php elseif (isset($error)): ?>
                <p class="text-red-500 text-sm mt-4"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST" class="mt-6 space-y-4">
                <div>
                    <label class="block text-gray-700 font-semibold">ชื่อสถานที่</label>
                    <input type="text" name="name" required 
                           class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">คำอธิบาย</label>
                    <textarea name="description" required 
                              class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">ที่ตั้ง</label>
                    <input type="text" name="location" required 
                           class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">ราคา (บาท)</label>
                    <input type="number" name="price" required 
                           class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">URL รูปภาพ</label>
                    <input type="text" name="image" 
                           class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                    ➕ เพิ่มสถานที่
                </button>
            </form>
        </div>
    </div>

</body>
</html>

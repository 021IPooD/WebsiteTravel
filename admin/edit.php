<?php
include '../db.php';

if (!isset($_GET['id'])) {
    header("Location: placese.php");
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM places WHERE id=$id");
$place = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("UPDATE places SET name=?, description=?, price=?, image=?, location=? WHERE id=?");
    $stmt->bind_param("ssissi", $name, $description, $price, $image, $location, $id);

    if ($stmt->execute()) {
        header("Location: placese.php");
        exit();
    } else {
        $error = "❌ เกิดข้อผิดพลาดในการบันทึกข้อมูล!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขสถานที่ | THAI COMMUNITY TRIP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold text-center text-blue-600">✏️ แก้ไขสถานที่</h1>

        <?php if (isset($error)): ?>
            <p class="text-red-500 text-sm mt-4"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" class="mt-6 space-y-4">
            <div>
                <label class="block text-gray-700 font-semibold">ชื่อสถานที่</label>
                <input type="text" name="name" value="<?= htmlspecialchars($place['name']) ?>" required 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">รายละเอียด</label>
                <textarea name="description" required 
                          class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"><?= htmlspecialchars($place['description']) ?></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">ราคา (บาท)</label>
                <input type="number" name="price" value="<?= htmlspecialchars($place['price']) ?>" required 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">ลิงก์รูปภาพ</label>
                <input type="text" name="image" value="<?= htmlspecialchars($place['image']) ?>" 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">ที่ตั้ง</label>
                <input type="text" name="location" value="<?= htmlspecialchars($place['location']) ?>" required 
                       class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                บันทึกการเปลี่ยนแปลง
            </button>
        </form>
    </div>

</body>
</html>

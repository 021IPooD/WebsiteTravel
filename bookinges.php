<?php
session_start();
include 'db.php';

$places = $_GET['places'] ?? null;

// ✅ ดึงข้อมูลสถานที่
$sql = "SELECT * FROM places WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $place_id);
$stmt->execute();
$places = $stmt->get_result()->fetch_assoc();

if (!$places) {
    die("❌ ไม่พบข้อมูลสถานที่");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['user_id'];  // ต้องล็อกอินก่อน
    $travel_date = $_POST['travel_date'];
    $people = $_POST['people'];
    $total_price = $places['price'] * $people;

    $sql = "INSERT INTO bookings (user_id, place_id, travel_date, people, total_price, status) 
            VALUES (?, ?, ?, ?, ?, 'pending')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $user_id, $place_id, $travel_date, $people, $total_price);
    
    if ($stmt->execute()) {
        header("Location: booking.php?success=1");
        exit;
    } else {
        echo "เกิดข้อผิดพลาดในการจอง";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🛒 จองทริป: <?= htmlspecialchars($places['name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto py-10 px-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">🛒 จองทริป: <?= htmlspecialchars($places['name']) ?></h2>

            <form action="" method="POST">
                <label class="block text-gray-600">📅 วันที่เดินทาง:</label>
                <input type="date" name="travel_date" required class="w-full px-3 py-2 border rounded-md mb-3">
                
                <label class="block text-gray-600">👥 จำนวนคน:</label>
                <input type="number" name="people" min="1" required class="w-full px-3 py-2 border rounded-md mb-3">

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                    ✅ ยืนยันการจอง
                </button>
            </form>
        </div>
    </div>

</body>
</html>

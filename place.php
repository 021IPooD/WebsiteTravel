<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM placese WHERE id = $id");
$villa = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $place['name'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <div class="bg-white p-6 rounded shadow-lg">
            <img src="<?= $place['image'] ?>" class="w-full h-64 object-cover rounded">
            <h1 class="text-3xl font-bold mt-4"><?= $place['name'] ?></h1>
            <p class="text-gray-600"><?= $place['description'] ?></p>
            <p class="text-xl font-bold text-blue-600 mt-4">$<?= $place['price'] ?>/คน</p>
            <p class="text-gray-500">📍 <?= $place['location'] ?></p>
            <a href="bookinges.php?place_id=<?= $place['id'] ?>" 
            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">🛒 จองเลย
</a>        </div>
    </div>
</body>
</html>
<?php
include 'db.php'; // เชื่อมต่อฐานข้อมูล

$message = ""; // ตัวแปรเก็บข้อความแจ้งเตือน

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน

    // ใช้ prepared statement เพื่อป้องกัน SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $checkUser = $stmt->get_result();

    if ($checkUser->num_rows > 0) {
        $message = "<div class='alert alert-danger text-center'>❌ ชื่อนี้มีคนใช้แล้ว กรุณาเลือกชื่อใหม่</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success text-center'>✅ สมัครสมาชิกสำเร็จ! <a href='login_user.php' class='btn btn-primary btn-sm'>เข้าสู่ระบบ</a></div>";
        } else {
            $message = "<div class='alert alert-danger text-center'>❌ เกิดข้อผิดพลาด: " . $conn->error . "</div>";
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            height: 100vh;
        }
        .card {
            border-radius: 15px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #0072ff;
            color: white;
            border-radius: 10px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .input-group-text {
            background-color: #0072ff;
            color: white;
            border-radius: 10px 0 0 10px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="card shadow-lg p-4 mx-auto" style="max-width: 400px;">
            <h2 class="text-center text-primary">สมัครสมาชิก</h2>
            <?php echo $message; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">ชื่อผู้ใช้</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">รหัสผ่าน</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-custom w-100">สมัครสมาชิก</button>
            </form>
            <div class="text-center mt-3">
                <a href="login_user.php">เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
</body>
</html>

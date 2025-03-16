<?php

include 'db.php';



if (isset($_SESSION['user'])) {
    echo "👋 สวัสดี, " . $_SESSION['user'] . "! <a href='logout_user.php'>ออกจากระบบ</a>";
}

$result = $conn->query("SELECT * FROM places");
?>
<ul>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองทริปท่องเที่ยวเชิงชุมชนทั่วไทย</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gradient-to-r from-blue-50 to-blue-200">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg p-6 flex justify-between items-center rounded-b-3xl">
        <h1 class="text-3xl font-extrabold text-orange-500 hover:text-orange-600 cursor-pointer transition-all duration-300">THAI COMMUNITY TRIP</h1>
        
        <div class="space-x-4 flex items-center">
        <li><a href="login_user.php" class="hover:text-blue-500">Login</a></li>
        <li><a href="register_user.php" class="hover:text-blue-500">Sign Up</a></li>
        </div>
    
    </nav>
    
    
    <!-- Header -->
    <header class="text-center my-8">
        <h2 class="text-3xl font-bold">จองทริปท่องเที่ยวเชิงชุมชนทั่วไทย</h2>
        <p class="text-gray-600">เลือกที่เที่ยวตามภาคและจังหวัดที่คุณต้องการ</p>
    </header>

    <section id='home' class="relative w-full h-screen bg-cover bg-center flex items-center justify-center text-center text-white" 
             style="background-image: url('https://media.bookmundi.com/files/uploads/bookmundi/resized/cmsfeatured/6-days-in-thailand-1721747184-785X440.jpg?width=1440&quality=75');">
        <div class="bg-black bg-opacity-50 w-full h-full absolute top-0 left-0"></div>
        <div class="relative z-10 px-6">
            <h1 class="text-5xl font-bold uppercase">Travel Trip</h1>
            <p class="text-lg mt-4">สัมผัสประสบการณ์การพักผ่อนที่สมบูรณ์แบบกับธรรมชาติพิเศษของเรา</p>
            <a href="login_user.php" 
               class="mt-6 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg text-lg shadow-md">
               Book Now </a>


        </div>
    </section>

    <!-- JavaScript for Mobile Menu -->
    <script>
        document.getElementById('menuBtn').addEventListener('click', function() {
            var menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });
    </script>
    <!-- About Section -->
    <section id="about" class="bg-white py-16">
    <div class="container mx-auto px-6 md:px-12">
        <div class="flex flex-col md:flex-row items-center">
            
            <!-- Text Content -->
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold text-gray-800">ABOUT <br> Traval Trip</h2>
                <p class="mt-4 text-gray-600 leading-relaxed">
                THAI COMMUNITY TRIP คือโครงการท่องเที่ยวเชิงอนุรักษ์ ที่เปิดโอกาสให้นักเดินทางได้สัมผัส วัฒนธรรมท้องถิ่น และ วิถีชีวิตชุมชนไทย อย่างใกล้ชิด 
                ผ่านกิจกรรมที่หลากหลาย เช่น การเรียนรู้หัตถกรรมพื้นบ้าน, การทำอาหารท้องถิ่น, การล่องเรือชมธรรมชาติ, และ การเข้าพักแบบโฮมสเตย์
                </p>
                <p class="mt-4 text-gray-600 leading-relaxed">
                📌 เหมาะสำหรับนักเดินทางที่ต้องการ ประสบการณ์ที่มากกว่าการท่องเที่ยว – ได้ทั้งความสนุก, ความรู้, และความประทับใจจากการใช้ชีวิตร่วมกับชุมชนไทย

🔎 พร้อมออกเดินทางไปค้นพบเสน่ห์ของชุมชนไทยกับเราแล้วหรือยัง? 🌏✨
                </p>
            </div>

            <!-- Image -->
            <div class="md:w-1/2 mt-8 md:mt-0 md:ml-12">
                <img src="https://feelfreetravel.b-cdn.net/uploads/destinations/a29e2a7f2437fcaee966e61a2878bb518013adbb6158f387fbcce0ab359cfb50.jpg?width=1600" 
                     alt="Traval Trip" 
                     class="rounded-lg shadow-lg w-full">
            </div>
        </div>
    </div>
</section>


<!-- Contact Section -->
<section id="contact" class="bg-gray-100 py-16">
    <div class="container mx-auto px-6 md:px-12">
        <h2 class="text-3xl font-bold text-gray-800 text-center">📞 Contact Us</h2>
        <p class="text-gray-600 text-center mt-2">มีคำถาม? ติดต่อเราสิ!</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-semibold text-gray-700">🏡 ที่อยู่</h3>
                <p class="text-gray-600">321 THAI COMMUNITY TRIP Road, Surattani, Thailand</p>
                
                <h3 class="text-xl font-semibold text-gray-700 mt-4">📧 อีเมล</h3>
                <p class="text-gray-600">contact@triptravel.com</p>

                <h3 class="text-xl font-semibold text-gray-700 mt-4">📞 โทร</h3>
                <p class="text-gray-600">+66 987 654 321</p>
            </div>

            <!-- Contact Form -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">ส่งข้อความถึงเรา</h3>
                <form action="#" method="POST" class="mt-4">
                    <input type="text" name="name" placeholder="ชื่อของคุณ" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="email" name="email" placeholder="อีเมลของคุณ" class="w-full p-3 mt-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <textarea name="message" rows="4" placeholder="ข้อความของคุณ" class="w-full p-3 mt-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    <button type="submit" class="w-full bg-blue-500 text-white py-3 mt-4 rounded-lg hover:bg-blue-600 transition">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Footer -->
<footer class="bg-gray-900 text-white py-10 mt-16">
    <div class="container mx-auto px-6 md:px-12">
        
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            
            <!-- About Us -->
            <div>
                <h3 class="text-xl font-semibold">🏡 Travel Trip</h3>
                <p class="text-gray-400 mt-2">
                   Trip travel ให้บริการที่พักโฮมสเตย์ พร้อมสิ่งอำนวยความสะดวกครบครัน ให้คุณได้พักผ่อนอย่างเต็มที่
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-semibold">🔗 Quick Links</h3>
                <ul class="mt-2 space-y-2">
                    <li><a href="#home" class="text-gray-400 hover:text-white">Home</a></li>
                    <li><a href="#about" class="text-gray-400 hover:text-white">About</a></li>
                    <li><a href="#contact" class="text-gray-400 hover:text-white">Contact</a></li>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h3 class="text-xl font-semibold">📱 Follow Us</h3>
                <div class="flex justify-center md:justify-start space-x-4 mt-3">
                    <a href="#" class="text-gray-400 hover:text-white text-2xl"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white text-2xl"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white text-2xl"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

        </div>




    
    <!-- Footer -->
    <footer class="bg-blue-600 text-white mt-12 p-8 text-center">
        <p>© 2025 THAI COMMUNITY TRIP. All rights reserved.</p>
    </footer>
</body>
</html>

</ul>



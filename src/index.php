<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <title>الصفحة الرئيسية</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md text-center">
        <h2 class="text-3xl mb-4">مرحبًا، <?= $_SESSION["user"]; ?>!</h2>
        <a href="logout.php" class="text-red-500">تسجيل الخروج</a>
    </div>
</body>
</html>

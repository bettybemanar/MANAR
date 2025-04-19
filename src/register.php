<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        header("Location: login.php");
        exit();
    } else {
        $error = "حدث خطأ أثناء التسجيل!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <title>إنشاء حساب</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <form class="bg-white p-8 rounded shadow-md w-96" method="post">
        <h2 class="text-2xl mb-4">إنشاء حساب</h2>
        <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
        <input type="text" name="username" placeholder="اسم المستخدم" class="w-full p-2 mb-2 border" required>
        <input type="password" name="password" placeholder="كلمة المرور" class="w-full p-2 mb-2 border" required>
        <button class="w-full bg-green-500 text-white p-2 rounded" type="submit">تسجيل</button>
    </form>
</body>
</html>

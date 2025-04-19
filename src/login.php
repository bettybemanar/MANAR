<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "اسم المستخدم أو كلمة المرور غير صحيحة!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <form class="bg-white p-8 rounded shadow-md w-96" method="post">
        <h2 class="text-2xl mb-4">تسجيل الدخول</h2>
        <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
        <input type="text" name="username" placeholder="اسم المستخدم" class="w-full p-2 mb-2 border" required>
        <input type="password" name="password" placeholder="كلمة المرور" class="w-full p-2 mb-2 border" required>
        <button class="w-full bg-blue-500 text-white p-2 rounded" type="submit">دخول</button>
        <p class="mt-2 text-sm">ليس لديك حساب؟ <a href="register.php" class="text-blue-500">إنشاء حساب</a></p>
    </form>
</body>
</html>

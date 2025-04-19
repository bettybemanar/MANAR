<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
echo "مرحبًا، " . $_SESSION['user'];
?>
<a href="logout.php">تسجيل الخروج</a>

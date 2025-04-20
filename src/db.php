<?php
$host = getenv("MYSQLHOST") ?: "mysql.railway.internal";
$port = getenv("MYSQLPORT") ?: "3306";
$dbname = getenv("MYSQLDATABASE") ?: "railway";
$username = getenv("MYSQLUSER") ?: "root";
$password = getenv("MYSQLPASSWORD") ?: "GKSZjLITJlmBZQveVgoHpSrBMICaUQTX";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>

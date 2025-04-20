import mysql.connector
import os

# إعداد الاتصال
config = {
    "host": os.getenv("MYSQL_HOST", "mysql.railway.internal"),
    "user": os.getenv("MYSQL_USER", "root"),
    "password": os.getenv("MYSQL_PASSWORD", "GKSZjLITJlmBZQveVgoHpSrBMICaUQTX"),
    "port": int(os.getenv("MYSQL_PORT", "3306"))
}

# الاتصال بالسيرفر
conn = mysql.connector.connect(**config)
cursor = conn.cursor()

# اختيار قاعدة البيانات المطلوبة
cursor.execute("USE railway")

# إنشاء جدول المستخدمين إن لم يكن موجود
cursor.execute("""
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)
""")

# حذف المستخدم admin إن وُجد مسبقًا
cursor.execute("DELETE FROM users WHERE username = %s", ("admin",))

# إدخال المستخدم admin
cursor.execute("""
INSERT INTO users (username, password)
VALUES (%s, %s)
""", ("admin", "passtest"))

# تأكيد العمليات
conn.commit()

print("✅ تم إنشاء جدول المستخدمين وإضافة مستخدم admin بكلمة مرور عادية")

cursor.close()
conn.close()

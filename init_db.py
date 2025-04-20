import mysql.connector
import os
import bcrypt

config = {
    "host": os.getenv("MYSQL_HOST", "mysql.railway.internal"),
    "user": os.getenv("MYSQL_USER", "root"),
    "password": os.getenv("MYSQL_PASSWORD", "GKSZjLITJlmBZQveVgoHpSrBMICaUQTX"),
    "port": int(os.getenv("MYSQL_PORT", "3306"))
}

conn = mysql.connector.connect(**config)
cursor = conn.cursor()

cursor.execute("USE railway")

cursor.execute("""
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)
""")

# تشفير كلمة المرور
hashed_pw = bcrypt.hashpw("passtest".encode(), bcrypt.gensalt())

cursor.execute("""
INSERT INTO users (username, password)
VALUES (%s, %s)
""", ("admin", hashed_pw.decode()))


print("✅ تم إنشاء جدول المستخدمين وإضافة مستخدم admin بكلمة مرور مشفّرة")

cursor.close()
conn.close()

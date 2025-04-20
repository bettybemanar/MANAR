import mysql.connector

config = {
    "host": os.environ["MYSQL_HOST"],
    "user": os.environ["MYSQL_USER"],
    "password": os.environ["MYSQL_PASSWORD"],
    "port": int(os.environ["MYSQL_PORT"])
}

conn = mysql.connector.connect(**config)
cursor = conn.cursor()

cursor.execute("CREATE DATABASE IF NOT EXISTS myapp")
cursor.execute("USE myapp")

cursor.execute("""
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)
""")

cursor.execute("""
INSERT IGNORE INTO users (username, password)
VALUES (%s, %s)
""", ("admin", "passtest"))


print("✅ تم إنشاء قاعدة البيانات والجداول")

cursor.close()
conn.close()
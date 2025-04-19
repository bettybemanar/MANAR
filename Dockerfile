# استخدام PHP مع Apache
FROM php:8.0-apache

# تحديث الحزم وتثبيت الامتدادات المطلوبة
RUN docker-php-ext-install pdo pdo_mysql

# نسخ ملفات المشروع إلى مجلد الاستضافة في Apache
COPY src/ /var/www/html/

# فتح المنفذ 80
EXPOSE 80

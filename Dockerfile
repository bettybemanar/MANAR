FROM php:8.0-apache

# تثبيت Python و mysql connector
RUN apt-get update && apt-get install -y python3 python3-pip \
    && pip3 install mysql-connector-python

# نسخ ملفات PHP
COPY src/ /var/www/html/

# نسخ سكربت الإنشاء
COPY init_db.py /init_db.py

# شغّل السكربت ثم شغّل PHP
CMD python3 /init_db.py && apache2-foreground

EXPOSE 80

FROM php:7.2-apache

# 复制文件和目录
COPY ./html/ /var/www/html/
COPY ./run.sh /
COPY ./flag /

# 更换中国源
#COPY files/sources.list /etc/apt/sources.list

# 创建文件夹
RUN mkdir /nobodys3cr3t /allPe0p1e && chown www-data:www-data /nobodys3cr3t /allPe0p1e && chmod 700 /nobodys3cr3t /allPe0p1e

# 添加权限
RUN chmod 755 -R /var/www/html/ && chown -R root:www-data /var/www/html && chmod +x /run.sh && chmod 400 /flag

CMD /run.sh
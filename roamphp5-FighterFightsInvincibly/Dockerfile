FROM php:7.4.8-apache

# 复制文件和目录
COPY ./html/ /var/www/html/
COPY ./run.sh /
COPY ./flag /
COPY ./readflag /
COPY ./php.ini /usr/local/etc/php/

# 更换中国源
#COPY files/sources.list /etc/apt/sources.list

# 安装扩展
RUN apt-get update && apt install -y cron && apt install -y --no-install-recommends libffi-dev && rm -rf /var/lib/apt/lists/* && docker-php-ext-install ffi

# 定时清理
RUN echo "*/5 * * * * root find /tmp/* -mmin +10 -exec rm -rf {} \;" >> /etc/crontab

# 添加权限
RUN chmod +x /run.sh && chmod 555 /var/www/html && chmod 400 /flag && chmod 4111 /readflag

# 防止搅屎
RUN ln -s /dev/null /tmp && ln -s /dev/null /var/tmp

CMD /run.sh
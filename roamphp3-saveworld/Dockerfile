FROM php:7.2-apache

# 创建目录
RUN mkdir -p /home/ytoworld

# 复制文件,设置web权限
COPY ./flag /fl2222ggg_1s_h3re
COPY ./ssh/ /home/ytoworld/.ssh/
COPY ./html/ /var/www/html/
COPY ./funny /etc/funny
COPY ./ytosh /bin/ytosh
COPY ./run.sh /run.sh
COPY ./miaonei.jpeg /home/ytoworld/.miaonei.jpeg
#COPY ./sources.list /etc/apt/sources.list
RUN chmod 755 -R /var/www/html/ && chown -R www-data:www-data /var/www/html


# 安装ssh
RUN apt-get update && \
    apt-get install -y openssh-server vim libxml2-dev \
    && apt-get clean \
    && rm -fr /var/lib/apt/lists/* \
    && docker-php-ext-install xmlrpc \
    && mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
    && chmod +x /bin/ytosh \
    && chmod +x /run.sh

# 创建用户 设置权限
RUN useradd -d /home/ytoworld -s /bin/ytosh -u 2333 -g 0 -p '$6$aWNu7jrO7hH1spnE$tGgR3Qo5IVKjJ/KKqRkQXVZDhKgjCWQe7eAXZD2XgoPWxYv5f2sGOExI1DgpvgpY6dauJ.TvEUpsi6ytNznL11' ytoworld && chmod 555 -R /home/ytoworld && chown -R ytoworld:root /home/ytoworld && chmod 440 /fl2222ggg_1s_h3re

CMD /run.sh
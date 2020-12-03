FROM ilovintit/php5.6-apache

RUN mkdir -p /etc/question/misc/ /tmp/something/ /usr/liuzhuang/

COPY ./flag /
COPY ./note /
COPY ./html/ /var/www/html
COPY ./php.ini /etc/php.ini
COPY ./run.sh /run.sh
COPY ./mylog1 /etc/question/misc/
COPY ./mylog2 /tmp/something/
COPY ./mylog3 /usr/liuzhuang/


# 设置web权限
RUN chmod 755 -R /var/www/html/ && chmod 775 /var/www/html/upload/ && chown -R root:www-data /var/www/html

# 创建用户 设置权限
RUN useradd -d /home/liuzhuang -s /bin/bash -u 2333 -g 0 -p '$6$IE.mus87$Zneplt3hAFtIwz9h9musl2wsWMuTqHyJvdw83o/KpkM0zDY4POpIJ4YKgjd2d.sjyjmY48bxQ244Cntwe2lL.1' liuzhuang && mkdir -p /home/liuzhuang && chmod 550 /home/liuzhuang && chown liuzhuang:root /home/liuzhuang && chmod 440 /flag && chmod 444 /note && chown liuzhuang:root /etc/question/misc/mylog1 /tmp/something/mylog2 /usr/liuzhuang/mylog3 && chmod go-x /usr/bin/passwd && chmod 444 /etc/question/misc/mylog1 /tmp/something/mylog2 /usr/liuzhuang/mylog3

#安装cron,设置crontab
RUN apt-get update && \
    apt-get install -y cron \
    && apt-get clean \
    && rm -fr /var/lib/apt/lists/* \
    && echo "*/5 * * * * root rm /var/www/html/upload/*" >> /etc/crontab \
    && chmod +x /run.sh

CMD /run.sh
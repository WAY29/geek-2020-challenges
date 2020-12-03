FROM leonsec/xssbot:v1

WORKDIR /var/xssbot/

# 复制文件和目录
COPY ./xssbot.py /var/xssbot/
COPY ./run.sh /

# 安装requests
RUN pip install requests && chmod +x /run.sh

# 运行xssbot
CMD python /var/xssbot/xssbot.py
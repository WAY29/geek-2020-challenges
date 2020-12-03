#!/bin/bash

docker exec cross sh -c "chattr -i /etc/question/misc/mylog1 /tmp/something/mylog2 /usr/liuzhuang/mylog3"
docker-compose down
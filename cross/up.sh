#!/bin/bash

docker-compose up -d
docker exec cross sh -c "chmod 774 /etc/question/misc/mylog1 /tmp/something/mylog2 /usr/liuzhuang/mylog3"
docker exec cross sh -c "chattr +i /etc/question/misc/mylog1 /tmp/something/mylog2 /usr/liuzhuang/mylog3"
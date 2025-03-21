#!/bin/bash

docker compose down -v
#docker system prune
docker system prune -af --volumes
docker rmi $(docker images "kapver/*" -q) 2>/dev/null
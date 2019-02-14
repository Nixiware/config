#!/bin/bash

docker exec -it $(docker container ls --filter name=php_application -q) /bin/bash -c "export COLUMNS=`tput cols`; export LINES=`tput lines`; exec bash"
#!/bin/bash

cp /home/site/wwwroot/build /home/site/wwwroot/build/public

cp /home/site/wwwroot/default /etc/nginx/sites-enabled/default
service nginx reload

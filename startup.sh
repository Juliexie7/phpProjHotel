#!/bin/bash

cp -r /home/site/wwwroot/build /home/site/wwwroot/public

cp /home/site/wwwroot/default /etc/nginx/sites-enabled/default
service nginx reload

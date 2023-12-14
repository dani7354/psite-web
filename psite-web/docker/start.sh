#!/bin/bash
# Start Apache and PHP-FPM inside the container

# Start PHP-FPM
/etc/init.d/php8.3-fpm start &
  
# Start apachectl
/usr/sbin/apachectl -D FOREGROUND
  
# Wait for any process to exit
wait -n
  
# Exit with status of process that exited first
exit $?


<?php
// Check process is running
$output = shell_exec("ps auxwww|grep puller.php|grep -v grep");

// Star process if it isn't.
if($output == '') {
    echo "Starting Puller";
    shell_exec("/usr/bin/php /var/www/html/hookers/puller.php > /dev/null 2>/dev/null &");
} else {
    echo "Already running";
}
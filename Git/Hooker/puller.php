<?php
$branch = 'master';

$start = time();

while(1) {
    // Kill script every hour to keep it dougie-fresh..
    if((time() - $start) > 3600) {
        exit;
    }

    $pull = false;

    if(!file_exists('/tmp/fab.txt')) {
        // File not found skip
        sleep(1);
        continue;
    }

    echo "File found\n";

    $json = file_get_contents('/tmp/fab.txt');
    $pushData = json_decode($json);

    // Check if there's a pull request
    foreach($pushData->commits as $commit) {
        if(strpos($commit->message, '-pull-') !== false) {
            $pull = true;
        }
    }

    // Pull the most recent
    if($pull) {
        $out = shell_exec("git pull origin $branch");
        echo 'Pulling: ' . $out;
    } else {
        echo "No pull request found\n";
    }

    // Cleanup
    unlink('/tmp/fab.txt');
    sleep(1);
}
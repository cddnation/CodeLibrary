<?php
while(1) {
    if(file_exists('/tmp/fab.txt')) {
        echo "File found\n";
        // Read file
        $json = file_get_contents('/tmp/fab.txt');
        $pushData = json_decode($json);

        $pull = false;
        $commitSHA = '';
        $branch = 'master';

        // Check if there's a pull request
        foreach($pushData->commits as $commit) {
            if(strpos($commit->message, '-pull-') !== false) {
                $pull = true;
                $commitSHA = $commit->id;
            }
        }

        // IF so, pull the most recent
        if($pull && $commitSHA != '') {
//            $cmd = "git pull origin $commitSHA:$branch";
            $cmd = "git pull origin $branch";
            echo $cmd;
            $out = shell_exec($cmd);

            echo $out;
            echo 'Pulling:' . $out;
        } else {
            echo "No pull request found\n";
        }



        unlink('/tmp/fab.txt');
    }

    sleep(1);
}
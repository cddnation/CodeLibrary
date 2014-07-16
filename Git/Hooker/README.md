#Github Hooker

Automatically have your server `git pull` from your branch when you push your local changes.

## Setup
Inside your repo you will need to find your post-receive hook and add the url to the github.php file you're about to place on the server.

Clone the dir in to the docroot of your server.

Once added change any names you feel appropriate such as the file created by the github.php script and the **$branch** variable.

Add the daemon-php-check.php to crontab

```
 $ sudo nano /etc/crontab
```

add

```
* * * * * root /path/to/php /path/to/daemon-php-check.php > /tmp/check.txt
```

Save and exit

```
$ sudo service crond restart
```

Et voila. You should be able to push changes now and assuming set up correctly it'll pick them up and pull automatically.


## Running

Simply add -pull- to your commit messages to have it git pull automatically
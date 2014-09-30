# DevOps for A100 Teams

## LAMP stack
 - Linux (Ubuntu)
 - Apache
 - MySQL (including MySQLWorkbench)
 - PHP (including PHPMyAdmin)
 - Git and GitHub

### Installation procedure of VirtualBox, Ubuntu, LAMP, GitHub accounts

#### Ubuntu Linux
 - popular desktop Linux OS (or server version)
 - Install a 32-bit desktop version if your computer has less than 4GB physical memory
 - After OS installation, optionally install a lightweight or alternative desktop environment (default is Unity): http://askubuntu.com/questions/65083/what-kinds-of-desktop-environments-and-shells-are-available

#### Oracle VirtualBox
 - VM manager 

#### Install VirtualBox and Ubuntu
1. Download VirtualBox and Ubuntu prior to training
   - https://www.virtualbox.org/wiki/Downloads
   - http://www.ubuntu.com/download/desktop
2. Go through full VirtualBox installation on Mac or Windows, accepting all settings, including networking (with temporary interruption of Internet connectivity during installation)
3. Create New VirtualBox VM, with at least 512 MB memory, and dynamically allocated 8GB disk space, all other options at default
4. Once created, Start the VM, and select the downloaded ISO Ubuntu disk image for starting installation
5. Erase disk (this refers to your VirtualBox hardisk that you just created) and install Ubuntu
6. Accept most settings, create a user name and password, download updates during installation
7. Upon restart, you may need to select Reset in the VirtualBox window (Under File -> Reset) once the Ubuntu screen reaches "Stopping early crypto disks… [OK]"
8. Once it’s restarted, find the Software Updater icon on the Launcher bar, and click through to install updates and restart.
9. Install VirtualBox Guest Additions (of drivers/applications for running VM on your computer, including video/graphics and filesystem):
   1. Under the VirtualBox window options, go to "Devices -> Insert Guest Additions CD image"
   2. Enter your user password to continue

#### Terminal
 - command line interface
    Go to Applications on the Launcher, and search "terminal'
    Open Terminal, then right-click on the Terminal icon in Launcher and select "Lock to Launcher"
```
    $ sudo apt-get update
    $ sudo apt-get upgrade
```

#### Linux Directory Tree
 - directories not folders
```
    $ ls -al
        -a for showing hidden files (important when working with git)
        -l for showing detailed information (especially user and group permissions)
    $ cd
    $ cat
```

#### git
 - version control
```
    $ sudo apt-get install git
```

#### vim, nano
 - text editors
```
    $ sudo apt-get install vim
```

#### Install AMP
https://help.ubuntu.com/community/ApacheMySQLPHP
```
    $ sudo apt-get install lamp-server^
```     
For why you need to use the caret (^): 
 - http://tech.shantanugoel.com/2010/10/23/apt-get-caret.html
 - Set and confirm your MySQL root user's password

#### Apache
 - web server
 - Go to http://127.0.0.1 or http://localhost >> It works!
 - apache config in /etc/apache2
 - website directory in /var/www

##### Apache commands
```
    $ sudo service apache2 reload
    $ sudo service apache2 start
    $ sudo service apache2 stop
    $ sudo a2dissite 000-default
    $ sudo a2ensite 000-default    
```

#### PHP - confirm installation
```
    $ ls /etc/apache2/mods-enabled
```

Is "php5.conf" listed? If not,

```
    $ sudo a2enmod php5
    $ sudo service apache2 reload
```

Move to the 000-default site's web directory, and create a phpinfo page:

```
    cd /var/www/html
    $ ls -al
    $ sudo nano phpinfo.php
        <?php
            phpinfo();
        ?>
        ^X
        Yes
```

Go to http://localhost/phpinfo.php

#### MySQL - confirm installation
```
    $ mysql -u root -p
        Enter root user's password
    > show databases;
    > exit;
```
#### PHPMyAdmin
```
    $ sudo apt-get install phpmyadmin
```
1. Install for apache2
2. Yes, install with dbconfig-common
3. Use MySQL root username and password
4. Add phpmyadmin to apache's configuration:
```
    $ sudo nano /etc/apache2/apache2.conf
```
5. At bottom of file, enter the following:
```
    # Include phpmyadmin configuration:
    Include /etc/phpmyadmin/apache.conf
    ^x
    $ sudo service apache2 restart
```

http://localhost/phpmyadmin
 - Enter MySQL root user and password to open interface
    
 **OPTIONAL** To apply secure PHPMyAdmin web access (*Use only if you are hosting on an open web server (not just 'localhost')*) (https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-12-04)

#### MySQL Workbench
```
    $ sudo apt-get install mysql-workbench
```

#### Build and deploy test site
http://askubuntu.com/questions/46331/how-to-avoid-using-sudo-when-working-in-var-www
Principle of Least Privilege
 - http://en.wikipedia.org/wiki/Principle_of_least_privilege

```
    $ sudo gpasswd -a $USER www-data
    $ sudo chgrp -R www-data /var/www
    $ sudo chmod -R g+w /var/www
```

Test access

```
    $ touch /var/www/test.txt
    $ rm /var/www/test.txt
```

```
    $ cd ~
    $ mkdir dev
    $ cd dev
    $ git clone [https://github.com/AmundsenJunior/amp-test.git]
    $ ln -sT ~/dev/amp-test /var/www/amp-test
    $ cd /etc/apache2

    $ sudo cp sites-available/000-default.conf sites-available/amp-test.conf
    $ sudo nano sites-available/amp-test.conf
```

Change ```DocumentRoot /var/www/html``` to ```/var/www/amp-test```

```
    ^x
    $ sudo a2dissite 000-default
    $ sudo a2ensite amp-test
    $ sudo service apache2 reload

```

http://localhost
    
#### VirtualBox - shutdown
1. In the VM, initiate OS shutdown
2. Once completed, on the VM window, do File -> ACPI Shutdown


# DevOps for A100 Teams

### LAMP stack
 - Linux (Ubuntu)
 - Apache
 - MySQL (including MySQLWorkbench)
 - PHP (including PHPMyAdmin)
 - Git and GitHub

### Installation procedure of VirtualBox, Ubuntu, LAMP, GitHub account
 - Download VirtualBox and Ubuntu prior to training
[https://www.virtualbox.org/wiki/Downloads]
[http://www.ubuntu.com/download/desktop]
 - Go through full VirtualBox installation on Mac or Windows, accepting all settings, including networking (with temporary interruption of Internet connectivity during installation)
 - Create New VirtualBox VM, with at least 512 MB memory, and dynamically allocated 8GB disk space, all other options at default
 - Once created, Start the VM, and select the downloaded ISO Ubuntu disk image for starting installation
 - Erase disk (this refers to your VirtualBox hardisk that you just created) and install Ubuntu
 - Accept most settings, create a user name and password, download updates during installation
 - Upon restart, you may need to select Reset in the VirtualBox window (Under File -> Reset) once the Ubuntu screen reaches “Stopping early crypto disks… [OK]”
 - Once it’s restarted, find the Software Updater icon on the Launcher bar, and click to be prompted for Restart (this is installing the updates downloaded earlier.)

 - Install VirtualBox Guest Additions
     Under the VirtualBox window options, go to "Devices -> Insert Guest Additions CD image”
     Enter your user password to continue

Ubuntu Linux
 - popular desktop Linux OS (or server version)
 - Install a 32-bit desktop version if your computer has less than 4GB physical memory
 - Optionally install a lightweight or other desktop environment (default is Unity): [http://askubuntu.com/questions/65083/what-kinds-of-desktop-environments-and-shells-are-available]


Oracle VirtualBox
 - VM manager 

Terminal
 - command line interface
     Go to Applications on the Launcher, and search “terminal”
     Open Terminal, then right-click on the Terminal icon in Launcher and select “Lock to Launcher"
```
     $ sudo apt-get update
     $ sudo apt-get upgrade
```

Linux Directory Tree
 - directories not folders
```
     $ ls -al
         -a for showing hidden files (important when working with git)
         -l for showing detailed information (especially user and group permissions)
     $ cd
     $ cat
```

GitHub
 - code repository
 - Set up GitHub account prior to training

git
 - version control
```
      $ sudo apt-get install git
```

vim, nano
 - text editors
```
     $ sudo apt-get install vim
```

Install AMP
[https://help.ubuntu.com/community/ApacheMySQLPHP]
```
     $ sudo apt-get install lamp-server^
```     
     for why you need to use the caret (^): [http://tech.shantanugoel.com/2010/10/23/apt-get-caret.html]
     "root" for mysql root user's password

Apache
 - web server
 - http://127.0.0.1 or http://localhost >> It works!
 - apache config in /etc/apache2
 - website directory in /var/www

Apache commands
```
     $ sudo service apache2 reload
     $ sudo service apache2 start
     $ sudo service apache2 stop
     $ sudo a2dissite 000-default
     $ sudo a2ensite 000-default    
```

PHP - confirm installation
```
     $ ls /etc/apache2/mods-enabled
```
         Is "php5.conf" listed?
         If not,
```
              $ sudo a2enmod php5
              $ sudo service apache2 reload
```
     In /var/www/html,
```
         $ ls -al
```
              Are all files with root permission?
```
         $ sudo nano test.php
              <?php
                   phpinfo();
              ?>
              ^X
              Yes
```
         http://localhost/test.php

MySQL - confirm installation
```
     $ mysql -u root -p
         Enter root user's password
     > exit;
```
PHPMyAdmin
```
     $ sudo apt-get install phpmyadmin
```
          Install for apache2
         Yes, install with dbconfig-common
         Use root password
     Add phpmyadmin to apache's configuration:
```
         $ sudo nano /etc/apache2/apache2.conf
```
         At bottom of file, enter the following:
```
              # Include phpmyadmin configuration:
              Include /etc/phpmyadmin/apache.conf
         ^x
     $ sudo service apache2 restart
```
     http://localhost/phpmyadmin
         Enter MySQL root user and password to open interface
    
     Secure PHPMyAdmin web access ([https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-12-04])

MySQL Workbench
```
     $ sudo apt-get install mysql-workbench
```

Build and deploy test site
     [http://askubuntu.com/questions/46331/how-to-avoid-using-sudo-when-working-in-var-www]
     Principle of Least Privilege
         [http://en.wikipedia.org/wiki/Principle_of_least_privilege]
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
    
VirtualBox - shutdown
1. In the VM, initiate OS shutdown
2. Once completed, on the VM window, do File -> ACPI Shutdown
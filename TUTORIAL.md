# LAMP Stack Development Environment Creation
(*DevOps for A100 Apprentices*)

## LAMP stack and tools
 - Linux (Ubuntu)
 - Apache
 - MySQL (including MySQLWorkbench)
 - PHP (including PHPMyAdmin)
 - Git, Vim/Nano, Bash/Terminal

### Installation procedure of VirtualBox, Ubuntu, LAMP, Git

#### Ubuntu Linux
 - popular desktop Linux OS (or server version)
 - Install a 32-bit desktop version if your computer has less than 4GB physical memory
 - After OS installation, optionally install a lightweight or alternative desktop environment (default is Unity): http://askubuntu.com/questions/65083/what-kinds-of-desktop-environments-and-shells-are-available

#### Oracle VirtualBox
 - VM manager 
 - [VirtualBox manual](https://www.virtualbox.org/manual/)
Shutdown
1. In the VM, initiate OS shutdown
2. Once completed, on the VM window, do File -> ACPI Shutdown (if necessary)

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
 - directories, not folders
```
    $ ls -al
        -a for showing hidden files (important when working with git)
        -l for showing detailed information (especially user and group permissions)
    $ cd /directory/path/
    $ cat FILENAME
```

#### git
 - version control
```
    $ sudo apt-get install git
```

#### vim, nano
 - text editors
 - nano is already installed on Ubuntu
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
 - Web interface for admins into MySQL databases
```
    $ sudo apt-get install phpmyadmin
```
1. Install for apache2
2. Yes, install with dbconfig-common
3. Use MySQL root username and password
4. Add phpmyadmin to apache's configuration:

  ```$ sudo nano /etc/apache2/apache2.conf```
5. At bottom of file, enter the following:
```
    # Include phpmyadmin configuration:
    Include /etc/phpmyadmin/apache.conf
    ^x
    $ sudo service apache2 restart
```

Go to *http://localhost/phpmyadmin*
 - Enter MySQL root user and password to open interface
    
 **OPTIONAL** To apply secure PHPMyAdmin web access (*Use only if you are hosting on an open web server (not just 'localhost')*) (https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-12-04)

#### MySQL Workbench
 - GUI application for database design
```
    $ sudo apt-get install mysql-workbench
```

### Build and deploy test site

#### Clone project into Apache-accessible directory, and create amp-test Apache site configuration
```
    $ cd ~
    $ mkdir dev
    $ cd dev
    $ git clone https://github.com/AmundsenJunior/amp-test.git
    $ sudo ln -sT ~/dev/amp-test /var/www/amp-test
    $ cd /etc/apache2

    $ sudo cp sites-available/000-default.conf sites-available/amp-test.conf
    $ sudo nano sites-available/amp-test.conf
```

Change ```DocumentRoot /var/www/html``` to ```DocumentRoot /var/www/amp-test```
```
    ^x
    $ sudo a2dissite 000-default
    $ sudo a2ensite amp-test
    $ sudo service apache2 reload

```

Go to *http://localhost* to see if site is up

#### Create database credentials scripts
- Find the port that MySQL listens on by looking at the MySQL config file:
```
    $ cat /etc/mysql/my.cnf
```
   Or more directly, search the config file for the port listing:
```
    $ grep port /etc/mysql/my.cnf
```

 - Create ```~/dev/amp-test/cred_int.php``` and ```~/dev/amp-test/db_scripts/cred_ext.php```, as they contain passwords, and are therefore not included in the GitHub repo (via ```.gitignore```). One provides DB credentials to the front-end site scripts, currently listed as `cred_int.php` in the project root directory, and formatted as:

```
<?php
	DEFINE('DB_USERNAME', 'username');
	DEFINE('DB_PASSWORD', 'password');
	DEFINE('DB_HOST', 'hostname');
	DEFINE('DB_DATABASE', 'dbname');
?>
```

The other provides DB credentials to the `/db_scripts` directory, within that directory as `cred_ext.php` for making changes to the db itself, and similarly formatted as:

```
<?php
	DEFINE('DB_USERNAME', 'username');
	DEFINE('DB_PASSWORD', 'password');
	DEFINE('DB_HOST', 'hostname:port');
	DEFINE('DB_DATABASE', 'dbname');
?>
```

Use 'test_db' as ```dbname```, 'localhost' as ```hostname```, and provide your root ```username``` and ```password``` in this example project. In other projects you will want to create different database users with different permissions. 
In some cases, the port number will be needed for access, but not always. You can confirm these credentials by connecting to the database via command line, trying with and without ```-P port```:
```
    $ mysql -u username -p -h hostname -P port
```
Pass ```-p``` for password without argument for security. Use ```-D dbname``` once the db is created.

#### Build test_db database
 - From the command line, first build the database itself using ```create_db.php```, then create the table within the database using ```create_table.php```:
```
    $ php create_db.php
    $ php create_table.php
```
 - Reload http://localhost/ to see whether the MySQL connection error is present on the page.



- - - - 

***NOT COMPLETELY TESTED***

http://askubuntu.com/questions/46331/how-to-avoid-using-sudo-when-working-in-var-www
 - [Principle of Least Privilege](http://en.wikipedia.org/wiki/Principle_of_least_privilege)

```
    $ sudo gpasswd -a $USER www-data
    $ sudo chgrp -R www-data /var/www
    $ sudo chmod -R g+w /var/www
```

Test www-data user access
```
    $ touch /var/www/test.txt
    $ rm /var/www/test.txt
```

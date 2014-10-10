This project is an *AMP stack-based site, and POC for basic PHP-MySQL form functionality.

[TUTORIAL.md](TUTORIAL.md) provides the step-by-step procedure for setting this project up as a full LAMP stack-based site.

Use the `db_scripts/` files to create the MySQL database and tables within, along with altering table structure.

### Vagrant Deployment with ```Vagrantfile``` and ```bootstrap.sh```
Set up your development environment with VirtualBox and Vagrant using the procedure outlined in [DEPLOY.md](DEPLOY.md).

Before deploying with ```$ vagrant up```, be sure to change the Variables in [bootstrap.sh](bootstrap.sh), to taste.
 
### .gitignore
***(This includes the two cred_*.php files used.)***
 
One provides DB credentials to the site, currently listed as `cred_int.php` in the project root directory, formatted as:

```
<?php
	DEFINE('DB_USERNAME', 'username');
	DEFINE('DB_PASSWORD', 'password');
	DEFINE('DSN', 'mysql:host=*hostname*;dbname=*dbname*');
?>
```

The other provides DB credentials to the `/db_scripts` directory, within that directory as `cred_ext.php` for making changes to the db itself, similarly formatted as:

```
<?php
	DEFINE('DB_USERNAME', 'username');
	DEFINE('DB_USERNAME', 'password');
	DEFINE('DSN', 'mysql:host=*hostname*;dbname=*dbname*');
?>
```
 

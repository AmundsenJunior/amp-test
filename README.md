This project is an *AMP stack-based site, and POC for basic PHP-MySQL form functionality.

Use the `db_scripts/` files to create the MySQL database and tables within, along with altering table structure. (The `alter_table.php` file has been used twice already to add new columns to the Apprentices table.)


### .gitignore
#### (This includes the two cred_*.php files used.)
 
One provides DB credentials to the site, currently listed as `cred_int.php` in the project root directory, formatted as:

```
<?php
	DEFINE('DB_USERNAME', 'username');
	DEFINE('DB_PASSWORD', 'password');
	DEFINE('DB_HOST', 'hostname');
	DEFINE('DB_DATABASE', 'dbname');
?>
```

The other provides DB credentials to the `/db_scripts` directory, within that directory as `cred_ext.php` for making changes to the db itself, similarly formatted as:

```
<?php
	DEFINE('DB_USERNAME', 'username');
	DEFINE('DB_USERNAME', 'password');
	DEFINE('DB_HOST', 'hostname:port');
	DEFINE('DB_DATABASE', 'dbname');
?>
```
 

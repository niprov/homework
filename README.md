# Installation:

(assuming `Apache` and `MySQL` are installed and running - see below for the info about setting up XAMPP on Windows)

1. git clone or download
2. The following:

* `curl -sS https://getcomposer.org/installer | php`
* `php composer.phar install`  -> please ensure that mailer_user has some dummy data (fos_user will complain)
* `php bin/console doctrine:database:create`
* `php bin/console doctrine:schema:create`
* `php bin/console doctrine:fixtures:load`
* `php bin/console assets:install web`

# XAMPP Windows Installation

1. Add the following to the `c:\Windows\System32\drivers\etc\hosts`:
```
127.0.0.1    homework.dev
```
2. Install XAMPP (`c:\xampp` will be used below)
3. Edit `c:\xampp\apache\conf\extra\httpd-vhosts.conf`, add at the end:
```
 <VirtualHost *:80>
	DocumentRoot "C:/xampp/htdocs"
	ServerName localhost
</VirtualHost>
<VirtualHost *:80>
	ServerAdmin webmaster@webmaster.dev
	ServerName homework.dev
	ServerAlias homework.dev

	DocumentRoot "[path to your project dir]/web"
	<Directory "[path to your project dir]/web">
		Options Indexes Includes ExecCGI FollowSymLinks SymLinksifOwnerMatch
		AllowOverride All
		Order allow,deny
		Allow from all
		Require all granted
	</Directory>
</VirtualHost>
```
4. Add `c:\xampp\php` to `%PATH%`
5. Restart Apache
6. gl hf

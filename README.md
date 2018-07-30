# rho.one website

This project is used to demonstrate the basic functionalities of the
[yii2-rhoone](https://github.com/rhoone/yii2-rhoone) project and its extensions.

## System Requirements

- Apache 2.4
- PHP 7.2
- MySQL 8.0
- Composer 1.6

## Installation

### Check out the source code

The preferred way to install this project is through [Composer](https://getcomposer.org).

Please run:
```php
composer create-project rhoone/rho.one:dev-master rho.one
```

### Import the database

```shell
mysql < rho_one.sql
```

The `rho_one.sql` file can be found in the `databases` folder.
You may need to specify a username and password during the import process.

### Add site

You need to create a new link in the `/var/www` directory, pointing to the source code directory.

Then copy the `rho.one.conf` file to the `/etc/apache2/sites-available` directory, and enable it:

```shell
a2ensite rho.one.conf
```

Reload it:

```shell
service apache2 reload
```

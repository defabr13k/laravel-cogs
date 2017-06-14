Cogs for Laravel
================

> **Cogs for Laravel** is a Composer package that adds handy Artisan Console Commands for MySQL database administration.

> **WARNING**
>
> Be aware that these Artisan Console Commands are meant for use on an disposable local development environments such as a Homestead environment. They may introduce potentially serious security risks when used in a production environment!

Features
--------

Artisan Console Command | Functionality
------------------------|--------------
`cogs:db:backup`        | Dumps the database to SQL file for backup.
`cogs:db:drop`          | Drops the database.
`cogs:db:init`          | Creates a database user and the database, and executes migrations.
`cogs:db:reset`         | Drops the database and runs `cogs:db:init`.
`cogs:db:restore`       | Restores database from most recent SQL dump.
`cogs:db:user`          | Creates a database user as specified in the configuration.

Configuration
-------------

In `.env` there's already this:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

You have to add `DB_ADMIN_USERNAME`, `DB_ADMIN_PASSWORD`, and `DB_DUMP_PATH` as well, e.g.:

```
DB_ADMIN_USERNAME=homestead
DB_ADMIN_PASSWORD=secret
DB_DUMP_PATH=database/dumps
```

Installation
------------

### Install the latest release

```
$ composer require --dev defabr13k/laravel-cogs
```

### Install the latest development version

```
$ composer require --dev defabr13k/laravel-cogs @dev
```

Prior to Laravel `5.5` you also need to add the following to `app/config/app.php`:

```
<?php

…

        /*
         * Package Service Providers...
         */
        Laravel\Tinker\TinkerServiceProvider::class,
        DeFabr13k\Cogs\CogsServiceProvider::class,

…
```

Author
------

Olivier Parent is co-founder of deFABR13K and a lecturer in *Web & New Media* at [Artevelde University College Ghent](https://www.arteveldeuniverisitycollege.be).
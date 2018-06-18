Phone Book
========================
This application has been built using symfony 3.4 LST, dcotrine is used as DBAL and front end technologies include twig, css, html5, javascripting.

**Note**: I did not spend too much time on front-end, instead I focused on back-end e.g. structure of code, validation of 'canadian phone numbers' 
and unit-tests as this is meant for back-end developer. 

Deployment Instructions
--------------

**Instructions that would follow are tested on**
- Ubuntu 16.04.4 LTS
- PHP5.6 (Because PHP 5 was metioned in requiremnt of the task)
- Apache/2.4  
- Server version: 5.5.53-log MySQL Community Server (GPL)


**1. Clone the repository or extract the source**
- Clone the repository `git clone https://github.com/azhar87k/phone_book.git` OR
- Extract the code to desired location

**2. Create & load Database**
- Create the database with name 'phone_book'
- Load the database dump from the file to mysql
- You can find it in location app/Resources/sql/db.sql (https://github.com/azhar87k/phone_book/blob/master/app/Resources/sql/db.sql)

**3. Get Composer**
- Download the composer locally or globally, see https://getcomposer.org/download/

**4. Install using composer**
- Run composer install
```
composer install
```
- It will prompt for databse credential, provide database host, port ,password etc as per your settings.
- For database name you can use 'phone_book' or whatever was cerated in step 2.
- You can leae rest of the options empty
> You can always change the credentails in 'app/config/parameters.yml'

**4. Apache Setup**
- Setup the server, following is an example of minimul seeting that you need to run the app
> Adjust the following depending on your enviornment / apache2 version

```
<VirtualHost *:80>
    ServerName <servername.com>
    ServerAlias <alias if you want>

    DocumentRoot /path/to/phone_book/web
    <Directory /path/to/phone_book/web>
        AllowOverride All
        #Order Allow,Deny
        # apcahe 2.4
        Require all granted
        Allow from All
    </Directory>

</VirtualHost>
```

**5. Permissions**
- One important Symfony requirement is that the var directory must be writable both by the web server and the command line user.
- For details you can visit http://symfony.com/doc/3.4/setup/file_permissions.html and set them up as per your enviornment.

- On my system I have support for `setfacl`, so you can run the following if you have also have this

- Go inside the project root dir and run

````
 rm -rf var/cache/*
 rm -rf var/logs/*

 HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)

 sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
 sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
 ````
 
 
**5. Prepare Prod Enviornment**

````
php bin/console cache:clear --env=prod
php bin/console doctrine:schema:update --force --dump-sql
php bin/console assets:install --env=prod
php bin/console cache:warmup --env=prod
php bin/console assetic:dump --env=prod --no-debug
 ````
- After running above, you should be able to access the application by path http://yourserver.com/

**6. Prepare Dev Enviornment**

````
php bin/console cache:clear --env=dev
php bin/console doctrine:schema:update --force --dump-sql
php bin/console assets:install --env=dev
php bin/console cache:warmup --env=dev
php bin/console assetic:dump --env=dev --no-debug
 ````
- After running above, you should be able to access the application in dev mode by path http://yourserver.com/app_dev.php/

**7. Functional Tests**

- You can run tests by following command
````
php ./vendor/bin/simple-phpunit tests/AppBundle/
````

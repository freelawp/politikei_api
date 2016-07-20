# Php Sandbox Configuration

## Installation

```
git clone https://github.com/CodeForCuritiba/politikei_api.git
cd politikei_api
composer install
```

## Database

```
php artisan migrate
```

## Environment

### Environment Variable

Define the environment name in an environment variable.
For example you can add the following line to the `public/.htaccess`:

```
SetEnv ENVIRONMENT development
```

In that case, you may want to configure git so the `.htaccess` file doesn't appear in the modified files to commit:

```
$ git update-index --assume-unchanged public/.htaccess 
```

### Environment Configuration

Define the environment name in an environment variable
Copy the .env.example to a file named .env and then edit the .env file

```
cp .env.example .env
```

### Apache alias example

```
Alias /politikei_api/ "c:/users/murilo/projetos/politikei_api/public/" 

<Directory "c:/users/murilo/projetos/politikei_api/public/">
  Options Indexes FollowSymLinks MultiViews
  AllowOverride all
  Require all granted
  SetEnv Environment development
</Directory>
```

### public/.htaccess example

```
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>

    RewriteEngine On
    RewriteBase /politikei_api

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)/$ /politikei_api/$1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```
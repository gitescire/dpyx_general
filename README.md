# dPyx

## Installation & requirements
1. You must install the next:  
[laravel](https://laravel.com/docs/8.x/installation)
[nodejs](https://nodejs.org/es/)

2. You should clone the repository:
https://git-codecommit.us-east-1.amazonaws.com/v1/repos/dpyx-concytec-laravel

3. You must go to the path where you installed your project and install dependencies:
`composer install`

4. Copy the .env.example file in .env:
`copy .env.example .env`

5. you must generate a new key:
`php artisan key:generate`

6. Edit your .env file to setup the database, the email, and the app variables.

7. You should have created a file in lang/es/<APP_NAME> and another file in lang/es.<APP_NAME>.json that will show a customized message depending the APP NAME.

### Permissions in linux file

1. Assign the project ownership to the web server user:
`sudo chown -R www-data:www-data /path/to/your/laravel/root/directory`

2. Assign our user to the web server user group:
`sudo usermod -a -G www-data elusuario`

3. Update the necessary permissions to files and directories
`sudo find /path/to/your/laravel/root/directory -type f -exec chmod 644 {} \;`  
`sudo find /path/to/your/laravel/root/directory -type d -exec chmod 755 {} \;`

## Set to production

1. When the steps shown before were executed, you need to run the migrations to create the database and tables:

`php artisan migrate:fresh`

2. Then you need to set the basic information (seed) to run the app:
`php artisan db:seed`

3. You need to create a storage link to make public the folder that users will save their files:
`php artisan storage:link`
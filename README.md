# dPyx

## Goal

dPyx aims to operate as a support platform for Open Science projects.

## Initial considerations

The installation guide of this manual was carried out in an Ubuntu 20.04 LTS operating system, likewise, Apache was used as a web server.

However, the system can be installed on other operating systems and using other web servers. The system is developed with the Laravel framework, so it has the same requirements as said framework, whose documentation address is indicated below, as well as the requirements it has.

## Requirements

1. You must install the next software:  
[laravel](https://laravel.com/docs/8.x/installation),
[nodejs](https://nodejs.org/es/)
[MySQL](https://dev.mysql.com/doc/),
[git](https://git-scm.com/doc),
[Apache](https://httpd.apache.org/docs/) &
[PHP 7.3](https://www.php.net/docs.php)

2. You must install the next php extensions:
* BCMath
* Ctype
* Fileinfo
* GD
* JSON
* MBString
* OpenSSL
* Tokenizer
* XML
* ZIP

3. At least 2 GB RAM & 20 GB hard disk.

## Instalation

1. Clone the repository:

`git clone https://github.com/gitescire/dpyx_general.git`

This action can be done in any system folder, however, it is recommended to do it in /var/www

2. Update owner and permissions:

`sudo chown -R www-data:www-data <project-route>`

`sudo usermod -a -G www-data <dpyx-user>`

In this step we are assigning the user dpyx permissions to be able to make modifications to the project in which www-data will be responsible.

3. Install dependencies:

`composer install`

4. Language configuration:

`mv <project-path>/resources/lang/es.json.example <project-path>/resources/lang/es.json`

In this step we are configuring some character strings that can be translated.

5. Configure environment variables:

`copy .env.example .env`

The environment variables allow to centralize important configurations that dPyx will occupy for its correct operation, this file is located in <path/of/project>/.env, however, when installing the project, this file may not exist, so it is necessary to copy the .env.example file, once it has been copied, we show the most important variables that must be configured and a brief description of them:

|APP_URL|URL donde será visitado el sistema.|
|:----|:----|
|DB_CONNECTION|Database engine used, in this case "mysql"|
|DB_HOST|Server where the database is hosted, if it is installed on the same server as the project, then the value will be "127.0.0.1"|
|DB_PORT|Database access port, by convention is “3306” for MySQL|
|DB_DATABASE|Name of the previously created database.|
|DB_USERNAME|User with permissions to access the database.|
|DB_PASSWORD|Password to access the database.|
|MAIL_MAILER|Protocol used for the exchange of emails, by default "smtp"|
|MAIL_HOST|Host used for sending emails, by default "smtp.gmail.com"|
|MAIL_PORT|Port for access to the mail server.|
|MAIL_USERNAME|dPyx email account|
|MAIL_PASSWORD|Password of the email account used previously.|
|MAIL_ENCRYPTION|Protocol for encryption and decryption of data.|
|IS_EVALUABLE|Sets whether the dPyx system will be evaluable or not.|
|ANSWERS_ARE_NESSSARY|Sets whether the dPyx system will force the user to answer all questions before submitting the assessment.|
|HAS_SUPPLEMENTARY_QUESTIONS|Sets whether the dPyx system will allow you to create questions that are not required.|

6. Configure the images:

`cp <project-path>/public/images/default.example <project-path/public/images/default>`

This step will copy the default images needed for the system.

5. you must generate a new key:
`php artisan key:generate`

7. Generate migrations and seeder:

`php artisan migrate && db:seed`

After having created the database, the tables must be loaded, as well as the basic information necessary for the operation of the platform.

8. Generate random key

`php artisan key:generate`

this command will generate a random key inside of the APP_KEY to prevent attacks from external sources.

9. Create storage link
`php artisan storage:link`

This command will generate a symbolic link to create a reference to the folder which stores files.

10. Change ini variables
:
`upload_max_filesize = 20M`
`post_max_size = 20M`

These changes will prevent an error according to the file size upload in the platform. If you consider that the fileze size could be greater than this, feel free to increment it.

11. Finishing up:

Now, what you need to do is to set up your apache to make your project available over internet. These steps are not described in this document because it depends on your server configuration, the other projects configuration, if you have or not a domain, if you have SSL certificate or not, etc. But do not worry, we share this link with you if you are not familiar with deployment:

https://help.clouding.io/hc/en-us/articles/4406607535634-How-to-Deploy-Laravel-8-with-Apache-and-Let-s-Encrypt-SSL-on-Ubuntu-20-04
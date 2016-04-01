# Laravel 5  + Admin LTE

####  Laravel 5 starter app + AminLTE integration 

## Installation

### Pre-requisities

#### Server Requirements

Laravel 5 system requirementes:

-  PHP >= 5.4
-  Mcrypt PHP Extension
-  OpenSSL PHP Extension
-  Mbstring PHP Extension

As of PHP 5.5, some OS distributions may require you to manually install the PHP JSON extension.. When using Ubuntu, this can be done via `apt-get install php5-json`.

#### Install NodeJS, Bower and Composer

Laravel utilizes [Composer](http://getcomposer.org) to manage its dependencies.

You will also need to install [NodeJS](https://nodejs.org) and then run:

	sudo npm install -g bower
	
to install [Bower](http://bower.io).

### Installation

#### Install the project and the required libraries

* Clone the project.
* `cd private`
* `npm install`
* `bower install`
* `composer install`

Read the installation instructions at Laravel's website on the [Configuration](http://laravel.com/docs/5.0#configuration) chapter for more information about the next steps.

#### Environment configuration

Duplicate the file `.env.example` at `/private` and name it `.env`. Set the correct values for your environment.

> These values can also be set via system environment variables (ex: via SetEnv on Apache configuration files).

#### Test the installation

Finally load the application on your web browser by specifying the base URL for it.

> ex: http://localhost/~your_username/laravel5-aminLTE, if you're developing on a Mac.

You should see a very simple page with a big title on the center. That is a placeholder page that you can later replace by your application/website's home page.

To enter the application, click the "Log In" button.

## FAQ

##### Why is the folder structure a little different from the standard Laravel 5 structure?

This slightly modified folder structure is more suitable for deployment on a standard linux box, as it doesn't pollute the application user's home folder with lots of files and folders, and the public folder also matches the typical `public_html` folder found on a user's home directory when publishing sites using Apache.

---

License: **MIT**

Created by [Impactwave, Lda](http://impactwave.com)

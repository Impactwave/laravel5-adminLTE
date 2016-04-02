# Laravel 5 + Admin LTE
Laravel 5 starter app + AdminLTE integration 

### What's this?

This is a functioning application protoype based on the Laravel 5 framework.
You can use it to bootstrap and accelerate your development process.

### Features

* An easy and rapid way of creating fully functional forms, with:

    * Server-side validation
    * Automated feedback for validation errors
        * highlighting invalid fields
        * displaying an explanation message next to each invalid field
    * Automatic form data population, either from the view model or from the previously submitted data

* DataTables.net integration, with:

    * Fully functioning data grid
    * Responsive (mobile friendly)
    * Custom styling
    * Page size selector
    * Search
    * Paginator (with auto-hiding when unneeded)
    * Sort by colum
    * Localization support
    * Blade directive for easy creation of fully configured data grids from simple tables

* Fully functioning user authentication system, with:

    * Login / Logout
    * New user registration
    * Password reset via email
    * Account activation by email, or manually by a moderator

* Transactional email templates (compatible with most email and webmail clients)

* Localization support, with:

    * Language selection (both on login and inside the application)
    * Fully translated app. interface
    * Extended localization API, with:
	    * Automated language activation middleware
	    * Two language selection modes: via session or via URL
	    * Easy configuration of available languages
	    * Automatic language detection

* User management

    * View current users
    * Edit a user or create a new one

* [Toastr](https://github.com/CodeSeven/toastr) integration for flash messages

* Enhanced development features, such as:

    * Bower and Composer integration
    * Improved compatibility with local development on Mac OSX, with support for `http://localhost/~user/site` URLs
    * Tweaked folder organization, better suited for deployment on Linux web servers with Apache
    * IDE-Helper tool, which generates files to improve your IDE's code analysis and auto-completion

#### AdminLTE integration

An integration of the popular open source AdminLTE Bootstrap-based application template with the Laravel framework, featuring:

* Blade templates, with hierarchical view composition (aka Master Pages)
* View Composers
* A small set of reusable and configurable components

#### Razorblade integration

An integration with the [Razorblade](https://github.com/Impactwave/razorblade) extension to the Blade templating engine.

##### Features

With Razorblade, you can:

* Write cleaner templates
* Reuse lightweight components
* Semi-automate form generation and validation
* Use new directives for implementing common UI patterns
* Easily write your own custom directives

> Please visit the [project's website]((https://github.com/Impactwave/razorblade)) to learn about all the features it provides and how to use them.

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

To enhance your IDE's code analysis and auto-completion, run the provided IDE-Helper tool:

	php artisan ide-helper:generate

#### Environment configuration

Duplicate the file `.env.example` at `/private` and name it `.env`. Set the correct values for your environment.

> These values can also be set via system environment variables (ex: via SetEnv on Apache configuration files).

#### Database configuration

You can configure the database driver on `private/config/database.php`.
The database access credentials may be configured on the `.env` file, or trough environmental variables.

The project comes pre-configured for a SQLite database, which requires no configuration.  
To use t, you'll need to create a blank SQLite database.

On the `private` directory, type:

	touch storage/database.sqlite

> **Note:** the SQLite database is excluded from the Git repo, so it will not be included on your commits.

#### Database initialization

To crete the database tables required by the application, just run the provided migrations.

On the `private` directory, type:

	php artisan migrate

#### Additional configuration

Altough, at this point, the application should be fully functional, you may need to perform additional configuration, if you have special requirements.

In that case, read the installation instructions at Laravel's website on the [Configuration](http://laravel.com/docs/5.0#configuration) chapter for more information about the next steps.

#### Test the installation

Finally, load the application on your web browser by specifying the base URL for it.

> ex: http://localhost/~your_username/laravel5-aminLTE, if you're developing on a Mac.

You should see a very simple page with a big title on the center. That is a placeholder page that you can later replace by your application/website's public home page.

To enter the application, click the "Log In" button.

## FAQ

##### Why is the folder structure a little different from the standard Laravel 5 structure?

This slightly modified folder structure is more suitable for deployment on a standard Linux box, as:

* it doesn't pollute the application user's home directory with lots of files and folders,
* the public folder also matches the typical `public_html` folder found on a user's home directory when publishing sites with the Apache web server.

---

License: **MIT**

Created by [Cláudio Silva](https://github.com/claudio-silva), at [Impactwave, Lda](https://github.com/impactwave)

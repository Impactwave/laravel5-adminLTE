# Selene Framework
*This is not your grandma's classic PHP framework!* ;-)

Selene is a web framework geared thoward the rapid development of websites and administration backends using the PHP language, providing a clean, pragmatic design, and making use of modern technologies and *forward thinking* development methodologies and patterns.

### What's new?

This new version of the Selene PHP framework is a complete rewrite of the original from the ground up, taking advantage of new technologies that have become mainstream during the years that have elapsed since the original framework was developed.

Selene is now built on top of the very popular **Laravel** framework, but it takes it much further into the realm of advanced, "reactive" web applications.

Under the hood, it uses the [Hyperblade](../hyperblade) templating engine to provide a component-based UI architecture and uses **Facebook's React** VDOM engine to provide lightening fast responses to user interactions.

With Selene, you can develop backend applications that behave like frontend applications, but writing almost no frontend (javascript) code.

## Installation

#### Server Requirements

The Selene framework has a few system requirements (the same as Laravel 5):

-  PHP >= 5.4
-  Mcrypt PHP Extension
-  OpenSSL PHP Extension
-  Mbstring PHP Extension

As of PHP 5.5, some OS distributions may require you to manually install the PHP JSON extension.. When using Ubuntu, this can be done via `apt-get install php5-json`.

#### Install Composer

Selene utilizes [Composer](http://getcomposer.org) to manage its dependencies. So, before using Selene, you will need to make sure you have Composer installed on your machine.

#### Install Selene

Issue the Composer create-project command in your terminal:

```shell
composer create-project impactwave/selene2 --prefer-dist
```

Read the installation instructions at Laravel's website on the [Configuration](http://laravel.com/docs/5.0#configuration) chapter for the next steps.

#### Environment configuration

Duplicate the file `/.env.example` and name it `.env`. Set the correct values for your environment.

> These values can also be set via system environment variables (ex: via SetEnv on Apache configuration files).

#### Test the installation

Finally load the application on your web browser by specifying the base URL for it.

> ex: http://localhost/~your_username/selene2, if you're developing on a Mac.

You should see a very simple page with a big *Selene 2* title. That is a placeholder page that you can later replace by your website's home page.

To access the administration backend, click the "Administration" link, or open the `/admin` URL.

## FAQ

#### Why is the folder structure a little different from the standard Laravel 5 structure?

This slightly modified folder structure is more suitable for deployment on a standard linux box, as it doesn't pollute the application user's home folder with lots of files and folders, and the public folder also matches the typical `public_html` folder found on a user's home directory when publishing sites using Apache.

## License

Both the Selene Framework and the Laravel framework are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

Selene Framework - Copyright &copy; Impactwave, Lda.

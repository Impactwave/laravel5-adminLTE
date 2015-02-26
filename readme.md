# Selene Framework

Selene is a PHP framework, built on top of the popular Laravel framework, that extends it to provide faster and easier development of advanced, "reactive" web applications.

### Why is the folder structure a little different from the standard Laravel 5 structure?

This slightly modified folder structure is more suitable for deployment on a standard linux box, as it doesn't pollute the application user's home folder with lots of files and folders, and the public folder also matches the typical `public_html` folder of an Apache-served website.

### Environment configuration

Duplicate the file `/.env.example` and name it `.env`. Set the correct values for your environment.

> These values can also be set via system environment variables (ex: via SetEnv on Apache configuration files).

### License

Both the Selene Framework and the Laravel framework are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

Selene Framework - Copyright &copy; Impactwave, Lda.

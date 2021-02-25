Tic Tac Toe game
========================

Application is created using Symfony framework.

In order to win the game, a player must place three of their marks in a horizontal, vertical, or diagonal row.

Requirements
------------

  * PHP 7.3 or higher;
  * [usual Symfony application requirements][1].

Installation
------------

Clone repository;

```bash
$ git clone https://github.com/arvyjaar/TicTacToeSymfony5.git
```

Install dependencies: 

```bash
$ composer install
```
[Download Symfony][3] to install the `symfony` binary on your computer

Usage
-----

If you have [installed Symfony][3] binary, run this command:

```bash
$ cd my_project/
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server][2] like Nginx or
Apache to run the application.

Tests
-----

Execute this command to run tests:

```bash
$ cd my_project/
$ bin/phpunit
```

[1]: https://symfony.com/doc/current/reference/requirements.html
[2]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
[3]: https://symfony.com/download
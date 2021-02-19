# Laravel (quick) init

Quickly initialize a Laravel/Lumen project using terminal.

This package:

1. Clean vendor and node_modules folder if provided
1. ⚠️ Reset your local MySQL `laravel` or `homestead` database or create it
1. Install Composer/NPM dependencies
1. Create `.env` file based on `.env.example` file and generate `APP_KEY`
1. Clear Laravel caches (route, config, cache)
1. Migrate and seed database

## Why creating this package?

I work as a web development teacher and frequently give assignments to my students. I teach them how to use Laravel, and then, they have to create many different Laravel projects for educational purpose.

That's why I need to quickly set up their Laravel project to be able to test and mark their projects.

## Requirements

### Composer

Make sure [Composer](https://getcomposer.org/download/) is installed globally.

## Install

```bash
$ composer global require cba85/laravel-init
```

Then make sure you have the global Composer binaries directory in your PATH.

This directory is platform-dependent, see [Composer documentation](https://getcomposer.org/doc/03-cli.md#composer-home) for details.

### Update

```bash
$ composer global update cba85/laravel-init
```

## Usage

Go inside a Laravel project folder.

```bash
$ laravel-init
```

## Options

### --lumen

Initialize a Lumen project.

```bash
$ laravel-init --lumen
```

### --npm

Initialize a laravel project using npm.

```bash
$ laravel-init --npm
```

## Dependencies

- [Symfony console](https://symfony.com/doc/current/components/console.html)

## Tests

No test yet.

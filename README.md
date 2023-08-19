# Writty

[![Build status](https://github.com/paparrot/writty/actions/workflows/laravel.yml/badge.svg)](https://github.com/paparrot/writty/actions/workflows/laravel.yml)

This is demo website for showing my competence in web development.
It is a light "microblogging" platform where users can post short messages and
comment on them. It is written in PHP using the Laravel framework.

**[Website link](https://writty.paparrot.me)**

## Prerequisites
- PHP ^8.1
- Composer ^2.1
- Npm ^7.20

## Installation

- Clone the repository
- Open project folder `cd writty`
- Copy .env.example to .env
- Create database file `touch database/database.sqlite`
- Run `composer install`
- Run `npm install`
- Run `php artisan key:generate`
- Run `php artisan migrate`

## Running

Default:
1) Run `php artisan serve`
2) Open http://localhost:8000 in your browser

[Valet (macOS only):](https://laravel.com/docs/10.x/valet)
1) Run `valet link writty`
2) Open http://writty.test in your browser

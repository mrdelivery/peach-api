# Peach Payments - API Client

NOTE: This app is still heavily under development.

## Getting started

### Introduction

This API currently only supports the "Peach Payments XML Query API". More to be added...

The API was designed to implement the Command Design Pattern. Since this package only supports the "Query" api,
there is only 1 command implemented - the QueryCommad. It requires a Request instance as it's only argument.

WARNING:
This package will be a pain to use without a Dependency Injection Container.
See [mnel/peach-extentions-laravel](https://github.com/m-nel/peach-extensions-laravel): if you are using Laravel.

### Installation

The suggested installation method is via [composer](https://getcomposer.org/):

```sh
php composer.phar require "mnel/peach:dev-master"
```

### Basic usage

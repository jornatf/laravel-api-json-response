# Changelog

All notable changes to will be documented in this file.

## v1.1.0 - 2023-04-23

- improvements and new features
- updated README

Use a `find()` method to get a model and return a JSON Response in a single line like this:

```php
// Finds and returns User with id 1
return ApiResponse::find(User::class, 1)->json();

```
> See [README](README.md) for more details.

## v1.0.0 - 2023-04-22

Laravel API Json Response is a Laravel Package that returns a JSON Response for APIs. In some methods, you can return cool Json response for your API.

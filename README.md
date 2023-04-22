# Laravel API Json Response

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jornatf/laravel-api-json-response.svg?style=flat-square)](https://packagist.org/packages/jornatf/laravel-api-json-response)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jornatf/laravel-api-json-response/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jornatf/laravel-api-json-response/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jornatf/laravel-api-json-response/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/jornatf/laravel-api-json-response/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jornatf/laravel-api-json-response.svg?style=flat-square)](https://packagist.org/packages/jornatf/laravel-api-json-response)

A Laravel Package that returns a JSON Response for APIs. In some methods, you can return cool Json response for your API.

## Installation

You can install the package via composer:

```bash
composer require jornatf/laravel-api-json-response
```

## Usage

### Example with `PostController`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function show(int $post_id)
    {
        $post = Post::find($post_id);

        if (! $post) {
            return ApiResponse::response(404)->json();
        }

        return ApiResponse::response(200)
            ->addDatas($post)
            ->json();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            // Status code 400 for "Bad Request"
            return ApiResponse::response(400)
                ->addDetails($validator->errors())
                ->json();
        }

        $post = Post::create($validator->validated());

        // Status code 200 for "Ok" or 201 for "Created"
        return ApiResponse::response(201)
            ->addDatas($post)
            ->json();
    }
}
```

### Success response example:

```json
{
    "success": {
        "status": 201,
        "message": "Created",
        "data": {
            "id": 1,
            "title": "Morbi in diam id dolor vehicula finibus",
            "content": "<p>Lorem ipsum dolor sit amet, ...</p>",
            "created_at": "2023-04-20 00:00:00",
            "updated_at": "2023-04-20 00:00:00"
        }
    }
}
```

### Error response example:

```json
{
    "error": {
        "status": 404,
        "message": "Not Found"
    }
}
```

### Available methods:

```php
<?php

// First, you can instantiate response with a status code (required):
$response = ApiResponse::response(int $statusCode);

// To add custom message:
$response->addMessage(string $message);

// To add datas to return when success:
$response->addDatas(array $datas);

// To add details (e.g. validator errors) when error:
$response->addDetails(mixed $details);
// or
$response->addDetails(array $details);
$response->addDetails(array $details);

// Last, formate response into json (required):
$response->json()
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Feel free to contribute to this project to improve with new features or fix bugs 👍

## Credits

-   [Jordan](https://github.com/jornatf)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

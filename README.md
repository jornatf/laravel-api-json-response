# Laravel API Json Response

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jornatf/laravel-api-json-response.svg?style=flat-square)](https://packagist.org/packages/jornatf/laravel-api-json-response)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jornatf/laravel-api-json-response/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jornatf/laravel-api-json-response/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jornatf/laravel-api-json-response/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/jornatf/laravel-api-json-response/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jornatf/laravel-api-json-response.svg?style=flat-square)](https://packagist.org/packages/jornatf/laravel-api-json-response)

A Laravel Package that returns a JSON Response for APIs. In some methods, you can return cool Json response for your API.

> #### If you like this package you can [Buy me a Coffee](https://www.buymeacoffee.com/jornatf) ☕️

## Installation

### Via composer:

```bash
composer require jornatf/laravel-api-json-response
```

## Usage

### Example 1:

> This example shows you how to use the basic required methods.

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
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

**Success response:**

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

**Error response:**

```json
{
    "error": {
        "status": 404,
        "message": "Not Found"
    }
}
```

### Exemple 2:

> This example shows you how to use a method to find a model and return a JSON Reponse in a single line of code.

```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
	public function show(int $post_id)
	{
		return ApiResponse::find(Post::class, $post_id)->json();
	}
}
```

**If model found:**

```json
{
    "success": {
        "status": 200,
        "message": "Post Found",
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

**Else:**

```json
{
    "error": {
        "status": 404,
        "message": "Post Not Found"
    }
}
```

## Documentation

### Available methods:

```php
<?php

// First, you can instantiate response with a status code (required):
$response = ApiResponse::response(int $statusCode);
// or directly find a model by id:
$response = ApiResponse::find(Model::class, int $id);

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

### Available status code:

| Status code | Response type | Default message              |
| ----------- | ------------- | ---------------------------- |
| `200`       | `success`     | Ok<br>Model Found            |
| `201`       | `success`     | Created                      |
| `202`       | `success`     | Accepted                     |
| `400`       | `error`       | Bad Request                  |
| `401`       | `error`       | Unauthorized                 |
| `403`       | `error`       | Forbidden                    |
| `404`       | `error`       | Not Found<br>Model Not Found |
| `405`       | `error`       | Method Not Allowed           |
| `408`       | `error`       | Request Timeout              |
| `429`       | `error`       | Too Many Requests            |
| `500`       | `error`       | Internal Server Error        |
| `502`       | `error`       | Bad Gateway                  |
| `503`       | `error`       | Service Unavailable          |

## Testing

```bash
composer test
```

## Changelog

> Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

> Feel free to contribute to this project to improve with new features or fix bugs 👍

## Credits

-   [Jordan](https://github.com/jornatf)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT).

> Please see [License File](LICENSE.md) for more information.

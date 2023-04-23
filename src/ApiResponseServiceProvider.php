<?php

namespace Jornatf\LaravelApiJsonResponse;

use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('ApiResponse', function ($app) {
            return new ApiResponse();
        });
    }
}

<?php

use Jornatf\LaravelApiJsonResponse\ApiResponse;

/*
it('can test', function () {
    expect(true)->toBeTrue();
});
*/

it('returns json', function () {
    $response = (new ApiResponse)->response(200)
        ->json();
    
    expect($response->getContent())->toBeJson();
});

it('returns success json response (customized)', function () {
    $response = (new ApiResponse)->response(200)
        ->addMessage('Datas successfully retrieved')
        ->addDatas(['foo' => 'bar'])
        ->json();

    expect($response->getContent())->toBeJson();
});

it('returns error json response (customized)', function () {
    $response = (new ApiResponse)->response(404)
        ->addMessage('No data found for this request')
        ->addDetails(['id' => 9999])
        ->json();

    expect($response->getContent())->toBeJson();
});

it('throws exception: status code is not valid', function () {
    (new ApiResponse)->response(100)->json();
})->throws(Exception::class);

it('throws exception: status code is not an integer', function () {
    (new ApiResponse)->response('string')->json();
})->throws(Exception::class);

it('throws exception: datas is not an array', function () {
    (new ApiResponse)->response(200)->addDatas('not an array')->json();
})->throws(Exception::class);

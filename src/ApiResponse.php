<?php

namespace Jornatf\LaravelApiJsonResponse;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Jornatf\LaravelApiJsonResponse\Traits\HasJsonResponse;

class ApiResponse
{
    use HasJsonResponse;

    private int $status;

    private string $message;

    private array $datas = [];

    private mixed $details = [];

    private array $validStatus = [
        200 => 'Ok',
        201 => 'Created',
        202 => 'Accepted',
        400 => 'BadRequest',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'NotFound',
        405 => 'MethodNotAllowed',
        408 => 'RequestTimeout',
        429 => 'TooManyRequests',
        500 => 'InternalServerError',
        502 => 'BadGateway',
        503 => 'ServiceUnavailable',
    ];

    private int $id;

    /**
     * Json response instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Method to instance class.
     *
     * @param  int  $status
     * @return ApiResponse
     */
    public function response($status)
    {
        if (! is_int($status) || ! isset($this->validStatus[$status])) {
            throw new Exception('Status code is not valid.');
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Method to add custom message.
     *
     * @param  string  $message
     * @return ApiResponse
     */
    public function addMessage($message)
    {
        if (! is_string($message)) {
            throw new Exception('addMessage(): must contain an array.');
        }

        $this->message = $message;

        return $this;
    }

    /**
     * Method to add datas.
     *
     * @param  array  $datas
     * @return ApiResponse
     */
    public function addDatas($datas)
    {
        if (! is_array($datas)) {
            throw new Exception('addDatas(): must contain an array.');
        }

        $this->datas = $datas;

        return $this;
    }

    /**
     * Method to find a model data.
     *
     * @param  string  $model
     * @param  int  $id
     * @return ApiResponse
     */
    public function find($model, $id)
    {
        $found = $model::find($id);

        $modelName = $this->getModelName($model);

        if (! $found) {
            $this->status = 404;
            $this->addMessage("{$modelName} Not Found");
        } else {
            $this->status = 200;
            $this->addDatas($found->toArray());
            $this->addMessage("{$modelName} Found");
        }

        return $this;
    }

    /**
     * Method to add details.
     *
     * @param  mixed  $details
     * @return ApiResponse
     */
    public function addDetails($details)
    {
        if (! in_array(gettype($details), ['array', 'string'])) {
            throw new Exception('addDetails(): must contain array or a string.');
        }

        if (is_array($this->details)) {
            $this->details[] = $details;
        } else {
            $this->details = $details;
        }

        return $this;
    }

    /**
     * Method to return JSON response.
     *
     * @return ApiResponse
     */
    public function json()
    {
        $method = $this->getMethod();

        $message = $this->message ?? $this->getStatusText();

        return ($this->status < 400)
            ? $this->$method($message, $this->datas)
            : $this->$method($message, $this->details);
    }

    /**
     * Method to get default status text.
     *
     * @return string
     */
    protected function getStatusText()
    {
        return Str::title(Str::snake($this->validStatus[$this->status], ' '));
    }

    /**
     * Returns response method.
     * 
     * @return string
     */
    protected function getMethod()
    {
        return 'response'.$this->validStatus[$this->status];
    }

    /**
     * Returns class name without namespace.
     * 
     * @param  string  $model
     * @return string
     */
    protected function getModelName($model)
    {
        $model = explode('\\', $model);

        return end($model);
    }
}

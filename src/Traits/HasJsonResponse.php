<?php

namespace Jornatf\LaravelApiJsonResponse\Traits;

trait HasJsonResponse
{
    /**
     * Success json response structure.
     *
     * @return \Illuminate\Http\Response
     */
    protected function successResponse(int $status, string $message, array $datas = [])
    {
        $response = [
            'success' => [
                'status' => $status,
                'message' => $message,
                'data' => $datas,
            ],
        ];

        return response()->json($response, $status);
    }

    /**
     * Error json response structure.
     *
     * @return \Illuminate\Http\Response
     */
    protected function errorResponse(int $status, string $message, array $details = [])
    {
        $response = [
            'error' => [
                'status' => $status,
                'message' => $message,
            ],
        ];

        foreach ($details as $detail) {
            $response['error']['details'][] = $detail;
        }

        return response()->json($response, $status);
    }

    /**
     * Success 200 : OK.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseOk(string $message, array $datas = [])
    {
        return $this->successResponse(200, $message, $datas);
    }

    /**
     * Success 201 : Created.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseCreated(string $message, array $datas = [])
    {
        return $this->successResponse(201, $message, $datas);
    }

    /**
     * Success 202 : Accepted.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseAccepted(string $message, array $datas = [])
    {
        return $this->successResponse(202, $message, $datas);
    }

    /**
     * Error 400 : Bad Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseBadRequest(string $message, array $details = [])
    {
        return $this->errorResponse(400, $message, $details);
    }

    /**
     * Error 401 : Unauthorized.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseUnauthorized(string $message, array $details = [])
    {
        return $this->errorResponse(401, $message, $details);
    }

    /**
     * Error 403 : Forbidden.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseForbidden(string $message, array $details = [])
    {
        return $this->errorResponse(403, $message, $details);
    }

    /**
     * Error 404 : Not Found
     *
     * @return \Illuminate\Http\Response
     */
    public function responseNotFound(string $message, array $details = [])
    {
        return $this->errorResponse(404, $message, $details);
    }

    /**
     * Error 405 : Method Not Allowed.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseMethodNotAllowed(string $message, array $details = [])
    {
        return $this->errorResponse(405, $message, $details);
    }

    /**
     * Error 408 : Request Timeout
     *
     * @return \Illuminate\Http\Response
     */
    public function responseRequestTimeout(string $message, array $details = [])
    {
        return $this->errorResponse(408, $message, $details);
    }

    /**
     * Error 429 : Too Many Requests.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseTooManyRequests(string $message, array $details = [])
    {
        return $this->errorResponse(429, $message, $details);
    }

    /**
     * Error 500 : Internal Server Error.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseInternalServerError(string $message, array $details = [])
    {
        return $this->errorResponse(500, $message, $details);
    }

    /**
     * Error 502 : Bad Gateway.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseBadGateway(string $message, array $details = [])
    {
        return $this->errorResponse(502, $message, $details);
    }

    /**
     * Error 503 : Service Unavailable.
     *
     * @return \Illuminate\Http\Response
     */
    public function responseServiceUnavailable(string $message, array $details = [])
    {
        return $this->errorResponse(503, $message, $details);
    }
}

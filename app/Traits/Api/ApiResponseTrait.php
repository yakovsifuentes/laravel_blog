<?php

namespace App\Traits\Api;

use Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait ApiResponseTrait
{

    protected $statusCode = 200;

    protected $response = [
        'status' => [
            'code' => 500,
            'msg' => null,
        ],
        'data' => [],
    ];

    public function getStatusCode()
    {
        return $this->response['status']['code'];
    }

    public function setStatusCode($statusCode)
    {
        $this->response['status']['code'] = $statusCode;
        return $this;
    }

    public function setMessage($message)
    {
        $this->response['status']['msg'] = $message;
        return $this;
    }

    public function respondWithValidationErrors($errors)
    {
        $this->setStatusCode(SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->response['status']['msg'] = $errors;
        return $this->respond();
    }

    public function respondWithError($error, $statusCode = SymfonyResponse::HTTP_BAD_REQUEST, $data = [])
    {
        $this->setStatusCode($statusCode);
        if (!empty($data)) {
            $this->response['data'] = $data;
        }
        $this->response['status']['msg'] = $error;
        return $this->respond();
    }

    public function respondCreated($data)
    {
        $this->response['data'] = $data;
        $this->setStatusCode(SymfonyResponse::HTTP_CREATED);
        return $this->respond();
    }

    public function respondNotFound($message = null)
    {
        if ($message) {
            $this->response['status']['msg'] = $message;
        }
        return $this->setStatusCode(SymfonyResponse::HTTP_NOT_FOUND)->respond();
    }

    public function respondWithData($data = null)
    {
        $this->response['data'] = $data;
        return $this->setStatusCode(SymfonyResponse::HTTP_OK)->respond();
    }

    public function respond($headers = [])
    {
        return Response::json($this->response, $this->getStatusCode(), $headers);
    }

    public function respondWithMessage($message = null, $statusCode = SymfonyResponse::HTTP_OK)
    {
        if ($message) {
            $this->response['status']['msg'] = $message;
        }
        return $this->setStatusCode($statusCode)->respond();
    }
}
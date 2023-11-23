<?php

class ErrorResponse
{
    private DateTime $timestamp;
    private int $statusCode;
    private string $statusName;
    private string $message;

    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    public function setTimestamp(DateTime $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusName(): string
    {
        return $this->statusName;
    }

    public function setStatusName(string $statusName): void
    {
        $this->statusName = $statusName;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
    public static function error400(string $errorMsg = 'Bad Request'): ErrorResponse
    {
        return ErrorResponse::error(404, $errorMsg);
    }

    public static function error404(string $errorMsg = 'Not found'): ErrorResponse
    {
        return ErrorResponse::error(404, $errorMsg);
    }

    public static function error403(string $errorMsg = 'Forbidden'): ErrorResponse
    {
        return ErrorResponse::error(404, $errorMsg);
    }

    public static function error406(string $errorMsg = 'Forbidden'): ErrorResponse
    {
        return ErrorResponse::error(406, $errorMsg);
    }

    public static function error(int $statusCode, string $errorMsg): ErrorResponse
    {
        $er = new ErrorResponse();
        $er->timestamp = new DateTime();
        switch ($statusCode) {
            case 403:
                $er->statusCode = 403;
                $er->statusName = 'Forbidden';
                break;
            case 404:
                $er->statusCode = 404;
                $er->statusName = 'Not found';
                break;
            case 405:
                $er->statusCode = 405;
                $er->statusName = 'Method not supported';
                break;
            case 406:
                $er->statusCode = 406;
                $er->statusName = 'Not Acceptable';
                break;
            default:
                $er->statusCode = 500;
                $er->statusName = 'Server error';
                break;
        }
        $er->message = $errorMsg;
        return $er;
    }

    public function toArray(): array
    {
        return [
            'timestamp' => $this->getTimestamp()->format('Y-m-d H:i:s'),
            'statusCode' => $this->getStatusCode(),
            'statusName' => $this->getStatusName(),
            'message' => $this->getMessage()
        ];
    }
}

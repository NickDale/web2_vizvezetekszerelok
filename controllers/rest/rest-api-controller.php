<?php
require_once 'models/rest/error_response.php';
require_once 'controllers/rest/SzerelokController.php';

class RestApiController
{
    public function __construct($url)
    {
        $url = substr($url, 1);
        if ((strpos($url, '/') !== false)) {
            list($path, $pathVariable) = explode('/', $url);
        } else {
            $path = $url;
            $pathVariable = null;
        }
        switch ($path) {
            case 'szerelok/':
            case 'szerelok':
                $controller = new SzerelokController($_SERVER['REQUEST_METHOD'], $pathVariable);
                break;
            default:
                $this->error_response(404, 'Nincs ilyen implementáció');
        }
    }

    function error_response(int $statusCode, ?string $msg)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode(ErrorResponse::error($statusCode, $msg)->toArray());
    }
}

<?php
require_once 'models/rest/error_response.php';
require_once 'controllers/rest/SzerelokController.php';
require_once 'controllers/print.php';

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
            case 'print/':
            case 'print':
                $controller = new Print_Controller();
                $controller->print($this->munkalapok());
                http_response_code(200);
                echo "Pdf sikeresen legenrálva";
                break;
            case 'search/':
            case 'search':
                $munkalapok = $this->munkalapok();
                http_response_code(200);
                echo json_encode(
                    array_map(function ($munkalap) {
                        return $munkalap->toArray();
                    }, $munkalapok)
                );
                break;
            default:
                $this->error_response(404, 'Nincs ilyen implementáció');
        }
    }

    private function munkalapok()
    {
        $munkaLapModel = new Munkalap_Model;
        $requestData = $this->getDataFromRequest();

        $bef = $requestData['befejezett'] ?? null;

        return  $munkaLapModel->filter(
            $requestData['szereloId'] ?? null,
            $requestData['helyId'] ?? null,
            $bef  == 'true'  ? true : false,
        );
    }

    function error_response(int $statusCode, ?string $msg)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode(ErrorResponse::error($statusCode, $msg)->toArray());
    }

    private function getDataFromRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents('php://input'), true);
            return $data;
        }
    }
}

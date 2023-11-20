<?php
require_once __DIR__ . '/../../models/szerelo.php';
require_once 'models/szerelo_model.php';

class SzerelokController
{

    private Szerelo_Model $model;
    public function __construct($method, $szereloId)
    {
        $params = [];
        $this->model = new Szerelo_Model();
        header('Content-Type: application/json');
        switch ($method) {
            case 'GET':
                $this->getAction();
                break;
            case 'POST':
                $this->postAction();
                break;
            case 'PUT':
                $this->putAction($params, $szereloId);
                break;
            case 'DELETE':
                $this->deleteAction($szereloId);
                break;
            default:
                http_response_code(405);
                //    header('Content-Type: application/json');
                echo json_encode(
                    ErrorResponse::error(405, "Nem  támogatott metódus")->toArray()
                );
                break;
        }
    }

    /**
     * Szerelők lekérdezése
     */
    private function getAction()
    {
        $szerelok = $this->model->listAllSzerelo();

        //header('Content-Type: application/json');
        http_response_code(200);

        echo json_encode(
            array_map(function ($szerelo) {
                return $szerelo->toArray();
            }, $szerelok)
        );
    }

    /**
     * Szerelő hozzáadása
     * Név megadása kötelező, a keződőév opcionális
     */
    private function postAction()
    {
        $data = json_decode(file_get_contents("php://input"));

        if ($data !== null) {
            $kezdev = $data->kezdoev ?? null;
            if (!isset($data->nev)) {
                $this->err('Szerelő nevének megadása kötelező');
            }
            $this->model->create($data->nev, $kezdev);

            http_response_code(201);
        } else {
            $this->err();
        }
    }


    public function putAction($szereloId)
    {
        
        $data = json_decode(file_get_contents("php://input"));
        if ($data !== null) {
        }
        $szerelo = $this->model->findById($szereloId);
        if ($szerelo == null) {
            $this->err('Szerelő nem található ezzel az Id-val');
        } else {
            print_r($szerelo);
            print_r("PUT");
        }



       
        print_r("PUT");
        print_r($_GET['id'] ?? 'nincs');
    }

    /**
     * Szerelő törlése a megadott Id alapján
     * 
     * Csak logikai törlés van!
     */
    public function deleteAction($szereloId)
    {
        $szerelo = $this->model->findById($szereloId);
        if ($szerelo == null) {
            $this->err('Szerelő nem található ezzel az Id-val');
        } else {
            if (!$szerelo->isActive()) {
                http_response_code(406);
                echo json_encode(
                    ErrorResponse::error(406, 'Nem törölhető, mert már deactivált')->toArray()
                );
            } else {
                $this->model->deactivate($szereloId);
                http_response_code(204);
            }
        }
    }

    public function err($msg = 'Bad Request')
    {
        http_response_code(400);
        echo json_encode(ErrorResponse::error400($msg)->toArray());
    }
}

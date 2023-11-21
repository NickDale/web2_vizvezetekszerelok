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

    /**
     * Szerelő módosítása a megadott Id alapján
     * 
     * Lehet nem aktív szerelőt  activálni és 
     */
    public function putAction($szereloId)
    {
        $data = json_decode(file_get_contents("php://input"));
        if ($data == null) {
            $this->err();
            return;
        }

        if ($data->nev == null  || IntlChar::isblank($data->nev)) {
            $this->err('nev mező értéke nem lehet null és üres string');
            return;
        }

        $szerelo = $this->model->findById($szereloId);
        if ($szerelo == null) {
            http_response_code(404);
            echo json_encode(
                ErrorResponse::error404('Szerelő nem található ezzel az Id-val')->toArray()
            );
            return;
        }

        if($data->active == false && $szerelo->isActive()){
            http_response_code(406);
            echo json_encode(
                ErrorResponse::error406('Ezzel az API-val nem inaktiválható a szerelő')->toArray()
            );
        }

        $szerelo->setKezdesEve($data->kezdoev ?? null);
        $szerelo->setNev($data->nev);
        $szerelo->setActive($data->nev);

        $this->model->update($szerelo);
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

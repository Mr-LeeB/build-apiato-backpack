<?php
namespace App\Ship\CustomContainer\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController as AbstractWebController;
use App;
use App\Ship\CustomContainer\Actions\CreateItemAction;
use App\Ship\CustomContainer\Actions\DeleteItemAction;
use App\Ship\CustomContainer\Actions\GetAllItemAction;
use App\Ship\CustomContainer\Actions\UpdateItemAction;
use App\Ship\Transporters\DataTransporter;
use Hash;

class WebCrudController extends AbstractWebController
{

    protected $view;

    protected $model;

    /**
     * @var array{
     *     create: string,
     *     update: string,
     *     delete: string,
     *     bulkDelete: string,
     *     find: string,
     *     getAll: string
     * }
     */
    protected $action = [
    ];

    private $acceptAction = [
        'create',
        'update',
        'delete',
        'bulkDelete',
        'find',
        'getAll',
    ];

    protected $repository;

    protected $request = [];
    public function __construct()
    {
        if (empty($this->action)) {
            $this->action = $this->acceptAction;
        } else {
            foreach ($this->action as $value) {
                if (!in_array($value, $this->acceptAction)) {
                    throw new \InvalidArgumentException("Invalid action type: $value");
                }
            }
        }

        if (!empty($this->request)) {
            foreach ($this->request as $key => $value) {
                if (!in_array($key, $this->acceptAction)) {
                    throw new \InvalidArgumentException("Invalid request type: $key");
                }
            }
        }

        $this->request = $this->getRequests();
        $this->repository ?? $this->repository = '\App\Containers\\' . $this->model . '\Data\Repositories\\' . $this->model . 'Repository';
    }

    /**
     * @param $type
     * 
     * @return string
     */
    private function setRequests($type)
    {
        switch ($type) {
            case 'create':
                return ('\App\Containers\\' . $this->model . '\UI\WEB\Requests\Create' . $this->model . 'Request');
            case 'update':
                return ('\App\Containers\\' . $this->model . '\UI\WEB\Requests\Update' . $this->model . 'Request');
            case 'delete':
                return ('\App\Containers\\' . $this->model . '\UI\WEB\Requests\Delete' . $this->model . 'Request');
            case 'bulkDelete':
                return ('\App\Containers\\' . $this->model . '\UI\WEB\Requests\BulkDelete' . $this->model . 'Request');
            case 'find':
                return ('\App\Containers\\' . $this->model . '\UI\WEB\Requests\Find' . $this->model . 'Request');
            case 'getAll':
                return ('\App\Containers\\' . $this->model . '\UI\WEB\Requests\GetAll' . $this->model . 'Request');
            default:
                throw new \InvalidArgumentException("Invalid request type: $type");
        }
    }

    /**
     * @return array
     */
    protected function getRequests()
    {
        $request = [];
        foreach ($this->action as $value) {
            isset($this->request[$value]) ? $request[$value] = $this->request[$value] : $request[$value] = self::setRequests($value);
        }

        return $request;
    }

    public function getContainerAndClassName($path)
    {
        $parts         = explode('\\', $path);
        $containerName = $parts[2];
        $className     = end($parts);

        return [$containerName, $className];
    }

    public function getAllItem()
    {
        $request = resolve($this->request['getAll']);

        $items = App::make(GetAllItemAction::class)->run($this->repository, new DataTransporter($request));

        return view($this->view, compact(['items']));
    }

    public function createItem()
    {
        $request = resolve($this->request['create']);
        $columns = App::make($this->repository)->getModel()->getFillable();
        $table   = [];
        foreach ($columns as $key => $value) {
            $table[$value] = $request->$value;
        }
        isset($table['password']) ? $table['password'] = Hash::make($table['password']) : null;
        $item = App::make(CreateItemAction::class)->run($this->repository, new DataTransporter($table));

        return view($this->view, compact(['items']));
    }

    public function updateItem()
    {
        $request = resolve($this->request['update']);
        $columns = App::make($this->repository)->getModel()->getFillable();
        $table   = [];
        foreach ($columns as $key => $value) {
            $table[$value] = $request->$value;
        }
        isset($table['password']) ? $table['password'] = Hash::make($table['password']) : null;

        App::make(UpdateItemAction::class)->run($this->repository, $request->id, new DataTransporter($table));

        return redirect()->back();
    }

    public function deleteItem()
    {
        $request = resolve($this->request['delete']);

        App::make(DeleteItemAction::class)->run($this->repository, new DataTransporter($request));

        return redirect()->back();
    }
}

?>
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

    protected $view = 'customcontainer::crud.list';

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

    protected $customIndexVariables = [];

    public function __construct()
    {
        if (!$this->model) {
            return;
        }

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
        $this->repository ?? $this->repository = '\App\Containers\\' . $this->getContainerAndClassName($this->model)['containerName'] . '\Data\Repositories\\' . $this->getContainerAndClassName($this->model)['className'] . 'Repository';
    }

    /**
     * @param $type
     * 
     * @return string
     */
    private function setRequests($type)
    {
        // dd($this->getContainerAndClassName($this->model));
        switch ($type) {
            case 'create':
                return ('\App\Containers\\' . $this->getContainerAndClassName($this->model)['containerName'] . '\UI\WEB\Requests\Create' . $this->getContainerAndClassName($this->model)['className'] . 'Request');
            case 'update':
                return ('\App\Containers\\' . $this->getContainerAndClassName($this->model)['containerName'] . '\UI\WEB\Requests\Update' . $this->getContainerAndClassName($this->model)['className'] . 'Request');
            case 'delete':
                return ('\App\Containers\\' . $this->getContainerAndClassName($this->model)['containerName'] . '\UI\WEB\Requests\Delete' . $this->getContainerAndClassName($this->model)['className'] . 'Request');
            case 'bulkDelete':
                return ('\App\Containers\\' . $this->getContainerAndClassName($this->model)['containerName'] . '\UI\WEB\Requests\BulkDelete' . $this->getContainerAndClassName($this->model)['className'] . 'Request');
            case 'find':
                return ('\App\Containers\\' . $this->getContainerAndClassName($this->model)['containerName'] . '\UI\WEB\Requests\Find' . $this->getContainerAndClassName($this->model)['className'] . 'Request');
            case 'getAll':
                return ('\App\Containers\\' . $this->getContainerAndClassName($this->model)['containerName'] . '\UI\WEB\Requests\GetAll' . $this->getContainerAndClassName($this->model)['className'] . 'Request');
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

    /**
     * Retrieves the container name and class name from a given path.
     *
     * @param string $path The path from which to extract the container name and class name.
     * @return array An array containing the container name and class name.
     */
    public function getContainerAndClassName($path)
    {
        $parts = explode('\\', $path);
        if (count($parts) > 1) {
            $containerName = $parts[2];
            $className     = end($parts);

            return [
                'containerName' => $containerName,
                'className'     => $className
            ];
        }
        return [];
    }

    /**
     * Appends custom variables.
     *
     * @return array Returns an array of custom variables.
     */
    public function appendCustomVariables($actionClass)
    {
        $custom = [];
        foreach ($this->customIndexVariables as $key) {
            //Later modified into "Target Request Class"
            $customRequest = resolve($key[1]);

            $repository = '\App\Containers\\' . $this->getContainerAndClassName($key[0])['containerName'] . '\Data\Repositories\\' . $this->getContainerAndClassName($key[0])['className'] . 'Repository';
            $collection = App::make($actionClass)->run($repository, new DataTransporter($customRequest));

            $custom[$this->getContainerAndClassName($key[0])['className']] = $collection->toArray();
        }

        return $custom;
    }


    /**
     * Retrieves all items.
     *
     * @return \Illuminate\Contracts\View\View The view that displays the items.
     */
    public function getAllItem()
    {
        $request = resolve($this->request['getAll']);

        $items = App::make(GetAllItemAction::class)->run($this->repository, new DataTransporter($request));

        $customs = [];
        if (!empty($this->customIndexVariables)) {
            $customs = $this->appendCustomVariables(GetAllItemAction::class);
        }

        return view($this->view, compact(['items', 'customs']));
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
        $items = App::make(CreateItemAction::class)->run($this->repository, new DataTransporter($table));

        return view($this->view, compact(['items']));
    }

    public function updateItem()
    {
        $request = resolve($this->request['update']);
        $columns = App::make($this->repository)->getModel()->getFillable();
        $table   = [];
        foreach ($columns as $value) {
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
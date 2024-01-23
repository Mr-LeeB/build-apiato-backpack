<?php
namespace App\Ship\CustomContainer\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController as AbstractWebController;
use App;
use App\Ship\CustomContainer\Actions\CreateItemAction;
use App\Ship\CustomContainer\Actions\DeleteItemAction;
use App\Ship\CustomContainer\Actions\FindItemAction;
use App\Ship\CustomContainer\Actions\GetAllItemAction;
use App\Ship\CustomContainer\Actions\UpdateItemAction;
use App\Ship\Parents\Requests\Request;
use App\Ship\Transporters\DataTransporter;
use Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Undocumented class.
 */
class WebCrudController extends AbstractWebController
{
    private $views = [
        'list' => 'customcontainer::admin.admin_list_page',
        'create_edit' => 'customcontainer::admin.admin_create_and_edit_page',
        'show' => 'customcontainer::admin.admin_show_page'
    ];

    protected $crud;

    private $columns = [];

    private $fields = [];

    private $model;

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
    private $action = [
    ];

    private $acceptAction = [
        'create',
        'store',
        'edit',
        'update',
        'delete',
        'bulkDelete',
        'find',
        'getAll',
    ];

    private $fieldsFind = [
        'id',
    ];

    private $repository;

    private $request = [];

    protected $customIndexVariables = [];

    private $currentOperation;


    /**
     * Constructs a new instance of the class.
     *
     * @throws \InvalidArgumentException if an invalid action type is provided
     * @throws \InvalidArgumentException if an invalid request type is provided
     */
    public function __construct()
    {
        if ($this->crud || strpos(url()->current(), 'login')) {
            return;
        }

        $this->middleware(function ($request, $next) {
            if (!auth()->check()) {
                return redirect('login');
            }
            $this->crud = app()->make('crud');

            $this->setup();
            self::setupValidate();

            $this->crud->setModel($this->model);
            $this->crud->setRepository($this->repository);
            $this->crud->setTitle($this->crud->makeLabel($this->crud->getModel()->getTable()));
            $this->setupConfigurationForCurrentOperation();

            return $next($request);
        });
    }

    private function setupValidate()
    {
        $this->repository ?? $this->repository = '\App\Containers\\' . $this->getContainerAndClassName($this->model)['containerName'] . '\Data\Repositories\\' . $this->getContainerAndClassName($this->model)['className'] . 'Repository';

        //Screen $action
        if (empty($this->action)) {
            $this->action = $this->acceptAction;
        } else {
            foreach ($this->action as $value) {
                if (!in_array($value, $this->acceptAction)) {
                    throw new \InvalidArgumentException("Invalid action type: $value");
                }
            }
        }
        //Screen $request
        if (!empty($this->request)) {
            foreach ($this->request as $key => $value) {
                if (!in_array($key, $this->acceptAction)) {
                    throw new \InvalidArgumentException("Invalid request type: $key");
                }
            }
        }

        $this->request = $this->getRequests();

        //Screen $customIndexVariables
        if (!empty($this->customIndexVariables)) {
            if (is_array($this->customIndexVariables)) {
                //Traverse through all customIndexVariable entries
                foreach ($this->customIndexVariables as $key => $value) {
                    //Class not found
                    if (!class_exists($key) || !class_exists($value)) {
                        throw new \InvalidArgumentException("Class not found: $key || $value");
                    }
                    //Class is not a subclass of Model
                    if (!is_subclass_of($key, Model::class)) {
                        throw new \InvalidArgumentException("Invalid Model class: $key");
                    }
                    //Class is not a subclass of Request
                    if (!is_subclass_of($value, Request::class)) {
                        throw new \InvalidArgumentException("Invalid Request class: $value");
                    }
                }
            }
        }

        if ($this->views) {
            foreach ($this->views as $key => $value) {
                if (!in_array($key, ['list', 'create_edit', 'show'])) {
                    throw new \InvalidArgumentException("Invalid view type: $key");
                }
            }
        }
    }

    protected function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @param array $views
     */
    protected function setViews($views)
    {
        foreach ($views as $key => $value) {
            if ($value) {
                $this->views[$key] = $value;
            }
        }
    }

    protected function setAction($action)
    {
        $this->action = $action;
    }

    protected function setFieldsFind($fieldsFind)
    {
        $this->fieldsFind = $fieldsFind;
    }

    protected function setRepository($repository)
    {
        $this->repository = $repository;
    }

    public function setup()
    {

    }

    protected function setupConfigurationForCurrentOperation()
    {
        $operationName = $this->crud->getCurrentOperation();
        $setupClassName = 'setup' . Str::studly($operationName) . 'Operation';
        if (method_exists($this, $setupClassName)) {
            $this->$setupClassName();
        }
    }

    public function setupRoutes($segment, $routeName, $controller)
    {
        preg_match_all('/(?<=^|;)setup([^;]+?)Routes(;|$)/', implode(';', get_class_methods($this)), $matches);

        if (count($matches[1])) {
            foreach ($matches[1] as $methodName) {
                $this->{'setup' . $methodName . 'Routes'}($segment, $routeName, $controller);
            }
        }
    }

    /**
     * @param $type
     *
     * @return string
     */
    private function getRequestClass($type, $fieldsFind = null)
    {
        $type = ucfirst($type);
        $requestClass = '\App\Containers\\'
            . $this->getContainerAndClassName($this->model)['containerName']
            . '\UI\WEB\Requests\\'
            . ($type)
            . $this->getContainerAndClassName($this->model)['className']
            . ($fieldsFind ? 'By' . ucfirst($fieldsFind) : null)
            . 'Request';

        if (!class_exists($requestClass)) {
            throw new \InvalidArgumentException("Invalid class request type: $type. Request Syntax: " . ($type) . "{$this->getContainerAndClassName($this->model)['className']}" . ($fieldsFind ? 'By' . ucfirst($fieldsFind) : null) . "Request");
        }

        return $requestClass;
    }

    /**
     * @return array
     */
    protected function getRequests()
    {
        $request = [];
        foreach ($this->action as $value) {
            if (isset($this->request[$value])) {
                $request[$value] = $this->request[$value];
            } elseif ($value === 'find') {
                foreach ($this->fieldsFind as $key => $fieldsFind) {
                    $request['findBy' . ucfirst($fieldsFind)] = self::getRequestClass('find', $this->fieldsFind[$key]);
                }
            } else {
                $request[$value] = self::getRequestClass($value);
            }
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
            $className = end($parts);

            return [
                'containerName' => $containerName,
                'className' => $className
            ];
        }
        return [];
    }

    /**
     * Appends custom variables.
     *
     * @var array $customIndexVariables [Role::class => Request::class, ...]
     *
     * @return array Returns an array of custom variables.
     */
    public function appendCustomVariables($actionClass)
    {
        $custom = [];
        foreach ($this->customIndexVariables as $key => $value) {
            $customRequest = resolve($value);

            $repository = '\App\Containers\\' . $this->getContainerAndClassName($key)['containerName'] . '\Data\Repositories\\' . $this->getContainerAndClassName($key)['className'] . 'Repository';
            $collection = App::make($actionClass)->run($repository, new DataTransporter($customRequest));

            $custom[$this->getContainerAndClassName($key)['className']] = $collection;
        }

        return $custom;
    }


    /**
     * Retrieves all items.
     *
     * @return \Illuminate\Contracts\View\View The view that displays the items.
     */
    public function index()
    {
        $request = resolve($this->request['getAll']);

        $crud = $this->crud;

        $items = App::make(GetAllItemAction::class)->run($this->repository, new DataTransporter($request));

        $customs = [];
        if (!empty($this->customIndexVariables)) {

            $customs = $this->appendCustomVariables(GetAllItemAction::class);
        }

        return view($this->views['list'], compact(['crud']));
    }

    public function search()
    {
        $totalRows = $this->crud->model->count();

        // Get the original request
        $originalRequest = request();

        $draw = request()->input('draw');

        $orderBy = request()->input('order') ? request()->input('columns')[request()->input('order')[0]['column']]['data'] : 'id';

        $sortedBy = request()->input('order') ? request()->input('order')[0]['dir'] : 'desc';

        $searchValue = request()->input('search')['value'];
        // $search = '';
        // if ($searchValue !== '') {
        //     foreach ($this->crud->columns as $value) {
        //         $search .= $value['name'] . ':' . $searchValue . ';';
        //     }
        // }

        // $search = rtrim($search, ';');

        // dump(request()->all());
        // Create a new request with the desired parameters
        $newRequest = $originalRequest->duplicate(null, [
            'page' => request()->input('start') !== 0 ? request()->input('start') / request()->input('length') + 1 : 1,
            'limit' => request()->input('length') !== '-1' ? request()->input('length') : $totalRows,
            'orderBy' => $orderBy,
            'sortedBy' => $sortedBy,
            'search' => $searchValue,
        ]);

        // Replace the original request with the new one
        request()->replace($newRequest->input());

        $items = App::make(GetAllItemAction::class)->run($this->repository, new DataTransporter($newRequest->all()));

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $items->total(),
            'recordsFiltered' => $items->total(),
            'data' => $items->toArray()['data'],
        ]);
    }

    //TODO: Ongoing construction
    // public function search()
    // {
    //     $this->crud->hasAccessOrFail('list');

    //     $this->crud->applyUnappliedFilters();

    //     $totalRows = $this->crud->model->count();
    //     $filteredRows = $this->crud->query->toBase()->getCountForPagination();
    //     $startIndex = request()->input('start') ?: 0;
    //     // if a search term was present
    //     if (request()->input('search') && request()->input('search')['value']) {
    //         // filter the results accordingly
    //         $this->crud->applySearchTerm(request()->input('search')['value']);
    //         // recalculate the number of filtered rows
    //         $filteredRows = $this->crud->count();
    //     }

    //     // start the results according to the datatables pagination
    //     if (request()->input('start')) {
    //         $this->crud->skip((int) request()->input('start'));
    //     }
    //     // limit the number of results according to the datatables pagination
    //     if (request()->input('length')) {
    //         $this->crud->take((int) request()->input('length'));
    //     }
    //     // overwrite any order set in the setup() method with the datatables order
    //     if (request()->input('order')) {
    //         // clear any past orderBy rules
    //         $this->crud->query->getQuery()->orders = null;
    //         foreach ((array) request()->input('order') as $order) {
    //             $column_number = (int) $order['column'];
    //             $column_direction = (strtolower((string) $order['dir']) == 'asc' ? 'ASC' : 'DESC');
    //             $column = $this->crud->findColumnById($column_number);
    //             if ($column['tableColumn'] && !isset($column['orderLogic'])) {
    //                 // apply the current orderBy rules
    //                 $this->crud->orderByWithPrefix($column['name'], $column_direction);
    //             }

    //             // check for custom order logic in the column definition
    //             if (isset($column['orderLogic'])) {
    //                 $this->crud->customOrderBy($column, $column_direction);
    //             }
    //         }
    //     }

    //     // show newest items first, by default (if no order has been set for the primary column)
    //     // if there was no order set, this will be the only one
    //     // if there was an order set, this will be the last one (after all others were applied)
    //     // Note to self: `toBase()` returns also the orders contained in global scopes, while `getQuery()` don't.
    //     $orderBy = $this->crud->query->toBase()->orders;
    //     $table = $this->crud->model->getTable();
    //     $key = $this->crud->model->getKeyName();

    //     $hasOrderByPrimaryKey = collect($orderBy)->some(function ($item) use ($key, $table) {
    //         return (isset($item['column']) && $item['column'] === $key)
    //             || (isset($item['sql']) && str_contains($item['sql'], "$table.$key"));
    //     });

    //     if (!$hasOrderByPrimaryKey) {
    //         $this->crud->orderByWithPrefix($this->crud->model->getKeyName(), 'DESC');
    //     }

    //     $entries = $this->crud->getEntries();


    //     return $this->crud->getEntriesAsJsonForDatatables($entries, $totalRows, $filteredRows, $startIndex);
    // }

    public function show()
    {
        $callByAjax = false;
        foreach ($this->fieldsFind as $value) {
            $request = resolve($this->request['findBy' . ucfirst($value)]);
            try {
                if (!$request->$value) {
                    continue;
                }
                $entry = App::make(FindItemAction::class)->run($this->repository, $value, new DataTransporter($request));

            } catch (\Exception $e) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => $e->getMessage(),
                        'errors' => ''
                    ]);
                }
                return redirect()->back()->withErrors($e->getMessage());
            }
            if ($request->expectsJson()) {
                $callByAjax = true;
            }
        }

        $crud = $this->crud;

        if ($callByAjax) {
            return response()->json([$entry ?? [], $crud ?? []]);
        }

        return view($this->views['show'], compact(['entry', 'crud']));
    }

    public function create()
    {
        resolve($this->request['create']);

        $crud = $this->crud;

        return view($this->views['create_edit'], compact(['crud']));
    }

    public function store()
    {
        $request = resolve($this->request['store']);
        $columns = App::make($this->repository)->getModel()->getFillable();
        $table = [];
        foreach ($columns as $key => $value) {
            $table[$value] = $request->$value;
        }
        isset($table['password']) ? $table['password'] = Hash::make($table['password']) : null;

        try {
            $item = App::make(CreateItemAction::class)->run($this->repository, new DataTransporter($table));
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'data' => ''
                ]);
            }
            return redirect()->back()->withErrors($e->getMessage());

        }

        $crud = $this->crud;

        if ($request->expectsJson()) {
            return response()->json([
                'message' => '',
                'data' => [$item, $crud]
            ]);
        }

        return redirect()->back()->with(['success' => 'ngon', 'item' => $item, 'crud' => $crud]);
    }

    public function edit()
    {
        $request = resolve($this->request['edit']);

        try {
            $item = App::make(FindItemAction::class)->run($this->repository, 'id', new DataTransporter($request));
        } catch (\Exception $e) {

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'data' => ''
                ]);
            }
            return redirect()->back()->withErrors($e->getMessage());
        }

        foreach ($this->crud->fields as &$field) {
            // set the value
            if (!isset($field['value'])) {

                $field['value'] = $item->{$field['name']};
            }
        }

        // always have a hidden input for the entry id
        if (!array_key_exists('id', $this->crud->fields)) {
            $fields['id'] = [
                'name' => 'id',
                'value' => $item->id,
                'type' => 'hidden',
            ];
        }

        $crud = $this->crud;
        // dd($crud);

        return view($this->views['create_edit'], compact(['item', 'crud']));
    }

    public function update()
    {
        $request = resolve($this->request['update']);
        $columns = App::make($this->repository)->getModel()->getFillable();
        $table = [];
        foreach ($columns as $value) {
            $table[$value] = $request->$value;
        }
        isset($table['password']) ? $table['password'] = Hash::make($table['password']) : null;

        try {

            $item = App::make(UpdateItemAction::class)->run($this->repository, $request->id, new DataTransporter($table));
        } catch (\Exception $e) {

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'data' => ''
                ]);
            }
            return redirect()->back()->withErrors($e->getMessage());
        }

        $crud = $this->crud;

        if ($request->expectsJson()) {
            return response()->json([
                'message' => '',
                'data' => [$item, $crud]
            ]);
        }
        return redirect()->back()->with(['success' => '', 'item' => $item, 'crud' => $crud]);
    }

    public function delete()
    {
        $request = resolve($this->request['delete']);
        try {
            App::make(DeleteItemAction::class)->run($this->repository, new DataTransporter($request));

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'success' => '',
                ]);
            }

            return redirect()->back()->withErrors($e->getMessage());
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => '',
                'success' => '',
            ]);
        }

        return redirect()->back()->with(['success' => '', 'crud' => $this->crud]);
    }

    public function bulkDelete()
    {
        $request = resolve($this->request['bulkDelete']);

        $request['id'] = $request['ids'];

        try {
            App::make(DeleteItemAction::class)->run($this->repository, new DataTransporter($request));
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'success' => '',
                ]);
            }
            return redirect()->back()->withErrors($e->getMessage());
        }
        if ($request->expectsJson()) {
            return response()->json([
                'message' => '',
                'success' => '',
            ]);
        }

        return redirect()->back()->with(['success' => '', 'crud' => $this->crud]);
    }
}

?>

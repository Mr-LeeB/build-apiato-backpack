<?php
namespace App\Ship\CustomContainer\Controllers;

use Apiato\Core\Abstracts\Controllers\WebController as AbstractWebController;
use App;
use App\Containers\Clients\Models\Clients;
use App\Ship\CustomContainer\Actions\CreateItemAction;
use App\Ship\CustomContainer\Actions\DeleteItemAction;
use App\Ship\CustomContainer\Actions\FindItemAction;
use App\Ship\CustomContainer\Actions\GetAllItemAction;
use App\Ship\CustomContainer\Actions\UpdateItemAction;
use App\Ship\Transporters\DataTransporter;
use Hash;
use Illuminate\Support\Str;

/**
 * Undocumented class.
 */
class WebCrudController extends AbstractWebController
{
    protected $views = [
        'list' => 'customcontainer::admin.admin_list_page',
        'create_edit' => 'customcontainer::admin.admin_create_and_edit_page',
        'show' => 'customcontainer::admin.admin_show_page'
    ];

    protected $model = Clients::class;

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
        'store',
        'edit',
        'update',
        'delete',
        'bulkDelete',
        'find',
        'getAll',
    ];

    protected $fieldsFind = [
        'id',
    ];

    protected $repository;

    protected $request = [];

    protected $customIndexVariables = [];

    /**
     * Constructs a new instance of the class.
     *
     * @throws \InvalidArgumentException if an invalid action type is provided
     * @throws \InvalidArgumentException if an invalid request type is provided
     */
    public function __construct()
    {

        if ($this->model === null) {
            throw new \InvalidArgumentException("Model is not set");
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
        //Screen $request
        if (!empty($this->request)) {
            foreach ($this->request as $key => $value) {
                if (!in_array($key, $this->acceptAction)) {
                    throw new \InvalidArgumentException("Invalid request type: $key");
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


        // ---------------------------
        // Create the CrudPanel object
        // ---------------------------
        // Used by developers inside their ProductCrudControllers as
        // $this->crud or using the CRUD facade.
        //
        // It's done inside a middleware closure in order to have
        // the complete request inside the CrudPanel object.
        $this->middleware(function ($request, $next) {

            // $this->setupDefaults();
            // $this->setup();
            $this->setupConfigurationForCurrentOperation();

            return $next($request);
        });

        $this->request = $this->getRequests();
        $this->repository ?? $this->repository = '\App\Containers\\' . $this->getContainerAndClassName($this->model)['containerName'] . '\Data\Repositories\\' . $this->getContainerAndClassName($this->model)['className'] . 'Repository';
    }

    protected $currentOperation;

    /**
     * Get the current CRUD operation being performed.
     *
     * @return string Operation being performed in string form.
     */
    public function getCurrentOperation()
    {
        return $this->currentOperation ?? \Route::getCurrentRoute()->action['operation'] ?? null;
    }

    protected function setupConfigurationForCurrentOperation()
    {
        $operationName = $this->getCurrentOperation();
        $setupClassName = 'setup' . Str::studly($operationName) . 'Operation';
        if (method_exists($this, $setupClassName)) {
            $this->setupListOperation();
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
    private function setRequests($type, $fieldsFind = null)
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
                    $request['findBy' . ucfirst($fieldsFind)] = self::setRequests('find', $this->fieldsFind[$key]);
                }
            } else {
                $request[$value] = self::setRequests($value);
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

            $custom[$this->getContainerAndClassName($key)['className']] = $collection->toArray();
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

        $items = App::make(GetAllItemAction::class)->run($this->repository, new DataTransporter($request));

        $customs = [];
        if (!empty($this->customIndexVariables)) {

            $customs = $this->appendCustomVariables(GetAllItemAction::class);
        }

        if ($request->expectsJson()) {
            return response()->json($items);
        }

        return view($this->views['list'], compact(['items', 'customs']));
    }

    public function show()
    {
        $items = [];
        $callByAjax = false;
        foreach ($this->fieldsFind as $value) {
            $request = resolve($this->request['findBy' . ucfirst($value)]);
            try {
                if (!$request->$value) {
                    continue;
                }
                $result = App::make(FindItemAction::class)->run($this->repository, $value, new DataTransporter($request));
                $items['by' . ucfirst($value)] = [];
                foreach ($result as $item) {
                    array_push($items['by' . ucfirst($value)], $item);
                }
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
        if ($callByAjax) {
            return response()->json($items);
        }
        return view($this->views['show'], compact(['items']));
    }

    public function create()
    {
        resolve($this->request['create']);
        return view($this->views['create_edit']);
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
        if ($request->expectsJson()) {
            return response()->json([
                'message' => '',
                'data' => $item
            ]);
        }

        return view($this->views['create_edit'])->with('success', '');
    }

    public function edit()
    {
        $request = resolve($this->request['edit']);

        try {
            $item = App::make(FindItemAction::class)->run($this->repository, new DataTransporter($request));
        } catch (\Exception $e) {

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'data' => ''
                ]);
            }
            return redirect()->back()->withErrors($e->getMessage());
        }

        return view($this->views['create_edit'], compact(['item']));
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
        if ($request->expectsJson()) {
            return response()->json([
                'message' => '',
                'data' => $item
            ]);
        }
        return redirect()->back()->with(['success' => '', 'item' => $item]);
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

        return redirect()->back()->with('success', '');
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

        return redirect()->back()->with('success', '');
    }
}

?>

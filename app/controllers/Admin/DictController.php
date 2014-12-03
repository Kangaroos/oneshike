<?php

class AdminDictController extends BaseController
{
    protected $resourceView = 'admin.dicts';

    protected $model = 'Dict';

    protected $resource = 'dicts';

    protected $resourceTable = 'dicts';

    protected $resourceName = '数据字典管理';

    public function __construct()
    {
        parent::__construct();
        // 实例化资源模型
        $this->model  = App::make($this->model);
    }

    public function index()
    {
        $resource     = $this->resource;
        $resourceName = $this->resourceName;
        $resourceDesc = '';
        return View::make($this->resourceView.'.index')->with(compact('resource', 'resourceName', 'resourceDesc'));
    }

    public function dataTables(){
        $dicts = Dict::whereNotIn('code', array('USER_LEVEL'))->get();

        return Datatable::collection($dicts)
            ->showColumns("id", "code", "name", "para_code", "para_name", "para_add1", "desc", "created_at")
            ->searchColumns('code')
            ->orderColumns('created_at')
            ->setAliasMapping()
            ->make();
    }

    public function store()
    {
        $post = Input::all();

        $response = array();

        switch($post["action"]){
            case "create":
                $data = $post["data"];
                $model = $this->model;
                $response = $this->saveModel($data, $model, Dict::$rules, Dict::$validatorMessages);
                break;
            case "edit":
                $data = $post["data"];
                $model = $this->model->find($post["id"]);
                $response = $this->saveModel($data, $model, Dict::$rules, Dict::$validatorMessages);
                break;
            case "remove":
                $ids = $post["id"];
                foreach($ids as $id) {
                    $data = $this->model->find($id);
                    $data->delete();
                }
                break;
        }
        return Response::json($response);
    }
}

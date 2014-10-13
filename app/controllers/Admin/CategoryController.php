<?php

class CategoryController extends BaseController
{
    protected $resourceView = 'admin.categorys';

    protected $model = 'Category';

    protected $resource = 'categorys';

    protected $resourceTable = 'categorys';

    protected $resourceName = '分类管理';

    public function __construct()
    {
        parent::__construct();
        // 实例化资源模型
        $this->model  = App::make($this->model);
    }

    public function index()
    {
        $category = Category::where("level",1)->lists("name","code");

        $resource     = $this->resource;
        $resourceName = $this->resourceName;
        $resourceDesc = '';

        return View::make($this->resourceView.'.index')->with(compact('resource', 'resourceName', 'resourceDesc'));
    }

    public function dataTables(){
        return Datatable::collection(Category::all(array("id", "code", "parent_code", "name", "level", "add1", "desc", "created_at")))
            ->showColumns("id", "code", "parent_code", "name", "level", "add1", "desc", "created_at")
            ->searchColumns('name')
            ->orderColumns('created_at')
            ->setAliasMapping()
            ->make();
    }

    public function store()
    {
        // 获取所有表单数据.
        $post = Input::all();

        $response = array();

        switch($post["action"]){
            case "create":
                $data = $post["data"];
                $model = $this->model;
                $response = $this->saveModel($data, $model);
                break;
            case "edit":
                $data = $post["data"];
                $model = $this->model->find($post["id"]);
                $response = $this->saveModel($data, $model);
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

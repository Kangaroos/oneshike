<?php

class UserController extends BaseController
{
    protected $resourceView = 'admin.users';

    protected $model = 'User';

    protected $resource = 'users';

    protected $resourceTable = 'users';

    protected $resourceName = '用户管理';

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
        $users = User::all();
        return Datatable::collection($users)
            ->showColumns("id", "account", "signature", "nickname", "status", "level", "phone_number", "email", "portrait", "qq", "wechat", "age", "address", "last_login_time", "last_login_ip", "total_login", "created_at")
            ->addColumn('status_list',function($model){
                return Dict::where('code', 'USER_STATUS')->where('para_code', $model->status)->select('para_name as label', 'para_code as value')->first();
            })
            ->addColumn('level_list',function($model){
                return Dict::where('code', 'USER_LEVEL')->where('para_code', $model->status)->select('para_name as label', 'para_code as value')->first();
            })
            ->addSelect('status_list', function(){
                return Dict::where('code', 'USER_STATUS')->select('para_name as label', 'para_code as value')->get();
            })
            ->addSelect('level_list', function(){
                return Dict::where('code', 'USER_LEVEL')->select('para_name as label', 'para_code as value')->get();
            })
            ->searchColumns('account')
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
                $data["pwd"] = Hash::make('oneshike');
                $model = $this->model;
                $response = $this->saveModel($data, $model, User::$rules, User::$validatorMessages);
                break;
            case "edit":
                $data = $post["data"];
                $model = $this->model->find($post["id"]);
                $response = $this->saveModel($data, $model, User::$rules, User::$validatorMessages);
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

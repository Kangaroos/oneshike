<?php

class AdminUserController extends BaseController
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
            ->showColumns("id", "email", "signature", "nickname", "status", "level", "points", "phone_number", "portrait", "qq", "wechat", "age", "address", "signin_at", "signin_ip", "signin_count", "created_at")
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
                $data["password"] = Hash::make('oneshike');
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

    public function getUserLevel()
    {
        $resource     = $this->resource.'.level';
        $resourceName = '会员等级管理';
        $resourceDesc = '';
        return View::make($this->resourceView.'.level')->with(compact('resource', 'resourceName', 'resourceDesc'));
    }

    public function postUserLevelStore() {
        $post = Input::all();

        $response = array();
        $model = App::make("Dict");

        switch($post["action"]){
            case "create":
                $data = $post["data"];
                $data["code"] = "USER_LEVEL";
                $data["name"] = "会员等级";
                $response = $this->saveModel($data, $model, Dict::$rules, Dict::$validatorMessages);
                break;
            case "edit":
                $data = $post["data"];
                $data["code"] = "USER_LEVEL";
                $data["name"] = "会员等级";
                $model = $model->find($post["id"]);
                $response = $this->saveModel($data, $model, Dict::$rules, Dict::$validatorMessages);
                break;
            case "remove":
                $ids = $post["id"];
                foreach($ids as $id) {
                    $data = $model->find($id);
                    $data->delete();
                }
                break;
        }
        return Response::json($response);
    }

    public function getUserLevelDataTables() {
        $levels = Dict::where('code', 'USER_LEVEL')->get();
        return Datatable::collection($levels)
            ->showColumns("id", "code", "name", "para_code", "para_name", "para_add1", "desc", "created_at")
            ->searchColumns('para_code')
            ->orderColumns('created_at')
            ->setAliasMapping()
            ->make();
    }
}

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
//        $category = Category::select(array('categorys.id','categorys.code','categorys.parent_code', 'categorys.name', 'categorys.level','categorys.add1', 'categorys.desc', 'categorys.created_at'));

        return Datatable::collection(Category::all(array("id", "code", "parent_code", "name", "level", "add1", "desc", "created_at")))
            ->showColumns("id", "code", "parent_code", "name", "level", "add1", "desc", "created_at")
            ->searchColumns('name')
            ->orderColumns('created_at')
            ->setAliasMapping()
            ->make();
    }

    public function create()
    {
        $adviseType = find_sysbase("ADVISE_TYPE", true);
        $users = User::lists('name','id');

        return View::make($this->resourceView.'.create')->with(compact('users','adviseType'));
    }

    public function store()
    {
        // 获取所有表单数据.
        $post = Input::all();

        $response = array();

        switch($post["action"]){
            case "create":
                $data = $post["data"];
                $validator = Validator::make($data, Category::$rules, Category::$validatorMessages);

                if ($validator->passes()) {
                    // 添加资源
                    $model = $this->model;
                    $model->code = $data["code"];
                    $model->parent_code  = $data["parent_code"];
                    $model->name = $data["name"];
                    $model->level = $data["level"];
                    $model->add1 = $data["add1"];
                    $model->desc = $data["desc"];

                    if ($id = $model->save()) {
                        $data["id"] = $model->id;
                        $response["row"] = $data;
                    } else {
                        $response["error"] = "操作失败，请联系管理员";
                    }
                } else {
                    $failed = $validator->messages();
                    $messages = $failed->getMessages();
                    $keys = array_keys($messages);
                    $fieldErrors = array();
                    foreach ($keys as $key)
                    {
                        $error = array();
                        $error["name"] = $key;
                        $error["status"] = $messages[$key][0];
                        array_push($fieldErrors,$error);
                    }
                    $response["fieldErrors"] = $fieldErrors;
                }

                break;
            case "update":
                break;
            case "delete":
                break;
        }
        return Response::json($response);
    }

    public function edit($id)
    {
        $adviseType = find_sysbase("ADVISE_TYPE", true);
        $data = $this->model->find($id);
        return View::make($this->resourceView.'.edit')->with(compact('data', 'adviseType'));
    }

    public function update($id)
    {
        // 获取所有表单数据.
        $data   = Input::all();
        // 开始验证
        $validator = Validator::make($data, Advise::$rules, Advise::$validatorMessages);

        if ($validator->passes()) {

            // 更新资源
            $model = $this->model->find($id);

            $model->feedback_at = date('Y-m-d H:i:s');
            $model->admin_id = Session::get("admin")->id;
            $model->feedback = Input::get('feedback');
            $model->status = '1';

            if ($model->save()) {
                return Redirect::to("/admin/agent/advises")
                    ->with('success', '<strong>'.$this->resourceName.'更新成功。</strong>');
            } else {
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'更新失败。</strong>');
            }
        } else {
            // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }
}

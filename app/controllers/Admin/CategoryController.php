<?php

class CategoryController extends BaseController
{
    protected $resourceView = 'admin.category';

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
        $data   = Input::all();
        // 开始验证
        $validator = Validator::make($data, Advise::$rules, Advise::$validatorMessages);

        if ($validator->passes()) {
            // 添加资源
            $model = $this->model;
            $model->subject = Input::get('subject');
            $model->type  = Input::get('type');;
            $model->desc = Input::get('desc');
            $model->user_id = Input::get('user_id');
            $model->status = '0';

            if ($model->save()) {
                // 添加成功
                return Redirect::to("/admin/agent/advises")
                    ->with('success', '<strong>'.$this->resourceName.'添加成功。</strong>');
            } else {
                // 添加失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>'.$this->resourceName.'添加失败。</strong>');
            }
        } else {
            // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
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

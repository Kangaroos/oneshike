<?php

class CategoryController extends BaseController
{
    protected $resourceView = 'admin.categroy';

    protected $model = 'Categroy';

    protected $resource = 'categroys';

    protected $resourceTable = 'categroys';

    protected $resourceName = '分类管理';

    public function index()
    {
        $parentCategory = find_dict("ADVISE_TYPE", true);
        $adviseStatus = find_dict("ADVISE_STATUS", true);

        // 获取排序条件
        $orderColumn = Input::get('sort_up', Input::get('sort_down', 'created_at'));
        $direction   = Input::get('sort_up') ? 'asc' : 'desc' ;
        // 获取搜索条件
        $subject = Input::get('subject');
        $status = Input::get('status',0);
        $type = Input::get('type');
        $feedback_at = Input::get('feedback_at');
        $feedback_at_end = Input::get('feedback_at_end');

        // 构造查询语句
        $query = $this->model->orderBy($orderColumn, $direction);

        !empty($subject) AND $query->where('subject', 'like', "%{$subject}%");
        (!empty($status) OR $status == '0') AND $query->where('status', (int)$status);
        !empty($type) AND $query->where('type', $type);
        !empty($feedback_at) AND $query->where('feedback_at', '>=', date("Y-m-d", strtotime($feedback_at)));
        !empty($feedback_at_end) AND $query->where('feedback_at', '<=', date("Y-m-d", strtotime($feedback_at_end)));
        $datas = $query->paginate(15);
        return View::make($this->resourceView.'.index')->with(compact('datas','adviseType','adviseStatus'));
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

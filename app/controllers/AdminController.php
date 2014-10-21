<?php

class AdminController extends BaseController
{
    protected $resourceView = 'admin';

    protected $model = 'Admin';

    protected $resource = 'admin';

    protected $resourceTable = 'admins';

    protected $resourceName = '管理员管理';

    public function __construct()
    {
        parent::__construct();
        // 实例化资源模型
        $this->model = App::make($this->model);
    }

    /**
     * 后台首页
     * @return Response
     */
    public function getConsoleIndex()
    {
        $resource     = $this->resource;
        $resourceName = '首页';
        $resourceDesc = '';
        return View::make($this->resourceView.'.index')->with(compact('resource', 'resourceName', 'resourceDesc'));
    }

    public function getSignin()
    {
        return View::make('admin');
    }

    public function postSignin()
    {
        // 凭证
        $credentials = array('account'=>Input::get('account'), 'pwd'=>Input::get('pwd'));
        // 是否记住登录状态
        $remember = Input::get('remember-me', 0);

        // 获取所有表单数据.
        $data = Input::all();
        // 创建验证规则
        $rules = array(
            'account'    => 'required|alpha',
            'pwd' => 'required|alpha_dash|between:5,16',
        );
        // 自定义验证消息
        $messages = array(
            'account.required'      => '请输入帐号。',
            'account.alpha'         => '请输入正确的帐号，帐号必须全部由字母字符构成。',
            'password.required'   => '请输入密码。',
            'password.alpha_dash' => '密码格式不正确。',
            'password.between'    => '密码长度请保持在:min到:max位之间。',
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            $admin = $this->model;
            // 验证登录
            if ($admin->hasLogin($credentials)) {
                // 登录成功，跳回之前被拦截的页面
                $path = Session::get('url.intended', "/admin");
                if($path === '/auth/admin')
                    return Redirect::to("/admin");
                return Redirect::to($path);
            } else {
                // 登录失败，跳回
                return Redirect::back()
                    ->withInput()
                    ->with('error', '“用户”或“密码”错误，请重新登录。');
            }
        } else {
            // 验证失败，跳回
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * 动作：修改当前账号密码
     * @return Response
     */
    public function putChangePassword()
    {
        $response = array();
        // 获取所有表单数据
        $data = Input::all();
        $admin = Session::get("admin");
        // 验证旧密码
        if (! Hash::check($data['password_old'], $admin->pwd) ) {
            $response['success'] = false;
            $response['message'] = '原始密码错误';
            return Response::json($response);
        }

        // 创建验证规则
        $rules = array(
            'password' => 'alpha_dash|between:6,16|confirmed',
        );
        // 自定义验证消息
        $messages = array(
            'password.alpha_dash' => '密码格式不正确。',
            'password.between'    => '密码长度请保持在:min到:max位之间。',
            'password.confirmed'  => '两次输入的密码不一致。',
        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 更新用户
            $admin->pwd = Hash::make(Input::get('password'));
            if ($admin->save()) {
                $response['success'] = true;
                $response['message'] = '密码修改成功';
            } else {
                $response['success'] = false;
                $response['message'] = '密码修改失败';
            }
        } else {
            $response['success'] = false;
            $response['message'] = $validator->errors->first();
        }
        return Response::json($response);
    }

    public function getLogout(){
        Session::forget('admin');
        return Redirect::to("/admin");
    }

    public function dataTables(){
        $admins = Admin::all();
        return Datatable::collection($admins)
            ->showColumns("id", "account", "name", "created_at")
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
                $response = $this->saveModel($data, $model, Admin::$rules, Admin::$validatorMessages);
                break;
            case "edit":
                $data = $post["data"];
                $model = $this->model->find($post["id"]);
                $response = $this->saveModel($data, $model, Admin::$rules, Admin::$validatorMessages);
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

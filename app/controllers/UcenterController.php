<?php

require __DIR__.'/../library/CropAvatar.php';

class UCenterController extends BaseController {

    public function getIndex() {
        return View::make('ucenter');
    }

    public function getUCenterArticle() {
        $articles = DraftArticle::where('user_id', '=' , Auth::id())->where('status', '!=', '001')->orderBy('created_at', 'desc')->get();
        return View::make('ucenter.article')->with(compact('articles'));
    }

    public function getUCenterCookbook() {
        $cookbooks = array();
        return View::make('ucenter.cookbook')->with(compact('cookbooks'));
    }

    public function getUCenterLike() {
        return View::make('ucenter.like');
    }

    public function getUCenterFavorite() {
        return View::make('ucenter.favorite');
    }

    public function getUCenterBuy() {
        return View::make('ucenter.buy');
    }

    public function getChangePwd() {
        return View::make('ucenter.changepwd');
    }

    public function postChangePwd() {
        $response = array();
        // 获取所有表单数据
        $data = Input::all();
        $user = User::where('id', '=', Auth::id())->first();
        // 验证旧密码
        if (! Hash::check($data['old_password'], $user->password) ) {
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
            $user->setPasswordAttribute($data['password']);
            if ($user->save()) {
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

    public function getBasic() {
        $user = User::where('id', '=', Auth::id())->first();
        return View::make('ucenter.basic')->with(compact('user'));
    }

    public function postBasic() {
        $response = array();
        // 获取所有表单数据
        $data = Input::all();
        $user = User::where('id', '=', Auth::id())->first();

        // 创建验证规则
        $rules = array(

        );
        // 自定义验证消息
        $messages = array(

        );
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 更新用户
            $user->nickname = $data['nickname'];
            $user->phone_number = $data['phone_number'];
            $user->qq = $data['qq'];
            $user->wechat = $data['wechat'];
            $user->address = $data['address'];
            $user->signature = $data['signature'];
            if ($user->save()) {
                $response['success'] = true;
                $response['message'] = '资料更新成功';
            } else {
                $response['success'] = false;
                $response['message'] = '资料更新失败';
            }
        } else {
            $response['success'] = false;
            $response['message'] = $validator->errors->first();
        }
        return Response::json($response);
    }

    public function changeAvatar() {
        $input = Input::all();
        $rules = array(
            'avatar_file' => 'image|max:2048',
        );

        $messages = array(
            'avatar_file.image' => '请上传合法的图片格式。',
            'avatar_file.max'      => '图片的大小请控制在 2048KB 以内。',
        );

        $validation = Validator::make($input, $rules, $messages);

        if ($validation->fails())
        {
            $response['state'] = 200;
            $response['message'] = $validation->messages()->first();
            return Response::json($response);
        }

        $file = $input["avatar_file"];
        $avatar_data = $input["avatar_data"];

        if (!empty($avatar_data)) {
            $avatar_data = json_decode(stripslashes($avatar_data));
        }

        $ext = $file->guessClientExtension();  // 根据 mime 类型取得真实拓展名
        $fullname = $file->getClientOriginalName(); // 客户端文件名，包括客户端拓展名
        $avatar = "avatar".'.'.$ext;

        $user = Auth::user();

        $imgPath = 'users/'.Auth::user()->id.'/';

        if(!File::exists($imgPath))
            File::makeDirectory($imgPath,0777,true);

        $avatar_path = '/'.$imgPath.$avatar;
        $user->avatar = $avatar_path;

        $image = Image::make($file->getRealPath());
//        $image->save(public_path($user->avatar));
        $image->crop($avatar_data->width, $avatar_data->height ,$avatar_data->x, $avatar_data->y)->save(public_path($user->avatar));
        $user->save();

        $response['state'] = 200;
        $response['result'] = $user->avatar;
        return Response::json($response);
    }
}

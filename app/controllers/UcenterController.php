<?php

require __DIR__.'/../library/CropAvatar.php';

class UCenterController extends BaseController {

    public function getIndex() {
        return View::make('ucenter');
    }

    public function getUCenterArticle() {
        $articles = DraftArticle::where('user_id', '=' , Auth::user()->id)->where('status', '!=', '001')->orderBy('created_at', 'desc')->get();
        return View::make('ucenter.article')->with(compact('articles'));
    }

    public function getUCenterCookbook() {
        return View::make('ucenter.cookbook');
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

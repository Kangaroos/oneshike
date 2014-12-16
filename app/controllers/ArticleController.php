<?php

class ArticleController extends BaseController {

	public function getIndex()
	{
		return View::make('article.index');
	}

    public function getDraftCreate() {
        $article = DraftArticle::firstOrCreate(array('user_id' => Auth::user()->id, 'status' => '001'));
        return View::make('article.create')->with(compact('article'));
    }

    public function getArticleEdit($article_id) {
        $article = DraftArticle::firstOrCreate(array('user_id' => Auth::user()->id, 'id' => $article_id));
        return View::make('article.create')->with(compact('article'));
    }

    public function saveDraftCreate($article_id) {
        $input = Input::all();

        $validator = Validator::make($input, DraftArticle::$rules, DraftArticle::$validatorMessages);
        if ($validator->passes()) {
            $model = DraftArticle::where('id', '=' , $article_id)->first();

            $model->title = Input::get('title');
            $model->content = Input::get('content');

            if($model->save()) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
                $response['message'] = '保存失败。';
            }
        } else {
            $response['success'] = false;
            $response['message'] = $validator->messages()->first();
        }
        return Response::json($response);
    }

    public function publishDraftCreate($article_id) {
        $input = Input::all();

        $validator = Validator::make($input, DraftArticle::$rules, DraftArticle::$validatorMessages);
        if ($validator->passes()) {
            $model = DraftArticle::where('id', '=' , $article_id)->first();

            $model->title = Input::get('title');
            $model->status = '002';
            $model->content = Input::get('content');

            if($model->save()) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
                $response['message'] = '发布失败。';
            }
        } else {
            $response['success'] = false;
            $response['message'] = $validator->messages()->first();
        }
        return Response::json($response);
    }


    public function deleteDraftCreate($article_id) {
        $model = DraftArticle::where('id', '=' , $article_id)->first();

        if($model->delete()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['message'] = '保存失败。';
        }
        return Response::json($response);
    }

    public function postImage($article_id)
    {
        $pictureTotal = DraftArticlePicture::where('article_id','=',$article_id)->count();
        if($pictureTotal < 10) {
            $input = Input::all();
            $rules = array(
                'file' => 'image|max:2048',
            );

            $messages = array(
                'file.image' => '请上传合法的图片格式。',
                'file.max'      => '图片的大小请控制在 2048KB 以内。',
            );

            $validation = Validator::make($input, $rules, $messages);

            if ($validation->fails())
            {
                $response['success'] = false;
                $response['message'] = $validation->messages()->first();
                return Response::json($response);
            }

            $file = Input::file('file');

            $ext = $file->guessClientExtension();  // 根据 mime 类型取得真实拓展名
            $fullname = $file->getClientOriginalName(); // 客户端文件名，包括客户端拓展名
            $hashname = date('His').'-'.md5($fullname).'.'.$ext; // 哈希处理过的文件名，包括真实拓展名

            $model = App::make('DraftArticlePicture');

            $imgPath = 'users/'.Auth::user()->id.'/'.date("Ymd").'/';

            if(!File::exists($imgPath))
                File::makeDirectory($imgPath,0777,true);

            $model->article_id = $article_id;
            $model->path = '/'.$imgPath.$hashname;
            $model->thumbnail = '/'.$imgPath.'thumbnail-'.$hashname;

            // 存储不同尺寸的图片
            $image = Image::make($file->getRealPath());
            $image->save(public_path($model->path));
            $image->resize(200, 200)->save(public_path($model->thumbnail));

            $model->save();
            $response['success'] = true;
            $response['data'] = $model;
        } else {
            $response['success'] = false;
            $response['message'] = '一篇图文最多只允许上传10张图片';
        }

        return Response::json($response);
    }

    public function deleteImage($id)
    {
        $data = DraftArticlePicture::where('id','=',$id)->first();
        $path = $data->path;
        $thumbnail = $data->thumbnail;
        if($data->delete()) {
            File::delete(public_path($path));
            File::delete(public_path($thumbnail));
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['message'] = '删除失败。';
        }
        return Response::json($response);
    }

    public function postDesc($id)
    {
        $data = DraftArticlePicture::where('id','=',$id)->first();

        $data->desc = Input::get('desc');
        if($data->save()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['message'] = '更新失败。';
        }
        return Response::json($response);
    }
}

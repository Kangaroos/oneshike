<?php

class CookbookController extends BaseController {

	public function getIndex()
	{
		return View::make('cookbook.index');
	}

    public function getCookbookWaterfall() {
        $cookbooks = DB::table('cookbooks')
            ->leftJoin('users', 'users.id', '=', 'cookbooks.user_id')
            ->select('cookbooks.id', 'cookbooks.digest', 'cookbooks.cover', 'users.nickname', 'users.avatar')
            ->orderBy('cookbooks.created_at', 'desc')
            ->paginate(20);
        $cookbooks->setBaseUrl('cookbook/waterfall');

        return Response::json($cookbooks);
    }

    public function getDraftCreate() {
        $cookbook = DraftCookbook::firstOrCreate(array('user_id' => Auth::user()->id, 'status' => '001'));
        return View::make('cookbook.create')->with(compact('cookbook'));
    }

    public function getCookbookEdit($cookbook_id) {
        $cookbook = DraftCookbook::firstOrCreate(array('user_id' => Auth::user()->id, 'id' => $cookbook_id));
        return View::make('cookbook.create')->with(compact('cookbook'));
    }

    public function saveDraftCreate($cookbook_id) {
        $input = Input::all();

        $validator = Validator::make($input, DraftCookbook::$rules, DraftCookbook::$validatorMessages);
        if ($validator->passes()) {
            $model = DraftCookbook::where('id', '=' , $cookbook_id)->first();

            $model->title = Input::get('title');
            $model->desc = Input::get('desc');
            $model->difficulty = Input::get('difficulty');
            $model->taste = Input::get('taste');
            $model->use_hours = Input::get('use_hours');
            $model->tips = Input::get('tips');
            $model->award = Input::get('award');

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

    public function publishDraftCreate($cookbook_id) {
        $input = Input::all();

        $validator = Validator::make($input, DraftCookbook::$rules, DraftCookbook::$validatorMessages);
        if ($validator->passes()) {
            $model = DraftCookbook::where('id', '=' , $cookbook_id)->first();

            $model->title = Input::get('title');
            $model->desc = Input::get('desc');
            $model->difficulty = Input::get('difficulty');
            $model->taste = Input::get('taste');
            $model->use_hours = Input::get('use_hours');
            $model->tips = Input::get('tips');
            $model->award = Input::get('award');
            $model->status = '002';

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


    public function deleteDraftCreate($cookbook_id) {
        $model = DraftCookbook::where('id', '=' , $cookbook_id)->first();

        if($model->delete()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['message'] = '保存失败。';
        }
        return Response::json($response);
    }

    public function postImage($cookbook_id)
    {
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

        $model = App::make('DraftCookbookStep');

        $imgPath = 'users/'.Auth::user()->id.'/'.date("Ymd").'/';

        if(!File::exists($imgPath))
            File::makeDirectory($imgPath,0777,true);

        $model->cookbook_id = $cookbook_id;
        $model->path = '/'.$imgPath.$hashname;
        $model->thumbnail = '/'.$imgPath.'thumbnail-'.$hashname;

        // 存储不同尺寸的图片
        $image = Image::make($file->getRealPath());
        $image->save(public_path($model->path));
        $image->resize(200, 200)->save(public_path($model->thumbnail));

        $model->save();
        $response['success'] = true;
        $response['data'] = $model;

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

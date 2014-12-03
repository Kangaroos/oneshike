<?php

class AdminArticleController extends BaseController
{
    protected $resourceView = 'admin.articles';

    protected $model = 'Article';

    protected $resource = 'articles';

    protected $resourceTable = 'articles';

    protected $resourceName = '美食图文';

    public function getCheckArticle()
    {
        $resource     = $this->resource.".check";
        $resourceName = "图文审核";
        $resourceDesc = '';

        $orderColumn = Input::get('sort_up', Input::get('sort_down', 'created_at'));
        $direction   = Input::get('sort_up') ? 'asc' : 'desc' ;
        // 获取搜索条件
        $title = Input::get('title');

        // 构造查询语句
        $query = DraftArticle::where('status','002')->orderBy($orderColumn, $direction);

        !empty($title) AND $query->where('title', 'like', "%{$title}%");
        $datas = $query->paginate(15);
        return View::make($this->resourceView.'.check')->with(compact('datas', 'resource', 'resourceName', 'resourceDesc'));
    }

    public function postCheckArticle() {

        $checked = Input::get('checked');

        $draftArticle = DraftArticle::where('id', '=' , Input::get('id'))->first();

        if($checked) {
            $draftArticle->status = '003';
            $article = Article::firstOrNew(array('draft_article_id' => $draftArticle->id));
            $article->title = $draftArticle->title;
            $article->content = $draftArticle->content;
            $article->user_id = $draftArticle->user_id;
            $article->content_format = $draftArticle->content_format;
            $article->save();
            $article->pictures()->delete();
            foreach($draftArticle->pictures as $picture) {
                $articlePicture = App::make("ArticlePicture");
                $articlePicture->article_id = $article->id;
                $articlePicture->path = $picture->path;
                $articlePicture->thumbnail = $picture->thumbnail;
                $articlePicture->desc = $picture->desc;
                $article->pictures()->save($articlePicture);
            }

        } else {
            $draftArticle->status = '004';
        }

        $draftArticle->memo = Input::get('memo');

        if($draftArticle->save()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['message'] = '保存失败。';
        }
        return Response::json($response);
    }
}

<?php

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
}

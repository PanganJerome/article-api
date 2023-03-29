<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function StoreArticle(ArticleRequest $request)
    {
        $article = Article::create([
            'title_fld' => $request->title_fld,
             'detail_fld'=>   $request->detail_fld, 
             'user_id' => $request->user_id,
        ]);
  
        return response([
            'article' => $article,
            'message' => 'added successfully' 
        ]); 
    }

    public function updateArticle(ArticleRequest $request, $id)
    {
        $article = Article::find($id);
        $article -> update($request->all());
        return $article;
    }

    public function getArticle($id)
    {
        $article = Article::where('user_id', $id)->get();
  
        return $article;
    }

    public function getArticleDetail($detail_fld)
    {
        $article = Article::where('detail_fld', $detail_fld)->get();
  
        return $article;
    }

    public function delArticle($id)
    {
        return Article::destroy($id);
    }
}

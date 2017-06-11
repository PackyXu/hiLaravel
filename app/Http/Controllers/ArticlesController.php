<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$articles = Article::all();
        //published 定义文章发布的时间 在Article中 scope Published
        $articles = Article::latest()->published()->get();//将最新的数据展现在最前面。
        return view('articles.index')->with('articles',$articles);
        //return $articles;
        //return "this is new articles";

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateArticleRequest $request)
    {
        //打印传递过来的数据
        //dd($request->all());
        //1.接受post传递过来的数    $input = $request->all();
        //2.存入数据库   Article::create($input);
        //3.重定向  return redirect('/articles');
        //4.$request->get('title');
        //dd($request->get('title')); 可以得到单个传递的值

        //表单验证：validate（）
        $this->validate($request,['title'=>'required|min:4|max:30','content'=>'required|min:10|max:200','published_art'=>'required']);
        Article::create($request->all());
        //Article::create(array_merge(['user_id'=>\Auth::user()->id],$request->all()));
        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $articles = Article::findOrFail($id);
        //dd($articles); 打印调试
        //return $articles;
        if (is_null($articles)){
            abort(404);//需要关闭.evn内的debug为false，页面可以自定义。
        }
        return view('articles.show',compact('articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article = Article::findOrFail($id);
        return view('articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CreateArticleRequest $request, $id)
    {

        $article = Article::findOrFail($id);
        $article->update($request->all());

        return redirect('/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

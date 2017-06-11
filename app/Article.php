<?php
    /**
     * 在终端中执行以下命令 创建一个model
     * php artisan make:model Article
     * php artisan tinker 进入命令行交互界面
     *
     * $article= new App\Article;
        => App\Article {#691}
     *  >>> $article->title='two title';                  赋值
        => "two title"
     *  >>> $article->content='two content';              赋值
        => "two content"
     *  >>> $article->published_art=Carbon\Carbon::now(); 赋值
        => Carbon\Carbon {#693
        +"date": "2017-06-08 12:58:42.000000",
        +"timezone_type": 3,
        +"timezone": "PRC",
        }
     *  >>> $article->intro='two intro';        赋值
        => "two intro"
     *  >>> $article;               查看
        => App\Article {#691
        title: "two title",
        content: "two content",
        published_art: Carbon\Carbon {#693
        +"date": "2017-06-08 12:58:42.000000",
        +"timezone_type": 3,
        +"timezone": "PRC",
        },
        intro: "two intro",
        }
     *  >>> $article->save();           保存
        => true
     *
     *  $first = App\Article::find(2);  查找
     *
        >>> $first->title='edit';       修改
        => "edit"
        >>> $first->save();             保存
        => true
        >>> $first = App\Article::find(2);    查看
     *
     *
        $first=App\Article::where('content','new content')->get();   查询数据合集。
        $first=App\Article::where('content','new content')->first(); 只查询一条数据。
     *
     * 创建新的数据，Laravel默认不允许填充数据，可以在下面model中配置fillable，
     * 然后推出命令 执行 php artisan tinker  在执行以下命令即可。
        $article=App\Article::create([
            'title'=>'new title',
            'content'=>'content',
            'published_art'=>Carbon\Carbon::now(),
            'intro'=>'intro'
        ]);
     *
     *
     * 更新数据内容
        $article->update(['title'=>'change title']);
     *
     *
     */
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //配置数据可以填充，解决Laravel不能填充数据
    protected $fillable =['title','content','published_art','intro'];

    //自定义处理时间,函数名必须严格和字段名一致 以驼峰格式书写：set PublishedArt Attribute
    public function setPublishedArtAttribute ($date)
    {
        $this->attributes['published_art'] = Carbon::createFromFormat('Y-m-d',$date);
        //dd($this->attributes['published_art']);
    }

    //自定义文章发布时间 scope 是关键字 后面跟着是方法名
    public function scopePublished ($query)
    {
        $query->where('published_art','<=',Carbon::now());
    }

    public function user ()
    {
        return $this->belongsTo('App\User');//指定文章所属用户
    }
}

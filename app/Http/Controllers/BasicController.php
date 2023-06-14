<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Entities\Article\Articles;
use Modules\Category\Entities\Category;
class BasicController extends Controller
{
    public function article_show($id){
    	$article = Articles::select('id','title','category_id','image','slider_image','body','sefriendly','created')->with('category')->where('sefriendly',$id)->first();
 // return $article;
    	return view('pages.articles.show',compact('article'));
    }
    public function category_show($id){
    	$category = Category::where('sefriendly',$id)->first();
  
    	$articles = Articles::select('id','title','category_id','image','slider_image','body','sefriendly','created','order_num')->where('category_id',$category->id)->orderBy('order_num','asc')->paginate(10);

    	return view('pages.category.show',compact('articles','category'));
    }
}

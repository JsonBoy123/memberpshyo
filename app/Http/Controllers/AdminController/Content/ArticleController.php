<?php

namespace Modules\Admin\Http\Controllers\Content;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Admin\Entities\Article\Articles;
use Modules\Admin\Entities\Article\ArticleImages;
use Modules\Admin\Entities\Article\ArticleAttachments;
use Modules\Admin\Entities\Article\ArticlesRevisions;
use Modules\Admin\Entities\Article\ArticlesSchedules;
use Modules\Admin\Entities\Article\ArticlesStats;
use Modules\Admin\Entities\Article\ArticlesTags;
use Modules\Category\Entities\Tags;
use Modules\Category\Entities\Category;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\User;
use App\Models\Country;
use Auth;
class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Articles::with('tags')->orderBy('order_num','ASC')->get();
        $parentCategories =  Category::whereNull('parent_cat')->orderBy('order_num','ASC')->get();
        // return $articles;
        return view('admin::content.articles.index',compact('articles','parentCategories'));
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $tags = Tags::pluck('name','id');
       
        $parentCategories =  Category::whereNull('parent_cat')->orderBy('order_num','ASC')->get();
        $countries = Country::pluck('country_name','country_code');
    
        $countries->prepend('Select Country','');
        return view('admin::content.articles.create',compact('tags','parentCategories','countries'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request);
        
        if($request->hasfile('abstract_image')){
           $data['image'] = $this->abstract_image($request);
        }

        if($request->hasfile('slider_image')){
           $data['slider_image'] =  $this->slider_image($request);
        }

        if($request->hasfile('video_attachment')){
           $data['video_attachment'] = $this->video_attachment($request);
        }

        if($request->hasfile('swf_file')){
           $data['swf_file'] = $this->swf_file($request);
        }

        $articles = Articles::orderBy('order_num','asc')->get();

        if(count($articles) !=0){
            $data['order_num'] = $articles[count($articles)-1]['order_num'] +1; 
        }else{
            $data['order_num'] = 0;
        }

        $article = Articles::create($data);
        $this->tags_store($article->id,$request);
        return redirect('article/'.$article->id.'/edit')->with('success','Article created successfully');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin::content.articles.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $tags = Tags::pluck('name','id');
       
        $parentCategories =  Category::whereNull('parent_cat')->orderBy('order_num','ASC')->get();
        $countries = Country::pluck('country_name','country_code');
    
        $countries->prepend('Select Country','');

        $article = Articles::with('tags')->where('id',$id)->first();

        return view('admin::content.articles.edit',compact('tags','parentCategories','countries','article'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $article = Articles::find($id);

        if($request->hasfile('abstract_image')){
           if($article->image !=''){
                Storage::delete($article->image);
           } 
           $data['image'] = $this->abstract_image($request);
        }

        if($request->hasfile('slider_image')){
            if($article->slider_image !=''){
                Storage::delete($article->image);
            } 
            $data['slider_image'] =  $this->slider_image($request);
        }

        if($request->hasfile('video_attachment')){
            if($article->video_attachment !=''){
                Storage::delete($article->image);
            } 
            $data['video_attachment'] = $this->video_attachment($request);
        }

        if($request->hasfile('swf_file')){
            if($article->swf_file !=''){
                Storage::delete($article->image);
            } 
            $data['swf_file'] = $this->swf_file($request);
        }

        $article->update($data);

        ArticlesTags::where('article_id',$id)->delete();
        $this->tags_store($id,$request);


        return redirect()->back()->with('success','Article updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        // return $id;
        $article = Articles::find($id);
        $article->delete();
        ArticlesTags::where('article_id',$id)->delete();
        return redirect()->back()->with('success','Article deleted successfully');
    }
    public function validation($request){
        $request->validate([
            'title'         => 'required|string|max:191|min:4',
            'abstract'      => 'nullable|string',
            'image_caption' => 'nullable|string|max:191|min:1',
            'source'        => 'nullable|string|max:191|min:1',
            'source_url'    => 'nullable|string|max:191|min:1',
            'description'   => 'nullable|string', 
            'abstract_image'=> 'nullable|mimes:jpg,jpeg,png,gif', 
            'slider_image'  => 'nullable|mimes:jpg,jpeg,png,gif', 
        ]);

         $data = [
            'category_id'           => $request->parent_cat,
            'user_id'               => Auth::user()->id,
            'title'                 => $request->title,
            'body'                  => $request->body,
            'image_caption'         => $request->image_caption,
            'source'                => $request->source,
            'source_url'            => $request->source_url,
            'abstract'              => $request->abstract,
            'status'                => $request->status,
            'created'          => $request->publish_date.' '. date('H:i:s'),
            'show_comment'          => $request->show_comment,
            'show_poll'             => $request->show_poll,
            'rss_feed'              => $request->rss_feed,
            'show_author'           => $request->show_author,
            'show_abstract_image'   => $request->show_abstract_image,
            'directory_show'        => $request->directory_show,
            'directory_bname'       => $request->directory_bname,
            'directory_cname'       => $request->directory_cname,
            'directory_email'       => $request->directory_email,
            'directory_address'     => $request->directory_address,
            'directory_country'     => $request->directory_country,
            'directory_state'       => $request->directory_state,
            'directory_city'        => $request->directory_city,
            'directory_zip'         => $request->directory_zip,
            'directory_tele'        => $request->directory_tele,
            'directory_fax'         => $request->directory_fax,
            'directory_website'     => $request->directory_website,
            'sefriendly'            => $request->sefriendly,
            'sef_title'             => $request->sef_title,
            'keywords'              => $request->keywords,
            'description'           => $request->description,
        ];
        return $data;
    }
    public function tags_store($id,$request){
        if($request->tag_id !=null){
            foreach ($request->tag_id as $key => $value) {
                $tag =Tags::find($value);
                $tags = new ArticlesTags();
                $tags->tag_id = $value;
                $tags->article_id = $id;
                $tags->tags_group_id = $tag->tags_group_id;
                $tags->user_id = Auth::user()->id;
                $tags->save();
            }
        }
    }

    public function abstract_image($request){
        $abstract_file = $request->file('abstract_image');
        $abstract_filename =  time().'_'.$abstract_file->getClientOriginalName();
        $abstract_path = $abstract_file->storeAs('public/'.date('Y').'/article/images', $abstract_filename);
        return  $abstract_path;
    }
    public function slider_image($request){
        $slider_file = $request->file('slider_image');
        $slider_filename =  time().'_'.$slider_file->getClientOriginalName();
        $slider_path = $slider_file->storeAs('public/'.date('Y').'/article/sliderimages', $slider_filename);
       return $slider_path;
    }

    public function video_attachment($request){
        $video_file = $request->file('video_attachment');
        $video_filename =  time().'_'.$video_file->getClientOriginalName();
        $video_path = $video_file->storeAs('public/'.date('Y').'/article/sliderimages', $video_filename);
       
        return $video_path;
    }
    public function swf_file($request){
        $swf_file = $request->file('swf_file');
        $swf_filename =  time().'_'.$swf_file->getClientOriginalName();
        $swl_path = $swf_file->storeAs('public/'.date('Y').'/article/sliderimages', $swf_filename);
        
        return $swl_path;
    }
    public function category_update(Request $request){
        // Article::find($request->article_id)->update('');
        return "Success";
    }
    public function update_order(Request $request){
        foreach ($request->order as $order) {
            $id[] = $order['id'];
        }



        $articles = Articles::all();

        foreach ($articles as $article){
            $id = $article->id;
            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                   Articles::find($order['id'])->update(['order_num' => $order['position']]); 
                }
            }
        }

        // foreach ($articles as $task) {
        //     // $task->timestamps = false; // To disable update_at field updation
        //     $id = $task->id;

        //     foreach ($request->order as $key => $order) {
        //         // Articles::find($order['id'])->update(['order_num' => $key+1]);
        //         if ($order['id'] == $id) {
        //             $task->update(['order_num' => $key+1]);
        //         }

        //        // $al[] = $order['id'];
        //        // $al1[] = $order['position'];
        //     }
        // }
      // return $al;
        
    }
}

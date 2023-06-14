<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Modules\Category\Entities\Category;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $parentCategories =  Category::whereNull('parent_cat')->orderBy('order_num','ASC')->get();
     
        return view('category::category.index1',compact('parentCategories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $parentCategories =  Category::whereNull('parent_cat')->orderBy('order_num','ASC')->get();
        $categoryInfo = null;
        return view('category::category.create',compact('parentCategories','categoryInfo'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request);

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename =  time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('public/'.date('Y').'/abstractimages', $filename);
            $url = Storage::url(date('Y').'/abstractimages/'.$filename);
            $data['image'] = $url;
        }
        Category::create($data);
        return redirect()->back()->with('success','Category created successfully');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $categoryInfo = Category::where('sefriendly', $id)->first();


        $parentCategories =  Category::whereNull('parent_cat')->orderBy('order_num','ASC')->get();
        return view('category::category.edit',compact('parentCategories','categoryInfo'));
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
        $category =  Category::find($id);
        $category->update($data);
        return redirect()->back()->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function validation($request){
        return $request->validate([
            'category_name'     => 'required|min:2|max:50|string',
            'sefriendly'        => 'required|string',
            'parent_cat'        => 'nullable',
            'article_num'       => 'nullable|min:1|max:4|string',
            'view_subcat'       => 'required',
            'cat_cust_title'    => 'nullable',
            'cat_cust_keywords' => 'nullable',
            'cat_cust_desc'     => 'nullable',
            'image'             => 'nullable|mimes:jpeg,jpg,png'
        ]);               
    }
    public function categoriesPosition(Request $request){
        $data = $request->data;
        $ids = $request->ids;

        foreach ($ids as $key => $id) {
            Category::find($id)->update(['order_num' => $key]);
        }

        $parent_id = null;
        
        $i = 0;

        foreach ($data as $key => $value) {
            if(count($value) == '2'){
                $this->updateFunction($value['id'],$parent_id);
                $parent_id = $value['id'];

                $this->loop($value,$parent_id);
            }else{
                $parent_id = null;
              $this->updateFunction($value['id'],$parent_id);  
            }  
            $parent_id =null; 
         }
       return "success";


    }
    public function loop($value,$parent_id){
        $p = $parent_id ;
        foreach ($value['children'] as $k => $v) {
            if(count($v) == '2'){
                $this->updateFunction($v['id'],$parent_id);
                $parent_id = $v['id'];
                $this->loop($v,$parent_id);
               
            }else{
               $parent_id = $p ;
               $this->updateFunction($v['id'],$parent_id); 
            }

        }
    }
    public function updateFunction($id,$parent_id){

        Category::find($id)->update(['parent_cat' => $parent_id]);

    }

    public function create_link(){
        return view('category::links.create');
    }
    public function store_link(Request $request){
        $request->validate([
            'category_name' => 'required|min:2|max:255',
            'redirect'      => 'nullable'
        ]);
        Category::create([
            'category_name' => $request->category_name,
            'redirect' => $request->redirect,
            'type'     => 'link' 
        ]);
        return redirect()->back()->with('success','Link created successfully');
    }
    public function edit_link($id){
        $link =  Category::find($id);
        return view('category::links.edit',compact('link'));
        
    }
    public function update_link(Request $request, $id){
        $data = $request->validate([
            'category_name' => 'required|min:2|max:255',
            'redirect'      => 'nullable'
        ]);
        Category::find($id)->update($data);
        return redirect()->back()->with('success','Link updated successfully');
    }


}

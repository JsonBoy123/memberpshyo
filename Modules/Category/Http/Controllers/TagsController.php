<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\TagsGroups;
use Modules\Category\Entities\Tags;
use Modules\Category\Entities\TagsToGroups;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $topics = TagsGroups::all();
        return view('category::tags.index',compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
       
        $names = explode(',',$request->name);
        if(count($names) !=0){
            foreach ($names as $name) {
                if($name !=''){
                   Tags::create(['name' => $name,'tags_group_id' => $request->tags_group_id]);
                }
            }
        }
        $tags = Tags::where('tags_group_id',$request->tags_group_id)->get();
        return view('category::tags.tagsList',compact('tags'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

        $topic = TagsGroups::find($id);
        $tags = Tags::where('tags_group_id',$id)->get();
        return view('category::tags.tagsShow',compact('tags','topic'));

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
    public function topicsStore(Request $request){

        $data =  $request->validate([
            'name' => 'required|max:191|min:2|string',
            'url'  => 'nullable|string|max:191|min:3'
        ]);
        TagsGroups::create($data);
        return redirect()->back()->with('success','Topics added successfully');

    }
}

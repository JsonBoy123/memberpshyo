<?php

namespace Modules\Member\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Member\Entities\UserSpec;
use App\Models\Specialization;
use Auth;
use App\User;
class SpecializationController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $specialization_ids = UserSpec::select('specialization_id')->where('user_id',Auth::user()->id)->get();

        $specializations = Specialization::whereNotIn('id',$specialization_ids->toArray())->get();
        $userSpec = UserSpec::with('specializations')->where('user_id',Auth::user()->id)->get();
             
        return view('member::specialization.index',compact('specializations','userSpec'));
    }

    
    public function create()
    {
        return view('member::create');
    }

    
    public function store(Request $request)
    {        
        $spec_id = $request->spec_id;

        $user =User::find(Auth::user()->id);

        $user->specializations()->sync($spec_id);

        return 'Specialization updated successfully';
    }

   
    public function show($id)
    {
        return view('member::show');
    }

    
    public function edit($id)
    {
        return view('member::edit');
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }

    public function specialization_reason(Request $request){
       return UserSpec::where('user_id',$request->user_id)->where('specialization_id',$request->id)->first();
    }
}

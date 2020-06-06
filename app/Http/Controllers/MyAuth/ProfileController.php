<?php

namespace App\Http\Controllers\MyAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //

    public function student(){

    }

    public function update(Request $request){
        $this->validate($request,[
            'profile' => 'image|max:400'
        ]);

        $user = auth()->user();

        if($user->profile !=null){
            $curr = $user->profile;
            Storage::disk('public')->delete($curr);
        }

        $path = $request->file('profile')->store('profile','public');
        
        
        $user->profile = $path;

        $user->save();
        // Session::has();
        // Session::put();
        // Session::get();

        //$response->withCookie(cookie('key', $value));
        

        return back();
    }

    public function index(){
        return view('myauth.profile');
    }

    public function profile(User $id){
        $this->authorize('view',$id);
        return view('user.profile', [
            'user'=> $id,
        ]);
    }

    public function updateProfile(Request $request, User $id){
        
       // if(Gate::allows('update-profile', $id)){
            $this->validate($request,[
                'profile' => 'image|max:400'
            ]);
    
            $user = $id;
    
            if($user->profile !=null){
                $curr = $user->profile;
                Storage::disk('public')->delete($curr);
            }
    
            $path = $request->file('profile')->store('profile','public');
            
            
            $user->profile = $path;
    
            $user->save();
            
    
            return back();
       // }  

        return abort(403);
    }
}

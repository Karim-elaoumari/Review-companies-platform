<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        
    }
    public function updatePassword(request $request){
        $user = JWTAuth::user();
        $request->validate([
            'last_password'=>['required','min:8',function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, JWTAuth::user()->password)) {
                    $fail(__('The last Password is incorrect.'));
                }
            }],
            'new_password'=> 'required|min:8',
            'confirm_password'=> 'required|same:new_password'
        ]);
        $user->password= Hash::make($request->newPassword);
        $user->save();
        return  response()->json([
            'message'=>' Password edited successfully',
            'user'=> new UserResource($user)]);
    }
    public function updateInfo(request $request){
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'speciality'=>'required',
            'job_id'=>'required|exists:jobs,id',
        ]);
        $user = JWTAuth::user();
        if ($request->hasFile('photo')) {
            $oldImage = public_path('images/').$user->photo;
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            $image = $request->file('photo');
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path('images/'), $imageName);
            $user->photo = $imageName;
        }
        $user->first_name= $request->first_name;
        $user->last_name= $request->last_name;
        $user->speciality= $request->speciality;
        $user->job_id= $request->job_id;
        $user->save();
        return  response()->json([
            'message'=>' Profile Information Updated successfully',
            'user'=> new UserResource($user)],200);
    }
    public function updateEmail(request $request){
        $request->validate([
            'email'=>'required|unique:users,email',
            'password'=>'required|min:8'
        ]);
        if(!Hash::check($request->password, JWTAuth::user()->password)){
            return response()->json([
                'message'=>'The password is incorrect'
            ],401);
        }else{
            $user = JWTAuth::user();
            $user->email= $request->email;
            $user->email_verified_at=NULL;
            $user->update();
            // user still can use the app but when it's logout and try to login he most verify email again 
            $user->sendConfirmationEmail('Verify Email');
            return  response()->json([
                'message'=>' Email edited successfully you still have to verify your new email check your Email Box',
                'user'=> new UserResource($user)],200);

        }
        
    } 
    public function user(){
        $user = JWTAuth::user();
        return new UserResource($user);
    }
    // public function users(){
    //     $users = User::with('roles')->get();
    //     return new UserCollection($users);
    // }
    // public function showOneUser($id){
    //     $user = User::find($id);
    //     return new UserResource($user);
    // }
    // public function updateUserRole(request $request){
    //     $request->validate([
    //         'user_id' =>'required|exists:users,id',
    //         'newRole'=>'required|exists:roles,name',
    //     ]);
    //     $user  = User::with('roles')->findOrFail($request->user_id);
    //     $user->syncRoles($request->newRole);
    //     return  response()->json([
    //         'success'=>'User Role updated successfully',
    //         'user'=> new UserResource($user)],202);

    // }

}

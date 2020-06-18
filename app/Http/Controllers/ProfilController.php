<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proje;
use App\User;
use App\Firmalar;
use Auth;
use DB;
use App\Projedetay;
use App\ProjeKisiler;
use App\ProjeDosyalari;
use App\Gallery;
use App\Gorusme;
use App\Gorev;
use App\Role;
use Hash;

class ProfilController extends Controller
{
    //
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $user=User::find($id);
        $role = Role::all();
        return view('profile.profile',['page_title'=>'Profil','user'=>$user,'roles'=>$role]);
    }


    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6'
        ]);

         $input = $request->only('name', 'email', 'password','rolename');
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
            $input['api_token'] = str_random(60); //update the password
        }else{
            $input = array_except($input,array('password')); //remove password from the input array
        }

        $user = User::find($id);
        $user->update($input); //update the user info
        //delete all roles currently linked to this user
        //DB::table('role_user')->where('user_id',$id)->delete();
        //attach the new roles to the user
        $roles=DB::table('roles')->where('rolename','=',$request->input('rolename'))->get();
        DB::table('role_users')->where('user_id', '=', $id)->delete();
        DB::table('role_users')->insert(
            ['user_id' => $id, 'role_id' => $roles[0]->roleid]
        );
        

        return redirect()->intended('profile/'.$id)->with('success','Güncellendi','user',$user,'roles',$roles);

    }

}

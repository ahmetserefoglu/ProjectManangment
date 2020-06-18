<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;

use App\User;
use Hash;
use DB;
use Auth;

class UserController extends Controller
{

    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        if($id==null){

            $users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->join('roles', 'roles.id', '=', 'role_users.role_id')
            //->where('users.id',Auth::guard('api')->id())
            ->orderby('users.id','asc')
            ->get();

            $roles = Role::get();

            return compact('users','roles');
         }
        else{
            return $this->show($id);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$message='success';
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
            
        ]);

        
        $input = $request->only('name', 'email', 'password','rolename');
        $input['password'] = Hash::make($input['password']);
        $input['api_token']=str_random(60);
       
        $user = User::create($input);

        $roles=DB::table('roles')->where('rolename','=',$request->input('rolename'))->get();
        
        DB::table('role_users')->insert(
            ['user_id' => $user->id, 'role_id' => $roles[0]->id]
        );

        return response()->json(['message' => $user->id.' id li kullanıcı sisteme eklenmiştir.'], $this->successStatus);

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
        $users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->join('roles', 'roles.id', '=', 'role_users.role_id')
            ->where('users.id','=',$id)
            ->get();

        $roles=DB::table('roles')->where('id','=',$users[0]->id)->get();

        return compact('users','roles');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            ['user_id' => $id, 'role_id' => $roles[0]->id]
        );

        return response()->json(['message' => $user->id.' id li kullanıcı başarıyla güncellenmiştir.'], $this->successStatus);
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
        User::find($id)->delete();
        DB::table('role_user')->where('user_id', '=', $id)->delete();
        
        return response()->json(['message' => $id.' id li kullanıcı başarıyla silinmiştir.'], $this->successStatus);
    }
}

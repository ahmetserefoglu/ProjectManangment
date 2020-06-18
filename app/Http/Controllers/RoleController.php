<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Permission;
use DB;

class RoleController extends Controller
{

     public $successStatus = 200;

    public function roles()
    {
        return view('roles');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id=null)
    {
        if($id==null)
        {
            return Role::orderBy('roleid','asc')->get();
        }
        else
        {
            return $this->show($id);
        }
        
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::pluck('display_name','id');
        return view('rolescreate',compact('permissions')); //return the view with the list of permissions passed as an array
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'rolename' => 'required|max:255',
            'role_display_name' => 'required|max:255',
            'role_description' => 'required'
        ]);
        //create the new role
        $role = new Role();
        $role->rolename = $request->input('rolename');
        $role->role_display_name = $request->input('role_display_name');
        $role->role_description = $request->input('role_description');
        $role->save();
        //attach the selected permissions
        /*foreach ($request->input('permissions') as $key => $value) {
            $role->attachPermission($value);
        }*/
        return response()->json(['message' => $role->id.' id li kullanıcı rolü başarıyla eklenmiştir.'], $this->successStatus);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $role=DB::table('roles')
            ->where('roleid','=',$id)
            ->get();

        //$role = Role::find($id); //Find the requested role
        //Get the permissions linked to the role
       /* $permissions =
            Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$id)
            ->get();*/
        //return the view with the role info and its permissions
        // dd($role);
        return $role;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::find($id);//Find the requested role
        $permissions = Permission::get(); //get all permissions
        //Get the permissions ids linked to the role
        $rolePermissions =
//            DB::table("permission_role")
//                ->where("permission_role.role_id",$id)
//                ->pluck('permission_role.permission_id','permission_role.permission_id')
//                ->toArray();
            DB::table("permission_role")
                ->where("role_id",$id)
                ->pluck('permission_id')
                ->toArray();
        return view('rolesedit',compact('role','permissions','rolePermissions'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        /*$this->validate($request, [
            'display_name' => 'required',
            'description' => 'required',
        ]);*/
        //Find the role and update its details

       // DB::table('roles')->where('roleid', '=', $id)->delete();
        DB::table('roles')
            ->where('roleid', '=', $id)
            ->update(
            ['rolename'=>$request->input('rolename'),'role_display_name' => $request->input('role_display_name'),'role_description'=>$request->input('role_description')]
        );

            
        //$role->role_display_name = $request->input('display_name');
        //$role->role_description = $request->input('description');
        //$role->update();

        //dd($request->input('permissions') );
        //delete all permissions currently linked to this role
        /*DB::table("permission_role")->where("role_id",$id)->delete();
        //attach the new permissions to the role
        foreach ($request->input('permissions') as $key => $value) {
            $role->attachPermission($value);
        }*/
        return response()->json(['message' => $id.' id li kullanıcı rolü başarıyla güncellenmiştir.'], $this->successStatus);
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('roleid',$id)->delete();
        
        return response()->json(['message' => $id.' id li kullanıcı rolü başarıyla silinmiştir.'], $this->successStatus);

        /*return redirect()->intended('ayarlar/roles')
            ->with('success','Role deleted successfully');*/
    }
}

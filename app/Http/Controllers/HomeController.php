<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function createNewRole(){
        $role = Role::create(['name'=>'BACKEND']);
        if($role){
            echo "Create Role success";
        }echo "Create Role failed";
    }
    public function createNewPermission(){
        $permission = Permission::create(['name'=>'all']);
        if($permission){
            echo "Create a permission success";
        }echo "Create a permission failed";
    }
    public function InitFirstRole(){
        $role = Role::findById(1);
        $permission = Permission::findById(1);
        $role->givePermissionTo($permission);
        if($role){
            echo "Cấp quyền thành công";
        }else{
            echo "Cấp quyền thất bại";
        }
    }
    public function InitFirstUser(){
        $user = User::find(1);
        $role = Role::findById(1);
        if($user->assignRole($role)){
            echo "Cấp vai trò cho người dùng thành công";
        }else{
            echo "Cấp quyền cho người dùng thất bại";
        }
    }
    public function AssignPermissionFirstUser(){
        $user = User::find(1);
        $permission = Permission::findById(1);
        if($user->givePermissionTo($permission)){
            echo "Gán Quyền cho SUPER ADMIN thành công";
        }else{
            echo "Gán quyền cho người dùng thất bại";
        }
    }

    /**
     * Các phương thức quản lý Role và Permission
     * Thêm sửa xóa và cấp quyền hạn cho Role
     * Tại đây chỉ cho phép SUPER_ADMIN và có permission all can thiệp
     * */
    public function ListRoleAndPermission(){
        $role = Role::all();
        $permission = Permission::all();
        return view("admin.Users.RoleAndPermission",[
            "role"=>$role,
            "permission"=>$permission
        ]);
    }
    public function addRole(){
        return view("admin.Users.addRole");
    }
    public function addPermission(){
        return view("admin.Users.addPermission");
    }
    public function postAddRole(Request $request){
        $role = new Role();
        $this->validate($request,[
            "name"=>"required",
            'guard_name'=>"required"
        ],[
            'name.required'=>'Please enter name',
            'guard_name.required'=>'please enter guard',
        ]);
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->save();
        return redirect()->back()->with("thong_bao","Add new Role success");
    }
    public function postAddPermission(Request $request){
        $permission = new Permission();
        $this->validate($request,[
            "name"=>"required",
            'guard_name'=>"required"
        ],[
            'name.required'=>'Please enter name',
            'guard_name.required'=>'please enter guard',
        ]);
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;
        $permission->save();
        return redirect()->back()->with("thong_bao","Add new Role success");
    }
    public function updateRole($id){
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.Users.updateRole',compact('title','role','permission','rolePermissions'));
    }
    public function updatePermission($id){
        $permission = Permission::find($id);
        return view("admin.Users.updatePermission",["permission"=>$permission]);
    }
    public function postUpdateRole(Request $request,$id){
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id,
            'guard_name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name       = $request->input('name');
        $role->guard_name = $request->input('guard_name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->back()->with('success','Role updated successfully');
    }
    public function postUpdatePermission(Request $request,$id){
        $permission = Permission::find($id);
        $this->validate($request,[
            "name"=>"required",
            'guard_name'=>"required"
        ],[
            'name.required'=>'Please enter name',
            'guard_name.required'=>'please enter guard',
        ]);
        $permission->name = $request->name;
        $permission->guard_name = $request->guard_name;
        $permission->save();
        return redirect()->back()->with("thong_bao","Update a permission success");
    }

    public function deleteRole($id){
        $role = Role::find($id);
        if($role->delete()){
            return redirect()->back()->with("thong_bao","Delete a role success");
        }else{
            return redirect()->back()->with("thong_bao","Delete a role failed");
        }
    }
    public function deletePermission($id){
        $permission = Permission::find($id);
        if($permission->delete()){
            return redirect()->back()->with("thong_bao","Delete a permission success");
        }else{
            return redirect()->back()->with("thong_bao","Delete a permission failed");
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menus;
use App\Helpers\changeTitle;
use App\Repositories\Menus\MenuRepositoryInterface;
class MenuController extends Controller
{
    //
    protected $MenuRepositories;
    public function __construct(MenuRepositoryInterface $menuRepositoryInterface)
    {
       $this->MenuRepositories = $menuRepositoryInterface;
    }
    public function index(){
        $menu = $this->MenuRepositories->getAll(1000);
        return view('admin.Menus.index', compact('menu'));
    }

    public function create(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'slug'=>'required',
            'sort'=>'required'
        ]);
        $data = $request->all();
        $updateChild = $this->MenuRepositories->updateChild();
        if($this->MenuRepositories->create($data) == true && $updateChild == "success"){
            return redirect('admin/Menu/menus')->with('thong_bao','Add new menu items success');
        }else{
            return redirect('admin/Menu/menus')->with('thong_bao','Add new items failed, please check again');
        }
    }

    public function edit($id){
        $menu = $this->MenuRepositories->getAll(1000);
        $menuItems = $this->MenuRepositories->find($id);
        if($menuItems){
            return view('admin.Menus.edit', compact('menu', 'menuItems'))->render();
        }
    }
    public function update(Request $request, $id){
        $this->validate($request,[
            'name'=>'required',
            'slug'=>'required',
            'sort'=>'required'
        ]);
        $data = $request->all();
        $updateChild = $this->MenuRepositories->updateChild();
        if($this->MenuRepositories->update($data, $id) == true && $updateChild == "success"){
            return redirect('admin/Menu/menus')->with('thong_bao','Add new menu items success');
        }else{
            return redirect('admin/Menu/menus')->with('thong_bao','Add new items failed, please check again');
        }
    }

    public function delete($id){
        $delete = $this->MenuRepositories->delete($id);
        $updateChild = $this->MenuRepositories->updateChild();
        if($delete == true && $updateChild == "success"){
            return "deleted";
        }else{
            return "errors";
        }
    }

    /**
     * Ajax more function
     * Function changeTitle: param(value change)
     *
     * @@ return slug text
     */
    public function changeTitle(Request $request){
        return changeTitle($request->value);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Rattings\SeoRepositoryInterface;
use App\Repositories\Products\ProductRepositoryInterface;
use App\Repositories\Rattings\SeoEloquentRepository;

class RattingController extends Controller
{
    //
    protected $RattingRepositories;
    protected $ProductRepositories;

    public function __construct(SeoRepositoryInterface $rattingsReporitory, ProductRepositoryInterface $productReporitory)
    {
        $this->RattingRepositories = $rattingsReporitory;
        $this->ProductRepositories = $productReporitory;
    }

    /**
     * Tại đây ta xây dựng CURD một cách ngắn gọn như sau
     * index
     * show
     * update
     * delete
     * */
    public function index(){
        $Rattings = $this->RattingRepositories->getAll(30);
        return view("admin.Sliders.index",compact('Rattings'));
    }

    public function show($id){
        $Ratting = $this->RattingRepositories->find($id);
        return $Ratting;
    }

    public function update(Request $request, $id){
        $properties = $request->all(10000);
        $Rattings = $this->RattingRepositories->update($properties,$id);
        if($Rattings == true){
            return redirect()->back()->with('thong_bao','Update ratting success');
        }else{
            return redirect()->back()->with('thong_bao','Update ratting failed');
        }
    }

    public function destroy($id){
        $Ratting = $this->RattingRepositories->delete($id);
        if($Ratting == true){
            return redirect()->back()->with('thong_bao','Delete ratting success');
        }else{
            return redirect()->back()->with('thong_bao','Delete ratting failed');
        }
    }

    public function getUpdateRatting($id){
        $Ratting = $this->show($id);
        $Product = $this->ProductRepositories->getAll(10000);
        return view("admin.Sliders.update",compact('Ratting','Product'));
    }
}

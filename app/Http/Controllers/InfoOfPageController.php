<?php

namespace App\Http\Controllers;

use App\InfoOfPages;
use App\Repositories\Eloquent\RepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\InfoOfPage\InfoOfPageRepositoryInterface;
use App\Repositories\Linked\LinkedRepositoryInterface;
class InfoOfPageController extends Controller
{
    //
    protected $InfoOfPageRepository;
    protected $LinkedRepository;
    //
    public function __construct(InfoOfPageRepositoryInterface $infoOfPageReporitory, LinkedRepositoryInterface $linkedRepository){
        $this->InfoOfPageRepository = $infoOfPageReporitory;
        $this->LinkedRepository = $linkedRepository;
    }

    public function index(){
        $InfoOfPage = $this->InfoOfPageRepository->getAll(10);
        $Linked = $this->LinkedRepository->getAll(4);
        return view('admin.InfoOfPage.index',["InfoOfPage"=>$InfoOfPage,"Linked"=>$Linked]);
    }

    public function updateInfo(Request $request,$id){
        $data = $request->all();
        $this->InfoOfPageRepository->update($data,$id);
        return redirect()->back()->with("thong_bao","Update success");
    }
    public function updateLinked(Request $request,$id){
        $data = $request->all();
        $this->LinkedRepository->update($data,$id);
        return redirect()->back()->with("thong_bao","Update success");
    }
}

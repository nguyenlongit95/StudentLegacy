<?php

namespace App\Http\Controllers;

use CKSource\CKFinder\Filesystem\File\File;
use Illuminate\Http\Request;
use App\Seo;
use App\Repositories\Seo\SeoRepositoryInterface;
use App\Helpers\SeoService;
class SeoController extends Controller
{
    //
    private $SeoRepository;

    public function __construct(SeoRepositoryInterface $SeoRepository)
    {
        $this->SeoRepository = $SeoRepository;
    }

    /**
     * Tại đây ta xây dựng CURD một cách ngắn gọn như sau
     * index
     * show
     * update
     * delete
     * restore
     * */
    public function index(){
        $Seo = $this->SeoRepository->getAll(30);
        return view('admin.Seo.index', compact('Seo'));
    }

    public function show($id){
        $Seo = $this->SeoRepository->find($id);
        return view('admin.Seo.update',compact('Seo'));
    }

    public function getStore(){
        return view('admin.Seo.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            "link"=>"required|unique:seo",
            "title"=>"required",
            "keywords"=>"required",
            "description"=>"required",
        ]);
        $data = $request->all();
        $hasLink = $this->SeoRepository->hasLink($data['link']);
        if($hasLink == "none"){
            return redirect()->back()->with("errors","Errors link");
        }
        $data['checksum'] = $hasLink;
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $fileName = str_random(5) ."_". $file->getClientOriginalName();
            $extFile = $file->getClientOriginalExtension();
            if($extFile == "jpg" || $extFile == "png" || $extFile == "JPG" || $extFile == "jpeg"){
                if($file->move('upload/Seo/', $fileName)){
                    $data['avatar'] = $fileName;
                }else{
                    return redirect()->back()->with("error","Upload image failed");
                }
            }else{
                return redirect()->back()->with("error","The image is in the wrong format");
            }
        }else{
            $data['avatar'] = "";
        }
        $Seo = $this->SeoRepository->create($data);
        if($Seo == true){
            return redirect('admin/Seo/index')->with("success","Add new link success");
        }else{
            return redirect()->back()->with("error","Add new link failed");
        }
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            "title"=>"required",
            "keywords"=>"required",
            "description"=>"required",
        ]);
        $data = $request->all();
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $fileName = str_random(5) ."_". $file->getClientOriginalName();
            $extFile = $file->getClientOriginalExtension();
            if($extFile == "jpg" || $extFile == "png" || $extFile == "JPG" || $extFile == "jpeg"){
                if($file->move('upload/Seo/', $fileName)){
                    $data['avatar'] = $fileName;
                }else{
                    return redirect()->back()->with("error","Upload image failed");
                }
            }else{
                return redirect()->back()->with("error","The image is in the wrong format");
            }
        }else{
        }
        $Seo = $this->SeoRepository->update($data, $id);
        if($Seo == true){
            return redirect('admin/Seo/index')->with("success","Add new link success");
        }else{
            return redirect()->back()->with("error","Add new link failed");
        }
    }

    /**
     * Khi xóa Seo Link thì phải xóa hình ảnh của Seo Link trước
     * Sau khi xóa thành công thì mới xáo Seo Link
     * Gọi đến phương thức xóa hình ảnh tại Eloquent
     * */
    public function destroy($id){
        $Seo = Seo::find($id);
        if($Seo){
            $deleteImage = $this->SeoRepository->deleteImage($id);
            if($deleteImage == "ok"){
                $Seo->delete();
                return redirect('admin/Seo/index')->with("Delete Seo link success");
            }elseif($deleteImage == "no file"){
                $Seo->delete();
                return redirect('admin/Seo/index')->with("Delete Seo link success");
            }else{
                return redirect()->back()->with("error", "Errors Images, please check again");
            }
        }else{
            return response()->json(["errors","Cannot find data!"]);
        }
    }
}

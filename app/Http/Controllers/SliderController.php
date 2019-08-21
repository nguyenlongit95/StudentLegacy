<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Sliders\SliderRepositoryInterface;
use Illuminate\Support\Facades\File;
class SliderController extends Controller
{
    //
    protected $SliderRepository;

    public function __construct(SliderRepositoryInterface $sliderReporitory)
    {
        $this->SliderRepository = $sliderReporitory;
    }

    public function index(){
        $Sliders = $this->SliderRepository->getAll(20);
        return view('admin.Sliders.index', ['Sliders'=>$Sliders]);
    }

    public function show($id){
        $Sliders = $this->SliderRepository->find($id);
        return $Sliders;
    }

    public function getStore(){
        return view('admin.Sliders.create');
    }

    public function store(Request $request){
        if($request->hasFile("sliders")){
            $file = $request->file("sliders");
            $extFile = $file->getClientOriginalExtension();
            if($extFile == "jpg" || $extFile == "JPG" || $extFile = "jpeg"){
                $fileName = str_random(3) ."_". $file->getClientOriginalName();
                $file->move("upload/Sliders/",$fileName);
                $data = array(
                    "slogan" => $request->slogan,
                    "sliders" => $fileName
                );
                $Sliders = $this->SliderRepository->create($data);
                if($Sliders == true){
                    return redirect('admin/Slider/Sliders')->with('thong_bao','Add new item success');
                }else{
                    return redirect()->back()->with('thong_bao','Add new item failed');
                }
            }
        }else{
            return response()->json(["Errors","Cannot's fill Images"]);
        }
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $Sliders = $this->SliderRepository->update($data,$id);
        if($Sliders == true){
            return redirect()->back()->with('thong_bao','Update an item success!');
        }else{
            return redirect()->back()->with('thong_bao','Update an item failed!');
        }
    }

    public function destroy($id){
        if($this->deleteImageSliders($id) == 1){
            $Slider = $this->SliderRepository->delete($id);
            if($Slider == true){
                return redirect('admin/Slider/Sliders')->with('thong_bao','Delete an item success!');
            }else{
                return redirect('admin/Slider/Sliders')->with('thong_bao','Delete an item failed');
            }
        }else{
            return redirect('admin/Slider/Sliders')->with('thong_bao','Delete an item failed');
        }
    }

    public function deleteImageSliders($id){
        $Slider = $this->SliderRepository->find($id);
        if(file_exists("upload/Sliders/".$Slider->Sliders)){
            if(File::delete("upload/Sliders/".$Slider->Sliders)){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}

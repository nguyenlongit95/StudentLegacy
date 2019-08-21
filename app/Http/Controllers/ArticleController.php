<?php

namespace App\Http\Controllers;

use App\Article;
use App\Repositories\Eloquent\RepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Articles\ArticleRepositoryInterface;

class ArticleController extends Controller
{
    /**
     *
     * Tại đây ta gọi và sử dungj các Repository một cách đơn giản
     * Mỗi một phương thức gọi ta dùng 1 phương thức.
     *
     * */
    // Đây là biến trung gian để gọi đến Interface
    protected $ArticleRepository;
    // Phương thức khởi tạo để gọi đến interface, Tham số đầu vào chính là interface
    public function __construct(ArticleRepositoryInterface $ArticleRepository)
    {
        $this->ArticleRepository = $ArticleRepository;
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
        $Articles = $this->ArticleRepository->getAll(30);
        return view('admin.Article.index', ['Articles'=>$Articles]);
    }

    public function show($id){
        $CategoryBlogs = $this->CategoryRepository->find($id);
        return $CategoryBlogs;
    }

    public function getStore(){
        return view('admin.Article.create');
    }

    public function store(Request $request){
        if($request->hasFile("images")){
            $file = $request->file("images");
            $extFile = $file->getClientOriginalExtension();
            if($extFile == "jpg" || $extFile == "png" || $extFile == "jpeg"){
                $name = str_random(5) . $file->getClientOriginalName();
                if($file->move("upload/Articles/",$name)){
                    $data = array(
                        "title"=>$request->title,
                        "slug"=>$request->slug,
                        "info"=>$request->info,
                        "images"=>$name,
                        "details"=>$request->details,
                        "author"=>$request->author,
                        "linked"=>$request->linked,
                        "status"=>$request->status
                    );
                }else{
                    return redirect()->back()->with('thong_bao','Upload image fail, please check folder system');
                }
            }else{
                return redirect()->back()->with('thong_bao','Image false, please check extendtion file');
            }
        }else{
            return redirect()->back()->with('thong_bao','Please chose a image');
        }
        $Article = $this->ArticleRepository->create($data);
        if($Article == true){
            return redirect('admin/Article/Articles')->with('thong_bao','Add new item success');
        }else{
            return redirect()->back()->with('thong_bao','Add new item failed');
        }
    }

    public function update(Request $request, $id){
        $deleteImage = $this->ArticleRepository->deleteImage($id);
        if($request->hasFile("images")) {
            $file = $request->file("images");
            $name = str_random(3) . "_" . $file->getClientOriginalName();
            if ($file->move("upload/Articles/", $name)) {
                $data = array(
                    "title" => $request->title,
                    "slug" => $request->slug,
                    "info" => $request->info,
                    "details" => $request->details,
                    "images" => $name,
                    "author" => $request->author,
                    "linked" => $request->linked,
                    "status" => $request->status
                );
            }else{
                return redirect()->back()->with("thong_bao","Upload file fail, please check system");
            }
        }else{
            $data = array(
                "title" => $request->title,
                "slug" => $request->slug,
                "info" => $request->info,
                "details" => $request->details,
                "author" => $request->author,
                "linked" => $request->linked,
                "status" => $request->status
            );
        }
        $CategoryBlogs = $this->ArticleRepository->update($data,$id);
        if($CategoryBlogs == true){
            return redirect()->back()->with('thong_bao','Update an item success!');
        }else{
            return redirect()->back()->with('thong_bao','Update an item failed!');
        }

    }

    public function destroy($id){
        $ArticleRepository = $this->ArticleRepository->delete($id);
        $deleteImageOfArticle = $this->ArticleRepository->deleteImage($id);
        if($ArticleRepository == true && $deleteImageOfArticle == 1){
            return redirect('admin/Categories/CategoriesBlog')->with('thong_bao','Delete an item success!');
        }else{
            return redirect('admin/Categories/CategoriesBlog')->with('thong_bao','Delete an item failed');
        }
    }

    /**
     * Các phương thức mở rộng khác được viết ở đây
     * Phương thức getUpdate
     * */
    public function getUpdate($id){
        $Article = Article::findOrFail($id);
        return view('admin.Article.update',['Article'=>$Article]);
    }

    /**
     * Ajax cho Slug
     * */
    public function postAjaxSlug(Request $request){
        return changeTitle($request->Title);
    }
}


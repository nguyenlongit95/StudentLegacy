<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Blogs\BlogRepositoryInterface;

use App\Repositories\CategoryBlogs\CategoryBlogRepositoryInterface;

class BlogController extends Controller
{
    /**
     *
     * Tại đây ta gọi và sử dungj các Repository một cách đơn giản
     * Mỗi một phương thức gọi ta dùng 1 phương thức.
     *
     * */
    // Đây là biến trung gian để gọi đến Interface
    protected $BlogRepositories;
    protected $CategoryBlogs;

    // Phương thức khởi tạo để gọi đến interface, Tham số đầu vào chính là interface
    public function __construct(BlogRepositoryInterface $reporitoryBlog, CategoryBlogRepositoryInterface $repositoryCategoryBlog)
    {
        $this->BlogRepositories = $reporitoryBlog;
        $this->CategoryBlogs = $repositoryCategoryBlog;
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
        $Blogs = $this->BlogRepositories->getAll(10);
        return view('admin.Blogs.index', ['Blogs'=>$Blogs]);
    }

    public function show($id){
        $Blogs = $this->BlogRepositories->find($id);
        return $Blogs;
    }

    public function getStore(){
        $Categories = $this->getCategories();
        return view('admin.Products.create',['Categories'=>$Categories]);
    }

    public function store(Request $request){
        $data = $request->all();
        $file = $request->file("image");
        $fileExtendstion = $file->getClientOriginalExtension();
        if($fileExtendstion == "jpg" || $fileExtendstion == "JPG" || $fileExtendstion == "jpeg" || $fileExtendstion == "JPEG" || $fileExtendstion == "png"){
            $fileName = $file->getClientOriginalName();
            $Name = str_random(5) . $fileName;
            if($file->move("upload/Blogs/",$Name)){
                // Sau khi kiểm tra tất cả xong thì thêm hình ảnh tại đây
                $data['image'] = $Name;
            }else{
                return redirect('admin/Blog/Blogs')->with('thong_bao','Add new item false, move image false!');
            }
        }else{
            return redirect('admin/Blog/Blogs')->with('thong_bao','Add new item false, check image again!');
        };
        $Blogs = $this->BlogRepositories->create($data);
        if($Blogs == true){
            return redirect('admin/Blog/Blogs')->with('thong_bao','Add new item success');
        }else{
            return redirect()->back()->with('thong_bao','Add new item failed');
        }
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $Blogs = $this->BlogRepositories->update($data,$id);
        if($Blogs == true){
            return redirect()->back()->with('thong_bao','Update an item success!');
        }else{
            return redirect()->back()->with('thong_bao','Update an item failed!');
        }
    }

    /**
     * Phương thức thay đổi hình ảnh của bài viết
     * Trước khi thay đổi hình ảnh thì phải xóa hình ảnh cũ đi
     * Tham số đầu vào là id của bài viết
     * Gọi đến phương thức xóa hình ảnh tại Eloquent
     * */
    public function changeImage(Request $request,$id){
        $ImageBlog = $this->BlogRepositories->deleteImageBlog($id);
        $this->validate($request,[
           'image'=>'required'
        ],[
            'image.required'=>'Please chose a image'
        ]);
        if($ImageBlog == 1){
            // Tiến hành thêm mới hình ảnh tại đây
            $file = $request->file("image");
            $fileExtendstion = $file->getClientOriginalExtension();
            if($fileExtendstion == "jpg" || $fileExtendstion == "JPG" || $fileExtendstion == "jpeg" || $fileExtendstion == "JPEG" || $fileExtendstion == "png"){
                 $fileName = $file->getClientOriginalName();
                 $Name = str_random(5) . $fileName;
                 if($file->move("upload/Blogs/",$Name)){
                     // Sau khi kiểm tra tất cả xong thì thêm hình ảnh tại đây
                     $InsertImage = $this->BlogRepositories->insertImage($id,$Name);
                     if($InsertImage == 1){
                         return redirect("admin/Blog/updateBlog/" . $id)->with('thong_bao','Update image success');
                     }else{
                         return redirect("admin/Blog/updateBlog/" . $id)->with('thong_bao','Update image failed');
                     }
                 }else{
                     return redirect("admin/Blog/updateBlog/" . $id)->with('thong_bao','Upload image failed');
                 }
            }else{
                return redirect("admin/Blog/updateBlog/" . $id)->with('thong_bao','Wrong image format');
            }
        }else if($ImageBlog == 2){
            $file = $request->file("image");
            $fileExtendstion = $file->getClientOriginalExtension();
            if($fileExtendstion == "jpg" || $fileExtendstion == "JPG" || $fileExtendstion == "jpeg" || $fileExtendstion == "JPEG" || $fileExtendstion == "png"){
                $fileName = $file->getClientOriginalName();
                $Name = str_random(5) . $fileName;
                if($file->move("upload/Blogs/",$Name)){
                    // Sau khi kiểm tra tất cả xong thì thêm hình ảnh tại đây
                    $InsertImage = $this->BlogRepositories->insertImage($id,$Name);
                    if($InsertImage == 1){
                        return redirect("admin/Blog/updateBlog/" . $id)->with('thong_bao','Update image success');
                    }else{
                        return redirect("admin/Blog/updateBlog/" . $id)->with('thong_bao','Update image failed');
                    }
                }else{
                    return redirect("admin/Blog/updateBlog/" . $id)->with('thong_bao','Upload image failed');
                }
            }else{
                return redirect("admin/Blog/updateBlog/" . $id)->with('thong_bao','Wrong image format');
            }
        }else{
            return redirect()->back()->with('thong_bao','Cannot delete image file!');
        }
    }

    /**
     * Khi xóa Blog thì phải xóa hình ảnh của Blog trước
     * Sau khi xóa thành công thì mới xáo Blog
     * Gọi đến phương thức xóa hình ảnh tại Eloquent
     * */
    public function destroy($id){
        $deleteImage = $this->BlogRepositories->deleteImageBlog($id);
        if($deleteImage == 1){
            $deleteBlog = $this->BlogRepositories->delete($id);
            if($deleteBlog == true){
                return redirect("admin/Blog/Blogs" . $id)->with('thong_bao','Delete blogs success');
            }else{
                return redirect("admin/Blog/Blogs" . $id)->with('thong_bao','Delete blog failed');
            }
        }else if($deleteImage == 2){
            $deleteBlog = $this->BlogRepositories->delete($id);
            if($deleteBlog == true){
                return redirect("admin/Blog/Blogs" . $id)->with('thong_bao','Delete blogs success');
            }else{
                return redirect("admin/Blog/Blogs" . $id)->with('thong_bao','Delete blogs failed');
            }
        }else{
            return redirect("admin/Blog/Blogs" . $id)->with('thong_bao','Cannot delete image, please check system again');
        }
    }

    public function getAddBlogs(){
        $CategoryBlogs = $this->CategoryBlogs->getAll(10000);
        return view('admin.Blogs.create',['CategoryBlogs'=>$CategoryBlogs]);
    }
    public function getUpdateBlogs($id){
        $Blog = $this->BlogRepositories->find($id);
        $CategoryBlog = $this->CategoryBlogs->getAll(10000);
        return view('admin.Blogs.update',['Blog'=>$Blog,'CategoryBlog'=>$CategoryBlog]);
    }

    /**
     * Ajax slug
     * */
    public function ajaxSlug(Request $request){
        $slug = $this->BlogRepositories->createSlug($request->title);
        return $slug;
    }
}

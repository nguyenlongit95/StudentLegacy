<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Comments\CommentRepositoryInterface;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\Blogs\BlogRepositoryInterface;
class CommentController extends Controller
{
    protected $CommentRepository;
    protected $UserRepository;
    protected $BlogRepository;

    public function __construct(
        CommentRepositoryInterface $commentReporitory,
        UsersRepositoryInterface $userRepository,
        BlogRepositoryInterface $blogReporitory
    )
    {
        $this->CommentRepository = $commentReporitory;
        $this->UserRepository = $userRepository;
        $this->BlogRepository = $blogReporitory;
    }

    public function index(){
        $Comments = $this->CommentRepository->getAll(30);
        return view('admin.Comments.index', ['Comment'=>$Comments]);
    }

    public function show($id){
        $Comments = $this->CommentRepository->find($id);
        return $Comments;
    }

    public function getStore($id){
        $Parent_id = $this->getParentID($id);
        $Comment = $this->CommentRepository->find($id);
        return view('admin.Comments.create',['Parent_id'=>$Parent_id,"Comment"=>$Comment,"id"=>$id]);
    }

    public function store(Request $request,$id){
        $data = $request->all();
        $Comments = $this->CommentRepository->create($data);

        if($Comments == true){
            return redirect('admin/Categories/CategoriesBlog')->with('thong_bao','Add new item success');
        }else{
            return redirect()->back()->with('thong_bao','Add new item failed');
        }
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $Comments = $this->CommentRepository->update($data,$id);
        if($Comments == true){
            return redirect()->back()->with('thong_bao','Update an item success!');
        }else{
            return redirect()->back()->with('thong_bao','Update an item failed!');
        }
    }

    public function destroy($id){
        $Comments = $this->CommentRepository->delete($id);
        if($Comments == true){
            return redirect('admin/Categories/CategoriesBlog')->with('thong_bao','Delete an item success!');
        }else{
            return redirect('admin/Categories/CategoriesBlog')->with('thong_bao','Delete an item failed');
        }
    }
    public function getParentID($id){
        $Parent_id = $this->CommentRepository->getParent_id($id);
        return $Parent_id;
    }
    public function getDetails($id){
        $Comment = $this->show($id);
        $Reply = $this->CommentRepository->getReply($id);
        $idUser = $this->CommentRepository->getIdUser($id);
        $User = $this->UserRepository->find($idUser->idUser);
        $idBlog = $this->CommentRepository->getIdBlog($id);
        $Blog = $this->BlogRepository->find($idBlog->idBlog);
        return view("admin.Comments.details",['Comment'=>$Comment,'Reply'=>$Reply,'User'=>$User,'Blog'=>$Blog]);
    }
    public function updateState(Request $request, $id){
        $State = $request->State;
        $Update = $this->CommentRepository->updateState($id, $State);
        if($Update == 1){
            return redirect()->back()->with("thong_bao","Update state success");
        }else{
            return redirect()->back()->with("thong_bao","Update state failed, please check again");
        }
    }
    public function getUpdate($id){
        $Comments = $this->show($id);
        return view("admin.Comments.update",['Comments'=>$Comments]);
    }

    public function adminReply(Request $request,$id){
        echo $id;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contact\ContactRepositoryInterface;

class ContactController extends Controller
{
    //
    protected $ContactRepository;
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->ContactRepository = $contactRepository;
    }
    public function index(){
        $Contacts = $this->ContactRepository->getAll(30);
        return view("admin.Contacts.index",["Contacts"=>$Contacts]);
    }
    public function ajaxChangeContact(Request $request,$id){
        $Contact = $this->ContactRepository->changeState($id,$request->State);
        return $Contact;
    }

    public function destroy($id){
        $Contact = $this->ContactRepository->delete($id);
        if($Contact == 1){
            return redirect()->back()->with("thong_bao","Delete success");
        }else{
            return redirect()->back()->with("thong_bao","Delete fail");
        }
    }
}

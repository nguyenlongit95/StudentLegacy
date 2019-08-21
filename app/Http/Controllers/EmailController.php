<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use DB;
use Illuminate\Mail\Mailer;
use App\Repositories\Email\EmailRepositoryInterface;
use Mail;
class EmailController extends Controller
{
    //
    protected $emailRepositories;

    public $config = [
        'driver'=>'smtp',
        'host' => 'smtp.gmail.com',
        'port' => '587',
        'encryption' => 'tls',
        'sendmail' => '/usr/sbin/sendmail -bs'
    ];

    public function __construct(EmailRepositoryInterface $emailRepository)
    {
        $this->emailRepositories = $emailRepository;
    }

    public function index(){
        $email = Email::all();
        return view('admin.Email.index', compact('email'));
    }

    public function edit($id){
        $email = Email::find($id);
        if($email){
            return view('admin.Email.update', compact('email'));
        }else{
            return redirect('admin/Email/Email')->with('Errors','Cannot find email driver!');
        }
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ]);
        $email = Email::find($id);
        $email->name = $request->name;
        $email->email = $request->email;
        $email->password = $request->password;
        $email->status = 0;
        if($email->save()){
            return redirect('admin/Email/Email')->with("success","Add new email driver success");
        }else{
            return response()->json(["Errors","Add new email failed"]);
        }
    }

    public function create(){
        return view('admin.Email.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required'
        ]);
        $email = new Email();
        $email->name = $request->name;
        $email->email = $request->email;
        $email->password = $request->password;
        $email->status = 0;
        if($email->save()){
            return redirect('admin/Email/Email')->with("success","Add new email driver success");
        }else{
            return response()->json(["Errors","Add new email failed"]);
        }
    }

    public function delete($id){
        $email = Email::find($id);
        if($email){
            $email->delete();
            return redirect('admin/Email/Email')->with("errors","Delete a email driver success");
        }else{
            return response()->json(['Errors','Cannot find email']);
        }
    }

    public function settings($id){
        $email = Email::find($id);

        if($email){
            $emailList = Email::all();
            foreach($emailList as $value){
                if($value->status == 1){
                    $temp = Email::find($value->id);
                    $temp->status = 0;
                    $temp->update();
                }
            }
            $email->status = 1;
            if($email->update()){
                return redirect('admin/Email/Email')->with('thanh_cong','Email active success');
            }else{
                return response()->json(['errors','Email active errors, please check system again']);
            }
        }else{
            return response()->json('errors','Cannot find email');
        }

    }

    public function sendMail(){

        $settings = Email::where('status',1)->where('email','!=',null)->first();

        $from_email = $settings->email;
        $from_name = $settings->name;

        $sendMail = $this->emailRepositories->sendMail($from_email, $from_name);

        return $sendMail;
    }
}

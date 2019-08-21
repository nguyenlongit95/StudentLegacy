<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\Email;

use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;
use App\Email;
use Mail;
class EmailEloquentRepository extends EloquentRepository implements EmailRepositoryInterface{

    public function configEmail($id,$State)
    {
        // TODO: Implement configEmail() method.

    }

    public function sendMail($from_email, $from_name){
        // TODO: Implement sendMail() method.
        $content = view('admin.Email.mailTemplate')->render();

        $data = [
            'subject' => "Tiêu đề hộp mail",
            'content' => "Xin chào, đây là ứng dụng nền của Long Nguyễn",
            'from_email' => $from_email,
            'from_name' => $from_name,
            'to' => 'nguyenlongit95@gmail.com'
        ];
        try{
            Mail::send('admin.Email.mailTemplate', [
                'subject' => "baseapp v1",
                'content' => $content,
                'data' => $data
            ],
            function ($message) use ($data)
            {
                $message->from($data['from_email'], $data['from_name']);
                $message->to($data['to']);
                $message->subject($data['subject']);
            }
        );
        }catch(\Exception $exception){
            dd($exception);
            return response()->json(["erros",$exception]);
        }
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\Email::class;
    }
}

?>

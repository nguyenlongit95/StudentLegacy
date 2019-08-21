<?php
/*
 * Tại đây ta sẽ khai báo các phương thức có thêm của 1 đối tượng
 * Các phương thức khai báo ở đây sẽ không có trong EloquentRepository
 * Các phương thức khai báo ở đây chỉ có tác dụng trong module CategoryProducts
 * */
namespace App\Repositories\Comments;

interface CommentRepositoryInterface{
    public function getParent_id($id);
    public function getReply($id);
    public function getIdBlog($id);
    public function getIdUser($id);
    public function updateState($id,$State);
}

?>

<?php
/*
 * Tại đây ta sẽ khai báo các phương thức có thêm của 1 đối tượng
 * Các phương thức khai báo ở đây sẽ không có trong EloquentRepository
 * Các phương thức khai báo ở đây chỉ có tác dụng trong module CategoryProducts
 * */
namespace App\Repositories\Seo;

interface SeoRepositoryInterface{
    /**
     * Kiểm tra link
     * Sinh ra mã md5 của link
     * Xóa hình ảnh của module Seo
     * Phương thức getInfo
     * */
    public function hasLink($link);

    public function checkLink($link);

    public function deleteImage($id);
}

?>

<?php
/*
 * Tại đây ta sẽ khai báo các phương thức có thêm của 1 đối tượng
 * Các phương thức khai báo ở đây sẽ không có trong EloquentRepository
 * Các phương thức khai báo ở đây chỉ có tác dụng trong module CategoryProducts
 * */
namespace App\Repositories\ImageProduct;

interface ImageProductRepositoryInterface{
    /*
     * Khai báo các phương thức có đặc điểm riêng của từng Products
     * Update hình ảnh
     * Delete hình ảnh
     * Lấy thông tin hình ảnh
     * Thay đổi kích cỡ hình ảnh
    */
    public function getImages($idProduct,$numberPaginate);

    public function ResizeImage($id);
    // $id lay vao tham so id cua san pham
    public function addImage($Image, $id);
    // $id se lay vao id cua hinh anh
    public function deleteImage($id);
}

?>

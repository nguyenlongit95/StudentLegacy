<?php
/*
 * Tại đây ta sẽ khai báo các phương thức có thêm của 1 đối tượng
 * Các phương thức khai báo ở đây sẽ không có trong EloquentRepository
 * Các phương thức khai báo ở đây chỉ có tác dụng trong module CategoryProducts
 * */
namespace App\Repositories\Products;

interface ProductRepositoryInterface{
    /*
     * Khai báo các phương thức có đặc điểm riêng của từng Products
     * thêm hình ảnh mới
     * Xóa hình ảnh đã tồn tại
     * Lấy danh mục sản phẩm
     * Tìm kiếm sản phẩm
     * lấy thông tin của sản phẩm
     * Lấy hình ảnh của sản phẩm
     * Lấy lượng đánh giá sản phẩm
    */

    public function updateImage($idImage);

    public function deleteImage($idImage);

    public function getCategory();

    public function search($keySearch);

    public function getInfo($id);

    public function getImages($idProduct);
}

?>

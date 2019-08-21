<?php
/*
 * Tại đây ta sẽ khai báo các phương thức có thêm của 1 đối tượng
 * Các phương thức khai báo ở đây sẽ không có trong EloquentRepository
 * Các phương thức khai báo ở đây chỉ có tác dụng trong module CategoryProducts
 * */
namespace App\Repositories\Products;

interface CustomPropertiesRepositoryInterface
{
    public function getCustomPropertiesOfProduct($id, $numberPaginate);

    public function getCustomPropertiesValue();

    public function getAttribute();

    public function getAttributeValue($idAttribute);

    public function addAttribute($data);

    public function addAttributeProduct($data, $AttributeValue);
}
?>

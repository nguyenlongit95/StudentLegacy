<?php
namespace App\Repositories\Eloquent;

/*
 * Ta sẽ tạo ra 1 Interface tại đây
 * Interface này sẽ khai báo các phương thức chung mà tất cả các đối tượng đều sử dụng
 * Tham số đầu vào và kiểu của phương thức được định nghĩa sẵn
 * */
interface RepositoryInterface{
    /*
     * Khai báo các phương thức tại đây
     * Tham số đầu vào cũng được định nghĩa tại đây
     * */
    // Lấy tất cả các bản ghi
    public function getAll($paginate);

    // Lấy thông tin chi tiết 1 bản ghi
    public function find($id);

    // Tạo mới 1 bản ghi với tham số đầu vào là một mảng các thuộc tính của 1 đối tượng
    public function create(array $attribute);

    // update, sửa 1 bản ghi, tham số đầu vào là 1 mảng thuộc tính và id của bản ghi
    public function update(array $attribute, $id);

    // Delete, xóa 1 bản ghi với tham số đầu vào là id của bản ghi
    public function delete($id);
}

?>

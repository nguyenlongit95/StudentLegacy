<?php
namespace App\Repositories\Eloquent;
/*
 * Tại đây ta sẽ khai báo các đường dẫn(driver) cho hệ thống
 * Ta sẽ đưa ra các phương thức mà Repository nào cũng phải có
 * Tại abstract ta sẽ implements các Interface mới được tạo
 * Ta khai báo đường dẫn đến các model
 * */
abstract class EloquentRepository implements RepositoryInterface{
    // Biến _model dùng để link tới các Models
    protected $_model;

    // Tạo 1 phương thức khởi tạo để lấy link đến các model
    public function __construct(){
        $this->setModel();
    }
    // Tạo 1 abstract để lấy Model có tên getModel
    abstract public function getModel();

    // Tạo 1 phương thức để gán giá trị model, truyen dữ liệu đến phương thức getModel
    public function setModel(){
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /*
     * Tại đây ta khai báo các phương thức đã có ở bên interface
     * Tất cả đều chỉ là driver
     * */
    // Phương thức sẽ trả về giá trị: Illuminate\Database\Eloquent\Collection\Static[]
    public function getAll($paginate){
        // TODO: Implement getAll() method.
        return $this->_model->paginate($paginate);
    }

    // Phương thức lấy về 1 bản ghi rồi trả về dạng mixed
    public function find($id){
        // TODO: Implement find() method.
        $result = $this->_model->find($id);
        return $result;
    }

    // Phương thức thêm bản ghi, tham số là mảng thuộc tính của bản ghi đó
    public function create(array $attribute){
        // TODO: Implement create() method.
        $create = $this->_model->create($attribute);
        if($create){
            return true;
        }else{
            return false;
        }
    }

    // Phương thức sửa, tham số đầu vào là 1 mảng thuộc tính và id của bản ghi
    public function update(array $attribute, $id)
    {
        // TODO: Implement update() method.
        $model = $this->_model->findOrFail($id);
        $model->fill($attribute);
        if($model->save()){
            return true;
        }else{
            return false;
        }

    }

    // Phương thức xóa, trả về kiểu boolean
    public function delete($id)
    {
        // TODO: Implement delete() method.
        $result = $this->_model->find($id);
        if($result){
            if($result->delete($id)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

?>

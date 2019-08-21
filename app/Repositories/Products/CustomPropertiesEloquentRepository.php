<?php
/*
 * Tại đây ta khai báo các phương thức cụ thể cho đối tượng
 * Class này sẽ extends EloquentRepository và Implements CateogryRepositoryInterface
 * */
namespace App\Repositories\Products;

use App\CategoriesProducts;
use App\Products;
use App\ImageProducts;
use App\Rattings;
use App\Repositories\Eloquent;
use App\Repositories\Eloquent\EloquentRepository;
use App\CustomProperties;

use App\Attribute;
use App\AttributeValue;

class CustomPropertiesEloquentRepository extends EloquentRepository implements CustomPropertiesRepositoryInterface{

    /*
     * Tại đây lấy các phương thức đặc biệt khi xây dựng chức năng quản lý thuộc tính riêng của các sản phẩm
     * */
    public function getCustomPropertiesOfProduct($id, $numberPaginate)
    {
        // TODO: Implement getCustomPropertiesOfProduct() method.
        $CustomProperties = CustomProperties::where(
            "idProduct",
            "=",
            $id
        )->paginate($numberPaginate);
        return $CustomProperties;
    }
    public function getAttribute(){
        $Attribute = Attribute::all();
        return $Attribute;
    }
    public function getCustomPropertiesValue(){
        $AttributeValue = AttributeValue::all();
        return $AttributeValue;
    }

    public function getAttributeValue($idAttribute){
        $AttributeValue = AttributeValue::where(
            "idAttribute",
            "=",
            $idAttribute
        )->get();
        return $AttributeValue;
    }
    /*
    * Phương thức thêm dữ liệu cho bảng Attribute
    * @return thí obiect
    */
    public function addAttribute($data){
        if($data['attribute'] == null || $data['value'] == null){
            return null;
        }
        $Attribute = new Attribute();
        $Attribute->attribute = $data['attribute'];
        $Attribute->parent_id = $data['parent_id'];
        if($Attribute->save()){
            $AttributeValue = new AttributeValue();
            $AttributeValue->idAttribute = $Attribute->id;
            $AttributeValue->value = $data['value'];
            if($AttributeValue->save()){
                return $AttributeValue;
            }else{
                return "false";
            }
        }else{
            return "false";
        }
    }
    /*
    * Thêm thuộc tính cho sản phẩm
    */
    public function addAttributeProduct($data, $AttributeValue){
        if($data['idProduct'] == null){
            return null;
        }
        $CustomProperties = new CustomProperties();
        $CustomProperties->idProduct = $data['idProduct'];
        $CustomProperties->attribute_value_id = $AttributeValue->id;
        if($CustomProperties->save()){
            return "success";
        }else{
            return "false";
        }
    }

    /*
    * Thêm thuộc tính đã có sẵn hoặc giá trị của 1 thuộc tính đã có sẵn
    */
    public function addCustomProperties($data, $id){
        if($data['idProduct'] == null || $data['idAttribute'] == null || $data['idAttributeValue'] == null){
            return "Error value";
        }else{
            if($data['idAttribute'] != null && $data['idAttributeValue'] == null){
                /*
                * Thêm mới giá trị của 1 thuộc tính
                */
                $AttributeValue = new AttributeValue();
                $AttributeValue->idAttribute = $data['idAttribute'];
                $AttributeValue->Value = $data['Value'];
                if($AttributeValue->save()){
                    $CustomProperties = new CustomProperties();
                    $CustomProperties->idProduct = $data['idProduct'];
                    $CustomProperties->Attribute_value_id = $AttributeValue->id;
                    $CustomProperties->save();
                    return "Success";
                }else{
                    return "Error insert DB";
                }
            }else if($data['idAttribute'] != null && $data['idAttributeValue'] != null){
                /*
                * Thêm 1 thuộc tính với giá trị đã có cho sản phẩm hiện tại
                */
                if($data['Value'] != null){
                    return "Error value";
                }
                $CustomProperties = new CustomProperties();
                $CustomProperties->idProduct = $data['idProduct'];
                $CustomProperties->Attribute_value_id = $data['idAttribute'];
                $CustomProperties->save();
                return "success";
            }
        }
    }

    public function updateCustomProperties($data, $id){
        if($data['Value'] == null){
            return "Insert value of properties";
        }
        $AttributeValue = AttributeValue::find($id);
        $AttributeValue->Value = $data['Value'];
        if($AttributeValue->save()){
            return "Change properties success";
        }else{
            return "Change properties feiled";
        }
    }

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return \App\CustomProperties::class;
    }
}

?>

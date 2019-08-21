<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Repositories\Products\ProductRepositoryInterface;
use App\Repositories\ImageProduct\ImageProductRepositoryInterface;
use App\Repositories\Rattings\RattingsRepositoryInterface;
use App\Repositories\Products\CustomPropertiesRepositoryInterface;

class ProductController extends Controller
{
    /**
     *
     * Tại đây ta gọi và sử dụng các Repository một cách đơn giản
     * Mỗi một phương thức gọi ta dùng 1 phương thức.
     *
     * */
    // Đây là biến trung gian để gọi đến Interface
    protected $ProductRepository;
    protected $ImageProductRepository;
    protected $RattingRepository;
    protected $CustomProperties;
    // Phương thức khởi tạo để gọi đến interface, Tham số đầu vào chính là interface
    public function __construct(
        ProductRepositoryInterface $repositoryProduct,
        ImageProductRepositoryInterface $imageProductReporitory,
        RattingsRepositoryInterface $rattingsReporitory,
        CustomPropertiesRepositoryInterface $customPropertiesRepository
    )
    {
        $this->ProductRepository = $repositoryProduct;
        $this->ImageProductRepository = $imageProductReporitory;
        $this->RattingRepository = $rattingsReporitory;
        $this->CustomProperties = $customPropertiesRepository;
    }

    /**
     * Tại đây ta xây dựng CURD một cách ngắn gọn như sau
     * index
     * show
     * update
     * delete
     * restore
     * */
    public function index(){
        $Products = $this->ProductRepository->getAll(15);
        return view('admin.Products.index', ['Products'=>$Products]);
    }

    public function show($id){
        $Product = $this->ProductRepository->find($id);
        return $Product;
    }

    public function getStore(){
        $Categories = $this->getCategories();
        return view('admin.Products.create',['Categories'=>$Categories]);
    }

    public function store(Request $request){
        $data = $request->all();
        $Products = $this->ProductRepository->create($data);
        if($Products == true){
            return redirect('admin/Product/Products')->with('thong_bao','Add new item success');
        }else{
            return redirect()->back()->with('thong_bao','Add new item failed');
        }
    }

    public function update(Request $request, $id){

        $data = $request->all();

        $Product = $this->ProductRepository->update($data,$id);
        if($Product == true){
            return redirect()->back()->with('thong_bao','Update an item success!');
        }else{
            return redirect()->back()->with('thong_bao','Update an item failed!');
        }
    }

    public function destroy($id){
        $ImageProduct = $this->ImageProductRepository->getImages($id);
        foreach($ImageProduct as $item){
            if($item != null){
                $image = $this->deleteImage($item->id);
                switch ($image){
                    case 0:
                        return redirect()->back()->with('thong_bao','Delete Image failed');
                        break;
                    case 1:
                        $Product = $this->ProductRepository->delete($id);
                        if($Product == true){
                            return redirect('admin/Product/Products')->with('thong_bao','Delete an item success!');
                            break;
                        }else{
                            return redirect('admin/Product/Products')->with('thong_bao','Delete an item failed');
                            break;
                        }
                    case 2:
                        return redirect()->back()->with('thong_bao','Delete file image failed, please check again system');
                        break;
                    case 3:
                        return redirect()->back()->with('thong_bao','File has not exits in system!');
                        break;
                }
            }else{
                return redirect()->back()->with('thong_bao','Delete Image failed, please check again');
            }
        }
    }

    /**
     * Gọi đến các phương thức đặc biệt
     * Lấy Categories
     * Lấy Info
     * Lấy Image của sản phẩm
     * */
    public function getInfo(){
        $getInfoProduct = $this->ProductRepository->getInfo();
        return $getInfoProduct;
    }
    // Lấy Category của sản phẩm
    public function getCategories(){
        $Categories = $this->ProductRepository->getCategory();
        return $Categories;
    }
    public function getImageProduct($id){
        $ImageProduct = $this->ImageProductRepository->getImages($id,2);
        return $ImageProduct;
    }
    /**
     * Các phương thức mở rộng khác được viết ở đây
     * Phương thức getUpdate
     * */
    public function getUpdate($id){
        $showProcuct = $this->show($id);
        $getCategory = $this->getCategories();
        $ImageProduct = $this->getImageProduct($id);
        $CustomProperties = $this->CustomProperties->getCustomPropertiesOfProduct($id,2);
        $getAttribute = $this->CustomProperties->getAttribute();
        $getAttributeValue = $this->CustomProperties->getCustomPropertiesValue();
        /**
         * Tại đây sẽ lấy ra Ratting của sản phẩm
         * Tại đây sẽ lấy ra số lượng trung bình của sản phẩm
         * */
        $RattingProduct = $this->RattingRepository->getProductRatting($id);
        $StarProduct = $this->RattingRepository->getStarAVG($id);
        return view('admin.Products.update', [
            'Product'=>$showProcuct,
            'Category'=>$getCategory,
            'ImageProduct'=>$ImageProduct,
            'RattingProduct'=>$RattingProduct,
            'StarProduct'=>$StarProduct,
            'CustomProperties'=>$CustomProperties,
            "getAttribute"=>$getAttribute,
            'CustomPropertiesValue'=>$getAttributeValue
        ]);
    }

    /**
     * Lam viec voi hinh anh
     * Them
     * Sua
     * Xoa
     * */
    public function postAddImage(Request $request ,$id){
        // Upload hình ảnh tại đây
        // Hình ảnh upload sẽ được chuyển vào thư mục ../public/Product/
        $this->validate($request,[
           'ImageProduct'=>'required'
            ],[
            'ImageProduct.required'=>'Please chose a images'
        ]);
        if($request->hasFile('ImageProduct')){
            $file = $request->file('ImageProduct');
            $fileExtendtion = $file->getClientOriginalExtension();
            if($fileExtendtion == "jpg" || $fileExtendtion == "png" || $fileExtendtion == "JPG" || $fileExtendtion == "PNG" || $fileExtendtion == "jpeg"){
                $fileName = $file->getClientOriginalName();
                $Name = str_random(3) . $fileName;
                if($file->move("upload/Product/",$Name) && $this->callFunctionPostImage($Name, $id)){
                    // Sau khi lưu hình ảnh vào thư mục thì gọi dến phương thức thêm hình ảnh trong Repository
                    return redirect()->back()->with('thong_bao','Upload image success!');
                }else{
                    return redirect()->back()->with('thong_bao','Upload file failed, please check again system!');
                }
            }else{
                return redirect()->back()->with('thong_bao','The image is not formatted correctly!');
            }
        }else{
            return redirect()->back()->with('thong_bao','Please chose a images');
        }
    }
    public function getDeleteImage($id){
        $Image = $this->deleteImage($id);
        switch ($Image){
            case 0:
                return redirect()->back()->with('thong_bao','Delete Image failed');
                break;
            case 1:
                return redirect()->back()->with('thong_bao','Delete Image success');
                break;
            case 2:
                return redirect()->back()->with('thong_bao','Delete file image failed, please check again system');
                break;
            case 3:
                return redirect()->back()->with('thong_bao','File has not exits in system!');
                break;
        }
    }
    // More function: function ở đây để tách cho code của các function chính khỏi bị dài
    // Đạt đúng tiêu chuẩn của McCall: không nên để quá 3 lệnh if else trong 1 phương thức
    public function callFunctionPostImage($Image, $id){
        $AddImage = $this->ImageProductRepository->addImage($Image,$id);
        if ($AddImage == true) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteImage($id){
        // TODO: Implement deleteImage() method.
        $ImageProduct = $this->ImageProductRepository->find($id);
        if(file_exists("upload/Product/".$ImageProduct->imageproduct)){
            if(File::delete("upload/Product/".$ImageProduct->imageproduct)) {
                $deleteImage = $this->ImageProductRepository->delete($id);
                if ($deleteImage) {
                    return 1;
                } else {
                    return 0;
                }
            }else{
                return 2;
            }
        }else{
            return 3;
        }
    }

    /**
     * Route quản lý thuộc tính mở rộng của sản phẩm
     * Thêm sửa xóa
     * id của sản phẩm được truyền lên theo sản phẩm
     * */
    public function updateCustomProperties($id, Request $request){
        $data = array(
            "Value"=>$request->Value
        );
        $CustomProperties = $this->CustomProperties->updateCustomProperties($data,$id);
        return redirect()->back()->with("thong_bao",$CustomProperties);
    }
    /**
    * Khi thêm mới thì phải thêm vào 2 bảng(Attribute_value và Customproperties)
    */
    public function addCustomProperties($id, Request $request){
        $data = array(
            "idProduct"=>$id,
            "idAttribute"=>$request->idAttribute,
            "idAttributeValue"=>$request->idAttributeValue,
            "Value"=>$request->Value
        );
        $addCustomProperties = $this->CustomProperties->addCustomProperties($data, $id);
        return redirect()->back()->with("thong_bao",$addCustomProperties);
    }

    /**
    * khi thêm mới 1 thuộc tính cho toàn hệ thống
    * Thì thêm mới thuộc tính đó cho sản phẩm hiện tại luôn
    */
    public function addAttribute($id, Request $request){
        $data = array(
           "idProduct"=>$id,
           "parent_id"=>$request->parent_id,
           "attribute" => $request->attribute,
           "value" => $request->value,
        );
        $AddAttribute = $this->CustomProperties->addAttribute($data);
        if($AddAttribute == null){
            return redirect()->back()->with("thong_bao","Please enter attribute");
        }else if($AddAttribute == "false"){
            return redirect()->back()->with("thong_bao","Add attribute false, please check again!");
        }else{
            /*
            * Sau khi thêm thuộc tính cho cả hệ thống thành công thì thêm luôn thuộc tính đó cho sản phẩm hiện tại
            */
            $AddAttributeProduct = $this->CustomProperties->addAttributeProduct($data, $AddAttribute);
            if($AddAttributeProduct === "success"){
                return redirect()->back()->with("thong_bao","Add new attribute success");
            }else{
                return redirect()->back()->with("thong_bao","Add attribute false, please check again");
            }
        }
    }

    public function deleteCustomProperties($id){
        $CustomProperties = $this->CustomProperties->delete($id);
        return redirect()->back();
    }

    /**
    * More function ajax
    */
    public function getAttributeValue(Request $request){
        $AttributeValue = $this->CustomProperties->getAttributeValue($request->idAttribute);
        ?>

            <option value="">----------</option>
            <?php foreach($AttributeValue as $value){ ?>
            <option value="<?php echo $value->id; ?>"><?php echo $value->value; ?></option>
            <?php } ?>

        <?php
    }
}
